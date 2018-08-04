<?php
$title = "Edit Supplier";
  include 'nav_admin/header.php';
  error_reporting(0);
  include '../koneksi.php';
  $id_supplier = $_GET['id_supplier'];
  $sqlquery = "SELECT * FROM supplier WHERE id_supplier='$id_supplier'";
  $result = mysqli_query($koneksi, $sqlquery) or die (mysqli_connect_error());
  $d = mysqli_fetch_assoc($result);
  ?>
   <div class="container">
  <h3><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data Supplier <b>( <?php echo $d['nama_supplier'] ?> )</b></h3><br>
<form class="form-horizontal" action="proses/proses_supplier.php?act=update" method="POST">
   <input type="hidden" name="id_supplier" id="id_supplier" value="<?php echo $d["id_supplier"]; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2" for="">Nama Supplier :</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" placeholder="Nama supplier" name="nama_supplier" value=" <?php echo $d['nama_supplier'] ?> ">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="">Alamat :</label>
      <div class="col-sm-6">          
      <input type="text" class="form-control" id="" placeholder="Alamat" name="alamat" value=" <?php echo $d['alamat'] ?> ">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="">No Telp :</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="" placeholder="No Telp" name="no_tlp" value=" <?php echo $d['no_tlp'] ?> ">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <button type='input' name='input' class='btn btn-warning'>Edit</button>
        <a class="btn btn-default" href="list_supplier.php">Batal</a>
      </div>
    </div>
  </form>
  </div>


    <?php 
include 'nav_admin/footer.php';
   ?>