<?php include 'header.php'; ?>
<?php

$lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk = $_GET[id]");
$list = $lenght->fetch_assoc();
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Detail Produk</h1>
        <nav class="d-flex align-items-center">
          <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="#">Produk<span class="lnr lnr-arrow-right"></span></a>
          <a href="single-product.html">Detail Produk</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<div class="product_image_area" style="margin-bottom:120px;">
  <div class="container">
    <div class="row s_product_inner">
      <div class="col-lg-6">
        <div class="s_Product_carousel">
          <div class="single-prd-item">
            <img class="img-fluid" src="../gambar_produk/<?php echo $list['gambar'] ?>" alt="">
          </div>
          <div class="single-prd-item">
            <img class="img-fluid" src="../gambar_produk/<?php echo $list['gambar'] ?>" alt="">
          </div>
          <div class="single-prd-item">
            <img class="img-fluid" src="../gambar_produk/<?php echo $list['gambar'] ?>" alt="">
          </div>
        </div>
      </div>
      <div class="col-lg-5 offset-lg-1">
        <div class="s_product_text">
          <h3><?php echo  $list['nama_produk']; ?></h3>
          <?php if ($list['diskon']) : ?>
            <h6 class="l-through" style="text-decoration:line-through;">Rp <?php echo number_format($list['harga']) ?></h6>
          <?php endif; ?>

          <h2>Rp <?php echo number_format($list['harga'] - $list['diskon']); ?></h2>
          <ul class="list">
            <li><a class="active" href="#"><span>Category</span> : <?php echo  $list['nama_kategori']; ?></a></li>
            <li><a href="#"><span>Stok</span> : <?= $list['stock'] ?></a></li>
          </ul>
          <p><?php echo  $list['deskripsi']; ?></p>
          <div class="product_count">
            <label for="qty">Quantity:</label>
            <input type="text" name="qty" id="sst" max="<?= $list['stock'] ?>" value="1" title="Quantity:" class="input-text qty">
            <button onclick="tambahProduk()" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
            <button onclick="kurangProduk()" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
          </div>
          <div class="card_area d-flex align-items-center">
            <?php if (isset($_SESSION['user'])) { ?>
              <?php if ($list['stock'] <= 0) : ?>
                <button class="btn btn-danger">Stok Habis</button>
              <?php else : ?>
                <a class="primary-btn" href="proses/add_cart.php?id_user=<?= $_SESSION['user']; ?>&id_produk=<?= $list['id_produk']; ?>&harga=<?= $list['harga']; ?>">Add to Cart</a>
              <?php endif; ?>
            <?php } else { ?>
              <a class="primary-btn" href="login.php">Add to Cart</a>
              </li>
            <?php } ?>

            <!-- <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a> -->
            <!-- <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->

<script>
  function kurangProduk() {
    var result = document.getElementById('sst');
    var sst = result.value;
    if (!isNaN(sst) && sst > 0) result.value--;
    return false;
  }

  function tambahProduk() {
    var result = document.getElementById('sst');
    let max = result.getAttribute('max');


    var sst = result.value;
    if (parseInt(sst) >= parseInt(max)) {

      return false;
    }

    if (!isNaN(sst)) result.value++;
    return false;
  }
</script>

<?php include 'footer.php'; ?>