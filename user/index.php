<?php
include 'header.php';

$batas = 12;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;


// $uk=$mysqli->query("SELECT  COUNT(id_pemesanan) as ukuran FROM pemesanan WHERE status_order = '$_GET[status]'");
$data = $mysqli->query("SELECT * FROM produk");

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
?>
<!-- start banner Area -->
<section class="banner-area">
  <div class="container">
    <div class="row fullscreen align-items-center justify-content-start">
      <div class="col-lg-12">
        <div class="active-banner-slider owl-carousel">
          <!-- single-slide -->
          <div class="row single-slide align-items-center d-flex">
            <div class="col-lg-5 col-md-6">
              <div class="banner-content">
                <h1>Gamashirt</h1>
                <p>Temukan barang yang kamu inginkan di Gamashirt, dengan desain yang Up to date dan harga terjangkau.
                  Beli dan miliki barang inpianmu di Gamashirt sekarang.
                </p>

              </div>
            </div>
            <div class="col-lg-7">
              <div class="banner-img">
                <img class="img-fluid" src="../baju.png" alt="" style="height: 500px;">
              </div>
            </div>
          </div>
          <!-- single-slide -->
          <div class="row single-slide">
            <div class="col-lg-5 col-md-6">
              <div class="banner-content">
                <h1>Gamashirt</h1>
                <p>Temukan barang yang kamu inginkan di Gamashirt, dengan desain yang Up to date dan harga terjangkau.
                  Beli dan miliki barang inpianmu di Gamashirt sekarang.</p>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="banner-img">
                <img class="img-fluid" src="../baju2.png" alt="" style="height: 500px;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
  <div class="container">
    <div class="row features-inner">
      <!-- single features -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
          <div class="f-icon">
            <img src="img/features/f-icon1.png" alt="">
          </div>
          <h6>Pengiriman Cepat</h6>
          <p>Mengirim produk anda dengan cepat</p>
        </div>
      </div>
      <!-- single features -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
          <div class="f-icon">
            <img src="img/features/f-icon2.png" alt="">
          </div>
          <h6>Akses Mudah</h6>
          <p>Akses web dimanapun</p>
        </div>
      </div>
      <!-- single features -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
          <div class="f-icon">
            <img src="img/features/f-icon3.png" alt="">
          </div>
          <h6>24/7 Support</h6>
          <p>Hubungi kami dalam 24 jam</p>
        </div>
      </div>
      <!-- single features -->
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="single-features">
          <div class="f-icon">
            <img src="img/features/f-icon4.png" alt="">
          </div>
          <h6>Pembayaran Aman</h6>
          <p>Bayar dimanapun dan kapanpun</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end features Area -->



<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">
  <!-- single product slide -->
  <div class="single-product-slider">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-title">
            <h1>Produk Terbaru</h1>
            <p>Cari Produk Kesukaanmu</p>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- single product -->

        <?php
        $no = $halaman_awal + 1;
        $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori LIMIT $halaman_awal, $batas");
        while ($list = $lenght->fetch_assoc()) {
        ?>

          <div class="col-lg-3 col-md-6">
            <div class="single-product">
              <img class="img-fluid" src="../gambar_produk/<?php echo $list['gambar'] ?>" alt="" style="height:150px;">
              <div class="product-details">
                <h6><?php echo $list['nama_produk'] ?></h6>
                <div class="price">
                  <h6>Rp <?php echo number_format($list['harga']) ?></h6>
                  <!-- <h6 class="l-through">Rp <?php echo $list['harga'] ?></h6> -->
                </div>
                <div class="prd-bottom">

                  <?php
                  if (isset($_SESSION['user'])) {
                  ?>
                    <a href="proses/add_cart.php?id_user=<?= $_SESSION['user']; ?>&id_produk=<?= $list['id_produk']; ?>&harga=<?= $list['harga']; ?>" class="social-info">
                      <span class="ti-bag"></span>
                      <p class="hover-text">add to bag</p>
                    </a>
                  <?php } else { ?>
                    <a href="login.php" class="social-info">
                      <span class="ti-bag"></span>
                      <p class="hover-text">add to bag</p>
                    </a>
                  <?php } ?>


                  <a href="produk-detail.php?id=<?php echo $list['id_produk'] ?>" class="social-info">
                    <span class="lnr lnr-move"></span>
                    <p class="hover-text">Detail produk</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- single product slide -->
  <div class="single-product-slider">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-title">
            <h1>Produk Terlaris</h1>
            <p>Cari Produk Kesukaanmu</p>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- single product -->
        <?php
        // $no = $halaman_awal+1;
        $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori LIMIT $halaman_awal, $batas");
        while ($list = $lenght->fetch_assoc()) {
        ?>
          <div class="col-lg-3 col-md-6">
            <div class="single-product">
              <img class="img-fluid" src="../gambar_produk/<?php echo $list['gambar'] ?>" alt="" style="height:150px;">
              <div class="product-details">
                <h6><?php echo $list['nama_produk'] ?></h6>
                <div class="price">
                  <h6>Rp <?php echo number_format($list['harga']) ?></h6>
                  <!-- <h6 class="l-through">Rp <?php echo $list['harga'] ?></h6> -->
                </div>
                <div class="prd-bottom">

                  <a href="" class="social-info">
                    <span class="ti-bag"></span>
                    <p class="hover-text">add to bag</p>
                  </a>
                  <a href="" class="social-info">
                    <span class="lnr lnr-move"></span>
                    <p class="hover-text">view more</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>
<!-- end product Area -->


<?php include 'footer.php'; ?>