<?php
$title = "Edit User";
  include 'nav_admin/header.php';
  error_reporting(0);
  include '../koneksi.php';
  $id = $_GET['id'];
  $sqlquery = "SELECT * FROM users WHERE id='$id'";
  $result = mysqli_query($koneksi, $sqlquery) or die (mysqli_connect_error());
  $d = mysqli_fetch_assoc($result);
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
        <strong><h3><span class="glyphicon glyphicon-edit"></span> Edit Pengguna <b>( <?php echo $d['nama'] ?> )</b></h3></strong><br>
        <div class="col-md-12 col-sm-12 col-xs-12 user-login-box">
          <form action="proses/proses_user.php?act=update" method="POST">
             <div class="form-group">
              <input type="hidden" name="id" id="id" value="<?php echo $d["id"]; ?>">
               <input type="text" class="form-control" name="nama" placeholder="Name" id="nama"  value="<?php echo $d["nama"]; ?>">
             </div>
          <div class="form-group">
              <input type="text" class="form-control" name="username" placeholder="Username" id="username"  value="<?php echo $d["username"]; ?>">
          </div>
          <div class="form-group">
              <input type="text" name="password" class="form-control" placeholder="Password" id="usr"  value="<?php echo $d["password"]; ?>">
          </div>
          <div class="form-group">
            <select name="level" class="form-control" id=""  value="<?php echo $d["level"]; ?>">
              <option value="admin">Admin</option>
              <option value="kasir">Kasir</option>
            </select>
          </div>
          <!-- <a href="#" class="btn btn-defualt">Login</a> -->
          <input type="submit" name="login" class="btn btn-primary" value="Edit" />
          <a href="list_user.php" class="btn btn-danger ">Batal</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'nav_admin/footer.php'; ?>