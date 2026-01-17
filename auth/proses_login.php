<?php
session_start();
include "../config/koneksi.php";

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tb_user 
     WHERE username='$username' 
     AND status_aktif=1"
);

$user = mysqli_fetch_assoc($query);

if ($user) {

    if ($password == $user['password']) {

        $_SESSION['id_user']  = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];

        mysqli_query($koneksi, "
            INSERT INTO tb_log_aktivitas (id_user, aktivitas)
            VALUES ('{$user['id_user']}', 'Login ke sistem')
");


        if ($user['role'] == 'admin') {
            header("Location: ../admin/dashboard.php");
            exit;
        } elseif ($user['role'] == 'petugas') {
            header("Location: ../petugas/dashboard.php");
            exit;
        } elseif ($user['role'] == 'owner') {
            header("Location: ../owner/dashboard.php");
            exit;
        } else {
            echo "Role tidak dikenali";
        }
    } else {
        echo "Password salah";
    }
} else {
    echo "Username tidak ditemukan atau akun nonaktif";
}
