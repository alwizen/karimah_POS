<?php 
$title = "Data Supplier"; 
include 'nav_admin/header.php';
include '../koneksi.php';
$query ="SELECT * FROM supplier ORDER BY id_supplier DESC";  
$result = mysqli_query($koneksi, $query);
?>

<link rel="stylesheet" href="../css/buttons.dataTables.min.css">
 <div class="container">
 	<a href="tambah_supplier.php"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah Data Supplier</button></a> <br>
</div> <br>
  <div class="container">
      <table class="table table-bordered table-condensed " id="mydata">
       	<thead> 
       		<tr class="danger">
    	      <th>#</th>
    				<th>Nama Supplier</th>
    				<th>Alamat</th>
    				<th>Nomer Telp</th>
    				<th><center> Aksi </center></th>
    			</tr>
	     	</thead>

		            <?php  
                      $no = 1;
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo '  
                               <tr>  
                                  <td>'.$no++.'</td>
                                    <td>'.$row["nama_supplier"].'</td>  
                                    <td>'.$row["alamat"].'</td>  
                                    <td>'.$row["no_tlp"].'</td>
                                    <td>
                                    <center>
                                        <a href="edit_supplier.php?id_supplier='. $row["id_supplier"].'" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></a>
                                    
                                       <a href="proses/proses_supplier.php?act=delete&id_supplier= '.$row['id_supplier']. '" class="btn btn-danger"  onclick ="if (!confirm(\'Apakah Anda yakin akan menghapus data ini?\')) return false;"><span class="glyphicon glyphicon-trash"></span></a>
                                      </center>
                                    </td>
                               </tr>  

                               ';  
                          }  
                          ?>  
		</table>
  </div>



<?php include 'nav_admin/footer.php'; ?>
<script src="../js/dataTables.buttons.min.js"></script>
<script src="../js/buttons.flash.min.js"></script>
<script src="../js/jszip.min.js"></script>
<script src="../js/pdfmake.min.js"></script>
<script src="../js/vfs_fonts.js"></script>
<script src="../js/buttons.html5.min.js"></script>
<script src="../js/buttons.print.min.js"></script>
<script>
  $(document).ready(function() {
    $('#mydata').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ]
    } );
} );
  $(document).ready(function() {
    $('#mydata').dataTable();
  });
</script>