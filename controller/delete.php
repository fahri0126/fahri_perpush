<?php
require_once "connection.php";

$table = $_GET['tb'];
$field = $_GET['fd'];
$id = $_GET['id'];

$getConn = new Connection();
$conn = $getConn->index();

$sql = "DELETE FROM $table WHERE $field=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

exit(header("location:".$_SERVER["HTTP_REFERER"]));