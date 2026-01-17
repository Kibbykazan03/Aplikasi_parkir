<?php
session_start();
include "../../config/koneksi.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Tarif Parkir</title>
</head>

<body>

    <h2>💰 Data Tarif Parkir</h2>


    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Jenis Kendaraan</th>
            <th>Tarif / Jam</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM tb_tarif");

        while ($t = mysqli_fetch_assoc($q)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $t['jenis_kendaraan'] ?></td>
                <td>Rp <?= number_format($t['tarif_per_jam'], 0, ',', '.') ?></td>
                <td>
                    <a href="tarif_edit.php?id=<?= $t['id_tarif'] ?>">✏️ Edit</a> |
                    <a href="tarif_hapus.php?id=<?= $t['id_tarif'] ?>" onclick="return confirm('Yakin hapus tarif?')">🗑️ Hapus</a>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>