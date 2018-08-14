<?php
include '../../koneksi.php';

$act=$_GET['act'];
 
if ($act=='delete'){
	$kd_barang=$_GET['kd_barang'];
	$row = mysqli_query($koneksi, "DELETE FROM barang WHERE kd_barang = '$kd_barang'");
	header("location:../list_barang.php");
}

elseif ($act=='input'){
	$nama_barang   = $_POST['nama_barang'];
    $model 		     = $_POST['model'];
    $id_supplier   = $_POST['id_supplier'];
    $harga_beli    = $_POST['harga_beli'];
    $harga_jual    = $_POST['harga_jual'];

	$sql = "INSERT INTO barang VALUES ('','$nama_barang', '$model', '$id_supplier', '$harga_beli', '$harga_jual')";
	$aksi =mysqli_query($koneksi, $sql);

	if($aksi)
	{
        echo "<script>alert('Input Barang berhasil .'); window.location = '../list_barang.php'</script>";
	}
	else {echo "gagal";}

}

elseif ($act=='update'){
		$kd_barang	   = $_POST['kd_barang'];
	    $nama_barang   = $_POST['nama_barang'];
	    $model  	   = $_POST['model'];
    	$id_supplier   = $_POST['id_supplier'];
    	$harga_beli    = $_POST['harga_beli'];
    	$harga_jual    = $_POST['harga_jual'];

	$sql = "UPDATE barang SET nama_barang='$nama_barang',model='$model' , id_supplier='$id_supplier', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE kd_barang='$kd_barang'";

	if(mysqli_query($koneksi, $sql)){
		mysqli_close($koneksi);
		 echo "<script>alert('Edit Barang berhasil .'); window.location = '../list_barang.php'</script>";
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("gagal");';
		echo '</script>';
	}

}
?>
