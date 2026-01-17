<?php
session_start();
include "../../config/koneksi.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Tarif</title>
</head>

<body>

    <h2>➕ Tambah Tarif Parkir</h2>

    <form method="POST">
        Jenis Kendaraan <br>
        <input type="text" name="jenis" required><br><br>

        Tarif Per Jam <br>
        <input type="number" name="tarif" required><br><br>

        <button type="submit" name="simpan">Simpan</button>
        <a href="index.php">⬅️ Kembali</a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $jenis = $_POST['jenis'];
        $tarif = $_POST['tarif'];

        mysqli_query($koneksi, "
        INSERT INTO tb_tarif (jenis_kendaraan, tarif_per_jam)
        VALUES ('$jenis', '$tarif')
    ");

        header("Location: tarif_index.php");
    }
    ?>

</body>

</html>