<?php


include '../../db/koneksi.php';

$profile =mysqli_query($mysqli, "UPDATE alamat SET is_select= 'false' WHERE id_user ='".$_GET['id']. "' ");

if ($profile) {
  $alamat =mysqli_query($mysqli, "UPDATE alamat SET is_select= 'true' WHERE id_alamat ='".$_GET['id_alamat']. "' ");
  
  if ($alamat) {
    header("Location: ../profile.php?id=".$_GET['id']."&page=alamat");
    }
}


?>