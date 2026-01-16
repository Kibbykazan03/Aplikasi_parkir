<?php
// ini gerbang awal saat halaman website di buka

session_start();

if (isset($_SESSION['role'])) {
    // kalau sudah login
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin/dashboard.php");
    } elseif ($_SESSION['role'] == 'petugas') {
        header("Location: petugas/dashboard.php");
    }
} else {
    // kalau belum login
    header("Location: auth/login.php");
}
exit;
