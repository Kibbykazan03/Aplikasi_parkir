<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['role'])) {
        header("Location: ../auth/login.php");
        exit;
    }
    ?>

    <ul>
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <li><a href="../admin/user_index.php">Kelola User</a></li>
        <?php } ?>

        <?php if ($_SESSION['role'] == 'petugas') { ?>
            <li><a href="../petugas/riwayat.php">Riwayat Parkir</a></li>
        <?php } ?>

        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>

</body>

</html>