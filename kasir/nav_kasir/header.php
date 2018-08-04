<?php
session_start(); //memulai session
if( !isset($_SESSION['nama_u']) ) //jika session nama tidak ada
{
 header('location:./../'.$_SESSION['akses']); //alihkan halaman
 exit();
}else{ //jika ada session
 $nama = $_SESSION['nama_u']; //menyimpan session nama ke variabel $nama
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?> | Kasir - Karimah Hijab Store</title>
  <link rel="icon" href="../img/logo1.png">
  <!-- Bootstrap -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/datepicker.css" rel="stylesheet">



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
            margin-bottom: 100px;
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
       }*/
  </style>



</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
   <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="../img/logoo.png"></a>
        </div>
        <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
       <li><a href="">&nbsp;</a></li>
        <li><a href="transaksi_penjualan.php"><strong><span class="glyphicon glyphicon-stats"></span> Transaksi Penjualan</strong></a></li>
        <li><a href="list_penjualan.php"><strong><span class="glyphicon glyphicon-tasks"></span> Riwayat Penjualan</strong></a></li>
      </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#"class="dropdown-toggle" data-toggle="dropdown" ><strong><span class="glyphicon glyphicon-share"></span> Lainnya</strong> <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li class=""><a href="../logout.php" onclick="return confirm('Yakin ingin Logout?')">Keluar (<b> <?php echo $nama; ?> </b>)</a></li>
                  </ul>
                </li>

            </ul>
             </div>
      </div>
</nav>
