<?php

include '../../db/koneksi.php';

$profile =mysqli_query($mysqli, "UPDATE alamat SET nama_penerima= '".$_GET['nama_penerima']. "', no_hp='".$_GET['no_hp']. "' , id_provinsi='".$_GET['province_destination']. "', id_kota='".$_GET['city_destination']. "', alamat_lengkap='".$_GET['alamat_lengkap']. "', kode_pos ='".$_GET['kode_pos']. "' WHERE id_alamat ='".$_GET['id_alamat']. "' ");

if ($profile) {
  header("Location: ../profile.php?page=alamat"."&&id=".$_GET['id_user']);
  }

?>