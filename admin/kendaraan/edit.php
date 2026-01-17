<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit </title>
</head>

<body>

    <?php
    session_start();
    include "../../config/koneksi.php";

    if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
        header("Location: ../../auth/login.php");
        exit;
    }

    $id = $_GET['id'];
    $q  = mysqli_query($koneksi, "SELECT * FROM tb_kendaraan WHERE id_kendaraan='$id'");
    $k  = mysqli_fetch_assoc($q);

    if (isset($_POST['update'])) {
        $plat  = $_POST['plat'];
        $jenis = $_POST['jenis'];

        mysqli_query($koneksi, "
        UPDATE tb_kendaraan SET
        plat_nomor='$plat',
        jenis_kendaraan='$jenis'
        WHERE id_kendaraan='$id'
    ");

        header("Location: index.php");
    }
    ?>

    <h2>✏️ Edit Kendaraan</h2>

    <form method="POST">
        Plat Nomor <br>
        <input type="text" name="plat" value="<?= $k['plat_nomor'] ?>" required><br><br>

        Jenis Kendaraan <br>
        <select name="jenis">
            <option value="motor" <?= $k['jenis_kendaraan'] == 'motor' ? 'selected' : '' ?>>Motor</option>
            <option value="mobil" <?= $k['jenis_kendaraan'] == 'mobil' ? 'selected' : '' ?>>Mobil</option>
        </select><br><br>

        <button type="submit" name="update">Update</button>
    </form>

</body>

</html>