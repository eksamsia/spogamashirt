<?php
require_once "../../db/koneksi.php";




$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];


$add =  mysqli_query($mysqli, "INSERT INTO admin(nama_admin,email,username,password,role) VALUES('{$nama}','{$email}','{$username}','{$password}','{$role}')");


if ($add) {
    echo "<script>alert('Admin berhasil ditambahkan');</script>";
    echo "<script>location='../admin.php';</script>";
} else {
    print_r($add);
    die();
}
