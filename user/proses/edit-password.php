<?php

include '../../db/koneksi.php';

$user = $_POST['id_user'];
$oldpassword = $_POST['password_lama'];
$newpassword = $_POST['password_baru'];
$cpassword = $_POST['c_password_baru'];

if ($newpassword == $cpassword) {
  $sql = "SELECT * FROM user WHERE password='$oldpassword' AND id_user = '$user'";
  $result = mysqli_query($mysqli, $sql);

  if ($result->num_rows > 0) {
    $sql = "UPDATE user SET password= '$newpassword' WHERE id_user ='$user' ";
    $results = mysqli_query($mysqli, $sql) or die(mysqli_error());
    
    if ($results) {
      echo "<script>alert('Password Telah Berhasil Diubah')</script>";

    header("Location: ../profile.php?msg=berhasi&page=transaksi"."&&id=".$user);
    }
    var_dump($results); 
    }else{
    header("Location: ../profile.php?page=password"."&&id=".$user);
    echo "<script>alert('Password Lama Salah')</script>";
    }

}else {
  header("Location: ../profile.php?page=password"."&&id=".$user);
  echo "<script>alert('Password Baru Tidak Sama')</script>";
}

die();
// $hapus =mysqli_query($mysqli, "DELETE FROM alamat WHERE id_alamat='$_GET[id_alamat]' ");

// var_dump($hapus);
// die();

// if ($hapus) {
//   header("Location: ../user/profile.php?section=alamat"."&&id=".$_GET['id']);
//   }

?>