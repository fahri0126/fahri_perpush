<?php
require_once "connection.php";

Class Book extends Connection{
    
    public function do_insert($data, $file){
        if(!isset($_FILES["file"])){
            $fileName = NULL;
        }else{
            $maxSize = 10 * 1024 * 1024;
            $allowExtension = ["pdf"];
            $extension = strtolower(pathinfo($file['file']['name'])['extension']);

            // filter ekstensi file dan ukuran gambar
            if(!in_array($extension, $allowExtension)){
                exit(header("location:../dashboard/buku.php?error=filextension"));
            }elseif($maxSize < $file["file"]["size"]){
                exit(header("location:../dashboard/buku.php?error=filesize"));
            }

            // ganti nama file
            $fileName = uniqid().".".$extension;
            $realPath = $_FILES['file']['tmp_name'];

            // memindahkan gambar ke folder img/
            $folder = "../assets/book/file/".$fileName;
            move_uploaded_file($realPath, $folder);
        }

        // upload image
        $maxSize = 5 * 1024 * 1024;
        $allowExtension = ["jpg", "jpeg", "png", "gif"];
        $fileExtension = strtolower(pathinfo($file["img"]["name"])["extension"]);

        // filter ekstensi file dan ukuran gambar
        if(!in_array($fileExtension, $allowExtension)){
            exit(header("location:../dashboard/buku.php?error=imgextenseion"));
        }elseif($maxSize < $file["img"]["size"]){
            exit(header("location:../dashboard/buku.php?error=imgsize"));
        }
        
        // mengganti nama gambar
        $imgName = uniqid().".".$fileExtension;
        $fileTmp = $_FILES['img']['tmp_name'];
        
        // memindahkan gambar ke folder img/
        $folder = "../assets/book/img/".$imgName;
        move_uploaded_file($fileTmp, $folder);

        
        $judul = $data["judul"];
        $penulis = $data["penulis"];
        $penerbit = $data["penerbit"];
        $tgl = $data["tgl"];
        $deskripsi = $data["deskripsi"];
        $kategori = $data["kategori"];

        // STEP 1 : insert ke tabel buku
        $sql = "INSERT INTO buku (Judul, Penulis, Penerbit, TahunTerbit, Deskripsi, Image, File) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssss", $judul, $penerbit, $penulis, $tgl, $deskripsi, $imgName, $fileName);
        $stmt->execute();
        $stmt->close();

        // ambil id dari data yang baru diinput di database
        $buku = $this->conn->insert_id;
        
        // STEP 2 : insert data ke tabel kategoribuku_relasi
        if(isset($kategori)){
            $sql = "INSERT INTO kategoribuku_relasi (BukuID, KategoriID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $buku, $kategori);
            $stmt->execute();
            $stmt->close();
        }

        return true;
    }

    public function get_data() {
        $sql = "SELECT buku.*, kategoribuku.*
                FROM buku
                LEFT JOIN kategoribuku_relasi ON buku.BukuID = kategoribuku_relasi.BukuID
                LEFT JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = [];
        while($fetch = $result->fetch_assoc()){
            $row[] = $fetch;
        }

        return $row;
    }

    public function get_data_edit($id){
        $sql = "SELECT * FROM buku LEFT JOIN kategoribuku_relasi ON kategoribuku_relasi.BukuID = buku.BukuID LEFT JOIN kategoribuku ON kategoribuku.KategoriID = kategoribuku_relasi.KategoriID WHERE buku.BukuID =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;   
    }

    public function update($data){
        $judul = $data["judul"];
        $penulis = $data["penulis"];
        $penerbit = $data["penerbit"];
        $tgl = $data["tgl"];
        $deskripsi = $data["deskripsi"];
        $kategori = $data["kategori"];
        $buku = $data["id"];

        $sql = "UPDATE buku SET Judul=?, Penulis=?, Penerbit=?, TahunTerbit=?, Deskripsi=? WHERE BukuID =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssisi", $judul, $penulis, $penerbit, $tgl, $deskripsi, $buku);
        $stmt->execute();
        $stmt->close();

        // cek 
        $cek = mysqli_query($this->conn, "SELECT * FROM kategoribuku_relasi WHERE BUKUID='$buku'");
        if(mysqli_num_rows($cek) == 1){
            $sql = "UPDATE kategoribuku_relasi SET KategoriID=? WHERE BukuID=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $kategori, $buku);
            $stmt->execute();
            $stmt->close();
        }else {
            $sql = "INSERT INTO kategoribuku_relasi (BukuID, KategoriID) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ii", $buku, $kategori);
            $stmt->execute();
            $stmt->close();
        }

        exit(header("location:../dashboard/buku.php"));
        
    }

}