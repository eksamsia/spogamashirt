<?php
require_once "../../db/koneksi.php";

if ($_GET['action'] === 'hapus') {
  $delete = mysqli_query($mysqli, "DELETE FROM keranjang WHERE id_keranjang = $_GET[id_keranjang]");
  if ($delete) {
    // echo "<script>alert('Data berhasil Dihapus');</script>";
    echo "<script>location='../keranjang.php?id=1';</script>";
  } else {
    var_dump($addoption);
    die();
  }
}

if ($_GET['action'] === 'tambah') {
  $idkeranjang = $_GET['id_keranjang'];
  $produk = $mysqli->query("SELECT produk.* FROM keranjang INNER JOIN produk USING(id_produk) WHERE id_keranjang = {$idkeranjang}");

  $produk = $produk->fetch_assoc();

  $stok     = $produk['stock'];
  $qty      = $_GET['qty'] + 1;
  if ($qty <= $stok) {
    $total    = $_GET['price'] *  $qty;
    $tambah   = mysqli_query($mysqli, "UPDATE keranjang SET qty= '$qty', total = '$total' WHERE id_keranjang = {$_GET['id_keranjang']}");
    if ($tambah) {
      echo "<script>location='../keranjang.php?id=1';</script>";
      die;
    } else {
      var_dump($addoption);
      die();
    }
  }

  echo "<script>location='../keranjang.php?id=1';</script>";
}

if ($_GET['action'] === 'kurang') {
  $qty = $_GET['qty'] - 1;
  $total = $_GET['price'] *  $qty;
  $tambah = mysqli_query($mysqli, "UPDATE keranjang SET qty= '$qty', total = '$total' WHERE id_keranjang = $_GET[id_keranjang]");
  if ($tambah) {
    // echo "<script>alert('Data berhasil Dihapus');</script>";
    echo "<script>location='../keranjang.php?id=1';</script>";
  } else {
    var_dump($addoption);
    die();
  }
}
