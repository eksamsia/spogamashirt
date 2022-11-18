<?php
require_once "../../db/koneksi.php";
$tanggal = date("Y-m-d H:i:s");

// dikemas
// dikirim
//selesaikan
// return


if ($_GET['status'] == 'packing') {
  $acckonfirmation = mysqli_query($mysqli, "UPDATE transaksi SET status_transaksi = 'pesanan dikemas' WHERE id_transaksi = '$_GET[id]'");
  if ($acckonfirmation) {
    echo "<script>location='../detail-pembelian.php?id=$_GET[id]';</script>";
  }
}

if ($_GET['status'] == 'resi') {

  $acckonfirmation = mysqli_query($mysqli, "UPDATE transaksi SET status_transaksi= 'Pesanan Dikirim' WHERE id_transaksi = '$_GET[id]'");
  $pengiriman = mysqli_query($mysqli, "UPDATE pengiriman SET resi = '{$_GET['resi']}' WHERE id_transaksi = {$_GET['id']}");
  if ($acckonfirmation) {
    echo "<script>location='../detail-pembelian.php?id=$_GET[id]';</script>";
    var_dump($pengiriman);
  }
}

if ($_GET['status'] == 'complete') {
  $acckonfirmation = mysqli_query($mysqli, "UPDATE transaksi SET status_transaksi= 'Pesanan Selesai' WHERE id_transaksi = '$_GET[id]'");
  if ($acckonfirmation) {
    echo "<script>location='../../user/detail-transaksi.php?id=$_GET[id]';</script>";
  }
}

if ($_GET['status'] == 'retur') {
  $acckonfirmation = mysqli_query($mysqli, "UPDATE transaksi SET status_transaksi= 'Retur Diterima' WHERE id_transaksi = '$_GET[id]'");

  $accretur = mysqli_query($mysqli, "UPDATE retur SET status= 'Retur Diterima' WHERE id_transaksi = '$_GET[id]'");

  if ($acckonfirmation) {
    echo "<script>location='../detail-retur.php?id=$_GET[id]';</script>";
  }
}

if ($_GET['status'] == 'reject') {
  $acckonfirmation = mysqli_query($mysqli, "UPDATE transaksi SET status_transaksi= 'Retur Ditolak' WHERE id_transaksi = '$_GET[id]'");
  $reject = mysqli_query($mysqli, "UPDATE retur SET status= 'Retur Ditolak', keterangan='$_GET[keterangan]' WHERE id_transaksi = '$_GET[id]'");
  if ($acckonfirmation) {
    echo "<script>location='../detail-retur.php?id=$_GET[id]';</script>";
    var_dump($pengiriman);
  }
}

var_dump($acckonfirmation);
die();
