<?php

session_start();
include "../../db/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$q = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username' and password='$password' ");
$r = mysqli_fetch_array($q);


if (mysqli_num_rows($q) == 1) {
  $_SESSION['user']       = $r['id_user'];
  $_SESSION['nama_user']  = $r['nama_user'];
  header('location:../index.php');
} else {
  header('location:../login.php?status=gagal');

  // echo "Login Gagal";
  var_dump($q);
  // var_dump($q2);
}
