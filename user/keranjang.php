<?php include 'header.php'; ?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Keranjang Belanja</h1>
        <nav class="d-flex align-items-center">
          <a href="">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="">Keranjang</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
  <div class="container">
    <div class="cart_inner">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
              <th scope="col">Total</th>
              <th scope="col"></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php

            $total = 0;
            $lenght = $mysqli->query("SELECT *, keranjang.qty AS beli FROM keranjang JOIN produk ON keranjang.`id_produk` = produk.`id_produk` WHERE id_user = $_SESSION[user]");
            while ($list = $lenght->fetch_assoc()) {
              $status = 0;

              if ($list['selected']) $status = 1;
              if ($list['stock'] == 0) {
                $mysqli->query("UPDATE keranjang SET selected = 0 WHERE id_keranjang = {$list['id_keranjang']}");
                $status = 0;
              }

              $harga = $list['harga'] - $list['diskon'];
            ?>
              <tr>
                <td>
                  <div class="media">
                    <div class="d-flex">
                      <img src="../gambar_produk/<?php echo $list['gambar'] ?>" style="width: 100px; height: 100px; border-radius: 10px;" alt="">
                    </div>
                    <div class="media-body">
                      <p><?php echo $list['nama_produk']; ?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>Rp <?php echo number_format($harga); ?></h5>
                </td>
                <?php if ($list['stock'] == 0) : ?>
                  <?php
                  $harga = $list['harga'] * $list['beli'];
                  if ($list['diskon']) {
                    $harga -= $list['diskon'] * $list['beli'];
                  }

                  $total += $harga;
                  ?>
                  <td>
                    STOK HABIS
                  </td>
                <?php else : ?>
                  <td>
                    <div class="product_count">
                      <input type="text" name="qty" id="sst" maxlength="12" value="<?php echo $list['beli']; ?>" title="Quantity:" class="input-text qty">
                      <button class="increase items-count" type="button"><a href="proses/update_cart.php?id_keranjang=<?php echo $list['id_keranjang'] ?>&action=tambah&qty=<?php echo $list['beli'] ?>&price=<?php echo $harga ?>"><i class="lnr lnr-chevron-up"></i></a></button>
                      <button class="reduced items-count" type="button"><a href="proses/update_cart.php?id_keranjang=<?php echo $list['id_keranjang'] ?>&action=kurang&qty=<?php echo $list['beli'] ?>&price=<?php echo $harga ?>"><i class="lnr lnr-chevron-down"></i></a></button>
                    </div>
                  </td>
                <?php endif; ?>

                <td>
                  <h5>Rp <?php echo number_format($list['total']); ?></h5>
                </td>
                <td>
                  <?php if ($status) : ?>
                    <input type="checkbox" class="pilihkeranjang" data-keranjang="<?= $list['id_keranjang'] ?>" checked>
                  <?php else : ?>
                    <input type="checkbox" class="pilihkeranjang" data-keranjang="<?= $list['id_keranjang'] ?>">
                  <?php endif; ?>
                </td>
                <td><a href="proses/update_cart.php?id_keranjang=<?php echo $list['id_keranjang'] ?>&action=hapus"><i class="lnr lnr-trash"></i></a></td>
              </tr>
            <?php } ?>
            <tr>

              <td colspan="5">
                <h5>Subtotal</h5>
              </td>
              <td>
                <?php
                $lenght = $mysqli->query("SELECT SUM(total) AS total FROM keranjang WHERE id_user = {$_SESSION['user']} AND selected = 1");
                $total = $lenght->fetch_assoc();
                ?>
                <h5>Rp <?php echo number_format($total['total']) ?></h5>
              </td>
            </tr>

            <tr class="out_button_area">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                <div class="checkout_btn_inner d-flex align-items-center">
                  <a class="gray_btn" href="produk.php?q=">Continue Shopping</a>
                  <a class="primary-btn" href="checkout.php?id=<?php echo $_GET['id'] ?>&ongkir=0&kurir=&amount=<?php echo $total['total'] ?>">Checkout</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script>
  $(function(e) {
    $(".pilihkeranjang").change(function(e) {
      let check = $(this).is(':checked');
      let idkeranjang = $(this).data('keranjang');
      $.ajax({
        method: 'POST',
        data: {
          check,
          idkeranjang
        },
        url: 'proses/pilihkeranjang.php',
        dataType: 'json',
        success: res => {
          location.reload();
        }
      })
    })
  })
</script>
<?php include 'footer.php'; ?>