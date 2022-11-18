<?php
require_once "../../db/koneksi.php";

$addoption =mysqli_query($mysqli, "DELETE FROM alamat WHERE id_alamat = $_GET[id]");


if ($addoption) {
  echo "<script>alert('Data berhasil Dihapus');</script>";
  echo "<script>location='../profile.php?id=".$_GET['id']."&page=alamat';</script>";
}else {
  var_dump($addoption);
  die();
}
?>