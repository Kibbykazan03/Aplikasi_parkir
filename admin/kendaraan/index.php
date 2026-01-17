<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kendaraan</title>
</head>

<body>

    <?php
    session_start();
    include "../../config/koneksi.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("Location: ../../auth/login.php");
        exit;
    }
    ?>

    <h2>🚗 Data Kendaraan</h2>

    <a href="tambah.php">➕ Tambah Kendaraan</a>
    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Plat Nomor</th>
            <th>Jenis</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "SELECT * FROM tb_kendaraan");

        while ($k = mysqli_fetch_assoc($q)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $k['plat_nomor'] ?></td>
                <td><?= $k['jenis_kendaraan'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $k['id_kendaraan'] ?>">✏️ Edit</a> |
                    <a href="hapus.php?id=<?= $k['id_kendaraan'] ?>" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>