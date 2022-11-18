<?php
require_once "../../db/koneksi.php";

$add_cart = $mysqli->query("INSERT INTO alamat (id_user, nama_penerima, no_hp, id_provinsi, id_kota, alamat_lengkap, kode_pos, is_select) VALUES('" . $_POST['id_user'] . "', '" . $_POST['nama_penerima'] . "', '" . $_POST['no_hp'] . "','" . $_POST['province_destination'] . "', '" . $_POST['city_destination'] . "', '" . $_POST['alamat_lengkap'] . "', '" . $_POST['kode_pos'] . "', 'false')") or die(mysqli_error($mysqli));
// print_r($$addkaryawan);
// die();
if ($add_cart) {
    echo "<script>alert('Berhasil Menambah Alamat');</script>";
    echo "<script>location='../profile.php?id=$_POST[id_user]&page=alamat';</script>";
}
