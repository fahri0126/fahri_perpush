<?php 
require_once "../controller/book.php";
$book = new Book();

$conn = new Connection();

function isInCollection($userId, $bukuId){
  global $conn;
    $query = "SELECT BukuID, UserID FROM koleksipribadi WHERE UserID=? AND BukuID=?";
    $stmt = $conn->index()->prepare($query);
    $stmt->bind_param("ii", $userId, $bukuId);
    $stmt->execute();
    $result = $stmt->get_result();

    return mysqli_num_rows($result) > 0;
}

$user = $_SESSION["login"]["UserID"];
include "layout/navbar.php";
?>
    <!-- Main content -->
    <div class="content pt-5">
      <div class="container">
        <div class="row">

        <?php foreach($book->get_data() as $row) : ?>
          <div class="col-lg-3">
            <div class="card overflow-hidden bg-dark position-relative">
              <div class="bg-seondary d-flex justify-content-center align-items-center" style="height: 15rem; opacity: 50%">
                <img src="../assets/book/img/<?= $row["Image"] ?>"  class="" alt="">
              </div>
              <div class="card-body position-absolute fixed-bottom">
                <h5 class="font-weight-bold"><?= $row["Judul"] ?></h5>
                <p class="mt-3 text-truncate">
                  <?= $row["Deskripsi"] ?>
                  
                </p>
                <a href="detail-buku.php?id=<?= $row["BukuID"] ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                <?php if(isInCollection($user, $row["BukuID"])) : ?>
                    <button type="button" id="addBuku<?= $row["BukuID"] ?>" class="btn btn-info" data-toggle="tooltip" title="Tambah koleksi" onclick="tambahKoleksi(<?= $row['BukuID'] ?>, <?= $user ?>, 1)" style="display:none"><i class="far fa-bookmark"></i></button>
                    <button type="button" id="removeBuku<?= $row["BukuID"] ?>" class="btn btn-danger" data-toggle="tooltip" title="Tambah koleksi" onclick="tambahKoleksi(<?= $row['BukuID'] ?>, <?= $user ?>, 2)"><i class="far fa-bookmark"></i></button>
                <?php else: ?>
                    <button type="button" id="addBuku<?= $row["BukuID"] ?>" class="btn btn-info" data-toggle="tooltip" title="Tambah koleksi" onclick="tambahKoleksi(<?= $row['BukuID'] ?>, <?= $user ?>, 1)"><i class="far fa-bookmark"></i></button>
                    <button type="button" id="removeBuku<?= $row["BukuID"] ?>" class="btn btn-danger" data-toggle="tooltip" title="Tambah koleksi" onclick="tambahKoleksi(<?= $row['BukuID'] ?>, <?= $user ?>, 2)" style="display:none"><i class="far fa-bookmark"></i></button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
          
        </div>
        </div>
      </div>
  
  <?php include "layout/footer.php"; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
function tambahKoleksi(bukuId, userId, status){
      $.ajax({
        url: '../controller/Collection.php',
        type: 'post',
        data: 
        {
          bukuId : bukuId,
          userId : userId,
          status : status
        },
        success: function(response){
          // Menguraikan respons JSON menjadi objek JavaScript
          var data = JSON.parse(response);
          console.log(data);

          if(data == 1){
            $('#removeBuku' + bukuId).show();
            $('#addBuku' + bukuId).hide();
          }else{
            $('#removeBuku' + bukuId).hide();
            $('#addBuku' + bukuId).show();
          }
        }
      })
    }
</script>