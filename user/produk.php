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

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb mb-5">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Produk Kami</h1>
        <nav class="d-flex align-items-center">
          <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="#">Produk<span class="lnr lnr-arrow-right"></span></a>
          <a href="category.html">Daftar Produk</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->
<div class="container">
  <div class="row">

    <div class="col-xl-3 col-lg-4 col-md-5">
      <div class="sidebar-categories">
        <div class="head">Kategori Produk</div>
        <ul class="main-categories">
          <?php

          $ktg = $mysqli->query("SELECT * FROM kategori");
          while ($kategori = $ktg->fetch_assoc()) {
            $idkategori = $kategori['id_kategori'];
            $jumlahBarang = $mysqli->query("SELECT id_produk FROM produk WHERE id_kategori = {$idkategori}")->num_rows;

          ?>

            <li class="main-nav-list"><a href="produk.php?q=<?php echo $kategori['nama_kategori'] ?>"><?php echo $kategori['nama_kategori'] ?><span class="number"><?= $jumlahBarang ?></span></a></li>
          <?php } ?>
        </ul>
      </div>

      <div class="sidebar-categories">
        <div class="head">Harga</div>
        <form action="" method="POST">
          <input type="number" class="form-control" name="min" placeholder="Min harga">
          <input type="number" class="form-control" name="max" placeholder="Max Harga">

          <button class="btn btn-block" name="submit">Filter</button>
        </form>
      </div>
    </div>
    <div class="col-xl-9 col-lg-8 col-md-7 mb-5">
      <!-- Start Filter Bar -->

      <!-- End Filter Bar -->
      <!-- Start Best Seller -->
      <section class="lattest-product-area pb-40 category-list">
        <div class="row">
          <!-- single product -->
          <?php
          $no = $halaman_awal + 1;
          if (!isset($_GET['q'])) {
            if (isset($_POST['submit'])) {
              $min = $_POST['min'];
              $max = $_POST['max'];
              $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.harga BETWEEN {$min} AND {$max}");
            } else {
              $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori");
            }
          } else {

            if (isset($_POST['submit'])) {
              $min = $_POST['min'];
              $max = $_POST['max'];
              $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE nama_kategori = '{$_GET['q']}' AND produk.harga BETWEEN {$min} AND {$max}");
              if (!$lenght->num_rows) {
                $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.nama_produk LIKE '%{$_GET['q']}%' OR kategori.nama_kategori LIKE '%{$_GET['q']}%' AND produk.harga BETWEEN {$min} AND {$max}");
              }
            } else {
              $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE nama_kategori = '{$_GET['q']}'");
              if (!$lenght->num_rows) {
                $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.nama_produk LIKE '%{$_GET['q']}%' OR kategori.nama_kategori LIKE '%{$_GET['q']}%'");
              }
            }
          }

          while ($list = $lenght->fetch_assoc()) {
          ?>
            <div class="col-lg-4 col-md-6">
              <div class="single-product">
                <img class="img-fluid" src="../gambar_produk/<?php echo $list['gambar'] ?>" alt="" style="height:150px;">
                <div class="product-details">
                  <h6><?php echo $list['nama_produk'] ?></h6>
                  <div class="price">
                    <h6>Rp <?php echo number_format($list['harga'] - $list['diskon']) ?></h6>
                    <?php if ($list['diskon']) : ?>
                      <h6 class="l-through">Rp <?php echo number_format($list['harga']) ?></h6>
                    <?php endif; ?>
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
                      <p class="hover-text">Detail Produk</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>

        </div>
      </section>
      <!-- End Best Seller -->

    </div>


  </div>
</div>


<script>
  var slider = document.getElementById('slider');

  noUiSlider.create(slider, {
    start: [20, 80],
    connect: true,
    range: {
      'min': 0,
      'max': 100
    }
  });
</script>

<?php
include 'footer.php';
?>