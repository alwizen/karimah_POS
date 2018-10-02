<?php
include '../../koneksi.php';
 
$act=$_GET['act'];

if ($act=='delete'){
  $id=$_GET['id'];
  $row = mysqli_query($koneksi, "DELETE FROM users WHERE id = '$id'");
  header("location:../list_user.php");
}
 
elseif ($act=='input'){
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level    = $_POST['level'];

  $cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE nama='$nama' or level='$level'"));
  if ($cek > 0) {
    echo "<script>window.alert('nama atau username yang anda masukan sudah ada')
    window.location='../tambah_user.php'</script>";
  } else {
    mysqli_query($koneksi, "INSERT INTO users(id, nama, username, password, level)
    VALUES ('','$nama','$username','$password','$level')");

    echo "<script>window.alert('DATA SUDAH DISIMPAN')
    window.location='../list_user.php'</script>";
  }
}

elseif ($act=='update'){
    $id     = $_POST['id'];
    $nama   = $_POST['nama'];
    $username = $_POST['username'];
    $password    = $_POST['password'];
    $level    = $_POST['level'];

  $sql = "UPDATE users SET nama='$nama', username='$username', password='$password', level='$level' WHERE id='$id'";

  if(mysqli_query($koneksi, $sql)){
    mysqli_close($koneksi);
     echo "<script>alert('Anda telah berhasil .'); window.location = '../list_user.php'</script>";
  }
  else {
    echo '<script type="text/javascript">';
    echo 'alert("gagal");';
    echo '</script>';
  }

}
?>
