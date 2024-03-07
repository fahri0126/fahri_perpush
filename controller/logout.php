<?php 
session_start();

$_SESSION = "";

session_destroy();


exit(header("location:../login.php"));
