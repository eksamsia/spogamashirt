<?php
include 'header.php';

include '../db/koneksi.php';
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;


// $uk=$mysqli->query("SELECT  COUNT(id_pemesanan) as ukuran FROM pemesanan WHERE status_order = '$_GET[status]'");
$data = $mysqli->query("SELECT * FROM produk");

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
          <div class="card-header ">
            <h4 class="card-title">Data Pembelian</h4>
            <!-- <a href="tambah-produk.php?page=produk" class="btn btn-success mt-4">Tambah Produk</a> -->
            <!-- <p class="card-category">Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped">
              <thead>
                <th>No</th>
                <th>Id Order</th>
                <th>Tanggal Pembelian</th>
                <th>Total Bayar</th>
                <th>Status Pembayaran</th>
                <th>Status Pembelian</th>

                <th></th>
              </thead>
              <tbody>
                <?php
                $no = $halaman_awal + 1;
                $lenght = $mysqli->query("SELECT * FROM transaksi");
                while ($list = $lenght->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo  $no++; ?></td>

                    <td><?php echo $list['order_id']; ?></td>
                    <td><?php echo $list['tgl_bayar']; ?></td>
                    <td>Rp <?php echo number_format($list['total_bayar'] + $list['ongkir']); ?></td>
                    <td>
                      <?php if ($list['status_pembayaran'] == 'pending') {
                        echo ' <span class="badge badge-warning">Pending</span>';
                      } ?>
                      <?php if ($list['status_pembayaran'] == 'settlement') {
                        echo ' <span class="badge badge-success">Lunas</span>';
                      } ?>

                      <?php if ($list['status_pembayaran'] == 'expired') {
                        echo ' <span class="badge badge-danger">Expired</span>';
                      } ?>


                    </td>
                    <td>
                      <?php if ($list['status_transaksi'] == 'menunggu pembayaran') {
                        echo ' <span class="badge badge-warning">Menunggu Pembayaran</span>';
                      } ?>
                      <?php if ($list['status_transaksi'] == 'pesanan dikemas') {
                        echo ' <span class="badge badge-info">Pesanan Dikemas</span>';
                      } ?>
                      <?php if ($list['status_transaksi'] == 'Pesanan Dikirim') {
                        echo ' <span class="badge badge-primary">Pesanan Dikirim</span>';
                      } ?>
                      <?php if ($list['status_transaksi'] == 'complete') {
                        echo ' <span class="badge badge-success">Pesanan Selesai</span>';
                      } ?>
                    </td>
                    <td><a href="detail-pembelian.php?id=<?php echo $list['id_transaksi']; ?>" class="btn btn-info mt-4">Lihat</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php include 'footer.php' ?>