<?php 


$connect = mysqli_connect("localhost", "root", "BAba55ko", "karimah");
$request = mysqli_real_escape_string($connect, $_POST["query"]);

$query = "SELECT * FROM barang WHERE nama_barang LIKE '%".$request."%' ";

$result = mysqli_query($connect, $query);

$date = array();

if (mysqli_num_rows($result) > 0) 
{
	while ($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row["nama_barang"];	    
	}	
	echo json_encode($data);
}

 ?>

