<?php
$page = "Edit Buku";
require "../controller/book.php";
require "../controller/category.php";
// instansiasi class
$book = new Book();
$category = new Category();

// id buku dari url
$id = $_GET['id'];

// ambil data dari database
$row = $book->get_data_edit($id);

if(isset($_POST["save-changes"])){
    $_POST["id"] = $id;
    $book->update($_POST);
}

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
            <h3 class="card-title">Edit Buku</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= $row["Judul"] ?? "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $row["Penulis"] ?? "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $row["Penerbit"] ?? "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="tgl">Tahun Terbit</label>
                        <input type="text" class="form-control" id="tgl" name="tgl" value="<?= $row["TahunTerbit"] ?? "" ?>">
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control">
                            <?php foreach($category->get_data() as $cat) : ?>
                                <option value="<?= $cat['KategoriID'] ?>" <?= isset($row["KategoriID"])  ? ( $cat['KategoriID'] == $row['KategoriID'] ? 'selected' : '') : '' ?>><?= $cat["NamaKategori"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"><?= $row["Deskripsi"] ?? "" ?></textarea>
                    </div>

                    <div class="mt-3">
                        <button type="submit" name="save-changes" class="btn btn-danger">Simpan Perubahan</button>
                        <a class="btn btn-primary ml-2" href="buku.php">Kembali</a>
                    </div>
                </form>
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

<!-- Footer -->
<?php include "layout/footer.php" ?>
<!-- /.Footer -->
