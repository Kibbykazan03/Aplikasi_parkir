<?php
include "../../config/koneksi.php";
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM tb_area_parkir WHERE id_area='$id'");
header("Location: index.php");
?>