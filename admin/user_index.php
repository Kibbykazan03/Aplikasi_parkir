<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data User</title>
</head>

<body>

    <h2>Data User</h2>

    <a href="user_tambah.php">➕ Tambah User</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM tb_user");

        while ($u = mysqli_fetch_assoc($q)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $u['nama_lengkap'] ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $u['id_user'] ?>">✏️ Edit</a> |
                    <a href="hapus.php?id=<?= $u['id_user'] ?>"
                        onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>