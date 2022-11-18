<?php

session_start();
include "../../db/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$q = mysqli_query($mysqli, "SELECT * FROM admin WHERE username='$username' and password='$password'");
$r = mysqli_fetch_array($q);


if (mysqli_num_rows($q) == 1) {
  $_SESSION['user_id']    = $r['id_admin'];
  $_SESSION['nama_admin'] = $r['nama_lengkap'];
  $_SESSION['role']       = $r['role'];
  $_SESSION['status']     = 'admin';
  header('location:../dashboard.php?page=dashboard');
} else {
  header('location:../index.php?status=gagal');
  var_dump($q);
}
