<?php
$title = "Transaksi Penjualan ";
include 'nav_kasir/header.php';
include '../koneksi.php';
// include '../assets/fungsi_tanggal.php';
 ?>
<link rel="stylesheet" href="../css/select2.min.css">
<link rel="stylesheet" href="../css/select2-bootstrap.min.css">
<div class="container" style="margin-top: 50px;">
      <div class="row">
        <div class="col-lg-6">
        </div>
      </div>
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="glyphicon glyphicon-tag"></span><strong> Form Transaksi Penjualan</strong></h3>
          </div>
          <div class="panel-body">
            <!-- <form id="form_input" action="proses/proses.php" method="post"> -->

                <!-- tanggal dan model  -->
                 <div class="row">
                   <div class="col-xs-4 form-group">
                     <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal"  class="form-control" required />
                     </div>

                    <?php
                      $query = "SELECT * FROM barang";
                      $result = mysqli_query($koneksi, $query);
                     ?>

                  <div class="col-xs-5 form-group">
                     <label>Nama Barang</label>
                        <select class="form-control item" id="item" name="nama_barang">
                            <?php while($row1 = mysqli_fetch_array($result)):;?>

                            <option value="<?php echo $row1['kd_barang'];?>" data-price="<?php echo $row1["harga_jual"] ?>"><?php echo $row1['nama_barang'];?></option>

                            <?php endwhile;?>

                        </select>
                     </div>
                     <div class="row">
                  <div class="col-xs-2 form-group">
                     <label class="control-label">Jumlah</label>
                     <input type="text" class="form-control" placeholder="Qty .." name="jumlah" id="jumlah" required>
                   </div>
                   </div>

                   <div class="col-xs-1 form-group">

                     <label class="control-label"></label>
                   <input type="button" id="add_item" value="Tambah Barang" class="btn btn-primary">
                 </div><br>

                 </div>
                 <!-- akhir tanggal dan model -->
                 <!-- button -->
                 <br>
                 <h4><span class="glyphicon glyphicon-shopping-cart"></span> Barang Belanja </h4>
                     <!-- Table -->
                    <table class="table table-hover" id="order_items_table">
                      <thead>
                        <tr class="active">
                          <th>#</th>
                          <th>Nama Barang</th>
                          <th>Jumlah</th>
                          <th>Sub-Total</th>
                          <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                     </tbody>
                     <tfoot>
                       <tr>
                        <td colspan="2">Total</td>
                        <td><input type="text" id="total_barang" class="form-control" readonly></td>
                        <td><input type="text" id="grand_total_harga" class="form-control" readonly></td>
                        <td></td>
                      </tr>
                     </tfoot>
                   </table><br>
                   <div class="row">
                    <div class="col-lg-3 col-lg-offset-4">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Rp</span>
                        <input type="number" class="form-control" id="total_dibayarkan" placeholder="Total Bayar ..">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-3">
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Rp</span>
                        <input type="number" class="form-control" id="total_kembalian" placeholder="Kembalian .." disabled>
                      </div><!-- /input-group -->

                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-2">
                        <button class="btn btn-primary" type="button" id="checkout">Bayar</button>
                        <a href="kasir/index.php" class="btn btn-default">Batal</a>
                      </div>
                  </div><!-- /.row -->
                  </div>
                </div>
              </div>
            <!-- </form> -->
         </div>
      </div>
   </div>
</div>

</body>
 <!-- library jQuery -->
  <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/select2.min.js"></script>

    <script>
      $(document).ready(function() {
      $('.item').select2({
       theme: "bootstrap",
       placeholder: "Pilih Barang",
       allowClear: true
        });
    });
          $order_items = [];
          $total_price = 0;
          $number =1;
      var formBarang={
        getTotal:function(){
          var totalHarga = 0;
          var totalBarang = 0;
          $('.row_barang').each(function(){
            totalBarang += parseFloat($(this).find('td:eq(2)').text());
            totalHarga += parseFloat($(this).find('td:eq(3)').text());
          });
          $('#total_barang').val(totalBarang);
          $('#grand_total_harga').val(totalHarga);
        }
      }
      $(function() {

          $("#add_item").on("click", function() {
              // Add data to order_items before it's submitted
              $order_items.push({
                "kd_barang": $("#item").val(),
                "jumlah": $("#jumlah").val(),
                "harga": $("#item option:selected").attr("data-price"),
                "temp_id":$number

              });

              $total_price += (parseInt($("#jumlah").val()) * parseInt($("#item option:selected").attr("data-price")));
              // Add row to table
              $("#order_items_table > tbody").append("<tr class='row_barang'><td>" + ($order_items.length + 1) + "</td><td>" + $("#item option:selected").text() + "</td><td>" + $("#jumlah").val() + "</td><td>" + (parseInt($("#jumlah").val()) * parseInt($("#item option:selected").attr("data-price"))) + "</td><td> <button data-id='"+$number+"' class='btn btn-danger hapus_item'>Hapus</button> </td></tr>");

              // Reset selected item and quantity
              $("#jumlah").val("");
              $("#item").prop("selectedIndex", 0);

              console.log($order_items);
              $number++;
              formBarang.getTotal();
          });

          $("#total_dibayarkan").on("keyup", function() {
            var total_dibayarkan = $(this).val();
              var  grand_total_harga = $('#grand_total_harga').val();
              // console.log(total_dibayarkan.length);
              if (total_dibayarkan.length > grand_total_harga.length) {
                alert('Sesuaikan Harga !!');
              }
              $("#total_kembalian").val(parseInt($(this).val()) - $total_price);
          });
           $(document).on("click", ".hapus_item", function(e){
            // console.log('hapus');
            var tempId = $(this).attr('data-id');
            console.log(tempId);
            var temp_order_items = $order_items.filter(function(obj) {
              return obj.temp_id != tempId;
            });
            $order_items = temp_order_items;
            $(this).parent().parent().remove();
            formBarang.getTotal();
          });

          $("#checkout").on("click", function() {
            console.log($order_items);
              if ($order_items.length < 1) {
                alert("Anda belum memasukkan item!");
              } else {

                var totalDibayar = ($('#total_dibayarkan').val() == "" || !isNaN($('#total_dibayarkan').val())) ? parseInt($('#total_dibayarkan').val()) : 0;

                if(totalDibayar > 0) {
                  //ini diproses
                var request = $.ajax({
                  url: "aksi_penjualan.php",
                  method: "POST",
                  data: {
                    "order_items": $order_items,
                    "tanggal":$('#tanggal').val()
                  },
                  json: true
                });

                request.success(function(response) {
                    alert("Transaksi Berhasil!");
                    location.reload();
                });

                request.fail(function(error) {
                  alert(error);
                });
                } else {
                  //klo 0 tampilkan notifikasi
                  alert("Harus diisi");
                }



              }
          });
      });
    </script>
</html>
