<?php
require_once "../controller/connection.php";
include "layout/navbar.php";
$conn = new Connection();

$user= $_SESSION['login']['UserID'];

$query = mysqli_query($conn->index(), "SELECT buku.BukuID, buku.Judul, buku.Deskripsi, koleksipribadi.KoleksiID, user.UserID FROM koleksipribadi LEFT JOIN buku ON buku.BukuID = koleksipribadi.BukuID LEFT JOIN user ON user.UserID=koleksipribadi.UserID WHERE user.UserID='$user'");

$row = [];
while($result = mysqli_fetch_assoc($query)){
    $row[] = $result;
}

if($row == NULL){
    echo "<h6 style='display:flex; justify-content:center; margin-top:30dvh'>Anda tidak mempunyai koleksi pribadi, silahkan &nbsp;<a href='index.php'>tambah koleksi</a></h6>";
}

$user = $_SESSION['login']['UserID'];

?>

<div class="content pt-5">
    <div class="container">

    <div class="row justify-content-center">
        <?php foreach($row as $rows) : ?>
            <div class="card col-md-3 mx-1">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <?= $rows["Judul"] ?>
                        </div>
                        <div class="">
                            <a class="btn btn-primary" href="detail-buku.php?id=<?= $rows["BukuID"] ?>"><i class="fas fa-eye"></i></a>
                            <a href="../controller/delete-collection.php?id=<?= $rows["KoleksiID"] ?>" class="btn btn-danger"><i class="fas fa-window-minimize"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
            
    </div>
</div>

<?php include "layout/footer.php" ?>
