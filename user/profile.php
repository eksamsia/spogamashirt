<?php include 'header.php';

$list = $mysqli->query("SELECT * FROM user WHERE id_user = $_GET[id]");
$user = $list->fetch_assoc();

?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1><?php echo $user['nama_user'] ?></h1>
        <nav class="d-flex align-items-center">
          <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="category.html">Akun</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->

<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
  <div class="container">
    <div class="row">
      <?php if ($_GET['page'] === 'transaksi') {
        # code...
      ?>
        <div class="col-lg-8 posts-list">
          <div class="comments-area">
            <h4>Transaksi Terakhir</h4>
            <div class="comment-list">
              <?php

              $lenght = $mysqli->query("SELECT *, detail_transaksi.qty AS jmlbeli FROM transaksi 
           JOIN detail_transaksi ON transaksi.`id_transaksi` = detail_transaksi.`id_transaksi`
           JOIN produk ON detail_transaksi.`id_produk` = produk.`id_produk` WHERE transaksi.id_user = $_GET[id] GROUP BY transaksi.id_transaksi");
              while ($list = $lenght->fetch_assoc()) {
              ?>
                <div class="single-comment justify-content-between d-flex">
                  <div class="user justify-content-between d-flex">
                    <div class="thumb">
                      <img src="../gambar_produk/<?php echo $list['gambar'] ?>" style="width: 70px; height: 70px;" alt="">
                    </div>
                    <div class="desc">
                      <?php echo $list['status_transaksi'] ?>
                      <p class="comment">
                        <?php echo $list['order_id'] ?>
                      </p>
                      <h5><a href="#"> <?php echo $list['nama_produk'] ?></a></h5>
                      <p class="date"> Rp <?php echo number_format($list['total']) ?></p>

                    </div>
                  </div>

                  <div class="reply-btn">
                    <a href="detail-transaksi.php?id=<?php echo $list['id_transaksi'] ?>" class="btn btn-success" style="color: white;">Lihat Detail</a>
                  </div>
                  
                </div>
                <hr />
              <?php } ?>
            </div>

          </div>

        </div>
      <?php } ?>
      <?php if ($_GET['page'] === 'profile') {
        $lenght = $mysqli->query("SELECT * FROM user WHERE id_user = $_GET[id]");
        $alamat = $lenght->fetch_assoc();
      ?>
        <div class="col-lg-8 posts-list">
          <div class="comments-area">
            <h4>Edit Informasi Pribadi</h4>
            <div class="comment-list">
              <form class="row contact_form" action="proses/edit-profile.php" method="GET" novalidate="novalidate">
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" id="first" name="nama_user" value="<?php echo $alamat['nama_user'] ?>">
                  <input type="hidden" class="form-control" id="first" name="id_user" value="<?php echo $alamat['id_user'] ?>">
                  <!-- <span class="placeholder" data-placeholder="Nama Penerima"></span> -->
                </div>
                <div class="col-md-6 form-group p_star">
                  <input type="number" class="form-control" id="last" name="no_hp" value="<?php echo $alamat['no_hp'] ?>">
                  <!-- <span class="placeholder" data-placeholder="Nomor Handphone"></span> -->
                </div>
                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" id="first" name="username" value="<?php echo $alamat['username'] ?>">
                </div>

                <div class="col-md-6 form-group p_star">
                  <input type="text" class="form-control" id="first" name="email" value="<?php echo $alamat['email'] ?>">
                </div>





                <button type="submit" class="primary-btn">Simpan Data Diri</button>
              </form>
            </div>

          </div>

        </div>
      <?php } ?>

      <?php if ($_GET['page'] === 'password') {

      ?>
        <div class="col-lg-8 posts-list">
          <div class="comments-area">
            <h4>Edit Kata Sandi</h4>
            <div class="comment-list">
              <form class="row contact_form" action="proses/edit-password.php" method="POST" novalidate="novalidate">
                <div class="col-md-12 form-group p_star">
                  <input type="password" class="form-control" id="first" name="password_lama" placeholder="Password Lama">
                  <input type="hidden" class="form-control" id="first" name="id_user" value="<?php echo $_GET['id'] ?>">
                  <!-- <span class="placeholder" data-placeholder="Nama Penerima"></span> -->
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="password" class="form-control" id="last" name="password_baru" placeholder="Password Baru">
                  <!-- <span class="placeholder" data-placeholder="Nomor Handphone"></span> -->
                </div>
                <div class="col-md-12 form-group p_star">
                  <input type="password" class="form-control" id="first" name="c_password_baru" placeholder="Konfirmasi Password Baru">
                </div>



                <button type="submit" class="primary-btn">Simpan Password</button>
              </form>
            </div>

          </div>

        </div>
      <?php } ?>

      <?php if ($_GET['page'] === 'alamat') {
        # code...
      ?>
        <div class="col-lg-8 posts-list">
          <div class="comments-area">
            <a href="tambah-alamat.php?id=<?php echo $_GET['id']; ?>" class="btn btn-primary">Tambah Alamat</a>
            <h4>Daftar Alamat</h4>
            <div class="comment-list">
              <?php

              $lenght = $mysqli->query("SELECT * FROM alamat WHERE id_user = $_SESSION[user]");
              while ($list = $lenght->fetch_assoc()) {
              ?>
                <div class="single-comment justify-content-between d-flex">
                  <div class="user justify-content-between d-flex">
                    <div class="thumb">
                      <!-- <img src="img/blog/c1.jpg" alt=""> -->
                    </div>
                    <div class="desc">

                      <h5><a href="#"><?php echo $list['nama_penerima'] ?></a></h5>
                      <p class="date">(<?php echo $list['no_hp'] ?>)</p>
                      <p class="comment">
                        <?php echo $list['alamat_lengkap'] ?>,
                        <?php echo $list['kode_pos'] ?>
                      </p>
                      <a href="edit-alamat.php?id=<?php echo $list['id_alamat'] ?>" style="color: blue;">Edit</a>&nbsp
                      &nbsp &nbsp<span><a href="proses/hapus-alamat.php?id=<?php echo $list['id_alamat'] ?>" style="color: red;">Hapus</a></span>
                    </div>

                  </div>
                  <?php if ($list['is_select'] === 'true') {
                    # code...
                  ?>
                    <div class="reply-btn">
                      <a href="#" class="btn-reply text-uppercase">Utama</a>
                    </div>
                  <?php } ?>

                  <?php if ($list['is_select'] === 'false') {
                    # code...
                  ?>
                    <div class="reply-btn" style="width: 180px;">
                      <a href="proses/set_alamat.php?id=<?php echo $_GET['id']; ?>&status=<?php echo $list['is_select']; ?>&id_alamat=<?= $list['id_alamat'] ?>" class="btn-reply text-uppercase">Jadikan Utama</a>
                    </div>
                  <?php } ?>
                </div>
                <hr />
              <?php } ?>




            </div>
          </div>


        </div>
      <?php } ?>

      <div class="col-lg-4">
        <div class="blog_right_sidebar">
          <div class="br"></div>
          </aside>
          <aside class="single_sidebar_widget author_widget">
            <?php if ($user['image'] === null) {
              # code...
            ?>
              <img class="author_img rounded-circle" src="https://icons.veryicon.com/png/o/business/multi-color-financial-and-business-icons/user-139.png" style="width: 250px; height: 250px;" alt="">
            <?php } else { ?>

              <img class="author_img rounded-circle" src="img/<?php echo $user['image']  ?>" style="width: 250px; height: 250px;" alt="">

            <?php } ?>
            <h4><?php echo $user['nama_user'] ?></h4>
            <!-- <p>Senior blog writer</p> -->
            <!-- <div class="social_icon">
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-github"></i></a>
              <a href="#"><i class="fa fa-behance"></i></a>
            </div> -->
            <p><?php echo $user['email'] ?></p>
            <p><?php echo $user['no_hp'] ?></p>
            <div class="br"></div>
          </aside>
          <a href="profile.php?id=<?php echo $_SESSION['user'] ?>&page=profile">
            <h3 class="widget_title">Update Profile</h3>
          </a>
          <a href="profile.php?id=<?php echo $_SESSION['user'] ?>&page=alamat">
            <h3 class="widget_title">Daftar Alamat</h3>
          </a>
          <a href="profile.php?id=<?php echo $_SESSION['user'] ?>&page=password">
            <h3 class="widget_title">Ganti Password</h3>
          </a>

        </div>
      </div>
    </div>
  </div>
</section>
<!--================Blog Area =================-->
<?php include 'footer.php'; ?>