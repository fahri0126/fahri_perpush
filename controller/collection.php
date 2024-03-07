<?php
require_once "../controller/connection.php";
$connection = new Connection();

$buku = $_POST["bukuId"];
$user = $_POST["userId"];
$status = $_POST["status"];

if($status == 2){
    mysqli_query($connection->index(), "DELETE FROM koleksipribadi WHERE BukuID='$buku' AND UserID='$user'");

    echo json_encode(2);
    return true;
}

mysqli_query($connection->index(), "INSERT INTO koleksipribadi (UserID, BukuID) VALUES ('$user', '$buku')");

echo json_encode(1);
return true;