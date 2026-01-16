<?php

session_start();
include "../config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// ambil data user berdasarkan username
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' AND status_aktif=1");
$user  = mysqli_fetch_assoc($query);

// cek user ada atau tidak di databasenya
if ($user) {

    // cek password dari form dengan database
    // (sementara tanpa hash)
    if ($password == $user['password']) {

        // set session
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // arahkan sesuai role
        if ($user['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
        } elseif ($user['role'] == 'petugas') {
            header("Location: ../petugas/dashboard.php");
        } elseif ($user['role'] == 'owner') {
            header("Location: ../owner/dashboard.php");
        } else {
            echo "Role tidak dikenali";
        }

    } else {
        echo "Password salah";
    }
} else {
    echo "Username tidak ditemukan atau akun nonaktif";
}



?>