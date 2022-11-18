<?php
require_once "../../db/koneksi.php";


$namanamafoto = $_FILES['gambar']['name'];
$lokasilokasifoto = $_FILES['gambar']['tmp_name'];

  if (!empty($lokasilokasifoto))
  {

move_uploaded_file($lokasilokasifoto, "../../gambar_produk/".$namanamafoto);

 $add =  mysqli_query($mysqli, "UPDATE produk SET nama_produk= '$_POST[nama_produk]', harga= '$_POST[harga]',diskon= '$_POST[diskon]', stock= '$_POST[stock]', gambar= '$namanamafoto', deskripsi= '$_POST[deskripsi]', id_kategori= '$_POST[id_kategori]' WHERE id_produk = '$_POST[id_produk]'");
  } else{

    
 $add =  mysqli_query($mysqli, "UPDATE produk SET nama_produk= '$_POST[nama_produk]', harga= '$_POST[harga]',diskon= '$_POST[diskon]', stock= '$_POST[stock]', deskripsi= '$_POST[deskripsi]', id_kategori= '$_POST[id_kategori]' WHERE id_produk= '$_POST[id_produk]'");

  }

  // print_r($add);
  //   die();
echo "<script>alert('Brands berhasil diubah');</script>";
echo "<script>location='../produk.php?page=produk';</script>";






 

?>