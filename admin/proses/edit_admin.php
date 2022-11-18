<?php
require_once "../../db/koneksi.php";


$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$id_admin = $_POST['id_admin'];


if ($password) {

    $addoption = mysqli_query($mysqli, "UPDATE admin SET nama_admin = '{$nama}', email = '{$email}', username = '{$username}', role = {$role}, password = '{$password}' WHERE id_admin = {$id_admin}");
} else {
    $addoption = mysqli_query($mysqli, "UPDATE admin SET nama_admin = '{$nama}', email = '{$email}', username = '{$username}', role = {$role} WHERE id_admin = {$id_admin}");
}



if ($addoption) {
    echo "<script>alert('Data berhasil diubah');</script>";
    echo "<script>location='../admin.php';</script>";
} else {
    var_dump($addoption);
    die();
}
