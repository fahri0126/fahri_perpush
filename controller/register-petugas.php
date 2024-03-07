<?php
require_once "connection.php";


Class Petugas extends Connection{
    public function get_data(){
        $petugas = "Petugas";
        $sql = "SELECT * FROM user WHERE Level=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $petugas);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = [];
        while($fetch = $result->fetch_assoc()){
            $row[] = $fetch;
        }

        return $row;
    }
}