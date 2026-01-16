<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Parkir</title>
</head>
<body>

<?php
session_start();
if ($_SESSION['role'] != 'petugas') {
    header("Location: ../auth/login.php");
}

?>

<h2>Dashboard Petugas</h2>

<ul>
    <li>
        <a href="transaksi_masuk.php"> Transaksi Parkir Masuk </a>
    </li>
</ul>
    
</body>
</html>