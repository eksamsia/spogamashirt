<?php
require_once "../../db/koneksi.php";

$addoption =mysqli_query($mysqli, "DELETE FROM kategori WHERE id_kategori = $_GET[id]");


if ($addoption) {
  echo "<script>alert('Data berhasil Dihapus');</script>";
  echo "<script>location='../kategori.php?page=kategori&id=$_GET[id]';</script>";
}else {
  var_dump($addoption);
  die();
}
?>