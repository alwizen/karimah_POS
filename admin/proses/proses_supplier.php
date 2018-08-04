<?php 
include '../../koneksi.php';
 
$act=$_GET['act'];  

if ($act=='delete'){
	$id_supplier=$_GET['id_supplier'];
	$row = mysqli_query($koneksi, "DELETE FROM supplier WHERE id_supplier = '$id_supplier'");
	header("location:../list_supplier.php");
}

elseif ($act=='input'){
	$nama_supplier  = $_POST['nama_supplier'];
	$alamat         = $_POST['alamat'];
	$no_tlp         = $_POST['no_tlp'];
	
	$sql = "INSERT INTO supplier VALUES('', '$nama_supplier', '$alamat', '$no_tlp')";
	$aksi =mysqli_query($koneksi, $sql);

	if($aksi)
	{
       echo "<script>alert('Anda telah berhasil .'); window.location = '../list_supplier.php'</script>";
	}
	else {echo "gagal";}

}

elseif ($act=='update'){	
	$id_supplier    = $_POST['id_supplier'];
	$nama_supplier  = $_POST['nama_supplier'];
	$alamat         = $_POST['alamat'];
	$no_tlp         = $_POST['no_tlp'];

	$sql = "UPDATE supplier SET nama_supplier='$nama_supplier', alamat='$alamat', no_tlp='$no_tlp' WHERE id_supplier='$id_supplier'";

	if(mysqli_query($koneksi, $sql)){
		mysqli_close($koneksi);
		 echo "<script>alert('Anda telah berhasil .'); window.location = '../list_supplier.php'</script>";
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("gagal");';
		echo '</script>';
	}

}
?>
