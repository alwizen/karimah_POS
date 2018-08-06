<?php
$title = "Selamat Datang";
include 'nav_admin/header.php';
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
?>
<link rel="stylesheet" href="../css/style_admin.css">
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">

<!-- chart -->
    <!-- akhir chart -->
<div class="container">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="kotak_kecil bg-aqua" style="background-color:#46a9e2;">
            <div class="inner">
             <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from barang");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>'.$jum['jumlah'].'</h3>';
           
            ?>

              <p>Total Barang</p>
            </div>
            <div class="icon">
              
              <span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span>
              
            </div>
            <a href="list_barang.php" target="_blank" class="kotak_kecil-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="kotak_kecil bg-green" style="background-color:#00A65A;">
            <div class="inner">
            <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from supplier");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>' . $jum['jumlah'] . '</h3>';

            ?>

              <p>Total Supplier</p>
            </div>
            <div class="icon">
              <span class="glyphicon glyphicon-user"></span>
            </div>
            <a href="list_barang.php" target="_blank" class="kotak_kecil-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="kotak_kecil bg-yellow" style="background-color:#F39C12;">
            <div class="inner">
             <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM `det_penjualan`");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>' . $jum['total'] . '</h3>';

            ?>

              <p>Total Barang Terjual </p>
            </div>
            <div class="icon">
              <span class="glyphicon glyphicon-shopping-cart"></span>
            </div>
            <a href="list_barang.php" target="_blank" class="kotak_kecil-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="kotak_kecil bg-red" style="background-color:#DD4B39;">
            <div class="inner">
            <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM penjualan");
        
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>' . $jum['jumlah'] . '</h3>';

            ?>

              <p>Total Penjualan</p>
            </div>
            <div class="icon">
              <span class=" glyphicon glyphicon-piggy-bank "></span>
            </div>
            <a href="list_barang.php" target="_blank" class="kotak_kecil-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>        
      </div>
    </section>
<!-- akhir box kecil pertama -->
       <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-olive"><span style="color: #fff;" class="glyphicon glyphicon-fire"></span></span>

            <div class="info-box-content">
               <?php
              $jumlah_record = mysqli_query($koneksi, "SELECT tanggal,COUNT(*) AS harian FROM penjualan WHERE tanggal=DATE(NOW()) GROUP BY tanggal");
              $jum = mysqli_fetch_array($jumlah_record);
              echo '
	            <a href="list_trans_penjualan.php" target="_blank" style="color: #000;"><span class="info-box-text">penjualan hari ini</span></a>
	            <span class="info-box-number">' . $jum['harian'] . '</span>';
              ?>
              </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><span style="color: #fff;" class="glyphicon glyphicon-usd"></span></span>

            <div class="info-box-content">
                <?php
                $total = 0;
                $jumlah_record = mysqli_query($koneksi, "SELECT
                                                        nama_barang,
                                                        harga_jual,
                                                    SUM(jumlah*harga_jual) as total
                                                    FROM penjualan p 
                                                    LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan 
                                                    LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
                                                    GROUP by nama_barang ORDER BY p.kd_transaksi ASC");
                $jum = mysqli_fetch_array($jumlah_record);
                $total += $row['total'];
                echo '
	            <a href="list_trans_penjualan.php" target="_blank" style="color: #000;"><span class="info-box-text">Total Pemasukkan</span></a>
	            <span class="info-box-number">' . number_format($jum['total']) . '</span>';
                ?>
              </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-maroon"><span style="color: #fff;" class="glyphicon glyphicon-random"></span></span>

            <div class="info-box-content">
               <?php
              $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from pembelian");
              $jum = mysqli_fetch_array($jumlah_record);
              echo '
	            <a href="list_trans_pembelian.php" target="_blank" style="color: #000;"><span class="info-box-text">Total Pembelian</span></a>
	            <span class="info-box-number">' . $jum['jumlah'] . '</span>';
              ?>
              </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><span style="color: #fff;" class="glyphicon glyphicon-list-alt"></span></span>
             <div class="info-box-content">
              <?php
              $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM `kategori`");
              $jum = mysqli_fetch_array($jumlah_record);
              echo '
	            <a href="list_kategori.php" target="_blank" style="color: #000;"><span class="info-box-text">Total model</span></a>
	            <span class="info-box-number">' . $jum['total'] . '</span>';
              ?>
              </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
  </div>
      <!-- /.row (main row) -->




<div class="container">
  <a href="tambah_barang.php" target="_blank" class="btn btn-primary">Tambah Barang</a>
  <a href="trans_pembelian.php" target="_blank" class="btn btn-danger">Pembelian Barang</a>
   <a href="bar/graphic.php" target="_blank" class="btn btn-warning">Presentase Penjualan</a><br><br>
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
                       <th>Stok</th>
                   </tr>
                    </thead>
                   <?php

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
                                    <td>'.$row["jml"].'</td>
                                    <td>'.$row["stok"].'</td>
                               </tr>

                               ';
                          }
                          ?>
            </table>
          </div>
        </div>
    </div>
  </body>
 <?php include 'nav_admin/footer.php'; ?>
  </html>
  <!-- <script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script type="text/javascript" src="../bar/app.js"></script> -->


<script>
  $(document).ready(function() {
    $('#mydata').dataTable();
  });
</script>
