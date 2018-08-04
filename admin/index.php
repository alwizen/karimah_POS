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


</style>
<link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">


<div id="myCarousel" style="margin-bottom: 0px; margin-top: -40px; background-position: 0% 40%;" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="../img/cor3.jpg" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="../img/cor1.jpg" alt="Chicago">
    </div>

  <!--   <div class="item">
      <img src="../img/cor2.jpg" alt="New York">
    </div> -->
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div><br>


<!-- <div class="jumbotron" style="margin-top: -5%">
   <div class="container">
    <h1>Karimah Hijab Store</h1>
  <p>Suplier Grosir jilbab paling murah dan terupdate setiap minggunya. Siap menyuplai jilbab ke seluruh nusantara.</p>

</div>
</div><br> -->
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
<script>

  $(document).ready(function() {
    $('#mydata').dataTable();
  });
</script>
