<?php
session_start();
if ($_SESSION['role'] != 'owner') {
    header("Location: ../auth/login.php");
}
echo "Dashboard Owner";
?>