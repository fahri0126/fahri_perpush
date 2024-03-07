<?php 
$page = "Laporan";

require_once "../controller/pinjam.php";
$pinjam = new Pinjam();

$row = $pinjam->get_data();

include "layout/header.php";
include "layout/navbar.php";
include "layout/sidebar.php" ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Peminjaman</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="peminjaman" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Pinjaman</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($row as $item) : ?>
                <tr>
                    <td><?= $item["Username"] ?></td>
                    <td><?= $item["Judul"] ?></td>
                    <td><?= $item["TanggalPeminjaman"] ?></td>
                    <td><?= $item["TanggalPengembalian"] ?></td>
                    <td><?= $item["StatusPeminjaman"] ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                <th>Peminjam</th>
                <th>Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Status Pinjaman</th>
                </tr>
                </tfoot>
            </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<?php include "layout/footer.php" ?>
<script>
$(function () {
    $("#peminjaman").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", {extend : "excel", className: "btn-success" }, { extend:"pdf", className: "btn-danger" }, "print"]
    }).buttons().container().appendTo('#peminjaman_wrapper .col-md-6:eq(0)');
});
</script>
