<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <?php
    session_start();
    include "../config/koneksi.php";

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../auth/login.php");
        exit;
    }

    $id = $_GET['id'];
    $u = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user='$id'"));

    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        mysqli_query($koneksi, "
        UPDATE tb_user SET
        nama_lengkap='$nama',
        role='$role',
        status_aktif='$status'
        WHERE id_user='$id'
    ");

        echo "<script>alert('User diupdate');location='user.php';</script>";
    }
    ?>

    <h2>Edit User</h2>
    <br>

    <a href="dashboard.php">Dashboard</a>

    <form method="POST">
        Nama <br>
        <input type="text" name="nama" value="<?= $u['nama_lengkap'] ?>"><br>

        Role <br>
        <select name="role">
            <option value="admin" <?= $u['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="petugas" <?= $u['role'] == 'petugas' ? 'selected' : '' ?>>Petugas</option>
            <option value="owner" <?= $u['role'] == 'owner' ? 'selected' : '' ?>>Owner</option>
        </select><br>

        Status <br>
        <select name="status">
            <option value="1" <?= $u['status_aktif'] ? 'selected' : '' ?>>Aktif</option>
            <option value="0" <?= !$u['status_aktif'] ? 'selected' : '' ?>>Nonaktif</option>
        </select><br><br>

        <button type="submit" name="update">Update</button>
    </form>
    

</body>

</html>