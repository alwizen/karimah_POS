<?php
$title = "Detail Transaksi Penjualan";
include ('nav_admin/header.php');
include '../assets/fungsi_rupiah.php';
include '../assets/fungsi_tanggal.php';
 ?>


 <div class="container">
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading"><strong>List Transaksi Penjualan</strong></div>
  <div class="panel-body">
   <!-- Table -->
  <table class="table table-hover table-bordered table-striped" id="mydata">
    <thead>
      <tr class="danger">
        <th>#</th>
        <th>No. Transaksi</th>
        <th>Tanggal</th>
        <th>Grand Total</th>
        <th><center> Action </center></th>
      </tr>
    </thead>
    <tbody>

        <?php
          include '../koneksi.php';
          $no = 1;
          $data = mysqli_query($koneksi,"SELECT
                                        p.no_penjualan,
                                        p.kd_transaksi,
                                        p.tanggal,
                                        jumlah,
                                        nama_barang,
                                        model,
                                        SUM(dp.jumlah*dp.harga) as grand_total
                                        FROM penjualan p
                                        LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan
                                        LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
                                        GROUP BY p.no_penjualan ORDER BY p.tanggal DESC");
            while($d = mysqli_fetch_array($data))
            {
              echo '
          <tr>
            <td>'.$no++ .'</td>
            <td>'.$d['kd_transaksi'].'</td>
            <td>'.tgl_indo($d['tanggal']).'</td>
            <td>'.Rp($d['grand_total']). '</td>
            <td>
              <center><button type="button" class="btn btn-primary" onclick="getDetailTransaksi('.$d['no_penjualan'] . ')"><span class="glyphicon glyphicon-paperclip"></span>  Detail</button></center>
            </td>
          </tr>
          ';
          }
          ?>
        </tbody> 
      </table>
  </div>
  <div class="panel-footer">
  </div>
</div>
</div>



<!-- Modal -->
<div id="modal_list" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="judul"> </h4>
      </div>
      <div class="modal-body">
          <table class="table table-stripped">
            <thead>
              <tr class="active">
                <th>Nama Barang</th>
                <th>Model</th>
                <th>Harga</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody id="list_transaksi">

            </tbody>
          </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

  <!-- <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script> -->
<?php include('nav_admin/footer.php'); ?>
<script>
    $(document).ready(function() {
    $('#mydata').dataTable();
    responsive: true
  });
  var getDetailTransaksi = function (no_penjualan) {

    $.get("dtl_penjualan.php?no_penjualan="+no_penjualan, function(response){
      $("#list_transaksi").html('');
      console.log(response);
        if (response.data.length > 0 ) {
          $.each(response.data, function(i,obj){
            console.log(obj);
            var content = "<tr>";
            content += "<td>" + obj.nama_barang + "</td>";
            content += "<td>" + obj.model + "</td>";
            content += "<td>" + obj.harga_jual + "</td>";
            content += "<td>" + obj.jumlah + "</td>";
            content +=  "</tr>";
            $("#list_transaksi").append(content);
          })
          $("#judul").html(response.judul);
          $("#modal_list").modal('show');
        }

    },'json');
  }
</script>


