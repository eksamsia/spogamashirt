<?php
require_once "../../db/koneksi.php";
$input_source           = file_get_contents('php://input');
$data                   = json_decode($input_source);
$oderid                 = $data->order_id;
$transaction_status     = $data->transaction_status;


if ($data->status_code == 200) {
    $query = "UPDATE transaksi SET status_pembayaran = '{$transaction_status}', status_transaksi = 'pesanan dikemas', tgl_bayar = NOW() WHERE order_id = '{$oderid}'";
    $mysqli->query($query);
}
