<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit area</title>
</head>

<body>

    <?php
    session_start();
    include "../../config/koneksi.php";

    $id = $_GET['id'];
    $data = mysqli_fetch_assoc(mysqli_query(
        $koneksi,
        "SELECT * FROM tb_area_parkir WHERE id_area='$id'"
    ));
    ?>

    <h2>Edit Area Parkir</h2>

    <form method="POST">
        Nama Area <br>
        <input type="text" name="nama" value="<?= $data['nama_area'] ?>"><br><br>

        Kapasitas <br>
        <input type="number" name="kapasitas" value="<?= $data['kapasitas'] ?>"><br><br>

        Status <br>
        <select name="status">
            <option value="aktif" <?= $data['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
            <option value="nonaktif" <?= $data['status'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
        </select><br><br>

        <button type="submit" name="update">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        mysqli_query($koneksi, "
        UPDATE tb_area_parkir SET
        nama_area='$_POST[nama]',
        kapasitas='$_POST[kapasitas]',
        status='$_POST[status]'
        WHERE id_area='$id'
    ");

        header("Location: index.php");
    }
    ?>

</body>

</html>