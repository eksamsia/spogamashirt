<?php

include '../../db/koneksi.php';

$profile =mysqli_query($mysqli, "UPDATE user SET nama_user= '".$_GET['nama_user']. "', username='".$_GET['username']. "' , email='".$_GET['email']. "', no_hp ='".$_GET['no_hp']. "' WHERE id_user ='".$_GET['id_user']. "' ");

if ($profile) {
  header("Location: ../profile.php?page=profile"."&&id=".$_GET['id_user']);
  }

?>