<?php 
$title = "Tambah Supplier";
include 'nav_admin/header.php';
  ?>

<div class="container">
<div class="panel panel-primary">
  <div class="panel-heading"><span class="glyphicon glyphicon-download-alt"></span>  Form Tambah Supplier</div>
  <div class="panel-body">
    <form class="form-horizontal" action="proses/proses_supplier.php?act=input" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-2" for="">Nama Supplier :</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" placeholder="Nama Supplier" name="nama_supplier" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="">Alamat :</label>
      <div class="col-sm-6">          
        <textarea type="text" class="form-control" id="" placeholder="Alamat supplier" name="alamat"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="">No Telp :</label>
      <div class="col-sm-6">          
        <input type="text" class="form-control" id="" placeholder="No Telp" name="no_tlp">
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="datasupplier.php">Batal</a>
      </div>
    </div>
  </form>
  </div>
</div>

</div>


<?php 
include 'nav_admin/footer.php';
  ?>