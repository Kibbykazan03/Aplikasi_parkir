<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Area</title>
</head>

<body>

    <?php
    session_start();
    include "../../config/koneksi.php";

    if ($_SESSION['role'] != 'admin') {
        header("Location: ../../auth/login.php");
        exit;
    }
    ?>

    <h2>Tambah Area Parkir</h2>

    <form method="POST">
        Nama Area <br>
        <input type="text" name="nama" required><br><br>

        Kapasitas <br>
        <input type="number" name="kapasitas" required><br><br>

        <button type="submit" name="simpan">Simpan</button>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $kap  = $_POST['kapasitas'];

        mysqli_query($koneksi, "
        INSERT INTO tb_area_parkir (nama_area, kapasitas)
        VALUES ('$nama', '$kap')
    ");

        header("Location: index.php");
    }
    ?>

</body>

</html>