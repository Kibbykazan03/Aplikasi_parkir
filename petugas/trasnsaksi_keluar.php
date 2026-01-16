<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Keluar Parkiran</title>
</head>

<body>
    <?php
    session_start();
    include "../config/koneksi.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
        header("Location: ../auth/login.php");
        exit;
    }
    ?>

    <h2>Transaksi Parkir Keluar</h2>

    <form method="POST">
        Plat Nomor <br>
        <input type="text" name="plat" required><br><br>

        <button type="submit" name="keluar">Proses Keluar</button>
    </form>

    <?php
    if (isset($_POST['keluar'])) {

        $plat = $_POST['plat'];

        // cari transaksi aktif
        $q = mysqli_query($koneksi, "
        SELECT tb_transaksi.*, tb_tarif.harga, tb_area_parkir.id_area
        FROM tb_transaksi
        JOIN tb_kendaraan ON tb_transaksi.id_kendaraan = tb_kendaraan.id_kendaraan
        JOIN tb_tarif ON tb_transaksi.id_tarif = tb_tarif.id_tarif
        JOIN tb_area_parkir ON tb_transaksi.id_area = tb_area_parkir.id_area
        WHERE tb_kendaraan.plat_nomor = '$plat'
        AND tb_transaksi.status = 'masuk'
        LIMIT 1
    ");

        if (mysqli_num_rows($q) == 0) {
            echo "<p style='color:red;'>❌ Kendaraan tidak ditemukan / sudah keluar</p>";
            exit;
        }

        $d = mysqli_fetch_assoc($q);

        // hitung durasi parkir (jam)
        $masuk  = strtotime($d['waktu_masuk']);
        $keluar = time();

        $durasi_jam = ceil(($keluar - $masuk) / 3600);

        // hitung total bayar
        $total = $durasi_jam * $d['harga'];

        // update transaksi
        mysqli_query($koneksi, "
        UPDATE tb_transaksi SET
        waktu_keluar = NOW(),
        total_bayar = '$total',
        status = 'keluar'
        WHERE id_transaksi = '" . $d['id_transaksi'] . "'
    ");

        // tambah kapasitas area
        mysqli_query($koneksi, "
        UPDATE tb_area_parkir
        SET kapasitas = kapasitas + 1
        WHERE id_area = '" . $d['id_area'] . "'
    ");

        echo "
        <p style='color:green;'>✅ Kendaraan keluar</p>
        <p>Lama parkir : $durasi_jam jam</p>
        <p>Total bayar : Rp " . number_format($total, 0, ',', '.') . "</p>
    ";
    }
    ?>

</body>

</html>