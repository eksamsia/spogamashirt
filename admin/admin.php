<?php
include 'header.php';
include '../db/koneksi.php';

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Data Admin</h4>
                        <a href="tambah-admin.php" class="btn btn-success mt-4">Tambah Admin</a>
                        <!-- <p class="card-category">Here is a subtitle for this table</p> -->
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped" id="table_id">
                            <thead>
                                <th>Nama Admin</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php

                                $lenght = $mysqli->query("SELECT * FROM admin");
                                while ($list = $lenght->fetch_assoc()) {
                                    $role = 'Karyawan';
                                    if ($list['role'] == 1) $role = "Admin";
                                ?>
                                    <tr>
                                        <td><?php echo $list['nama_admin']; ?></td>
                                        <td><?php echo $list['email']; ?></td>
                                        <td><?php echo $list['username']; ?></td>
                                        <td><?= $role ?></td>
                                        <td><a href="detail-admin.php?id=<?php echo $list['id_admin']; ?>" class="btn btn-info mt-4">Lihat</a></td>
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