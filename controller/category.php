<?php
require_once "connection.php";

Class Category extends Connection{
    
    public function do_insert($data){
        $kategori = $data['kategori'];

        // filter duplicate
        $check = mysqli_query($this->conn, "SELECT*FROM kategoribuku WHERE NamaKategori='$kategori'");
        if(mysqli_num_rows($check) > 0){
            return false;
            exit;
        }

        // mempersiapkan query
        $sql = "INSERT INTO kategoribuku (NamaKategori) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $kategori);
        // mengeksekusi query
        $stmt->execute();

        // return $stmt->affected_rows;
        exit(header("location:../dashboard/kategori.php"));
    }

    public function get_data(){
        $sql = "SELECT*FROM kategoribuku";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = [];
        while($fetch = $result->fetch_assoc()){
            $row[] = $fetch;
        }

        return $row;

    }

    public function update($data){

        $kategori = $data['kategori'];
        $id = $data['id'];

        $sql = "UPDATE kategoribuku SET NamaKategori=? WHERE KategoriID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $kategori, $id);
        $stmt->execute();

        exit(header("location:../dashboard/kategori.php"));
    }
}