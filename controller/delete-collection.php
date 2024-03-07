<?php
require_once "connection.php";

$conn = new Connection();

$id = $_GET["id"];

$query = mysqli_query($conn->index(), "DELETE FROM koleksipribadi WHERE KoleksiID='$id'");

if($query){
    exit(header("location:" . $_SERVER['HTTP_REFERER']));
}