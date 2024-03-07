<?php
require_once "connection.php";
$connection = new Connection();

$id = $_GET["id"];
$buku = $_GET["buku"];

$sql = "DELETE FROM ulasanbuku WHERE UlasanID=?";
$stmt = $connection->index()->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

exit(header("location:../peminjam/detail-buku.php?id=$buku"));

