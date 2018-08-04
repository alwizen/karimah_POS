<?php
$title = "Tambah Barang";
include 'nav_admin/header.php';
 include '../koneksi.php';
// include("../fungsi/fungsi_indotgl.php");
// include("../fungsi/fungsi_rupiah.php");
 ?>

<div class="container main-section">
    <div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
      <div class="row">
        <h3><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Tambah Data Barang</h3><br>
          <form action="proses/proses_barang.php?act=input" method="POST">
             <div class="form-group">
                 <input type="text" class="form-control" name="nama_barang" placeholder="Name Barang" id="nama_barang">
              </div>
              <div class="form-group">
                  <?php
                    $query = "SELECT * FROM kategori";
                    $result = mysqli_query($koneksi, $query);
                   ?>
                <select class="form-control" id="model" name="model">
                        <option>- Pilih Model -</option>
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
                <select class="form-control" id="item" name="id_supplier">
                        <option>- Pilih Supplier -</option>
                          <?php while($row1 = mysqli_fetch_array($result)):;?>
                          <option value="<?php echo $row1['id_supplier'];?>"> <?php echo $row1['nama_supplier'];?></option>
                          <?php endwhile;?>
                </select>
              </div>
              <div class="form-group">
                 <input type="text" class="form-control" name="harga_beli" placeholder="Harga Beli" id="harga_beli">
              </div>
              <div class="form-group">
                 <input type="text" class="form-control" name="harga_jual" placeholder="Harga Jual" id="harga_jual">
              </div>

          <input type="submit" class="btn btn-primary" value="Simpan" />
          <a href="index.php" class="btn btn-danger ">Batal</a>
        </div>
    </form>
</div>
</div>

   <script src="../js/jquery-3.3.1.min.js"></script>
   <script src="../js/jquery.mask.min.js"></script>
  <script type="text/javascript">
            $(document).ready(function(){
 
                // Format mata uang.
                $( '.harga_beli' ).mask('000.000.000', {reverse: true});
 
            })
        </script>

<?php
include 'nav_admin/footer.php';
?>