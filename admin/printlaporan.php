<?php
require_once "../db/koneksi.php";


$awal       = '';
$selesai    = '';

if (isset($_GET['awal'])) {
    $awal       = $_GET['awal'];
    $selesai    = $_GET['selesai'];
    $query      = "SELECT * FROM transaksi WHERE status_transaksi != 'menunggu pembayaran' AND tgl_bayar BETWEEN '{$awal}' AND '{$selesai}'";
} else {
    $query = "SELECT * FROM transaksi WHERE status_transaksi != 'menunggu pembayaran'";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body onload="window.print();">

    <table>
        <div class="kontain">
            <div class="isi" style="position:relative;">
                <img src="../../assets/img/logo-ngawi.png" alt="" style="float:left;height:115px;position:absolute;left:-40px;">
                <p style="text-align:center"><span style="font-family:Times New Roman,Times,serif">
                        <font size="8">GAMASHIRT</font>
                    </span></p>
                <p style="text-align:center"><span style="font-size:15px">Jl. Agro, Kocoran, Caturtunggal, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</span></p>
            </div>
        </div>

        <hr style="border:1.5px solid black;">

        <h4 class="text-center mt-5" style="text-decoration:underline;">LAPORAN PENJUALAN</h4>
        <?php if (isset($_GET['awal']) && isset($_GET['selesai'])) { ?>
            <h6 class="text-center">
                <?= $_GET['awal'] . " / " . $_GET['selesai'] ?>
            </h6>
        <?php
        } ?>
        <hr>
        <table id="mytable" class="table table-bordered table-md">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Id Order</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Bayar</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pembelian</th>
                </tr>
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
                                echo ' Pending';
                            } ?>
                            <?php if ($list['status_pembayaran'] == 'settlement') {
                                echo ' Lunas';
                            } ?>
                            <?php if ($list['status_pembayaran'] == 'expired') {
                                echo ' Expired';
                            } ?>

                        </td>
                        <td>
                            <?php if ($list['status_transaksi'] == 'menunggu pembayaran') {
                                echo ' Menunggu Pembayaran';
                            } ?>
                            <?php if ($list['status_transaksi'] == 'pesanan dikemas') {
                                echo ' Pesanan Dikemas';
                            } ?>
                            <?php if ($list['status_transaksi'] == 'Pesanan Dikirim') {
                                echo 'Pesanan Dikirim';
                            } ?>
                            <?php if ($list['status_transaksi'] == 'complete') {
                                echo ' Pesanan Selesai';
                            } ?>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>


        </table>



        <p class="text-right">
            Yogyakarta,
            <?= date("Y-m-d") ?>
        </p>



</body>

</html>