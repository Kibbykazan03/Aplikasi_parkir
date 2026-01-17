<?php
session_start();
include "../../config/koneksi.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];
$q = mysqli_query($koneksi, "SELECT * FROM tb_tarif WHERE id_tarif='$id'");
$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Tarif</title>
</head>

<body>

    <h2>✏️ Edit Tarif</h2>

    <form method="POST">
        Jenis Kendaraan <br>
        <input type="text" name="jenis" value="<?= $data['jenis_kendaraan'] ?>" required><br><br>

        Tarif Per Jam <br>
        <input type="number" name="tarif" value="<?= $data['tarif_per_jam'] ?>" required><br><br>

        <button type="submit" name="update">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $jenis = $_POST['jenis'];
        $tarif = $_POST['tarif'];

        mysqli_query($koneksi, "
        UPDATE tb_tarif SET
        jenis_kendaraan='$jenis',
        tarif_per_jam='$tarif'
        WHERE id_tarif='$id'
    ");

        header("Location: index.php");
    }
    ?>

</body>

</html>