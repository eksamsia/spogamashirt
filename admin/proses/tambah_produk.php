<?php
require_once "../../db/koneksi.php";



$namanamafoto       = $_FILES['gambar']['name'];
$lokasilokasifoto   = $_FILES['gambar']['tmp_name'];
move_uploaded_file($lokasilokasifoto, "../../gambar_produk/" . $namanamafoto);

$nama_product = $_POST['nama_produk'];
$id_kategori = $_POST['id_kategori'];
//  $gambar = $_POST['foto_produk'];
$deskripsi = $_POST['deskripsi'];
$harga = $_POST['harga'];
$qty = $_POST['stock'];
$diskon = $_POST['diskon'];
//  $harga = $_POST['harga'];

$add =  mysqli_query($mysqli, "INSERT INTO produk(id_kategori, nama_produk, stock, harga, deskripsi,  diskon,  gambar) VALUES('$id_kategori', '$nama_product', '$qty', '$harga', '$deskripsi', '$diskon', '$namanamafoto '  )");


if ($add) {

  // print_r($add);
  // die();
  echo "<script>alert('Produk Berhasil Ditambahkan');</script>";
  echo "<script>location='../produk.php';</script>";
} else {
  print_r($add);
  die();
}
