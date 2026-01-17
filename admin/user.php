<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <?php
    session_start();
    include "../config/koneksi.php";

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../auth/login.php");
        exit;
    }

    $q = mysqli_query($koneksi, "SELECT * FROM tb_user");
    ?>

    <h2 align="center">Data User</h2>

    <a href="user_tambah.php">➕ Tambah User</a><br>
    <a href="dashboard.php"> ⚙️ Dashboard</a>

    <br>
    
    <br>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1;
        while ($u = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $u['nama_lengkap'] ?></td>
                <td><?= $u['username'] ?></td>
                <td><?= $u['role'] ?></td>
                <td><?= $u['status_aktif'] ? 'Aktif' : 'Nonaktif' ?></td>
                <td>
                    <a href="user_edit.php?id=<?= $u['id_user'] ?>">✏️ Edit</a> |
                    <?php if ($u['role'] != 'admin') { ?>
                        <a href="?hapus=<?= $u['id_user'] ?>" onclick="return confirm('Hapus user?')">🗑️ Hapus</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php
    // hapus user
    if (isset($_GET['hapus'])) {
        mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='" . $_GET['hapus'] . "'");
        echo "<script>alert('User dihapus');location='user.php';</script>";
    }
    ?>

</body>

</html>