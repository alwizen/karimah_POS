<?php
session_start(); //memulai session
if( !isset($_SESSION['saya_admin']) ) //jika session login bukan admin
{
 header('location:./../'.$_SESSION['akses']); //alihkan berdasarkan hak akses
 exit();
}
$nama = ( isset($_SESSION['nama_u']) ) ? $_SESSION['nama_u'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> | Karimah Hijab Store</title>
  <link rel="icon" href="../img/logo1.png">
  <!-- Bootstrap -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/dataTables.bootstrap.min.css">
  
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/datatables.min.js"></script>
  
  <style>
.navbar-default {
  background-color: #881c45;
  border-color: #752141;
}
.navbar-default .navbar-brand {
  color: #ecf0f1;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
  color: #ecdbff;
}
.navbar-default .navbar-text {
  color: #ecf0f1;
}
.navbar-default .navbar-nav > li > a {
  color: #ecf0f1;
}
.navbar-default .navbar-nav > li > a:hover,
.navbar-default .navbar-nav > li > a:focus {
  color: #ecdbff;
}
.navbar-default .navbar-nav > .active > a,
.navbar-default .navbar-nav > .active > a:hover,
.navbar-default .navbar-nav > .active > a:focus {
  color: #ecdbff;
  background-color: #752141;
}
.navbar-default .navbar-nav > .open > a,
.navbar-default .navbar-nav > .open > a:hover,
.navbar-default .navbar-nav > .open > a:focus {
  color: #ecdbff;
  background-color: #752141;
}
.navbar-default .navbar-toggle {
  border-color: #752141;
}
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus {
  background-color: #752141;
}
.navbar-default .navbar-toggle .icon-bar {
  background-color: #ecf0f1;
}
.navbar-default .navbar-collapse,
.navbar-default .navbar-form {
  border-color: #ecf0f1;
}
.navbar-default .navbar-link {
  color: #ecf0f1;
}
.navbar-default .navbar-link:hover {
  color: #ecdbff;
}

@media (max-width: 767px) {
  .navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #ecf0f1;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #ecdbff;
  }
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #ecdbff;
    background-color: #752141;
  }
}    .navbar-nav > li > a {
            padding-top: 15px;
        }
        .navbar-brand {
            line-height: 0px;
        }
        .navbar-brand>img {
            max-height: auto;
            height: 250%;
            margin: -12px;
            width: auto;
            padding-bottom: auto;
        }
        body {
            margin-top: 80px;
            margin-bottom: 50px;
        }
        /* .footer{
            height:50px;
            text-align: right;
            line-height:50px;
            background:#040c19;
            color:#fff;
            position:fixed;
            bottom:0px;
            padding-right: 50px;
            z-index:9999;
            width:100%;
       } */
  </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
   <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="../img/logoo.png"></a>
        </div>
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              
              <li class="dropdown">
                <a href="#"class="dropdown-toggle" data-toggle="dropdown" ><strong><span class="glyphicon glyphicon-tasks"></span> Master</strong> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="list_barang.php">Data Barang</a></li>
                    <li><a href="list_kategori.php">Data Kategori</a></li>
                    <li><a href="list_supplier.php">Data Supplier</a></li>
                    <li><a href="list_user.php">Data User</a></li>
                </ul>
              </li>

   
                <li class="dropdown">
                  <a href="#"class="dropdown-toggle" data-toggle="dropdown" ><strong><span class="glyphicon glyphicon-stats"></span> Transaksi</strong> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="trans_pembelian.php">Pembelian Barang</a></li>
                    <li><a href="list_trans_penjualan.php">Detail Penjualan</a></li>
                    <li><a href="list_trans_pembelian.php">Detail Pembelian</a></li>
                  </ul>
                </li>


              <li class="dropdown">
                  <a href="#"class="dropdown-toggle" data-toggle="dropdown" ><strong><span class="glyphicon glyphicon-book"></span> Laporan</strong> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="lap_penjualan.php">Laporan Penjualan</a></li>
                    <li><a href="lap_pembelian.php">Laporan Pembelian</a></li>
                    <li><a href="lap_persediaan.php">Laporan Persediaan Barang</a></li>
                  </ul>
                </li>
              

                <li class="dropdown">
                  <a href="#"class="dropdown-toggle" data-toggle="dropdown" ><strong><span class="glyphicon glyphicon-share"></span> Lainnya</strong> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="tambah_user.php">Tambah User</a></li>
                    <li role="separator" class="divider"></li>
                    <li class=""><a href="../logout.php" onclick="return confirm('Yakin ingin Logout?')"><span class="glyphicon glyphicon-off"></span> Keluar (<b> <?php echo $nama; ?> </b>)</a></li>
                  </ul>
                </li>
              </ul>

              </div>
             </div>
      </div>
</nav>
