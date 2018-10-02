<?php
//setting header to json
header('Content-Type: application/json');

//database
include '../../koneksi.php';

//query to get data from the table
$query = sprintf("SELECT
		nama_barang,
		SUM(jumlah) as jml
		FROM penjualan p
		LEFT JOIN det_penjualan dp ON p . no_penjualan = dp . no_penjualan
		LEFT JOIN barang b ON dp . kd_barang = b . kd_barang
		GROUP by nama_barang ORDER BY p . kd_transaksi ASC ");

//execute query
$result = $koneksi->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$koneksi->close();

//now print the data
print json_encode($data);