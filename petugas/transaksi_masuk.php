<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi masuk</title>
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

    <h2>Transaksi Parkir Masuk</h2>
    <form method="POST">
        plat nomor <br>
        <input type="text" name="plat" required><br>

        jenis kendaraan <br>
        <select name="jenis">
            <option value="motor">Motor</option>
            <option value="mobil">Mobil</option>
        </select><br>

        Area parkir <br>
        <select name="area">

            <?php

            $area = mysqli_query($koneksi, "SELECT *FROM tb_area_parkir");
            while ($a = mysqli_fetch_assoc($area)) {
                echo "<option value='" . $a['id_area'] . "'>" . $a['nama_area'] . "</option>";
            }
            ?>
        </select><br>

        <button type="submit" name="simpan">Simpan</button>

    </form>

    <?php
    if (isset($_POST['simpan'])) {

        $plat  = $_POST['plat'];
        $jenis = $_POST['jenis'];
        $area  = $_POST['area'];

        $cek = mysqli_query($koneksi, "
    SELECT *
    FROM tb_kendaraan 
    JOIN tb_transaksi ON tb_kendaraan.id_kendaraan = tb_transaksi.id_kendaraan
    WHERE tb_kendaraan.plat_nomor = '$plat'
    AND tb_transaksi.status = 'masuk'
");


        if (mysqli_num_rows($cek) > 0) {
            echo "<p style='color:red;'>❌ Kendaraan dengan plat ini masih parkir!</p>";
            exit;
        }

        // simpan kendaraan
        mysqli_query($koneksi, "INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan)
                            VALUES ('$plat', '$jenis')");

        $id_kendaraan = mysqli_insert_id($koneksi);

        // ambil tarif
        $tarif = mysqli_query($koneksi, "SELECT * FROM tb_tarif WHERE jenis_kendaraan='$jenis'");
        $t = mysqli_fetch_assoc($tarif);

        // simpan transaksi
        mysqli_query($koneksi, "INSERT INTO tb_transaksi 
        (id_kendaraan, waktu_masuk, id_tarif, status, id_user, id_area)
        VALUES
        ('$id_kendaraan', NOW(), '" . $t['id_tarif'] . "', 'masuk', '" . $_SESSION['id_user'] . "', '$area')
    ");

        echo "
        <script>
            alert('✅ Transaksi parkir MASUK berhasil');
             window.location.href = 'riwayat_parkir.php';
        </script>
                ";
    }


    ?>
</body>

</html>