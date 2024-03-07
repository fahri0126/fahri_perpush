<?php
$page = $_SERVER["REQUEST_URI"];

$user = $_SESSION["login"]["Username"];

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <!-- <i class="fas fa-book-reader brand-image img-circle elevation-3" style="opacity: .8"></i> -->
            <img src="../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Perpustakaan Digital</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="https://ui-avatars.com/api/?name=<?= $user ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block"><?= $user ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item my-4">
                    <a href="index.php" class="nav-link  <?php if($page == '/perpustakaan/dashboard/' || $page == '/perpustakaan/dashboard/index.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="buku.php" class="nav-link <?php if($page == '/perpustakaan/dashboard/buku.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-book"></i>
                        <p>
                            Data Buku
                        </p>
                    </a>
                </li>
                
                <?php if($_SESSION['login']['Level'] == 'administrator') : ?>
                <li class="nav-item">
                    <a href="kategori.php" class="nav-link <?php if($page == '/perpustakaan/dashboard/kategori.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Data Kategori
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="peminjaman.php" class="nav-link <?php if($page == '/perpustakaan/dashboard/peminjaman.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-hand-holding"></i>
                        <p>
                            Peminjaman
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ulasan.php" class="nav-link <?php if($page == '/perpustakaan/dashboard/ulasan.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-comment-dots"></i>
                        <p>
                            Ulasan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="registrasi-petugas.php" class="nav-link <?php if($page == '/perpustakaan/dashboard/registrasi-petugas.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-user"></i>
                        <p>
                            Registrasi Petugas
                        </p>
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="laporan.php" class="nav-link <?php if($page == '/perpustakaan/dashboard/laporan.php') echo 'active' ?>">
                    <i class="nav-icon fas fa-folder-open"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../controller/logout.php" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>