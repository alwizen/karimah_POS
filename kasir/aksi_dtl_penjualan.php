<?php 
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
$id = $_GET['no_penjualan'];

$query = "SELECT 
		p.kd_transaksi, 
        p.tanggal,
        jumlah,
        model,
        harga_jual,
        nama_barang
		FROM penjualan p 
		LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan 
		LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
		WHERE p.no_penjualan = ".$id." 
		ORDER BY p.kd_transaksi ASC";

		 $result = mysqli_query($koneksi, $query);
		 $data = array();

		 while($row = mysqli_fetch_array($result)){
           $judul = $row['kd_transaksi'];
          $data[] = array(
              'nama_barang' =>$row['nama_barang'] ,
              'model' =>$row['model'],
              'harga_jual' =>Rp($row['harga_jual']),
          	  'jumlah' 		  =>$row['jumlah']
          );

          } 
          echo json_encode(array(
          	"data"  => $data, 
          	"judul" => $judul
          ));
 ?>
         