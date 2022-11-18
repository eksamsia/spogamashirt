<?php
include 'header.php';

include '../db/koneksi.php';
// SALAH SUDAH MENGGUNAKAN DATA TABLE
// $batas = 15;
// $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
// $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;
// $previous = $halaman - 1;
// $next = $halaman + 1;
// $jumlah_data = mysqli_num_rows($data);
// $total_halaman = ceil($jumlah_data / $batas);
// SALAH

$data = $mysqli->query("SELECT * FROM produk");



?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
          <div class="card-header ">
            <h4 class="card-title">Data Produk</h4>
            <a href="tambah-produk.php?page=produk" class="btn btn-success mt-4">Tambah Produk</a>
            <!-- <p class="card-category">Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped" id="table_id">
              <thead>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>diskon</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                // SALAH
                // $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori LIMIT $halaman_awal, $batas");
                // SALAH
                $lenght = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori");
                while ($list = $lenght->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo  $no++; ?></td>
                    <td><img src="../gambar_produk/<?php echo $list['gambar']; ?>" style="width: 30px; height: 30px; border-radius: 5px;" /></td>
                    <td><?php echo $list['nama_produk']; ?></td>
                    <td><?php echo $list['nama_kategori']; ?></td>
                    <td><?php echo $list['stock']; ?></td>
                    <td><?php echo $list['harga']; ?></td>
                    <td><?php echo $list['diskon']; ?></td>
                    <td><a href="detail-produk.php?id=<?php echo $list['id_produk']; ?>" class="btn btn-info mt-4">Lihat</a></td>
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

<script>
  $(document).ready(function() {
    $('#table_id').DataTable();
  });
</script>
<?php include 'footer.php' ?>