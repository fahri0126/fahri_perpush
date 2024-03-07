<?php
require_once "../controller/register-petugas.php";
require_once "../controller/auth.php";

$_SESSION['login']['Level'] != 'administrator' ? exit(header("location:index.php?err=permission")) : '';

$auth = new Auth();

if(isset($_POST["register-petugas"])){
    $_POST['Level'] = 'petugas';
    $auth->do_register($_POST);
}

if(isset($_POST['update-petugas'])){
    $auth->petugas_edit($_POST);
}

$petugas = new Petugas();

    $page = "Registrasi Petugas";

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
            <h3 class="card-title">Registrasi Petugas</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Petugas</button>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($petugas->get_data() as $row) : ?>
                    <tr>
                        <td><?= $row["Username"] ?></td>
                        <td><?= $row["Password"] ?></td>
                        <td><?= $row["Level"] ?></td>
                        <td>
                            <button class="btn btn-secondary btn-edit" data-username="<?= $row["Username"] ?>" data-user_Id=<?= $row["UserID"] ?> data-pass="<?= $row["Password"] ?>" data-IniEmail="<?= $row["Email"]?>" data-nama="<?= $row["NamaLengkap"] ?>" data-alamat="<?= $row["Alamat"] ?>" data-toggle="modal" data-target="#update"><i class="fas fa-pen"></i></button>
                            <a href="../controller/delete.php?tb=user&fd=UserID&id=<?= $row["UserID"] ?>" onclick="return confirm('Hapus Petugas <?= $row['Username'] ?>')" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
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
<div class="modal fade"  data-backdrop="static" id="tambah">
<div class="modal-dialog modal-md">
<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Registrasi Akun Petugas</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form method="post">
        <div class="mb-3">
            <input type="text" placeholder="User" name="user" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Password" name="pass" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Nama Lengkap" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Alamat" name="alamat" class="form-control" required>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="register-petugas">Submit</button>
        </div>
    </div>
    </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal tambah-->

<!-- modal Update -->
<div class="modal fade"  data-backdrop="static" id="update">
<div class="modal-dialog modal-md">
<div class="modal-content">
    <div class="modal-header">
    <h4 class="modal-title">Edit Akun Petugas</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="modal-body">
    <form method="post">
        <input type="hidden" name="id_user" id="id_user">
        <div class="mb-3">
            <input type="text" placeholder="User" name="user" id="user" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Password" name="pass" id="pass" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Nama Lengkap" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <input type="text" placeholder="Alamat" name="alamat" id="alamat" class="form-control" required>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="update-petugas">Submit</button>
        </div>
    </div>
    </form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal Update -->

<?php include "layout/footer.php" ?>
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
        $(document).on('click', '.btn-edit', function(){
            var data_user = $(this).attr('data-username');
            var pass = $(this).attr('data-pass');
            var email = $(this).attr('data-IniEmail');
            var nama = $(this).attr('data-nama');
            var alamat = $(this).attr('data-alamat');
            var user_id = $(this).attr('data-user_id');

            $('#user').val(data_user);
            $('#pass').val(pass);
            $('#email').val(email);
            $('#nama').val(nama);
            $('#alamat').val(alamat);
            $('#id_user').val(user_id);

        });
    });
</script>