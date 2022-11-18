<?php include 'header.php';



$list = $mysqli->query("SELECT * FROM transaksi WHERE id_transaksi = $_GET[id]");
$transaksi = $list->fetch_assoc();

$data = $mysqli->query("SELECT * FROM pengiriman WHERE id_transaksi = $_GET[id]");
$alamat = $data->fetch_assoc();

?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Konfirmasi Pembelian</h1>
        <nav class="d-flex align-items-center">
          <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="category.html">Konfirmasi Pembelian</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->

<!--================Order Details Area =================-->
<section class="order_details section_gap">
  <div class="container">
    <?php if ($transaksi['status_transaksi'] === 'Pesanan Dikirim') {
      # code...
    ?>
      <div class="alert alert-primary" role="alert">
        Pesananmu Sudah Dikirim! Harap Konfirmasi pesanan jika sudah sampai. <a href="../admin/proses/confirm_pesanan.php?status=complete&id=<?php echo $_GET['id'] ?>" class="alert-link">Konfirmasi
          Disini</a>.
      </div>
    <?php } ?>

    <?php if ($transaksi['status_transaksi'] === 'Pesanan Selesai') {
      # code...
    ?>
      <div class="alert alert-success" role="alert">
        Selamat pesananmu telah selesai! Terimakasih telah berbelanja di Toko Kami.
      </div>
    <?php } ?>

    <!-- <h3 class="title_confirmation">Thank you. Your order has been received.</h3> -->
    <div class="row order_d_inner">
      <div class="col-lg-4">
        <div class="details_item">
          <h4>Informasi Pembelian</h4>
          <ul class="list">
            <li><a href="#"><span>Order number</span> : <?php echo $transaksi['order_id'] ?></a></li>
            <li><a href="#"><span>Tangga Beli</span> : <?php echo $transaksi['tgl_bayar'] ?></a></li>
            <li><a href="#"><span>Total Bayar</span> :
                Rp <?php echo number_format($transaksi['total_bayar'] + $transaksi['ongkir'])  ?></a></li>
            <li><a href="#"><span>Metode Pembayaran</span> : <?php echo $transaksi['payment_type'] ?></a></li>
            <li><a href="#"><span>Status Pembelian</span> : <?php echo $transaksi['status_transaksi'] ?></a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="details_item">
          <h4>Informasi Pembayaran</h4>
          <ul class="list">
            <li><a href="#"><span>Bank</span> : <?php echo $transaksi['bank'] ?></a></li>
            <li><a href="#"><span>Virtual Number</span> : <?php echo $transaksi['va_number'] ?></a></li>
            <li><a href="#"><span>batas Pembayaran</span> :
                <?php echo $transaksi['tgl_bayar']  ?></a></li>
            <li><a href="#"><span>Cara Pembayaran</span> : <a href="<?php echo $transaksi['pdf_url'] ?>">
                  Lihat disini</a></li>
            <li><a href="#"><span>Status Pembayaran</span> :
                <?php echo $transaksi['status_pembayaran'] ?>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="details_item">
          <h4>Alamat Pengantaran</h4>
          <ul class="list">
            <li><a href="#"><span>Nama Penerima</span> : <?php echo $alamat['nama_penerima'] ?></a></li>
            <li><a href="#"><span>No Handphone</span> : <?php echo $alamat['no_hp'] ?></a></li>
            <li><a href="#"><span>Alamat Lengkap</span> :<?php echo $alamat['alamat_lengkap'] ?></a></li>
            <li><a href="#"><span>Kode Pos </span> : <?php echo $alamat['kode_pos'] ?></a></li>
            <li><a href="#"><span>No Resi </span> : <?php echo $alamat['resi'] ?></a></li>
          </ul>
        </div>
      </div>
      <!-- <div class="col-lg-4">
        <div class="details_item">
          <h4>Shipping Address</h4>
          <ul class="list">
            <li><a href="#"><span>Street</span> : 56/8</a></li>
            <li><a href="#"><span>City</span> : Los Angeles</a></li>
            <li><a href="#"><span>Country</span> : United States</a></li>
            <li><a href="#"><span>Postcode </span> : 36952</a></li>
          </ul>
        </div>
      </div> -->
    </div>
    <div class="order_details_table">
      <h2>Order Details</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nama Produk</th>
              <th scope="col">qty</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $x = $mysqli->query("SELECT *, detail_transaksi.qty AS jumlah_beli FROM detail_transaksi JOIN produk ON detail_transaksi.`id_produk` = produk.`id_produk` WHERE id_transaksi = $_GET[id]");
            while ($produk = $x->fetch_assoc()) {
            ?>
              <tr>
                <td>
                  <p><?php echo $produk['nama_produk'] ?></p>
                </td>
                <td>
                  <h5>x <?php echo $produk['jumlah_beli'] ?></h5>
                </td>
                <td>
                  <p>Rp <?php echo number_format($produk['total']) ?></p>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<!--================End Order Details Area =================-->
<?php include 'footer.php'; ?>