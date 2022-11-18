<?php
session_start();
include '../db/koneksi.php';
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
  <!-- Mobile Specific Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/fav_kopma.png">
  <!-- Author Meta -->
  <meta name="author" content="CodePixar">
  <!-- Meta Description -->
  <meta name="description" content="">
  <!-- Meta Keyword -->
  <meta name="keywords" content="">
  <!-- meta character set -->
  <meta charset="UTF-8">
  <!-- Site Title -->
  <title>Gamashirt Kopma UGM</title>
  <!--
		CSS
		============================================= -->
  <link rel="stylesheet" href="css/linearicons.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/themify-icons.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/nice-select.css">
  <link rel="stylesheet" href="css/nouislider.min.css">
  <link rel="stylesheet" href="css/ion.rangeSlider.css" />
  <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="slider/nouislider.min.css">


  <script src="js/vendor/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="slider/nouislider.min.js"></script>

</head>

<body>

  <!-- Start Header Area -->
  <header class="header_area sticky-header">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light main_box">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.php"><img src="img/logo_kopma.png" width="30px" height="30px" alt=""> Gamashirt</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item submenu dropdown">
                <a href="produk.php" class="nav-link">Produk</a>
              </li>

            </ul>
            <?php
            if (isset($_SESSION['user'])) {
            ?>
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item submenu dropdown">
                  <a href="profile.php?id=<?php echo $_SESSION['user'];  ?>&page=transaksi" class="nav-link"><?php echo $_SESSION['nama_user']; ?></a>
                </li>
                <li class="nav-item submenu dropdown">
                  <a href="keranjang.php?id=<?php echo $_SESSION['user'];  ?>" class="nav-link"><span class="ti-bag"></span></a>
                </li>
                <li class="nav-item submenu dropdown">
                  <a class="nav-link" href="proses/logout.php">Logout</a>
                </li>
              </ul>
            <?php } else { ?>
              <ul class="nav navbar-nav menu_nav ml-auto">
                <li class="nav-item submenu dropdown">
                  <a class="nav-link" href="login.php">Masuk</a>
                </li>
              </ul>
            <?php } ?>
            <ul class="nav navbar-nav menu_nav ml-auto">
              <li class="nav-item submenu dropdown">
                <input type="text" class="form-control" id="cariproduk" style="margin-top:2px;" placeholder="Cari Produk">
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <script>
      $(function(e) {
        $("#cariproduk").keyup(function(e) {
          var code = (e.keyCode ? e.keyCode : e.which);
          if (code == 13) { //Enter keycode
            let val = $(this).val();
            document.location.href = 'produk.php?q=' + val
          }
        })
      })
    </script>

  </header>