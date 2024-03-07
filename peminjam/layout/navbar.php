<?php 
require_once "../controller/connection.php";
    if(!isset($_SESSION['login'])){
        exit(header("location:../login.php"));
    }else {
        if($_SESSION['login']['Level'] != 'peminjam'){
            exit(header("location:../dashboard/index.php"));
        }
    }

$username = $_SESSION['login']['Username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Perpustakaan Digital</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition layout-top-nav bg-light">
<div class="wrapper mb-5">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
    <div class="container">
    <a href="../assets/index3.html" class="navbar-brand">
        <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bolder">Perpustakaan</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3 my-3" id="navbarCollapse">
        <ul class="navbar-nav" style="width: 100%">
            <li class="nav-item">
            <a href="index.php" class="nav-link"><i class="fas fa-home"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item">
            <a href="pinjaman.php" class="nav-link"><i class="fas fa-book-open"></i>&nbsp;Peminjaman</a>
            </li>
            <li class="nav-item">
            <a href="koleksi-pribadi.php" class="nav-link"><i class="fas fa-bookmark"></i>&nbsp;koleksi pribadi</a>
            </li>

            <li class="nav-item dropdown dropdown-hover ml-auto">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle d-flex align-items-center p-3">
                <img src="https://ui-avatars.com/api/?name=<?= $username ?>" alt="" style="height: 20px; width:20px; border-radius: 50%">&nbsp;
                <span><?= $username ?></span>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 mt-0 shadow">
                <li><a href="#" class="dropdown-item"><i class="fas fa-user-alt"></i>&nbsp;&nbsp;Profile</a></li>
                <li><a href="../controller/logout.php" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Logout</a></li>
            </ul>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <!-- <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
            </div>
        </div>
        </form> -->
    </div>

    </div>
</nav>
<!-- /.navbar -->

<!-- <div class="content-wrapper"> -->