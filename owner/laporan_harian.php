<?php
session_start();
include "../config/koneksi.php"; // ← WAJIB

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian</title>
</head>

<body>


    <?php
    $q = mysqli_query($koneksi, "
    SELECT 
        t.waktu_keluar,
        k.plat_nomor,
        k.jenis_kendaraan,
        a.nama_area,
        t.total_bayar
    FROM tb_transaksi t
    JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
    JOIN tb_area_parkir a ON t.id_area = a.id_area
    WHERE DATE(t.waktu_keluar) = CURDATE()
    AND t.status = 'keluar'
");

    if ($_SESSION['role'] != 'owner') {
        die("Akses ditolak");
    }

    ?>

    <table border="1">
        <tr>
            <th>Plat</th>
            <th>Kendaraan</th>
            <th>Area</th>
            <th>Waktu Keluar</th>
            <th>Total</th>
        </tr>

        <?php while ($d = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $d['plat_nomor'] ?></td>
                <td><?= $d['jenis_kendaraan'] ?></td>
                <td><?= $d['nama_area'] ?></td>
                <td><?= $d['waktu_keluar'] ?></td>
                <td>Rp <?= number_format($d['total_bayar']) ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>