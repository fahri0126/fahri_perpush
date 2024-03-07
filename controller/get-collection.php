<?php
require_once "connection.php";

Class Collection extends Connection{

    public function get_data($id){
        $sql = "SELECT * FROM koleksipribadi WHERE UserID=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $stmt->get_result();

        $row = [];
        while($fetch = $stmt->fetch()){
            $row[] = $fetch;
        }
        return $row;
    }
}
