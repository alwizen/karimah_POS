<?php
$title = "Riwayat Penjualan";
include ('nav_kasir/header.php');
include '../assets/fungsi_rupiah.php';
include '../assets/fungsi_tanggal.php';
 ?>

 <div class="container">
   <!-- Table -->
   <h3>Riwayat Penjualan</h3> <br>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>No. Transaksi</th>
        <th>Tanggal</th>
        <th>Grand Total</th>
        <th>Action</th>
      </tr>
    </thead>

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
                                        GROUP BY p.no_penjualan ORDER BY p.kd_transaksi DESC");
                            while($d = mysqli_fetch_array($data)){
                         ?>

                  <tbody>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $d['kd_transaksi']; ?></td>
                      <td><?php echo tgl_indo($d['tanggal']); ?></td>
                      <td><?php echo Rp($d['grand_total']); ?></td>
                       <td>

                          <button type="button" class="btn btn-info" onclick="getDetailTransaksi(<?php echo $d['no_penjualan']; ?>)">Detail</button>

                       </td>
                    </tr>
                    <?php
                  }
                     ?>
                </tbody>
  </table>
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
              <!-- <p>Nama Kasir : <b><?php echo $nama; ?> </p></b> | <?php echo Rp($d['grand_total']); ?>  -->
            </tbody>
          </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
  var getDetailTransaksi = function (no_penjualan) {

    $.get("aksi_dtl_penjualan.php?no_penjualan="+no_penjualan, function(response){
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

 <?php
 include ('nav_kasir/footer.php'); ?>
