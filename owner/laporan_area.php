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
    <title>Laporan <Area></Area></title>
</head>

<body>
    <?php
    $q = mysqli_query($koneksi, "
    SELECT 
        a.nama_area,
        COUNT(t.id_parkir) total_kendaraan,
        SUM(t.total_bayar) total_uang
    FROM tb_transaksi t
    JOIN tb_area_parkir a ON t.id_area = a.id_area
    WHERE t.status = 'keluar'
    GROUP BY a.id_area
");

    if ($_SESSION['role'] != 'owner') {
        die("Akses ditolak");
    }


    ?>
</body>

</html>