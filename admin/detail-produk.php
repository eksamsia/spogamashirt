<?php
include 'header.php';
include '../db/koneksi.php';


$data = $mysqli->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk = $_GET[id]");
$detail = $data->fetch_assoc();

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tambah Produk</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" placeholder="Tulis Disini" name="nama_produk" value="<?= $detail['nama_produk'] ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" class="form-control" placeholder="Tulis Disini" name="id_kategori" value="<?= $detail['id_kategori'] ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" min="0" class="form-control" placeholder="Tulis Disini" name="harga" value="<?= $detail['harga'] ?>" readonly>
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>diskon</label>
                    <input type="number" min="0" class="form-control" placeholder="Tulis Disini" name="diskon" value="<?= $detail['diskon'] ?>" readonly>
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>Stock</label>
                    <input type="number" min="0" class="form-control" placeholder="Tulis Disini" name="stock" value="<?= $detail['stock'] ?>" readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Gambat Produk</label><br>
                    <img src="../gambar_produk/<?php echo $detail['gambar']; ?>" style="width: 130px; height: 130px; border-radius: 15px;" />
                    <!-- <input type="file" class="form-control" name="gambar"> -->
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea rows="4" cols="80" class="form-control" placeholder="Tulis Disini" name="deskripsi" readonly><?= $detail['deskripsi'] ?></textarea>
                  </div>
                </div>
              </div>
              <a href="edit-produk.php?id=<?php echo $detail['id_produk']; ?>" class="btn btn-info btn-fill pull-right">Edit Produk</a>
              <a href="proses/hapus_produk.php?id=<?php echo $detail['id_produk']; ?>" class="btn btn-danger btn-fill pull-right mr-3">Hapus Produk</a>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>