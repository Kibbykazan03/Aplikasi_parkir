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
    <title>Laporan Kendaraan</title>
</head>

<body>
    <?php
    $q = mysqli_query($koneksi, "
    SELECT 
        DATE(waktu_keluar) tanggal,
        COUNT(*) total_kendaraan,
        SUM(total_bayar) total_uang
    FROM tb_transaksi
    WHERE MONTH(waktu_keluar) = MONTH(CURDATE())
    AND YEAR(waktu_keluar) = YEAR(CURDATE())
    GROUP BY DATE(waktu_keluar)
");
    if ($_SESSION['role'] != 'owner') {
        die("Akses ditolak");
    }

    ?>
</body>

</html>