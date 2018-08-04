<?php
$title = "Edit Barang";
  include 'nav_admin/header.php';
  error_reporting(0);
  include '../koneksi.php';
  $kd_barang = $_GET['kd_barang'];
  $sqlquery = "SELECT * FROM barang WHERE kd_barang='$kd_barang'";
  $result = mysqli_query($koneksi, $sqlquery) or die (mysqli_connect_error());
  $d = mysqli_fetch_assoc($result);
  ?>


  <div class="container main-section">
      <div class="col-md-4 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-2 login-image-main text-center">
<h4><span class="glyphicon glyphicon glyphicon-edit"></span> Edit Barang <b  style="color: red;">( <?php echo $d['nama_barang'] ?> )</b></h4><br>
        <div class="row">

        <form id="form_input" action="proses/proses_barang.php?act=update" method="post">
             <input type="hidden" name="kd_barang" id="kd_barang" value="<?php echo $d["kd_barang"]; ?>">
             <div class="form-group">
                 <input type="text" class="form-control" placeholder="Name Barang" id="nama_barang" name="nama_barang" value="<?php echo $d['nama_barang']; ?>" required>
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

                     <input type="text" class="form-control" placeholder="Harga Beli .." name="harga_beli" id="" value="<?php echo $d['harga_beli']; ?>" required>
                   </div>
                   <div class="form-group">

                     <input type="text" class="form-control" placeholder="Harga Jual .." name="harga_jual" id="" value="<?php echo $d['harga_jual']; ?>" required>
                   </div>
                 </div>
            <div class="form-group">
              <button class="btn btn-primary">Simpan</button>
              <a href="list_barang.php" class="btn btn-danger">Batal</a>
            </div>
         </div>
      </form>
  </div></div>
</div>
</div>

  <?php
include 'nav_admin/footer.php';
   ?>
