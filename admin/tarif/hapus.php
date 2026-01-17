<?php
session_start();
include "../../config/koneksi.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM tb_tarif WHERE id_tarif='$id'");

header("Location: index.php");
