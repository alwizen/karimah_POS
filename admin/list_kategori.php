<?php 
$title = "Data Kategori";
include 'nav_admin/header.php'; 
include '../koneksi.php'; 
$query ="SELECT * FROM kategori ORDER BY kd_kategori DESC";  
$result = mysqli_query($koneksi, $query);
?>
<div class="container">
	<a href="tambah_kategori.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Kategori</a><br><br>
        <table class="table table-bordered table-condensed " id="mydata">
                <thead>
                 <tr class="danger">
                  <th>#</th>
                  <th>Kode Kategori</th>
                  <th>Nama Kategori</th>
                  <th><center> Aksi </center></th>
                </tr>
            </thead>
			 <?php 
			    include '../koneksi.php';
			    $no = 1;
			    $data = mysqli_query($koneksi,"SELECT * FROM kategori");
			    while($d = mysqli_fetch_array($data)){
			    echo '
			<tbody>
				<tr>
          <td>'.$no++ .'</td>
          <td>'.$d['kd_kategori'].'</td>
          <td>'.$d['nama_kategori'].'</td>
          <td>
              <center>
                <a href="edit_kategori.php?kd_kategori='. $d["kd_kategori"] .'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                <a href="proses/proses_kategori.php?act=delete&kd_kategori='. $d['kd_kategori'] .'" class="btn btn-danger" onclick ="if (!confirm(\'Apakah Anda yakin akan menghapus data ini?\')) return false;"><span class="glyphicon glyphicon-trash"></span></a>
              </center>
            </td>
          </tr>
                '; 
                  }
                     ?>  
			</tbody>
    </table>
</div>
<?php include ('nav_admin/footer.php'); ?>
<script>
    $(document).ready(function() {
    $('#mydata').dataTable();
    responsive: true
  });
</script>