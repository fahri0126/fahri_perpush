<?php
    require_once "../controller/book.php";

    $book = new Book();
    if(isset($_POST["submit"])){
      $book->do_insert($_POST, $_FILES);
    }

    $page = "Data Buku";

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
                <h3 class="card-title">List Buku</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i> Buku</button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Penulis</th>
                      <th>Penerbit</th>
                      <th>Tahun Terbit</th>
                      <th>Kategori</th>
                      <th class="col-md-3">Deskripsi</th>
                      <th class="col-1">File</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($book->get_data() as $row) : $file = $row["File"];
                      $kategori = $row['NamaKategori']?>
                      <tr>
                        <td><?= $row["Judul"] ?></td>
                        <td><?= $row["Penulis"] ?></td>
                        <td><?= $row["Penerbit"] ?></td>
                        <td><?= $row["TahunTerbit"] ?></td>
                        <td> <?= isset($row['NamaKategori']) ? "<button class='btn btn-success btn-sm'>$kategori</button>" : 'tidak ada' ?></td>
                        <td><?= $row["Deskripsi"] ?></td>
                        <td><?= $row['File'] == NULL ? 'No Action' : "<a href='../assets/book/file/$file'>lihat</a>" ?></td>
                        <td>
                          <a href="../controller/delete.php?tb=buku&fd=BukuID&id=<?= $row["BukuID"] ?>" class="btn btn-danger" onclick="return confirm('Hapus <?= $row['Judul'] ?> ?')"><i class="fas fa-trash-alt"></i></a>
                          <a href="buku-edit.php?id=<?= $row["BukuID"] ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Judul</th>
                      <th>Penulis</th>
                      <th>Penerbit</th>
                      <th>Tahun Terbit</th>
                      <th>Kategori</th>
                      <th>Deskripsi</th>
                      <th>File</th>
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

  <!-- Modal Tambah -->
  <div class="modal fade"  data-backdrop="static" id="tambah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Input Data Buku</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          require_once "../controller/category.php";
          $category = new Category(); ?>
          <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="">Judul Buku</label>
              <input type="text" placeholder="Judul Buku" name="judul" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="">Penulis</label>
              <input type="text" placeholder="Penulis" name="penulis" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="">Penerbit</label>
              <input type="text" placeholder="Penerbit" name="penerbit" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="">Tahun Terbit</label>
              <input type="number" placeholder="Tahun Terbit" name="tgl" class="form-control" required autocomplete="off">
            </div>
            <div class="mb-3">
              <label for="">Kategori</label>
              <select name="kategori" class="form-control" required>
                <option value="">Pilih kategori</option>
                <?php foreach($category->get_data() as $row) : ?>
                <option value="<?= $row["KategoriID"] ?>"><?= $row["NamaKategori"] ?></option>
                <?php  endforeach; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="">Deskripsi</label>
              <textarea rows="5" placeholder="Deskripsi" name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
              <label for="">Gambar</label>
              <input type="file" name="img" class="form-control" placeholder="Input gambar" required>
            </div>
            <div class="mb-3">
              <label for="">File Buku <small class="text-info ml-1">*pdf</small></label>
              <input type="file" name="file" class="form-control" placeholder="Input File">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<!-- Footer -->
<?php include "layout/footer.php" ?>
<!-- /.Footer -->
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