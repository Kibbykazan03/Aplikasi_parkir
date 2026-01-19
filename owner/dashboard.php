<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'owner') {
    header("Location: ../auth/login.php");
    exit;
}

// total transaksi hari ini
$q1 = mysqli_query($koneksi, "
    SELECT COUNT(*) total
    FROM tb_transaksi
    WHERE DATE(waktu_keluar) = CURDATE()
");

$total_transaksi = mysqli_fetch_assoc($q1)['total'];

// total pemasukan hari ini
$q2 = mysqli_query($koneksi, "
    SELECT SUM(total_bayar) total
    FROM tb_transaksi
    WHERE DATE(waktu_keluar) = CURDATE()
");

$total_uang = mysqli_fetch_assoc($q2)['total'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner</title>
</head>

<body>

    <h2>📊 Dashboard Owner</h2>

    <p>Total Transaksi Hari Ini : <b><?= $total_transaksi ?></b></p>
    <p>Total Pemasukan Hari Ini : <b>Rp <?= number_format($total_uang) ?></b></p>


    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="laporan_harian.php">Laporan Harian</a></li>
        <li><a href="laporan_bulanan.php">Laporan Bulanan</a></li>
        <li><a href="laporan_area.php">Laporan Area</a></li>
        <li><a href="laporan_kendaraan.php">Laporan Kendaraan</a></li>

    </ul>



</body>

</html>