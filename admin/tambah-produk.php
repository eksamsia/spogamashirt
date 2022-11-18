<?php
include 'header.php';
include '../db/koneksi.php';
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
            <form action="proses/tambah_produk.php" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" placeholder="Tulis Disini" name="nama_produk">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="id_kategori" class="form-control form-control-round">
                      <option value="opt1">------ Pilih Kategori -------</option>
                      <?php
                      $lenght = $mysqli->query("SELECT * FROM kategori");
                      while ($list = $lenght->fetch_assoc()) {
                      ?>
                        <option value="<?= $list['id_kategori'] ?>"><?= $list['nama_kategori'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Harga</label>
                    <input type="number" min="0" class="form-control" placeholder="Tulis Disini" name="harga">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>diskon</label>
                    <input type="number" min="0" class="form-control" placeholder="Tulis Disini" name="diskon">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>Stock</label>
                    <input type="number" min="0" class="form-control" placeholder="Tulis Disini" name="stock">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Gambat Produk</label>
                    <input type="file" class="form-control" name="gambar">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea rows="4" cols="80" class="form-control" placeholder="Tulis Disini" name="deskripsi"></textarea>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info btn-fill pull-right">Tambah Produk</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>