<?php

include "layout/navbar.php";
require_once "../controller/connection.php";

$connection = new Connection();
$user = $_SESSION["login"]["UserID"];

$query = mysqli_query($connection->index(), "SELECT * FROM peminjaman LEFT JOIN buku ON buku.BukuID=peminjaman.BukuID WHERE UserID='$user'");
$rows = [];
while($result = mysqli_fetch_assoc($query)){
    $rows[] = $result;
}

?>
<div class="content py-5">
    <div class="container">
        <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($rows as $row) : ?>
                    <tr>
                        <td><?= $row["Judul"] ?></td>
                        <td><?= date("d, M Y", strtotime($row["TanggalPeminjaman"]))?></td>
                        <td><?= date("d, M Y", strtotime($row["TanggalPengembalian"]))?></td>
                        <td class="<?= $row["StatusPeminjaman"] == 'pinjam' ? "text-danger" : "text-info" ?>"><?= $row["StatusPeminjaman"] ?></td>
                        <td>
                            <a href="../controller/delete.php?tb=peminjaman&fd=PeminjamanID&id=<?= $row["PeminjamanID"] ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus ?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </tfoot>
            </table>
    </div>
</div>

<?php include "layout/footer.php"; ?>
<script>
    $(function () {
        $('#example').DataTable({
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