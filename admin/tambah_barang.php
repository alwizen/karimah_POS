<?php
$title = "Tambah Barang";
include 'nav_admin/header.php';
include '../koneksi.php';
 ?>

  <link rel="stylesheet" href="../css/select2.min.css">
  <link rel="stylesheet" href="../css/select2-bootstrap.min.css">
<div class="container main-section">
    <div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
      <div class="row">
        <h3><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Tambah Data Barang</h3><br>
          <form action="proses/proses_barang.php?act=input" method="POST">
             <div class="form-group">
                 <input type="text" class="form-control" name="nama_barang" placeholder="Name Barang" id="nama_barang" required>
              </div>
              <div class="form-group">
                  <?php
                    $query = "SELECT * FROM kategori";
                    $result = mysqli_query($koneksi, $query);
                   ?>
                <select required class="form-control model" id="model" name="model">
                          <?php while($row1 = mysqli_fetch_array($result)):;?>
                          <option value="<?php echo $row1['nama_kategori'];?>"> <?php echo $row1['nama_kategori'];?></option>
                          <?php endwhile;?>
                  </select>
              </div>
              <div class="form-group">
                  <?php
                    $query = "SELECT * FROM supplier";
                    $result = mysqli_query($koneksi, $query);
                   ?>

                <select required class="form-control supplier" id="supplier" name="id_supplier">
                  <?php while($row1 = mysqli_fetch_array($result)):;?>
                    <option value="<?php echo $row1['id_supplier'];?>"> <?php echo $row1['nama_supplier'];?></option>
                          <?php endwhile;?>
                </select>
              </div>
              <div class="form-group">
                 <input type="text" class="form-control" name="harga_beli" placeholder="Harga Beli" id="harga_beli" required>
              </div>
              <div class="form-group">
                 <input type="text" class="form-control" name="harga_jual" placeholder="Harga Jual" id="harga_jual" required>
              </div>

          <input type="submit" class="btn btn-primary" value="Simpan" />
          <a href="index.php" class="btn btn-danger ">Batal</a>
        </div>
    </form>
</div>
</div>
<!-- <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script> -->
  <script src="../js/select2.min.js"></script>
   <script type="text/javascript">
    $(document).ready(function() {
      $('.model').select2({
       theme: "bootstrap",
       placeholder: "Pilih Model",
       allowClear: true
        });

       $('.supplier').select2({
       theme: "bootstrap",
       placeholder: "Pilih Supplier",
       allowClear: true
        });
    });
  </script>

<?php
include 'nav_admin/footer.php';
?>