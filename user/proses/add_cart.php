<?php
require_once "../../db/koneksi.php";



$id = $_GET['id_produk'];
$user = $_GET['id_user'];
// $id_option = $_GET['id_option'];

$qty = 1;

// var_dump($kd_warna,$kd_ukuran );
// die();

$cart = $mysqli->query("SELECT * FROM keranjang");
while ($keranjang = $cart->fetch_assoc()) {
  $idKeranjang  =  $keranjang['id_produk'];
  $idUser       =  $keranjang['id_user'];
  // $idoption =  $keranjang['id_option'];


}

$ambil = $mysqli->query("SELECT * FROM produk WHERE id_produk='$id'");
$perproduk = $ambil->fetch_assoc();

// $diskon = ($perproduk['diskon_percent'] / 100) * $perproduk['harga'];
$price = $perproduk['harga'];
$diskon = $perproduk['diskon'];

$total = ($price * $qty) - ($diskon * $qty);



if ($id == $idKeranjang & $user == $idUser) {
  $ambil1 = $mysqli->query("SELECT * FROM produk WHERE id_produk='$id'");
  $perproduk1 = $ambil1->fetch_assoc();

  $barang   = $mysqli->query("SELECT * FROM keranjang WHERE id_produk='$id' AND id_user='$user'");
  $jumlah   = $barang->fetch_assoc();
  $oldQty   = $jumlah['qty'];
  $newQty   = $oldQty + 1;
  // $diskon1 = ($perproduk1['diskon_percent'] / 100) * $perproduk1['harga'];
  $price1   = $perproduk1['harga'];
  $diskon1  = $perproduk1['diskon'];

  $total1 = ($price1 * $newQty) - ($diskon1 - $newQty);


  $sql = mysqli_query($mysqli, "UPDATE keranjang SET qty = '$newQty', total='$total1' WHERE id_produk='$id' AND id_user='$user'");

  if ($sql) {
    echo "<script>alert('Produk Berhasil Ditambahkan Ke Keranjang');</script>";
    echo "<script>location='../keranjang.php?id=$_GET[id_user]';</script>";
  }
} else {
  // $id_option = $_POST['id_option'];
  // $date = date('y'-'m'-'d');

  $sql = mysqli_query($mysqli, "INSERT INTO keranjang (id_user, id_produk, qty, total, selected) VALUES ({$user},{$id},{$qty},{$total},1)");

  if ($sql) {
    echo "<script>alert('Produk Berhasil Ditambahkan Ke Keranjang');</script>";
    echo "<script>location='../keranjang.php?id=$_GET[id_user]';</script>";
  } else {
    var_dump(mysqli_error($sql));
    die();
  }
}




// $add_cart = $mysqli->query("INSERT INTO keranjang (id_user, id_produk, qty, total) VALUES('".$_GET['id_user']."', '".$_GET['id_produk']."', 1, '".$_GET['harga']."')") or die(mysqli_error($mysqli));

// if ($add_cart) {
//   echo "<script>alert('Produk Berhasil Ditambahkan Ke Keranjang');</script>";
//   echo "<script>location='../keranjang.php?id=$_GET[id_user]';</script>";
// }
