<?php
require_once "../../db/koneksi.php";
echo "good";





$transaksi = $mysqli->query("INSERT INTO transaksi(id_user, total_bayar, order_id, ongkir, tgl_bayar, status_transaksi, payment_type, status_pembayaran, transaction_id, bank, va_number, pdf_url) VALUES($_POST[id_user], '" . $_POST['total_bayar'] . "', '" . $_POST['order_id'] . "', '" . $_POST['ongkir'] . "', '" . $_POST['tgl_bayar'] . "', 'menunggu pembayaran', '" . $_POST['payment_type'] . "' , '" . $_POST['transaction_status'] . "' , '" . $_POST['transaction_id'] . "', '" . $_POST['bank'] . "', '" . $_POST['va_number'] . "', '" . $_POST['pdf_url'] . "')") or die(mysqli_error($mysqli));


if ($transaksi) {
  $select = $mysqli->query("SELECT MAX(id_transaksi) AS id_trans FROM transaksi");
  $idtrans = $select->fetch_assoc();

  $pengiriman = $mysqli->query("INSERT INTO pengiriman(id_user, id_transaksi, kurir, nama_penerima, no_hp, alamat_lengkap, kode_pos) VALUES($_POST[id_user], '" . $idtrans['id_trans'] . "', '" . $_POST['kurir'] . "', '" . $_POST['nama_penerima'] . "' , '" . $_POST['no_hp'] . "',  '" . $_POST['alamat_lengkap'] . "', '" . $_POST['kode_pos'] . "')") or die(mysqli_error($mysqli));

  for ($i = 0; $i < sizeof($_POST['id_product']); $i++) {

    $detail = "INSERT INTO detail_transaksi (id_transaksi, id_user, id_produk, qty, total ) VALUES ('" . $idtrans['id_trans'] . "',$_POST[id_user],'" . $_POST['id_product'][$i] . "','" . $_POST['qty'][$i] . "','" . $_POST['total'][$i] . "')";
    mysqli_query($mysqli, $detail) or die(mysqli_error());

    if ($detail) {
      $delete = $mysqli->query("DELETE FROM keranjang WHERE id_user = {$_POST['id_user']} AND selected = 1");
      if ($delete) {
        //  header("Location: ../detail_pembelian.php?id=$_GET[id]");
        //  echo "<script>location='../detail_pembelian.php?id=$idtrans[id_trans]';</script>";
        echo $idtrans['id_trans'];
      }
    }
  }
  echo $idtrans['id_trans'];
} else {
  echo 'gagal input data :(';
}


// print_r($$addkaryawan);
// die();
// if ($add_cart) {
//   echo "<script>alert('Produk Berhasil Ditambahkan Ke Keranjang');</script>";
//   echo "<script>location='../cart.php?id=$_GET[id_user]';</script>";
// }
