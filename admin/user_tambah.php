<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
</head>

<body>
    <?php
    session_start();
    include "../config/koneksi.php";

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../auth/login.php");
        exit;
    }

    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $user = $_POST['username'];
        $pass = md5($_POST['password']);
        $role = $_POST['role'];

        mysqli_query($koneksi, "
        INSERT INTO tb_user (nama_lengkap, username, password, role)
        VALUES ('$nama','$user','$pass','$role')
    ");

        echo "<script>alert('User ditambahkan');location='user.php';</script>";
    }
    ?>

    <h2>Tambah User</h2>

    <form method="POST">
        Nama Lengkap <br>
        <input type="text" name="nama" required><br>

        Username <br>
        <input type="text" name="username" required><br>

        Password <br>
        <input type="password" name="password" required><br>

        Role <br>
        <select name="role">
            <option value="petugas">Petugas</option>
            <option value="owner">Admin</option>
        </select><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>

</body>

</html>