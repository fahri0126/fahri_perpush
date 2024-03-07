<?php 

require_once "../controller/book.php";
require_once "../controller/pinjam.php";
include "layout/navbar.php";

$id = $_GET["id"];
$user = $_SESSION["login"]["UserID"];
$book = new Book();
$data = $book->get_data_edit($id);

$pinjam = new Pinjam();
if(isset($_POST["pinjam"])){
    $_POST["buku"] = $id;
    $_POST["user"] = $user;
    $_POST["tgl"] = date("Y-m-d");
    $pinjam->do_pinjam($_POST);
}

if(isset($_POST["submit-ulasan"])){
    $_POST["buku"] = $id;
    $_POST["user"] = $user;
    $pinjam->do_ulas($_POST);
}

if(isset($_POST["ulasan-update"])){
    $_POST["buku"] = $id;
    $_POST["user"] = $user;
    $pinjam->update_ulasan($_POST);
}


?>

<div class="content py-5">
    <div class="container">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none"></h3>
                    <div class="col-12">
                        <img src="../assets/book/img/<?= $data["Image"] ?>" class="product-image" alt="Product Image">
                    </div>
                </div>

                <div class="col-12 col-sm-6">
                    <h3 class="my-3 font-weight-bold"><?= $data["Judul"] ?></h3>
                    <hr>

                    <div class="bg-light border rounded py-2 px-3 mt-4">
                        <h6 class="mb-0 font-weight-bold">
                            Penerbit
                        </h6>
                        <h4 class="mt-0">
                            <small><?= $data["Penerbit"] ?></small>
                        </h4>
                    </div>

                    <div class="bg-light border rounded py-2 px-3 mt-4">
                        <h6 class="mb-0 font-weight-bold">
                            Penulis
                        </h6>
                        <h4 class="mt-0">
                            <small><?= $data["Penulis"] ?></small>
                        </h4>
                    </div>

                    <div class="py-2 mt-4">
                        <h6 class="mb-0 font-weight-bold">
                            Kategori
                        </h6>
                        <h4 class="mt-1">
                            <button class="btn btn-danger btn-small"><?= $data["NamaKategori"] ?></button>
                        </h4>
                    </div>

                    <div class="mt-5 d-flex">
                        <div class="">
                            <button id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle btn btn-primary">
                                Pinjam Buku
                            </button>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 mt-0 shadow">
                                <?php if($data["File"] != NULL) : ?>
                                    <li><a href="../assets/book/file/<?= $data["File"] ?>" class="dropdown-item"><i class="fas fa-download"></i>&nbsp;&nbsp;Download Buku</a></li>
                                <?php endif; ?>
                                <li><button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-pinjam"><i class="fas fa-book"></i>&nbsp;&nbsp;Pinjam Buku Fisik</button></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row mt-4">
                <nav class="w-100">
                <div class="nav nav-tabs" id="product-tab" role="tablist">
                    <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                </div>
                </nav>
                <div class="tab-content p-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?= $data["Deskripsi"] ?> </div>
                </div>
            </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card p-3">
            <div class="card-header row">
                <h5 class="card-title">Ulasan</h5>
                <button type="button" class="btn ml-auto" data-toggle="modal" data-target="#modal-ulasan"><span class="p-2 bg-success rounded"><i class="fas fa-comment-dots"></i></i></span>&nbsp;&nbsp;Beri Ulasan</button>
            </div>
            <div class="card-body">
                <?php if($pinjam->get_ulasan($id) == NULL) echo "<h5 class='text-center'>Tidak ada ulasan</h5>" ?>
                <?php foreach($pinjam->get_ulasan($id) as $row)  :  $rating = $row["Rating"] ?>
                <div class="">
                    <div class="">
                        <img src="https://ui-avatars.com/api/?name=<?= $row["Username"] ?>" alt="profile" style="height: 3rem; width: 3rem;" class="rounded-circle shadow-sm">
                        <span class="ml-1 font-weight-bold" style="font-size: 20px;"><?= $row["Username"] ?></span> <small class="ml-2"><?= date("l, M Y", strtotime($row["TanggalUlasan"])) ?></small>
                        <?php if($row["UserID"] == $user) : ?>
                        <button type="button" data-toggle="modal" data-target="#ulasan-edit" data-ulasan_id="<?= $row["UlasanID"] ?>" data-ulasan="<?= $row["Ulasan"] ?>" data-rating="<?= $row["Rating"] ?>" class="btn btn-sm btn-update-ulasan"><i class="fas fa-pen"></i></button>
                        <a class="btn text-danger btn-sm" href="../controller/ulasan-delete.php?id=<?= $row["UlasanID"] ?>&buku=<?= $id ?>" onclick="return confirm('Hapus Ulasan?')"><i class="fas fa-trash"></i></a>
                        <?php endif; ?>
                    </div>
                    <p class="mt-2"><?= $row["Ulasan"] ?></p>
                    <?php for($i = 1; $i <= 5; $i++) : ?>
                        <?php if($i <= $rating) : ?>
                            <i class="fas fa-star text-warning"></i>
                        <?php else: ?>
                            <i class="far fa-star text-warning"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <hr class="my-5">
                <?php endforeach; ?>
            </div>

        </div>

    </div>
