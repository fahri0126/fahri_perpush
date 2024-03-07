<?php
require_once "../controller/category.php";

    $category = new Category();

    if(isset($_POST['submit'])){
        $category->do_insert($_POST);
    }

    if(isset($_POST["update"])){
        $category->update($_POST);
    }

    $page = "Data Kategori";

    // Header
    include "layout/header.php";
    //Header
    
    // Navbar
    include "layout/navbar.php";
    // Navbar
    
    // Sidebar
    include "layout/sidebar.php";
    // Sidebar 
?>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">

            <div class="card">
            <div class="card-header">
                <h3 class="card-title">List Kategori</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i> Kategori</button>
                <table id="kategori" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th class="col-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($category->get_data() as $row) : ?>
                    <tr>
                        <td><?= $row["NamaKategori"] ?></td>
                        <td>
                            <a href="../controller/delete.php?tb=kategoribuku&fd=KategoriID&id=<?= $row["KategoriID"] ?>" onclick="return confirm('Hapus Kategori <?= $row['NamaKategori'] ?>')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            <button type="button" class="btn btn-secondary btn-edit" data-toggle="modal" data-target="#update" data-kategori="<?= $row["NamaKategori"] ?>" data-kategori_id="<?= $row["KategoriID"] ?>"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Kategori</th>
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

<!-- modal tambah -->
<div class="modal fade"  data-backdrop="static" id="modal-lg">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Input Data Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="post">
            <div class="mb-3">
                <input type="text" placeholder="Nama Kategori" name="kategori" class="form-control" required>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal tambah-->

<!-- modal update -->
<div class="modal fade"  data-backdrop="static" id="update">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Update Kategori</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="post">
            <div class="mb-3">
                <input type="hidden" id="id_kategori" name="id">
                <input type="text" placeholder="Nama Kategori" name="kategori" id="nama_kategori" class="form-control" required>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="update">Submit</button>
            </div>
        </div>
        </form>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal update -->

<!-- Footer -->
<?php include "layout/footer.php" ?>
<!-- /.Footer -->
<script>
    $(function () {
        $('#kategori').DataTable({
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
        $(document).on('click', '.btn-edit', function(){
            var kategori = $(this).attr('data-kategori'); 
            var id_kategori = $(this).attr('data-kategori_id'); 
            $('#nama_kategori').val(kategori);
            $('#id_kategori').val(id_kategori);
        });
    });
</script>
