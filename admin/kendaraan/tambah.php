<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
</head>

<body>
    <?php
    session_start();
    include "../../config/koneksi.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("Location: ../../auth/login.php");
        exit;
    }

    if (isset($_POST['simpan'])) {
        $plat  = $_POST['plat'];
        $jenis = $_POST['jenis'];

        mysqli_query($koneksi, "
        INSERT INTO tb_kendaraan (plat_nomor, jenis_kendaraan)
        VALUES ('$plat', '$jenis')
    ");

        header("Location: index.php");
    }
    ?>

    <h2>➕ Tambah Kendaraan</h2>

    <form method="POST">
        Plat Nomor <br>
        <input type="text" name="plat" required><br><br>

        Jenis Kendaraan <br>
        <select name="jenis">
            <option value="motor">Motor</option>
            <option value="mobil">Mobil</option>
        </select><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>

</body>

</html>