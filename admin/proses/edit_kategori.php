<?php
require_once "../../db/koneksi.php";

$addoption =mysqli_query($mysqli, "UPDATE kategori SET nama_kategori= '$_GET[nama_kategori]' WHERE id_kategori = '$_GET[id_kategori]'");


if ($addoption) {
  echo "<script>alert('Data berhasil diubah');</script>";
  echo "<script>location='../kategori.php?page=kategori&id=$_GET[id_kategori]';</script>";
}else {
  var_dump($addoption);
  die();
}
?>