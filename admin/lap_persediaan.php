<?php
$title = "Laporan Persediaan";
include 'nav_admin/header.php';
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
$query ="SELECT
    b.kd_barang,
    b.nama_barang,
    b.harga_jual,
    b.harga_beli,
    s.nama_supplier,
    IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah)) as jml_beli,
    IF(SUM(dp2.jumlah) IS NULL,0,SUM(dp2.jumlah)) as jml_jual,
    ((IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah))) - (IF(SUM(dp2.jumlah) IS NULL,0,SUM(dp2.jumlah)))) as stok
FROM `barang` b
LEFT JOIN supplier s ON b.id_supplier=s.id_supplier
LEFT JOIN det_pembelian dp ON dp.kd_barang=b.kd_barang
LEFT JOIN det_penjualan dp2 ON dp2.kd_barang=b.kd_barang
GROUP BY b.kd_barang
ORDER BY `nama_barang` ASC";
$result = mysqli_query($koneksi, $query);
?>


<link rel="stylesheet" href="../css/buttons.dataTables.min.css">
<div class="container">
<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading"><strong><span class="glyphicon glyphicon-briefcase"></span> Stok Barang</strong></div>
      <div class="panel-body">
        <table class="table table-bordered table-condensed " id="mydata">
                <thead>
                <tr class="active">
                       <th>#</th>
                       <th>Nama Barang</th>
                       <th>Supplier</th>
                       <th>Harga Beli</th>
                       <th>Harga Jual</th>
                       <th>Jumlah Awal</th>
                       <th>Terjual</th>
                       <th>Stok</th>
                   </tr>
                    </thead>

                   <?php
                      $no = 1;
                          while($row = mysqli_fetch_array($result))
                          {
                               echo '
                               <tr>
                                  <td>'.$no++.'</td>
                                    <td>'.$row["nama_barang"].'</td>
                                    <td>'.$row["nama_supplier"].'</td>
                                    <td>'. Rp($row["harga_beli"]).'</td>
                                    <td>'. Rp($row["harga_jual"]).'</td>
                                    <td>'.$row["jml_beli"].'</td>
                                    <td>'.$row["jml_jual"].'</td>
                                    <td>'.$row["stok"].'</td>
                               </tr>

                               ';
                          }
                          ?>
            </table>
          </div>
          <div class="panel-footer">
    <!-- <a href="cetak.php" target="_BLANK" class="btn btn-danger col-md-offset-11" ><span class="glyphicon glyphicon-print"></span> Cetak</a> -->
  </div>
        </div>
    </div>
<script src="../js/dataTables.buttons.min.js"></script>
<script src="../js/buttons.flash.min.js"></script>
<script src="../js/jszip.min.js"></script>
<script src="../js/pdfmake.min.js"></script>
<script src="../js/vfs_fonts.js"></script>
<script src="../js/buttons.html5.min.js"></script>
<script src="../js/buttons.print.min.js"></script>
<script>
  $(document).ready(function() {
    $('#mydata').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<?php include 'nav_admin/footer.php'; ?>
