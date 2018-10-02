<?php
$title = "Tambah Kategori";
include 'nav_admin/header.php'
?>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="custom.css">

 
<div class="container main-section">
  <div class="row">
    <div class="col-md-12 text-center user-login-header">
     
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
      <div class="row">
        <strong><h3><span class="glyphicon glyphicon-folder-close"></span> Tambah Kategori Barang</h3></strong><br>
        <div class="col-md-12 col-sm-12 col-xs-12 user-login-box">
          <form action="proses/proses_kategori.php?act=input" method="POST">
             <div class="form-group">
               <input type="text" class="form-control" name="kd_kategori" placeholder="Id Kategori" id="nama" required>
             </div>
        
          <div class="form-group">
              <input type="text" name="nama_kategori" class="form-control" placeholder="nama_kategori" required>
          </div>
          
          <!-- <a href="#" class="btn btn-defualt">Login</a> -->
          <input type="submit" name="login" class="btn btn-primary" value="Tambah Kategori" />
          <a href="list_kategori.php" class="btn btn-danger ">Batal</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'nav_admin/footer.php'; ?>