</div>


<!-- Modal Pinjam -->
<div class="modal fade" id="modal-pinjam" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pinjam Buku</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form method="post">
                <div class="mb-3">
                    <label>Tanggal Peminjaman</label>
                    <input type="date" class="form-control" readonly value="<?= date("Y-m-d") ?>">
                </div>
                <div class="mb-3">
                    <label>Tanggal Pengembalian</label>
                    <input type="date" class="form-control" name="tgl_kembali">
                </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="pinjam">Pinjam Sekarang</button>
            </div>
        </form>
    </div>
  </div>
</div>

<!-- Modal Ulasan -->
<div class="modal fade" id="modal-ulasan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ulasan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form method="post">
            <div class="mb-3">
                <select name="rating" class="form-control" required>
                    <option value="">Beri rating</option>
                    <option value="1">1&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="2">2&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="3">3&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="4">4&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="5">5&nbsp;<i class="fas fa-star text-warning"></i></option>
                </select>
            </div>
            <div class="">
                <textarea name="ulasan" rows="5" class="form-control" placeholder="Ketik ulasan" required></textarea>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit-ulasan"><i class="fas fa-paper-plane"></i></button>
            </div>
        </form>
  </div>
</div>
</div>

<!-- modal edit ulasan -->
<div class="modal fade" id="ulasan-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Ulasan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form method="post">
                <div class="mb-3">
                <input type="hidden" name="id_ulasan" id="id_ulasan">
                <select name="rating" id="rating" class="form-control" required>
                    <option value="">Beri rating</option>
                    <option value="1">1&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="2">2&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="3">3&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="4">4&nbsp;<i class="fas fa-star text-warning"></i></option>
                    <option value="5">5&nbsp;<i class="fas fa-star text-warning"></i></option>
                </select>
            </div>
            <div class="">
                <textarea name="ulasan" id="ulasan" rows="5" class="form-control" placeholder="Ketik ulasan" required></textarea>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="ulasan-update">Simpan Perubahan</button>
            </div>
        </form>
    </div>
  </div>
</div>

<?php include "layout/footer.php" ?>
<script>
    $(document).ready(function(){
        $(document).on('click', '.btn-update-ulasan', function(){
            var ulasan_id = $(this).attr("data-ulasan_id");
            var ulasan = $(this).attr("data-ulasan");
            var rating = $(this).attr("data-rating");

            $("#rating").val(rating);
            $("#ulasan").val(ulasan);
            $("#id_ulasan").val(ulasan_id);
        });
    });
</script>