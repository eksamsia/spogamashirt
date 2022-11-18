<?php include 'header.php';
                   
        $lenght=$mysqli->query("SELECT * FROM alamat WHERE id_alamat = $_GET[id]");
        $alamat = $lenght->fetch_assoc();

?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Edit Alamat</h1>
        <nav class="d-flex align-items-center">
          <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="single-product.html">Profile</a>
        </nav>
      </div>
    </div>
  </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
  <div class="container">

    <div class="billing_details">
      <div class="row">
        <div class="col-lg-8">
          <h3>Alamat</h3>
          <form class="row contact_form" action="proses/edit_alamat.php" method="GET" novalidate="novalidate">
            <div class="col-md-6 form-group p_star">
              <input type="text" class="form-control" id="first" name="nama_penerima"
                value="<?php echo $alamat['nama_penerima'] ?>">
              <input type="hidden" class="form-control" id="first" name="id_alamat"
                value="<?php echo $alamat['id_alamat'] ?>">
              <input type="hidden" class="form-control" id="first" name="id_user"
                value="<?php echo $alamat['id_user'] ?>">
              <input type="hidden" class="form-control" id="first" name="id_user" value="<?php echo $_GET['id'] ?>">
              <!-- <span class="placeholder" data-placeholder="Nama Penerima"></span> -->
            </div>
            <div class="col-md-6 form-group p_star">
              <input type="number" class="form-control" id="last" name="no_hp" value="<?php echo $alamat['no_hp'] ?>">
              <!-- <span class="placeholder" data-placeholder="Nomor Handphone"></span> -->
            </div>


            <div class="col-md-12 form-group p_star">
              <select class="all_province form-control" name="province_destination" id="province_destination"
                onchange="get_city_destination(this);" required>
                <option value>Provinsi</option>
              </select>
            </div>
            <div class="col-md-12 form-group p_star">
              <select class="form-control" name="city_destination" id="city_destination" required>
                <option value>Kabupaten/Kota</option>
              </select>
            </div>




            <div class="col-md-12 form-group">
              <textarea class="form-control" name="alamat_lengkap" id="message" rows="1"
                placeholder="Alamat Lengkap"><?php echo $alamat['alamat_lengkap'] ?></textarea>
            </div>

            <div class="col-md-12 form-group">
              <input type="text" class="form-control" name="kode_pos" placeholder="Kode Pos"
                <?php echo $alamat['kode_pos'] ?>>
            </div>

            <button type="submit" class="primary-btn">Simpan Alamat</button>
          </form>
        </div>
        <div class="col-lg-4">

          <img src="https://img.freepik.com/free-vector/address-concept-illustration_114360-4747.jpg"
            style="width: 500px; height: 500px;" />
          <p style="text-align: center;">Pastikan Alamat Pengirimanmu Sudah Benar ya!</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Checkout Area =================-->
<?php include 'footer.php'; ?>

<script src="js/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $.getJSON("province.php", function(all_province) {
    console.log(all_province);
    if (all_province) {
      $(".all_province").html("<option value=''>Pilih Provinsi</option>");
      $.each(all_province['rajaongkir']['results'], function(key, value) {
        $(".all_province").append(
          "<option value='" + value.province_id + "'>" + value.province + "</option>"
        );
      });
    }
  });
});

function get_city_origin(sel) {
  console.log(sel);
  $.getJSON("city.php?id=" + sel.value, function(get_city) {
    if (get_city) {
      $("#city_origin").html("<option value=''>Pilih Kota</option>");
      $.each(get_city['rajaongkir']['results'], function(key, value) {
        $("#city_origin").append(
          "<option value='" + value.city_id + "'>" + value.city_name + "</option>"
        );
      });
    }
  });
}

function get_city_destination(sel) {
  console.log(sel);
  $.getJSON("city.php?id=" + sel.value, function(get_city) {
    if (get_city) {
      $("#city_destination").html("<option value=''>Pilih Kota</option>");
      $.each(get_city['rajaongkir']['results'], function(key, value) {
        $("#city_destination").append(
          "<option value='" + value.city_id + "'>" + value.type + " - " + value.city_name + "</option>"
        );
      });
    }
  });
}

function get_cost(city_origin, city_destination, weight, courier) {
  if (city_origin != '' && city_destination != '' && weight != '' && courier != '') {
    $.getJSON("cost.php?city_origin=" + city_origin + "&city_destination=" + city_destination + "&weight=" + weight +
      "&courier=" + courier,
      function(cost) {
        console.log(cost);
        if (cost) {
          $.each(cost['rajaongkir']['results'], function(key, value) {
            $("#cost").append(
              "<strong>" + value.name + "</strong>"
            );
          });
          if (cost['rajaongkir']['results'][0]['costs'].length > 0) {
            $.each(cost['rajaongkir']['results'][0]['costs'], function(key, value) {
              $("#detail").append(
                "<tr>" +
                "<td>" + value.service + "</td>" +
                "<td>" + value.description + "</td>" +
                "<td>" + value.cost[0]['value'] + "</td>" +
                "<td>" + value.cost[0]['etd'] + "</td>" +

                "<td><a href='form.php?kurir=" + value.service + "&ongkir=" + value.cost[0]['value'] +
                "'>Pilih</a></td>" +
                "</tr>"
              );
            });
          }
        }
      });
  }
}
</script>