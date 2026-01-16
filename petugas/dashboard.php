<?php
session_start();
if ($_SESSION['role'] != 'petugas') {
    header("Location: ../auth/login.php");
}
echo "Dashboard Petugas";
