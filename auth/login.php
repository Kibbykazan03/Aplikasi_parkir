<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Parkir</title>
</head>

<body>
    <h2>Login</h2>

    <!-- untuk menghubungkan tapilan login dengan logika login  -->
    <form action="proses_login.php" method="POST">

        <label>Username</label><br>
        <input type="text" name="username"><br>

        <label>Password</label><br>
        <input type="password" name="password"><br>

<!-- tag button digunakan untuk melanjutkan tindakan ke halaman dashboard -->
        <button type="submit">Login</button>

    </form>
</body>

</html>