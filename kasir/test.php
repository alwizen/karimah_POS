<?php 
include '../koneksi.php';
$no_penjualan=$_GET['no_penjualan'];
$query="SELECT
                                        p.no_penjualan,
                                        p.kd_transaksi,
                                        p.tanggal,
                                        jumlah,
                                        nama_barang,
                                        model,
                                        SUM(dp.jumlah*dp.harga) as grand_total
                                        FROM penjualan p
                                        LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan
                                        LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
                                        WHERE p.no_penjualan = '$no_penjualan'
                                        GROUP BY no_det_penjualan ORDER BY p.tanggal DESC";
  $result = mysqli_query($koneksi, $query) or die (mysqli_connect_error());
  $d = mysqli_fetch_assoc($result);


 ?>
