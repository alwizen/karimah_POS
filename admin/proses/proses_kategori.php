<?php
include '../../koneksi.php';
 
$act=$_GET['act'];

if ($act=='delete'){
  $kd_kategori=$_GET['kd_kategori'];
  $row = mysqli_query($koneksi, "DELETE FROM kategori WHERE kd_kategori = '$kd_kategori'");
  header("location:../list_kategori.php");
}
 
elseif ($act=='input'){
    $kd_kategori    = $_POST['kd_kategori'];
    $nama_kategori  = $_POST['nama_kategori'];

  $sql = "INSERT INTO kategori VALUES ('$kd_kategori','$nama_kategori')";
  $aksi =mysqli_query($koneksi, $sql);

  if($aksi)
  {
        echo "<script>alert('Anda telah berhasil .'); window.location = '../list_kategori.php'</script>";
  }
  else {echo "gagal";}

}

elseif ($act=='update'){
    $kd_kategori     = $_POST['kd_kategori'];
    $nama_kategori   = $_POST['nama_kategori'];

  $sql = "UPDATE kategori SET  kd_kategori='$kd_kategori', nama_kategori='$nama_kategori' WHERE kd_kategori='$kd_kategori'";

  if(mysqli_query($koneksi, $sql)){
     mysqli_close($koneksi);
     echo "<script>alert('Anda telah berhasil .'); window.location = '../list_kategori.php'</script>";
  }
  else {
    echo '<script type="text/javascript">';
    echo 'alert("gagal");';
    echo '</script>';
  }

}
?>
