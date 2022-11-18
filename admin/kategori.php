<?php
include 'header.php';

include '../db/koneksi.php';
$batas = 5;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;


// $uk=$mysqli->query("SELECT  COUNT(id_pemesanan) as ukuran FROM pemesanan WHERE status_order = '$_GET[status]'");
$data = $mysqli->query("SELECT * FROM kategori");

$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card strpied-tabled-with-hover">
          <div class="card-header ">
            <h4 class="card-title">Data Kategori</h4>
            <a href="tambah-kategori.php?page=kategori" class="btn btn-success mt-4">Tambah Kategori</a>
            <!-- <p class="card-category">Here is a subtitle for this table</p> -->
          </div>
          <div class="card-body table-full-width table-responsive">
            <table class="table table-hover table-striped" id="table_id">
              <thead align="center">
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $no = $halaman_awal + 1;
                $lenght = $mysqli->query("SELECT * FROM kategori LIMIT $halaman_awal, $batas");
                while ($list = $lenght->fetch_assoc()) {
                ?>
                  <tr align="center">
                    <td><?php echo  $no++; ?></td>
                    <td><?php echo  $list['nama_kategori']; ?></td>
                    <td><a href="edit-kategori.php?id=<?php echo  $list['id_kategori']; ?>&page=kategori" class="btn btn-secondary mt-4">Edit</a>&nbsp &nbsp
                      <a href="proses/hapus_kategori.php?id=<?php echo  $list['id_kategori']; ?>" class="btn btn-warning mt-4">Hapus</a>
                    </td>
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