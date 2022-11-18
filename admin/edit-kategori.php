<?php include 'header.php';
include '../db/koneksi.php';

$data=$mysqli->query("SELECT * FROM kategori WHERE id_kategori = $_GET[id]");
$detail = $data->fetch_assoc();
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tambah Kategori</h4>
          </div>
          <div class="card-body">
            <form action="proses/edit_kategori.php" method="GET">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" placeholder="Contoh: Aksesoris"
                      value="<?php echo $detail['nama_kategori'] ?>" name="nama_kategori">
                    <input type="hidden" class="form-control" placeholder="Contoh: Aksesoris"
                      value="<?php echo $detail['id_kategori'] ?>" name="id_kategori">
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