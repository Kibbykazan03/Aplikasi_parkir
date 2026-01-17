<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
</head>

<body>

    <?php
    session_start();
    if ($_SESSION['role'] != 'admin') {
        header("Location: ../auth/login.php");
    }

    ?>

    <h2 align="center"> Dashboard Admin </h2>

<ul>
    <li><a href="user_tambah.php">➕  Tambah User</a></li>
    <li><a href="user.php">📇 Lihat User</a></li><br>
    <li><a href="../petugas/riwayat_parkir.php">🚦 Riwayat Parkir</a></li>
    <li><a href="../auth/logout.php">🚪 Logout</a></li>
</ul>
</body>

</html>