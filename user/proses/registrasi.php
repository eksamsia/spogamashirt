<?php 
 
 include '../../db/koneksi.php';
 
error_reporting(0);
 
session_start();
 
// if (isset($_SESSION['id_user'])) {
//     header("Location: index.php");
// }
 



  $id=$mysqli->query("SELECT MAX(id_user) + 1 as iduser FROM user");
  $idd = $id->fetch_assoc();

  $ids = $idd['iduser'];

    $nama = $_POST['nama_user'];
    $no_tlp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $username = $_POST['username'];

    // $city = $_POST['city_destination'];
    // $provinsi = $_POST['province_destination'];
    // $alamat = $_POST['alamat_lengkap'];
    // $kode = $_POST['kode_pos'];
    // $label = $_POST['label_pengiriman'];
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM user WHERE email='$email'";
        $cek = "SELECT MAX(id_user) + 1 as iduser FROM user";
        $result = mysqli_query($mysqli, $sql);
        $cc = mysqli_query($mysqli, $cek);
        // $id = $cc['iduser'];
        
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO user (nama_user, username, email, no_hp, password) VALUES ('$nama', '$username', '$email', '$no_tlp', '$password')";
            $result = mysqli_query($mysqli, $sql) or die(mysqli_error());

            if ($result) {
                // echo "<script>alert('Selamat, registrasi berhasil!')</script>";
            //     $query = "INSERT INTO alamat (id_user, label_alamat, nama_penerima, no_hp, id_kota, id_provinsi, alamat_lengkap, kode_pos, is_set) VALUES ('$ids', ' $label', '$nama', '$no_tlp', ' $city', ' $provinsi', '$alamat','$kode', 'true')";
            // $alamat = mysqli_query($mysqli, $query) or die(mysqli_error());

    
              header("Location: ../login.php?registrasi=sukses");
              $nama = "";
              $email = "";
              $_POST['password'] = "";
              $_POST['cpassword'] = "";
            
                
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
              header("Location: ../register.php?registrasi=sukses");

            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
            header("Location: ../register.php?registrasi=sukses");

        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
        header("Location: ../register.php?registrasi=sukses");

    }

 
?>