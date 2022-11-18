<?php
include 'header.php';

include '../db/koneksi.php';
$awal = '';
$selesai = '';

$link = 'printlaporan.php';
if (isset($_POST['submit'])) {

    $awal       = $_POST['tanggalawal'];
    $selesai    = $_POST['tanggalselesai'];
    $query      = "SELECT * FROM transaksi WHERE status_transaksi != 'menunggu pembayaran' AND tgl_bayar BETWEEN '{$awal}' AND '{$selesai}'";
    $link = "printlaporan.php?awal={$awal}&selesai={$selesai}";
} else {
    $query = "SELECT * FROM transaksi WHERE status_transaksi != 'menunggu pembayaran'";
}

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Data Pembelian</h4>
                        <form method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="tanggalawal" value="<?= $awal ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal Selesai</label>
                                        <input type="date" class="form-control" name="tanggalselesai" value="<?= $selesai ?>">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Pilih</button>
                            <a href="<?= $link ?>" target="_blank" class="btn btn-primary">Print</a>
                        </form>
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
                                $no = 1;
                                $lenght = $mysqli->query($query);
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