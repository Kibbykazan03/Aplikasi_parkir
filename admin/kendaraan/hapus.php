<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus</title>
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

    mysqli_query($koneksi, "
    DELETE FROM tb_kendaraan WHERE id_kendaraan='$id'
");

    header("Location: index.php");
    ?>

</body>

</html>