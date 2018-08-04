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

  $sql = "INSERT INTO users VALUES ('','$nama', '$username', '$password', '$level')";
  $aksi =mysqli_query($koneksi, $sql);

  if($aksi)
  {
        echo "<script>alert('Anda telah berhasil .'); window.location = '../list_user.php'</script>";
  }
  else {echo "gagal";}

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
