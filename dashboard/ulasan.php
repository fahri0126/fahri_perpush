<?php
$page = "Ulasan Buku";
require_once "../controller/pinjam.php";

$_SESSION['login']['Level'] != 'administrator' ? exit(header("location:index.php?err=permission")) : '';

$pinjam = new Pinjam();


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
                    <th>Tanggal Ulasan</th>
                    <th>Ulasan</th>
                    <th>Rating</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($pinjam->get_full_ulasan() as $row) : $rating = $row["Rating"] ?>
                    <tr>
                    <td><?= $row["Username"] ?></td>
                    <td><?= $row["Judul"] ?></td>
                    <td><?= date("d, M Y", strtotime($row["TanggalUlasan"])) ?></td>
                    <td><?= $row["Ulasan"] ?></td>
                    <td>
                        <?php for($i = 1; $i <= 5; $i++) :?>
                            <?php if($i <= $rating) : ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php else: ?>
                                <i class="fas fa-star"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tanggal Ulasan</th> 
                    <th>Ulasan</th> 
                    <th>Rating</th>
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