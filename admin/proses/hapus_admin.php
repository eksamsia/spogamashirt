<?php
require_once "../../db/koneksi.php";

$addoption = mysqli_query($mysqli, "DELETE FROM admin WHERE id_admin = {$_GET['id']}");


if ($addoption) {
    echo "<script>alert('Data berhasil Dihapus');</script>";
    echo "<script>location='../admin.php';</script>";
} else {
    var_dump($addoption);
    die();
}
