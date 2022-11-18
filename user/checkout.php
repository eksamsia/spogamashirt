<?php

namespace Midtrans;

include 'header.php';

require_once dirname(__FILE__) . '/Midtrans.php';

$user = $mysqli->query("SELECT email,nama_user FROM user WHERE id_user = {$_SESSION['user']}");
$user = $user->fetch_assoc();

//Set Your server key
Config::$serverKey = "Mid-server-JVMMOU0JX1FrqRSjZzhiQOBO";
// Config::$serverKey = "SB-Mid-server-BQWcejQbWDXrgTqmLsfX5_Oj";

// Uncomment for production environment
Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";


// Required
$transaction_details = array(
  'order_id' => rand(),
  'gross_amount' => 94000, // no decimal allowed for creditcard
);

// Optional
$item1_details = array(
  'id' => 'a1',
  'price' => $_GET['amount'] + $_GET['ongkir'],
  'quantity' => 1,
  'name' => "Pembayaran produk di Gamashirt"
);


// Optional
$item_details = array($item1_details);

// Optional



// Optional
$customer_details = array(
  'first_name'    => $user['nama_user'],
  'email'         => $user['email'],

);

// Optional, remove this to display all available payment methods
$enable_payments = array('bank_transfer');

// Fill transaction details
$transaction = array(
  'enabled_payments' => $enable_payments,
  'transaction_details' => $transaction_details,
  'customer_details' => $customer_details,
  'item_details' => $item_details,
);

$snapToken = Snap::getSnapToken($transaction);
// echo "snapToken = ".$snapToken;
?>


<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
  <div class="container">
    <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
      <div class="col-first">
        <h1>Checkout</h1>
        <nav class="d-flex align-items-center">
          <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
          <a href="single-product.html">Checkout</a>
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
        <div class="col-lg-7">
          <h3>Pilih Alamat Pengiriman</h3>
          <?php

          //SALAH
          // $lenght = $mysqli->query("SELECT * FROM alamat WHERE id_user = $_SESSION[user]");
          //SALAH
          $lenght = $mysqli->query("SELECT * FROM alamat WHERE id_user = $_SESSION[user] AND is_select = 'true'");
          $alamat = $lenght->fetch_assoc();

          ?>

          <!-- <button class="btn btn-primary mb-2">Kantor</button> -->
          <?php if ($alamat) : ?>
            <div style="border:1px solid gray;padding:10px;border-radius:1%;">
              <h5><?php echo $alamat['nama_penerima'] ?></h5>
              <p>(<?php echo $alamat['no_hp'] ?>)</p>
              <p><?php echo $alamat['alamat_lengkap'] ?>, <?php echo $alamat['kode_pos'] ?>
              </p>
            </div>
          <?php endif; ?>
          <div>
            <a href="profile.php?id=<?php echo $_GET['id'] ?>&page=alamat">Ganti Alamat &nbsp &nbsp
              &nbsp</a>
            <span><a href="tambah-alamat.php?id=<?php echo $_GET['id']; ?>">Tambah Alamat</a></span>
          </div>
          <input type="hidden" name="weight" id="weight" value="1000">
          <input type="hidden" name="city_origin" id="city_origin" value="501">
          <?php if ($alamat) : ?>
            <input type="hidden" name="province_destination" id="province_destination" value="<?php echo $alamat['id_provinsi'] ?>">
            <input type="hidden" name="city_destination" id="city_destination" value="<?php echo $alamat['id_kota'] ?>">
            <input type="hidden" name="alamat_lengkap" id="alamat_lengkap" value="<?= $alamat['alamat_lengkap'] ?>">
            <input type="hidden" name="nama_penerima" id="nama_penerima" value="<?= $alamat['nama_penerima'] ?>">
            <input type="hidden" name="no_hp" id="no_hp" value="<?= $alamat['no_hp'] ?>">
            <input type="hidden" name="kode_pos" id="kode_pos" value="<?= $alamat['kode_pos'] ?>">
          <?php endif; ?>
          <input type="hidden" name="kurir" id="kurir" value="<?= $_GET['kurir'] ?>">
          <input type="hidden" name="ongkir" id="ongkir" value="<?= $_GET['ongkir'] ?>">


          <h3 class="mt-5">Pilih Jasa Kurir</h3>


          <!-- <div class="col-md-12 form-group p_star" style="width: 2000px;"> -->
          <form class="row contact_form" novalidate="novalidate">

            <div class="col-md-12 form-group p_star">
              <select class="form-control" id="courier" name="courier" required="">
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS INDONESIA</option>
              </select>
            </div>

            <div class="col-lg-12 form-group">
              <input class="btn btn-dark" type="button" onclick="get_cost(city_origin.value, city_destination.value, weight.value, courier.value);" value="Cek Ongkir" />

            </div>

            <table id="customers">
              <thead>
                <tr>
                  <th>Service</th>
                  <th>Description</th>
                  <th>Biaya</th>
                  <th>Estimasi</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="detail">
              </tbody>
            </table>

          </form>

          <!-- </div> -->
        </div>
        <div class="col-lg-5">
          <div class="order_box">
            <h2>Daftar Pesananmu</h2>
            <ul class="list">
              <li><a href="#">Produk <span>Total</span></a></li>
              <?php

              $lenght = $mysqli->query("SELECT *, keranjang.qty AS beli FROM keranjang JOIN produk ON keranjang.`id_produk` = produk.`id_produk` WHERE id_user = {$_SESSION['user']} AND selected = 1");
              while ($list = $lenght->fetch_assoc()) {
              ?>
                <li><a href="#"> <?php echo $list['nama_produk']; ?> <span class="middle">x
                      <?php echo $list['beli']; ?></span> <span class="last">Rp
                      <?php echo $list['total']; ?></span></a>
                </li>
                <input type="hidden" name="id_produk[]" id="id_produk" value="<?php echo $list['id_produk'] ?>" />
                <input type="hidden" name="beli[]" id="qty" value="<?php echo $list['beli'] ?>" />
                <input type="hidden" name="total[]" id="total" value="<?php echo $list['total'] ?>" />
              <?php } ?>
            </ul>
            <ul class="list list_2">
              <?php

              $lenght = $mysqli->query("SELECT SUM(total) AS total FROM keranjang WHERE id_user = {$_SESSION['user']} AND selected = 1");
              $total = $lenght->fetch_assoc();
              ?>
              <li><a href="#">Subtotal <span>Rp <?php echo number_format($total['total']) ?></span></a></li>
              <li><a href="#">Ongkos Kirim <span>Rp <?php echo number_format($_GET['ongkir']) ?></span></a></li>
              <li><a href="#">Total Bayar <span>Rp
                    <?php echo number_format($total['total'] + $_GET['ongkir']) ?></span></a></li>
            </ul>
            <input type="hidden" name="total_bayar" id="total_bayar" value="<?php echo $total['total'] ?>" />

            <!-- <div class="creat_account">
              <input type="checkbox" id="f-option4" name="selector">
              <label for="f-option4">I’ve read and accept the </label>
              <a href="#">terms & conditions*</a>
            </div> -->
            <a class="primary-btn" href="#" id="pay-button">Proceed to Paypal</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<input type="hidden" name="order_id" id="order_id" />
