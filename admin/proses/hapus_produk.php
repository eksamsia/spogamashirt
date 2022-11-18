<?php
require_once "../../db/koneksi.php";

$addoption =mysqli_query($mysqli, "DELETE FROM produk WHERE id_produk = $_GET[id]");


if ($addoption) {
  echo "<script>alert('Data berhasil Dihapus');</script>";
  echo "<script>location='../produk.php?page=produk&id=$_GET[id]';</script>";
}else {
  var_dump($addoption);
  die();
}
?>