<?php
$page = "Peminjaman";
require_once "../controller/pinjam.php";

$_SESSION['login']['Level'] != 'administrator' ? exit(header("location:index.php?err=permission")) : '';


$pinjam = new Pinjam();

if(isset($_POST["update-status"])){
    $pinjam->update_status($_POST);
}

include "layout/header.php";
include "layout/navbar.php";
include "layout/sidebar.php";



?>

<section class="content">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

        <div class="card">
            <div class="card-header">
            <h3 class="card-title">List Ulasan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pinjam->get_data() as $row) : ?>
                    <tr>
                    <td><?= $row["Username"] ?></td>
                    <td><?= $row["Judul"] ?></td>
                    <td><?= date("d, M Y", strtotime($row["TanggalPeminjaman"])) ?></td>
                    <td><?= date("d, M Y", strtotime($row["TanggalPengembalian"])) ?></td>
                    <td><?= $row["StatusPeminjaman"] ?></td>
                    <td>
                        <button type="button" class="btn btn-secondary btn-status" data-toggle="modal" data-target="#pengembalian" data-status="<?= $row["StatusPeminjaman"] ?>" data-pinjam_id="<?= $row["PeminjamanID"] ?>"><i class="fas fa-edit"></i></button>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                    <th>Aksi</th>
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

<!-- modal update -->
<div class="modal fade"  data-backdrop="static" id="pengembalian">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Update Peminjaman </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="post">
            <div class="mb-3">
                <input type="hidden" id="status_id" name="id_status">
                <select name="status" id="status" class="form-control" required>
                    <option value="kembali">kembali</option>
                    <option value="pinjam">pinjam</option>
                </select>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="update-status">Submit</button>
            </div>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal update -->

<?php include "layout/footer.php"; ?>
<script>
    $(function () {
        $('#example1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '.btn-status', function(){
            var status = $(this).attr('data-status'); 
            var id_status = $(this).attr('data-pinjam_id'); 
            $('#status_id').val(id_status);
            $('#status').val(status);
        });
    });
</script>