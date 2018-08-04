<?php 
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
require ('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../img/logo.png',1,0.75,5,2);
$pdf->SetX(6);            
$pdf->MultiCell(20.5,0.5,'Karimah Hijab Store',0,'L');
$pdf->SetX(6);
$pdf->MultiCell(19.5,0.5,'Telpon : 085701366688',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(6);
$pdf->MultiCell(19.5,0.5,'JL. Otto Iskandar Dinata Soko Pekalongan Selatan',0,'L');
$pdf->SetX(4);
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Persediaan Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama Supplier', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Model', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Harga Beli', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'harga Jual', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Stok', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($koneksi,"SELECT
								    b.kd_barang,
								    b.model,
								    b.nama_barang,
								    b.harga_jual,
								    b.harga_beli,
								    s.nama_supplier,
								    IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah)) as jml_beli,
								    IF(SUM(dp2.jumlah) IS NULL,0,SUM(dp2.jumlah)) as jml_jual,
								    ((IF(SUM(dp.jumlah) IS NULL,0,SUM(dp.jumlah))) - (IF(SUM(dp2.jumlah) IS NULL,0,SUM(dp2.jumlah)))) as stok
								FROM `barang` b
								LEFT JOIN supplier s ON b.id_supplier=s.id_supplier
								LEFT JOIN det_pembelian dp ON dp.kd_barang=b.kd_barang
								LEFT JOIN det_penjualan dp2 ON dp2.kd_barang=b.kd_barang
								GROUP BY b.kd_barang
								ORDER BY `nama_barang` ASC");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8, $lihat['nama_barang'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['nama_supplier'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['model'],1, 0, 'C');
	$pdf->Cell(4.5, 0.8,Rp($lihat['harga_beli']), 1, 0,'C');
	$pdf->Cell(4.5, 0.8,Rp($lihat['harga_jual']),1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['stok'], 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

///