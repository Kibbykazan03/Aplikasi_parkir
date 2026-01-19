<?php
session_start();
include "../config/koneksi.php";

/* proteksi login */
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'petugas') {
    header("Location: ../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Transaksi Parkir Keluar</title>
</head>

<body>

    <h2>🚗 Transaksi Parkir Keluar</h2>

    <form method="POST">
        Plat Nomor <br>
        <input type="text" name="plat" required>
        <br><br>
        <button type="submit" name="keluar">Proses Keluar</button>
    </form>

    <?php
    if (isset($_POST['keluar'])) {

        $plat = trim($_POST['plat']);

        /* 1️⃣ cari transaksi AKTIF (status = masuk) */
        $stmt = mysqli_prepare($koneksi, "
        SELECT 
            t.id_parkir,
            t.id_area,
            t.waktu_masuk,
            tr.tarif_per_jam
        FROM tb_transaksi t
        JOIN tb_kendaraan k ON t.id_kendaraan = k.id_kendaraan
        JOIN tb_tarif tr ON t.id_tarif = tr.id_tarif
        WHERE k.plat_nomor = ?
        AND t.status = 'masuk'
        LIMIT 1
    ");

        mysqli_stmt_bind_param($stmt, "s", $plat);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo "<p style='color:red'>❌ Kendaraan tidak ditemukan / sudah keluar</p>";
            exit;
        }

        $d = mysqli_fetch_assoc($result);

        /* 2️⃣ hitung durasi & biaya */
        $masuk  = strtotime($d['waktu_masuk']);
        $keluar = time();

        $durasi_jam = ceil(($keluar - $masuk) / 3600);
        $biaya_total = $durasi_jam * $d['tarif_per_jam'];

        /* 3️⃣ update transaksi */
        mysqli_query($koneksi, "
        UPDATE tb_transaksi SET
            waktu_keluar = NOW(),
            durasi_jam   = '$durasi_jam',
            biaya_total  = '$biaya_total',
            total_bayar  = '$biaya_total',
            status       = 'keluar'
        WHERE id_parkir = '{$d['id_parkir']}'
    ");

        /* 4️⃣ tambah kapasitas area */
        mysqli_query($koneksi, "
        UPDATE tb_area_parkir
        SET kapasitas = kapasitas + 1
        WHERE id_area = '{$d['id_area']}'
    ");

        /* 5️⃣ redirect ke cetak struk */
        header("Location: cetak_struk.php?id=" . $d['id_parkir']);
        exit;
    }
    ?>

</body>

</html>