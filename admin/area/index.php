<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Pakir</title>
</head>

<body>
    <?php
    session_start();
    include "../../config/koneksi.php";

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../../auth/login.php");
        exit;
    }
    ?>

    <h2>Data Area Parkir</h2>

    <a href="tambah.php">➕ Tambah Area</a>
    <br><br>
    

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Nama Area</th>
            <th>Kapasitas</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM tb_area_parkir");

        while ($a = mysqli_fetch_assoc($q)) {
        ?>


            <tr>
                <td><?= $no++ ?></td>
                <td><?= $a['nama_area'] ?></td>
                <td><?= $a['kapasitas'] ?></td>
                <td><?= $a['status'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $a['id_area'] ?>">✏️ Edit</a> |
                    <a href="hapus.php?id=<?= $a['id_area'] ?>" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>