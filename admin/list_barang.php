<?php
$title = "Data Barang";
include 'nav_admin/header.php';
include '../assets/fungsi_rupiah.php';
 ?>
<link rel="stylesheet" href="../css/dataTables.semanticui.css">
<div class="container">

<!-- peringatan stok barang -->
<?php
include '../koneksi.php';
 $data = mysqli_query($koneksi,"SELECT
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
GROUP BY b.kd_barang ORDER BY `nama_barang` ASC");
while($q = mysqli_fetch_array($data)){
  if($q['stok']<=50){
    ?>
    <script> 
      $(document).resady(function(){
        $('#pesan_sedia').css("color","red");
        $('#pesan_sedia').append("<span class='glyphicon glyphicon-asterisk'></span>");
      });
    </script>
    <?php
    echo "<div style='padding:5px' class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'><strong>". $q['nama_barang']."</strong></a> *".$q['stok']. "* Klik <a href='trans_pembelian.php'>Disini</a> Untuk Mekalukan Pembelian !</div>"; 
  }
}
?>
<!-- akhir peringatan -->
<a href="tambah_barang.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Barang</a><br><br>
    <table class="table table-hover table-bordered" id="mydata">
      <thead>
        <tr class="danger">
          <th>#</th>
           <th>Nama Barang</th>
           <th>Model</th>
            <th>Nama Supplier</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th><center>ACTION</center></th>
          </tr>
        </thead>
        <tbody>

          <?php
          include '../koneksi.php';
          $no = 1;
          $data = mysqli_query($koneksi, "SELECT
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
                                          GROUP BY b.kd_barang ORDER BY `nama_barang` ASC");
          while($row = mysqli_fetch_array($data))
            {
              echo '
                <tr>
                  <td>'.$no++.'</td>
                  <td>'.$row["nama_barang"].'</td>
                  <td>'.$row["model"].'</td>
                  <td>'.$row["nama_supplier"].'</td>
                  <td>'.Rp($row["harga_beli"]).'</td>
                  <td>'.Rp($row["harga_jual"]).'</td>
                  <td>'.$row["stok"].'</td>
                  <td>
                    <center>
                      <a href="edit_barang.php?kd_barang='. $row["kd_barang"].'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>

                      <a href="proses/proses_barang.php?act=delete&kd_barang= '.$row['kd_barang'].'" class="btn btn-danger"  onclick ="if (!confirm(\'Apakah Anda yakin akan menghapus data ini?\')) return false;"><span class="glyphicon glyphicon-trash"></span></a>
                    </center>
                    </td>
                  </tr>
                ';
                }
                ?>
        </tbody>
      </table>
    </div>
     <?php
include 'nav_admin/footer.php';
  ?>
<script>
  $(document).ready(function() {
    $('#mydata').dataTable({
      "language" :{
        "url" : "../js/indo.json"
      }
    });
    responsive: true
  });
</script>
