<!-- file ini digunakan untuk menghubungkan antara PHP dengan mysql -->

<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "aplikasi_parkir";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
