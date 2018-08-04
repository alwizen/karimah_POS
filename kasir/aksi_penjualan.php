<?php

include '../koneksi.php';
$order_items = $_POST["order_items"];
$tanggal = $_POST['tanggal'];

$nota = strtoupper("pj-");
$acak = strtoupper(substr(uniqid(md5(time())),0,5));
$unik = $nota . $acak;

$order = mysqli_query($koneksi, "INSERT INTO penjualan (kd_transaksi, tanggal) VALUES ('$unik', '$tanggal')");
$order_id = mysqli_insert_id($koneksi);

foreach ($order_items as $item) {
  mysqli_query($koneksi, "INSERT INTO det_penjualan (no_penjualan, kd_barang, jumlah, harga) VALUES ($order_id, " . (int)$item["kd_barang"] . ", " . (int)$item["jumlah"] . ", " . (int)$item["harga"] .")");
}

echo "success";