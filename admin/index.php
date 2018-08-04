<?php
$title = "Selamat Datang";
include 'nav_admin/header.php';
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
$query ="SELECT
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
<style>
  .jumbotron {
    margin-bottom: 0px;
    background-image: url(../img/toko.jpg);
    background-position: 0% 40%;
    background-size: cover;
    background-repeat: no-repeat;
    color: #ffffff;
    text-shadow: black 0.3em 0.3em 0.3em;
  }
.small-box {
  border-radius: 2px;
  position: relative;
  display: block;
  margin-bottom: 20px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.small-box > .inner {
  padding: 10px;
}
.small-box > .small-box-footer {
  position: relative;
  text-align: center;
  padding: 3px 0;
  color: #fff;
  color: rgba(255, 255, 255, 0.8);
  display: block;
  z-index: 10;
  background: rgba(0, 0, 0, 0.1);
  text-decoration: none;
}
.small-box > .small-box-footer:hover {
  color: #fff;
  background: rgba(0, 0, 0, 0.15);
}
.small-box h3 {
  font-size: 38px;
  font-weight: bold;
  margin: 0 0 10px 0;
  white-space: nowrap;
  padding: 0;
}
.small-box p {
  font-size: 15px;
}
.small-box p > small {
  display: block;
  color: #f9f9f9;
  font-size: 13px;
  margin-top: 5px;
}
.small-box h3,
.small-box p {
  z-index: 5;
}
.small-box .icon {
  -webkit-transition: all 0.3s linear;
  -o-transition: all 0.3s linear;
  transition: all 0.3s linear;
  position: absolute;
  top: -10px;
  right: 10px;
  z-index: 0;
  font-size: 90px;
  color: rgba(0, 0, 0, 0.15);
}
.small-box:hover {
  text-decoration: none;
  color: #f9f9f9;
}
.small-box:hover .icon {
  font-size: 95px;
}
@media (max-width: 767px) {
  .small-box {
    text-align: center;
  }
  .small-box .icon {
    display: none;
  }
  .small-box p {
    font-size: 12px;
  }
}
/*
 * Component: Box
 * --------------
 */
.box {
  position: relative;
  border-radius: 3px;
  background: #ffffff;
  border-top: 3px solid #d2d6de;
  margin-bottom: 20px;
  width: 100%;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}

        #chart-container {
          align-items: center;
            width: 680px;
            height: auto;
        }

</style>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">


<div id="myCarousel" style="margin-bottom: 0px; margin-top: -40px; background-position: 0% 40%;" class="carousel slide" data-ride="carousel">

  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
  
  </ol>

  <div class="carousel-inner">
    <div class="item active">
      <img src="../img/cor3.jpg" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="../img/cor1.jpg" alt="Chicago">
    </div>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div><br><br>

<!-- <div class="container">
  <div id="chart-container">
          <canvas id="mycanvas"></canvas>
      </div>
</div> -->

<div class="container">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua" style="background-color:#46a9e2;">
            <div class="inner">
             <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from barang");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>'.$jum['jumlah'].'</h3>';
           
            ?>

              <p>Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="list_barang.php" class="small-box-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green" style="background-color:#00A65A;">
            <div class="inner">
            <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from supplier");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>' . $jum['jumlah'] . '</h3>';

            ?>

              <p>Supplier</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="list_barang.php" class="small-box-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow" style="background-color:#F39C12;">
            <div class="inner">
             <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from pembelian");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>' . $jum['jumlah'] . '</h3>';

            ?>

              <p>Pembelian </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="list_barang.php" class="small-box-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red" style="background-color:#DD4B39;">
            <div class="inner">
            <?php
            $jumlah_record = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah from penjualan");
            $jum = mysqli_fetch_array($jumlah_record);
            echo '
            <h3>' . $jum['jumlah'] . '</h3>';

            ?>

              <p>Penjualan</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="list_barang.php" class="small-box-footer">More info <span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->



<div class="container">
  <a href="tambah_barang.php" target="_blank" class="btn btn-primary">Tambah Barang</a>
  <a href="trans_pembelian.php" target="_blank" class="btn btn-danger">Pembelian Barang</a><br><br>
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
  <script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script type="text/javascript" src="../bar/app.js"></script>
<script>
  $(document).ready(function() {
    $('#mydata').dataTable();
  });
</script>