<input type="hidden" name="transaction_id" id="transaction_id" />
<input type="hidden" name="transaction_time" id="transaction_time" />
<input type="hidden" name="transaction_status" id="transaction_status" />
<input type="hidden" name="finish_redirect_url" id="finish_redirect_url" />
<input type="hidden" name="bank" id="bank" />
<input type="hidden" name="va_number" id="va_number" />
<input type="hidden" name="payment_type" id="payment_type" />
<input type="hidden" name="pdf_url" id="pdf_url" />
<input type="hidden" value="<?php echo $_SESSION['user']; ?>" name="id_user" id="id_user" />
<!--================End Checkout Area =================-->
<?php include 'footer.php'; ?>

<script src="js/jquery.min.js"></script>

<script src="js/jquery.min.js"></script>
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-7m0_hNthoY-K-Pbx">
  // <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-O9bNLXKBYfyOTgEL">
</script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function() {
    // SnapToken acquired from previous step
    snap.pay('<?php echo $snapToken ?>', {
      // Optional
      onSuccess: function(result) {
        /* You may add your own js here, this is just example */
        console.log(result);
        var order_id = document.getElementById('order_id').value = result.order_id;
        var transaction_id = document.getElementById('transaction_id').value = result.transaction_id;
        var pdf_url = document.getElementById('pdf_url').value = result.pdf_url;
        var transaction_status = document.getElementById('transaction_status').value = result
          .transaction_status;
        var transaction_time = document.getElementById('transaction_time').value = result.transaction_time;
        var payment_type = document.getElementById('payment_type').value = result.payment_type;
        // var va_number = document.getElementById('va_number').value = result.va_numbers[0].va_number;

        if (result.payment_type === 'bank_transfer') {
          if (result.permata_va_number !== undefined) {
            var va_number = result.permata_va_number;
            var bank = 'permata';
          } else {
            var va_number = document.getElementById('va_number').value = result.va_numbers[0].va_number;
            var bank = document.getElementById('bank').value = result.va_numbers[0].bank;
          }
        }
        if (result.payment_type === 'echannel') {
          var bank = 'mandiri';
          var va_number = result.bill_key;
        }

        var id_user = document.getElementById("id_user").value;
        var total = document.getElementById("total").value;
        var kurir = document.getElementById("kurir").value;
        var ongkir = document.getElementById("ongkir").value;

        var name = document.getElementById("nama_penerima").value;
        var phone = document.getElementById("no_hp").value;
        var alamat = document.getElementById("alamat_lengkap").value;
        var kode_pos = document.getElementById("kode_pos").value;

        // var id_product = document.getElementsByName("id_product[]").value;
        var id_product = [];
        var qty = [];
        var total = [];

        $('input[name^="id_produk"]').each(function() {
          id_product.push(this.value);
        });
        $('input[name^="beli"]').each(function() {
          qty.push(this.value);
        });
        $('input[name^="total"]').each(function() {
          total.push(this.value);
        });


        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);

        $.ajax({
          type: "POST", //type of method
          url: "proses/checkout.php", //your page
          data: {
            order_id: order_id,
            transaction_status: transaction_status,
            transaction_id: transaction_id,
            pdf_url: pdf_url,
            transaction_time: transaction_time,
            payment_type: payment_type,
            bank: bank,
            va_number: va_number,
            id_user: id_user,
            id_product: id_product,
            qty: qty,
            total: total,
            total_bayar: total_bayar,
            ongkir: ongkir,
            kurir: kurir,
            nama_penerima: nama_penerima,
            no_hp: no_hp,
            kode_pos: kode_pos,
            alamat_lengkap: alamat_lengkap,

          }, // passing the values
          success: function(res) {
            console.log(res);
            // location.reload();
            location.href = 'transaksi_result.php';
            //do what you want here...
          }
        });
      },
      // Optional
      onPending: function(result) {
        console.log(result);
        var order_id = document.getElementById('order_id').value = result.order_id;
        var transaction_id = document.getElementById('transaction_id').value = result.transaction_id;
        var pdf_url = document.getElementById('pdf_url').value = result.pdf_url;
        var transaction_status = document.getElementById('transaction_status').value = result
          .transaction_status;
        var transaction_time = document.getElementById('transaction_time').value = result.transaction_time;
        var payment_type = document.getElementById('payment_type').value = result.payment_type;

        var id_user = document.getElementById("id_user").value;
        var total_bayar = document.getElementById("total_bayar").value;
        var kurir = document.getElementById("kurir").value;
        var ongkir = document.getElementById("ongkir").value;

        var nama_penerima = document.getElementById("nama_penerima").value;
        var no_hp = document.getElementById("no_hp").value;
        var alamat_lengkap = document.getElementById("alamat_lengkap").value;
        var kode_pos = document.getElementById("kode_pos").value;

        // var id_product = document.getElementsByName("id_product[]").value;
        var id_product = [];
        var qty = [];
        var total = [];


        $('input[name^="id_produk"]').each(function() {
          id_product.push(this.value);
        });
        $('input[name^="beli"]').each(function() {
          qty.push(this.value);
        });
        $('input[name^="total"]').each(function() {
          total.push(this.value);
        });


        if (result.payment_type === 'bank_transfer') {
          if (result.permata_va_number !== undefined) {
            var va_number = result.permata_va_number;
            var bank = 'permata';
          } else {
            var va_number = document.getElementById('va_number').value = result.va_numbers[0].va_number;
            var bank = document.getElementById('bank').value = result.va_numbers[0].bank;
          }
        }

        if (result.payment_type === 'echannel') {
          var bank = 'mandiri';
          var va_number = result.bill_key;
        }


        $.ajax({
          type: "POST", //type of method
          url: "proses/checkout.php", //your page
          data: {
            order_id: order_id,
            transaction_status: transaction_status,
            transaction_id: transaction_id,
            pdf_url: pdf_url,
            transaction_time: transaction_time,
            payment_type: payment_type,
            bank: bank,
            va_number: va_number,
            id_user: id_user,
            id_product: id_product,
            qty: qty,
            total: total,
            total_bayar: total_bayar,
            ongkir: ongkir,
            kurir: kurir,
            nama_penerima: nama_penerima,
            no_hp: no_hp,
            kode_pos: kode_pos,
            alamat_lengkap: alamat_lengkap,
          }, // passing the values
          success: function(res) {
            console.log(res);
            // location.reload();
            location.href = 'transaksi_result.php';
            //do what you want here...
          }
        });

        /* You may add your own js here, this is just example */
        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
      },
      // Optional
      onError: function(result) {
        /* You may add your own js here, this is just example */
        document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
      }
    });
  };
</script>

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

                  "<td><a href='checkout.php?kurir=" + value.service + "&ongkir=" + value.cost[0]['value'] +
                  "&amount=<?php echo $_GET['amount'] ?>" + "&id=<?php echo $_GET['id'] ?>" +
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