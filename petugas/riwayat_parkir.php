<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Parkiran</title>
</head>

<body>

    <ul>

        <!-- ini masuk halaman transaksi masuk parkiran -->
        <li><a href="transaksi_masuk.php"> Transaksi Parkir Masuk </a></li>


        <!-- ini masuk ke halaman transaksi keluar parkiran -->
        <li><a href="transaksi_keluar.php"> Transaksi Parkir Keluar </a></li>

        <!-- ini buat kembali ke dashboard -->
        <li><a href="dashboard.php"> Dashboard</a></li>

    </ul>

    <?php
    session_start();
    include "../config/koneksi.php";

    if ($_SESSION['role'] != 'petugas') {
        header("Location: ../auth/login.php");
        exit;
    }

    $q = mysqli_query($koneksi, "
    SELECT 
        tb_kendaraan.plat_nomor,
        tb_kendaraan.jenis_kendaraan,
        tb_area_parkir.nama_area,
        tb_transaksi.waktu_masuk,
        tb_transaksi.waktu_keluar,
        tb_transaksi.total_bayar,
        tb_transaksi.status
    FROM tb_transaksi
    JOIN tb_kendaraan ON tb_transaksi.id_kendaraan = tb_kendaraan.id_kendaraan
    JOIN tb_area_parkir ON tb_transaksi.id_area = tb_area_parkir.id_area
    ORDER BY tb_transaksi.waktu_masuk DESC
");
    ?>

    <h2>Riwayat Parkir</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>Plat</th>
            <th>Jenis</th>
            <th>Area</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Status</th>
            <th>Total</th>
            <th>Cetak Struk</th>
        </tr><?php while ($d = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $d['plat_nomor'] ?></td>
                <td><?= $d['jenis_kendaraan'] ?></td>
                <td><?= $d['nama_area'] ?></td>
                <td><?= $d['waktu_masuk'] ?></td>
                <td><?= $d['waktu_keluar'] ?? '-' ?></td>
                <td>
                    <?= $d['status'] == 'masuk'
                        ? '<span style="color:red">Masih Parkir</span>'
                        : '<span style="color:green">Keluar</span>' ?>
                </td>
                <td>
                    <?= $d['total_bayar']
                        ? 'Rp ' . number_format($d['total_bayar'], 0, ',', '.')
                        : '-' ?>
                </td>
            </tr>
        <?php } ?>

    </table>

</body>

</html>