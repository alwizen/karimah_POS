<?php
$title = "Selamat datang ";
include 'nav_kasir/header.php';
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
$query = "SELECT
          b.kd_barang,
          b.model,
          b.nama_barang,
          b.harga_beli,
          b.harga_jual,
          s.nama_supplier,
          (SELECT IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah)) FROM det_pembelian dp  WHERE dp.kd_barang = b.kd_barang) as jml,
          ((SELECT IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah)) FROM det_pembelian dp  WHERE dp.kd_barang = b.kd_barang) - (SELECT (IF(SUM(dp2.jumlah) IS NULL,0,SUM(dp2.jumlah)))
          FROM det_penjualan dp2 WHERE dp2.kd_barang = b.kd_barang)) as stok
          FROM `barang` b
          LEFT JOIN supplier s ON b.id_supplier=s.id_supplier
          GROUP BY b.kd_barang ORDER BY `nama_barang` ASC";

$result = mysqli_query($koneksi, $query);
?>

<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">

<div class="container">
           <div class="row "style="padding-top:40px;">
                <div class="col-md-4 col-sm-4 col-xs-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                             <span class="glyphicon glyphicon-pushpin"></span> Informasi
                            </div>
                            <div class="panel-body">
                              <strong>
                                <?php
                              $tgl=date('l, d M Y');
                              echo $tgl;
                              ?>
                              </strong>
                                <p>
                                   Nama User : <strong><?php echo $nama;?></strong>
                                </p>
                                <!-- info penjualan hari ini -->
                                <?php
                                $jumlah_record = mysqli_query($koneksi, "SELECT tanggal,COUNT(*) AS harian FROM penjualan WHERE tanggal=DATE(NOW()) GROUP BY tanggal");

                                $jum = mysqli_fetch_array($jumlah_record);
                                echo '
                                <p>Penjualan Hari ini : <b>' . $jum['harian'] . '</b></p>';
                                ?>
                                <!-- akhir  -->
                                
                                <!-- penjualan bulan ini -->
                                <?php
                                $jumlah_record = mysqli_query($koneksi, "SELECT CONCAT(YEAR(tanggal),'/',MONTH(tanggal)) AS bulanan, COUNT(*) AS jml FROM penjualan WHERE CONCAT(YEAR(tanggal),'/',MONTH(tanggal))=CONCAT(YEAR(NOW()),'/',MONTH(NOW())) GROUP BY YEAR(tanggal),MONTH(tanggal)");

                                $jum = mysqli_fetch_array($jumlah_record);
                                echo '
                                <p>Penjualan Bulan ini : <b>' . $jum['jml'] . '</b></p>';
                                ?>
                                <!-- akhir -->



                            </div>
                            
                        </div>
                    </div>
                <div class="col-md-8 col-sm-4 col-xs-6">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                             <span class="glyphicon glyphicon-paperclip"></span> Stok Barang
                           </div>
                          <div class="panel-body">
                            <table class="table table-condensed table-bordered" id="mydata">
                                  <thead>
                                  <tr class="active">
                                         <th>#</th>
                                         <th>Nama Barang</th>
                                         <th>Model</th>
                                         <th>Harga</th>
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
                                             <td>'.$row["model"].'</td>
                                             <td>'.Rp($row["harga_jual"]).'</td>
                                             <td>'.$row["stok"].'</td>
                                        </tr>
                                     ';
                                    }
                                  ?>
                              </table>
                            </div>
                <div class="panel-footer">
                </div>
            </div>
        </div>
      </div>
    </div>

      <div class="footer">
          <!-- <span></span>&copy; Copyright | Made with ♥ <a href="index.php"><strong>Endhita Froozen Food 2018</strong></a> -->
   </div>


<?php include 'nav_kasir/footer.php'; ?>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-1.10.2.min.js"></script>
<script src="../js/datatables.min.js"></script>
<script>

  $(document).ready(function() {
    $('#mydata').dataTable();
  });
</script>
