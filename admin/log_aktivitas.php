<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas</title>
</head>

<body>
    <?php
    session_start();
    include "../config/koneksi.php";
    ?>

    <h2>📜 Log Aktivitas</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Aktivitas</th>
            <th>Waktu Aktivitas</th>
        </tr>

        <?php
        $no = 1;
        $q = mysqli_query($koneksi, "
    SELECT l.*, u.username
    FROM tb_log_aktivitas l
    JOIN tb_user u ON l.id_user = u.id_user
    ORDER BY l.waktu_aktivitas DESC

");

        while ($d = mysqli_fetch_assoc($q)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['username'] ?></td>
                <td><?= $d['aktivitas'] ?></td>
                <td><?= $d['waktu_aktivitas'] ?></td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>