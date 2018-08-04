<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'BAba55ko');
define('DB_NAME', 'karimah');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT  
          p.kd_pembelian,
          p.tanggal,
          b.nama_barang,
          b.harga_beli,
          dp.jumlah,
          s.nama_supplier, 
          SUM(dp.jumlah*b.harga_beli) AS grand_total
          FROM pembelian p
          LEFT JOIN det_pembelian dp ON p.id_pembelian=dp.id_pembelian
          LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
          LEFT JOIN supplier s ON b.id_supplier=s.id_supplier
          GROUP BY p.kd_pembelian ORDER BY p.tanggal DESC");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);