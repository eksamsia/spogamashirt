<?php include 'header.php'; ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tambah Kategori</h4>
          </div>
          <div class="card-body">
            <form action="proses/tambah_kategori.php" method="POST">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" placeholder="Contoh: Aksesoris" name="nama_kategori">
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info btn-fill pull-right">Tambah Kategoris</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php include 'footer.php'; ?>