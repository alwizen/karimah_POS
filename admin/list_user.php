<?php
$title = "Data User";
include 'nav_admin/header.php'
?>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="custom.css">
 
  <div class="container">
    <a href="tambah_user.php" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Tambah User</a>
     <div class="panel-body">
      <table class="table table-bordered table-responsive" id="mydata">
        <thead>
          <tr class="danger"">
            <th>#</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Level</th>
            <th><center>ACTION</center></th>
          </tr>
          </thead>
              <?php 
                include '../koneksi.php';
                $no = 1;
                $data = mysqli_query($koneksi,"SELECT * FROM users");
                while($d = mysqli_fetch_array($data))
                {
                  echo '
              
          <tbody>
            <tr>
              <td>'. $no++ .'</td>
              <td>'. $d['nama'] .'</td>
              <td>'. $d['username'] .'</td>
              <td>'. $d['level'] .'</td>
              <td>
                <center>
                  <a href="edit_user.php?id='. $d['id'] .'" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>

                  <a href="proses/proses_user.php?act=delete&id='. $d['id'].'" class="btn btn-danger" onclick ="if (!confirm(\'Apakah Anda yakin akan menghapus data ini?\')) return false;"><span class="glyphicon glyphicon-trash"></span></a>
                </center>
              </td>
              </tr>
                ';
                  }
                ?> 
            </tbody>
          </table>
        </div>

<?php include 'nav_admin/footer.php'; ?>
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