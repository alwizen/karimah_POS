<?php 
include '../koneksi.php';
include '../assets/fungsi_rupiah.php';
include '../assets/fungsi_tanggal.php';
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
$pdf->Cell(25.5,0.7,"Laporan Pembelian Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Supplier', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, ' Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysqli_query($koneksi,"SELECT  
					          p.kd_pembelian,
					          p.tanggal,
					          b.nama_barang,
					          b.model,
					          b.harga_beli,
					          dp.jumlah,
					          s.nama_supplier, 
					          SUM(dp.jumlah*b.harga_beli) AS grand_total
					          FROM pembelian p
					          LEFT JOIN det_pembelian dp ON p.id_pembelian=dp.id_pembelian
					          LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
					          LEFT JOIN supplier s ON b.id_supplier=s.id_supplier
					          GROUP BY p.kd_pembelian ORDER BY p.tanggal DESC");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['nama_supplier'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['nama_barang'], 1, 0,'C');
	$pdf->Cell(4, 0.8, tgl_indo($lihat['tanggal']),1, 0, 'C');
	$pdf->Cell(4.5, 0.8, Rp($lihat['harga_beli']), 1, 0,'C');
	$pdf->Cell(3.5, 0.8, $lihat['jumlah'],1, 0, 'C');
	$pdf->Cell(4, 0.8, Rp($lihat['grand_total']), 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

///