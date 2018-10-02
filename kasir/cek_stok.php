<?php
include '../koneksi.php';
$id = $_GET['id'];
$query = "SELECT
          b.kd_barang,
          b.nama_barang,
          b.harga_beli,
          b.harga_jual,
          (SELECT IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah)) FROM det_pembelian dp  WHERE dp.kd_barang = b.kd_barang) as jml,
          ((SELECT IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah)) FROM det_pembelian dp  WHERE dp.kd_barang = b.kd_barang) - (SELECT (IF(SUM(dp2.jumlah) IS NULL,0,SUM(dp2.jumlah)))
          FROM det_penjualan dp2 WHERE dp2.kd_barang = b.kd_barang)) as stok
          FROM `barang` b
          WHERE b.kd_barang = ".$id."
          GROUP BY b.kd_barang ORDER BY `nama_barang` ASC";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
echo json_encode(array("stok"=> $row['stok']));
// print_r($row['stok']);
?>