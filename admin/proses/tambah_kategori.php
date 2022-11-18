<?php
require_once "../../db/koneksi.php";
$addkaryawan = $mysqli->query("INSERT INTO kategori (nama_kategori) VALUES('".$_POST['nama_kategori']."')") or die(mysqli_error($mysqli));
// print_r($$addkaryawan);
// die();
if ($addkaryawan) {
  echo "<script>alert('Data berhasil Ditambah');</script>";
  echo "<script>location='../kategori.php?page=kategori';</script>";
}


?>