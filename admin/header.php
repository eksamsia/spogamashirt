<?php
session_start();
include '../db/koneksi.php';

if (($_SESSION['status']) !== 'admin') {
  header("Location: index.php");
}
$role = $_SESSION['role'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logo_kopma.png">
  <link rel="icon" type="image/png" href="../assets/img/logo_kopma.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Gamashirt</title>
  <link href='../assets/img/logo_kopma.png' rel='shorcut icon'>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/css/demo.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">

  <script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>


</head>

<body>
  <div class="wrapper">
    <div class="sidebar" data-image="../assets/img/logo_kopma.png">

      <div class="sidebar-wrapper">
        <div class="logo">
          <a class="navbar-brand logo_h" href="index.php"><img src="assets/img/logo_kopma.png" width="30px" height="30px" alt=""> Gamashirt</a>
        </div>
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="dashboard.php?page=dashboard">
              <i class="nc-icon nc-icon nc-paper-2"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a class="nav-link" href="produk.php?page=produk">
              <i class="nc-icon nc-tag-content"></i>
              <p>Produk</p>
            </a>
          </li>

          <li>
            <a class="nav-link" href="kategori.php?page=kategori">
              <i class="nc-icon nc-tablet-2"></i>
              <p>Kategori</p>
            </a>
          </li>

          <li>
            <a class="nav-link" href="pembelian.php?page=pembelian">
              <i class="nc-icon nc-cart-simple"></i>
              <p>Pembelian</p>
            </a>
          </li>
          <li>
            <a class="nav-link" href="laporanpenjualan.php">
              <i class="nc-icon nc-paper-2"></i>
              <p>Laporan Penjualan</p>
            </a>
          </li>
          <?php if ($role == 1) : ?>
            <li>
              <a class="nav-link" href="admin.php">
                <i class="nc-icon nc-paper-2"></i>
                <p>Pengurus</p>
              </a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class="container-fluid">

          <div class="collapse navbar-collapse justify-content-end" id="navigation">

            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <span class="no-icon">ganti password</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link btn btn-primary" href="proses/logout.php">
                  <span class="no-icon">Log out</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->