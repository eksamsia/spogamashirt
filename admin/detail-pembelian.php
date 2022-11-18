<?php include 'header.php';

$data = $mysqli->query("SELECT * FROM transaksi JOIN user ON  transaksi.id_user = user.id_user WHERE id_transaksi = $_GET[id]");
$detail = $data->fetch_assoc();

$query = $mysqli->query("SELECT * FROM pengiriman WHERE id_transaksi = $_GET[id]");
$alamat = $query->fetch_assoc();

?>
<div class="content">
  <div class="container-fluid">
    <div class="alert alert-warning">
      <button type="button" aria-hidden="true" class="close" data-dismiss="alert">
        <i class="nc-icon nc-simple-remove"></i>
      </button>
      <span>
        <b> Info - </b> <i class="nc-icon nc-bank"></i> Pesanan ini <?php echo $detail['status_transaksi'] ?></span>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card  card-tasks">
          <div class="card-header ">
            <h4 class="card-title">Informasi Pembelian dan Pembayaran</h4>
            <!-- <p class="card-category">Backend development</p> -->
          </div>
          <div class="card-body ">
            <div class="table-full-width">
              <table class="table">
                <tbody>
                  <tr>
                    <td colspan=5>

                      <p class="card-category">Order Id</p>
                    </td>
                    <td class="td-actions text-right"><?php echo $detail['order_id'] ?></td>
                  </tr>
                  <tr>
                    <td colspan=5>
                      <p class="card-category">Tanggal Pembelian</p>
                    </td>
                    <td class="td-actions text-right"><?php echo $detail['tgl_bayar'] ?></td>
                  </tr>
                  <tr>
                    <td colspan=5>
                      <p class="card-category">Nama Pembeli</p>
                    </td>
                    <td class="td-actions text-right"><?php echo $detail['nama_user'] ?></td>
                  </tr>
                  <tr>
                    <td colspan=5>
                      <p class="card-category">Total Pembayaran</p>
                    </td>
                    <td class="td-actions text-right">Rp <?php echo number_format($detail['total_bayar']) ?></td>
                  </tr>

                  <tr>
                    <td colspan=5>
                      <p class="card-category">Metode Pembayaran</p>
                    </td>
                    <td class="td-actions text-right"> <?php echo ($detail['payment_type']) ?></td>
                  </tr>
                  <tr>
                    <td colspan=5>
                      <p class="card-category">Bank</p>
                    </td>
                    <td class="td-actions text-right"> <?php echo ($detail['bank']) ?></td>
                  </tr>
                  <tr>
                    <td colspan=5>
                      <p class="card-category">Nomor Virtual Akun</p>
                    </td>
                    <td class="td-actions text-right"> <?php echo ($detail['va_number']) ?></td>
                  </tr>
                  <tr>
                    <td colspan=5>
                      <p class="card-category">Status Pembayaran</p>
                    </td>
                    <td class="td-actions text-right"> <?php echo ($detail['status_pembayaran']) ?></td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-6">
        Ubah Status :
        <?php if ($detail['status_transaksi'] === 'menunggu pembayaran') {
          # code...
        ?>
          <a href="" class="btn btn-primary btn-block mb-3 mt-1" onclick="demo.showNotification('top','left')" disabled>Packing
            Pesanan</a>
        <?php } ?>
        <?php if ($detail['status_transaksi'] === 'pembayaran terverifikasi') {
          # code...
        ?>
          <a href="proses/confirm_pesanan.php?status=packing&id=<?php echo $_GET['id'] ?>" class="btn btn-primary btn-block mb-3 mt-1" onclick="demo.showNotification('top','right')">Packing
            Pesanan</a>
        <?php } ?>
        <?php if ($detail['status_transaksi'] === 'pesanan dikemas') {
          # code...
        ?>
          <div class="form-group">
            <label>No resi</label>
            <form action="proses/confirm_pesanan.php?status=resi&id=<?php echo $_GET['id'] ?>" method="GET">
              <input type="text" class="form-control" placeholder="Tulis Disini" name="resi">
              <input type="hidden" class="form-control" placeholder="Tulis Disini" name="id" value="<?php echo $_GET['id'] ?>">
              <input type="hidden" class="form-control" placeholder="Tulis Disini" name="status" value="resi">
          </div>
          <button class="btn btn-primary btn-block mb-3 mt-1" type="submit">pesanan
            dikirim</button>
          </form>
        <?php } ?>

        <?php if ($detail['status_transaksi'] === 'Pesanan Dikirim') {
          # code...
        ?>
          <a href="" class="btn btn-primary btn-block mb-3 mt-1" onclick="demo.showNotification('top','left')" disabled>Pesanan Dalam Perjalanan</a>
        <?php } ?>

        <?php if ($detail['status_transaksi'] === 'complete') {
          # code...
        ?>
          <a href="" class="btn btn-success btn-block mb-3 mt-1" onclick="demo.showNotification('top','left')" disabled>Pesanan Diselesaikan Pembeli</a>
        <?php } ?>

        <div class="card  card-tasks">
          <div class="card-header ">
            <h4 class="card-title">Daftar Pembelian</h4>
            <!-- <p class="card-category">Backend development</p> -->
          </div>
          <div class="card-body ">
            <div class="table-full-width">
              <table class="table">
                <tbody>
                  <?php

                  $lenght = $mysqli->query("SELECT *, detail_transaksi.qty as beli FROM detail_transaksi JOIN produk ON detail_transaksi.`id_produk` = produk.`id_produk` WHERE id_transaksi = $_GET[id]");
                  while ($list = $lenght->fetch_assoc()) {
                  ?>
                    <tr>
                      <td>
                        <p class="card-category"><?php echo $list['nama_produk'] ?> </p>
                      </td>
                      <td>
                        <p class="card-category"><?php echo $list['beli'] ?>x </p>
                      </td>
                      <td>
                        <p class="card-category">Rp <?php echo number_format($list['total']) ?> </p>
                      </td>
                    </tr>

                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer ">
            <hr>
            <div class="stats">
              <?php echo $alamat['nama_penerima'] ?><br>
              <?php echo $alamat['no_hp'] ?><br>
              <?php echo $alamat['alamat_lengkap'] ?>
              <br>
              No Resi : <?php echo $alamat['resi'] ?>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<?php include 'footer.php'; ?>