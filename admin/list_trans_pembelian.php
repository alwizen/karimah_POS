<?php
$title = "Laporan Pembelian";
include 'nav_admin/header.php';
include '../assets/fungsi_rupiah.php';
include '../assets/fungsi_tanggal.php';
include '../koneksi.php';
$query = "SELECT  
          p.kd_pembelian,
          p.tanggal,
          b.nama_barang,
          b.harga_beli,
          dp.jumlah,
          s.nama_supplier, 
          SUM(dp.jumlah*b.harga_beli) AS grand_total
          FROM pembelian p
          LEFT JOIN det_pembelian dp ON p.id_pembelian=dp.id_pembelian
          LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
          LEFT JOIN supplier s ON b.id_supplier=s.id_supplier
          GROUP BY p.kd_pembelian ORDER BY p.tanggal DESC";
$sql = mysqli_query($koneksi, $query);
?> 

<link rel="stylesheet" href="../css/jquery-ui.css">
<div class="container">
	<div class="panel panel-primary">
  <!-- Default panel contents -->
	  <div class="panel-heading"><strong>Laporan Pembelian</strong></div>
	  <div class="panel-body">
            <table class="table table-bordered" id="mydata">
            <thead>
              <tr class="danger">
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Supplier</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Grand Total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $grand_total = 0;
                while ($row = mysqli_fetch_array($sql)) {
                echo '
                  <tr>
                  <td>'.$row['kd_pembelian'].'</td>
                  <td>'.tgl_indo($row["tanggal"]).'</td>
                  <td>'.$row["nama_barang"].'</td>
                  <td>'.$row["nama_supplier"].'</td>
                  <td>'.Rp($row['harga_beli']).'</td>
                  <td>'.$row['jumlah'].'</td>
                  <td>'.Rp($row["grand_total"]). '</td>
                  </tr>
                                 
                    ';
                $grand_total += $row['grand_total'];
               
                }
              echo '<tr>
                        <td colspan="6">TOTAL</td>
                        <td><b>' . Rp($grand_total) . '</b></td>
                      </tr>'
                ?>
                </tbody>
            </table>
      </div>
  </div>

</div>
</div>	

 <?php include 'nav_admin/footer.php'; ?>
<script>
    $(document).ready(function() {
    $('#mydata').dataTable();
    responsive: true
  });
</script>

