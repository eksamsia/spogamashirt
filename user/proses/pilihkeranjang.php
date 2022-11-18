<?php
require_once "../../db/koneksi.php";
$check = $_POST['check'];
$idkeranjang = $_POST['idkeranjang'];

$status = 0;
if ($check == 'true') $status = 1;

$mysqli->query("UPDATE keranjang SET selected = {$status} WHERE id_keranjang = {$idkeranjang}");

echo json_encode(['res' => 1]);
