<?php
include 'header.php';
include '../db/koneksi.php';


$data = $mysqli->query("SELECT * FROM admin WHERE id_admin = {$_GET['id']}");
$detail = $data->fetch_assoc();

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Admin</h4>
                    </div>
                    <div class="card-body">
                        <form action="proses/edit_admin.php" method="POST">
                            <input type="hidden" name="id_admin" value="<?= $detail['id_admin'] ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Admin</label>
                                        <input type="text" class="form-control" placeholder="Tulis Disini" name="nama" value="<?= $detail['nama_admin'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Tulis Disini" name="email" value="<?= $detail['email'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Tulis Disini" name="username" value="<?= $detail['username'] ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select name="role" id="role" class="form-control">
                                            <?php if ($detail['role'] == 1) : ?>
                                                <option value="1" selected>Admin</option>
                                                <option value="2">Karyawan</option>
                                            <?php else : ?>
                                                <option value="1">Admin</option>
                                                <option value="2" selected>Karyawan</option>
                                            <?php endif; ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <p>*Abaikan jika tidak ingin mengganti password</p>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Tulis Disini" name="password">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="edit" class="btn btn-info btn-fill pull-right">Edit Produk</button>
                            <a href="proses/hapus_admin.php?id=<?php echo $detail['id_admin']; ?>" class="btn btn-danger btn-fill pull-right mr-3">Hapus Produk</a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>