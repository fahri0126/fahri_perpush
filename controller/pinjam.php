<?php
require_once "connection.php";

Class Pinjam extends Connection{
    public function do_pinjam($data){
        $user = $data["user"];
        $buku = $data["buku"];
        $tgl_pinjam = date("Y-m-d");
        $tgl_kembali = $data["tgl_kembali"];
        $status = "pinjam";

        // cek data sebelum insert (mencegah duplicate)
        $cek = mysqli_query($this->conn, "SELECT BukuID, UserID FROM peminjaman WHERE BukuID='$buku' AND UserID='$user'");
        if(mysqli_num_rows($cek) > 0){
            exit(header("location:../peminjam/detail-buku.php?id=$buku"));
        }
        
        $sql = "INSERT INTO peminjaman (UserID, BukuID, TanggalPeminjaman, TanggalPengembalian, StatusPeminjaman) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisss", $user, $buku, $tgl_pinjam, $tgl_kembali, $status);
        $stmt->execute();
        
        exit(header("location:../peminjam/detail-buku.php?id=$buku"));
    }

    public function update_status($data){
        $status = $data["status"];
        $id = $data["id_status"];

        $sql = "UPDATE peminjaman SET StatusPeminjaman=? WHERE PeminjamanID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();

        exit(header("location:../dashboard/peminjaman.php"));
    }

    public function get_data(){
        $sql = "SELECT * FROM peminjaman LEFT JOIN user ON user.UserID=peminjaman.UserID LEFT JOIN buku ON buku.BukuID=peminjaman.BukuID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = [];
        while($fetch = $result->fetch_assoc()){
            $row[] = $fetch;
        }

        return $row;
    }
    
    public function do_ulas($data){
        $user = $data["user"];
        $buku = $data["buku"];
        $ulasan = $data["ulasan"];
        $rating = $data["rating"];
        $tgl = date("Y-m-d H:i:s");
        
        $sql = "INSERT INTO ulasanbuku (UserID, BukuID, Ulasan, Rating, TanggalUlasan) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisis", $user, $buku, $ulasan, $rating, $tgl);
        $stmt->execute();

        exit(header("location:../peminjam/detail-buku.php?id=$buku"));
    }

    public function get_ulasan($id){
        $sql = "SELECT * FROM ulasanbuku LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID LEFT JOIN user ON user.UserID = ulasanbuku.UserID WHERE buku.BukuID =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = [];
        while($fetch = $result->fetch_assoc()){
            $row[] = $fetch;            
        }
        
        return $row;   
    }

    public function get_full_ulasan(){
        $sql = "SELECT * FROM ulasanbuku LEFT JOIN buku ON buku.BukuID = ulasanbuku.BukuID LEFT JOIN user ON user.UserID = ulasanbuku.UserID";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = [];
        while($fetch = $result->fetch_assoc()){
            $row[] = $fetch;            
        }
        
        return $row;   
    }

    public function update_ulasan($data){
        $user = $data["user"];
        $buku = $data["buku"];
        $ulasan = $data["ulasan"];
        $rating = $data["rating"];
        $ulasan_id = $data["id_ulasan"];

        $sql = "UPDATE ulasanbuku SET UserID=?, BukuID=?, Ulasan=?, Rating=? WHERE UlasanID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iisii", $user, $buku, $ulasan, $rating, $ulasan_id);
        $stmt->execute();
        $stmt->close();

        exit(header("location:../peminjam/detail-buku.php?id=$buku"));
    }
}