<?php 
session_start();
$nama = ( isset($_SESSION['nama_u']) ) ? $_SESSION['nama_u'] : '';
include '../koneksi.php';
include '../assets/fungsi_tanggal.php';
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
$pdf->ln(0.5);
$pdf->Cell(25.5,0.7,"LAPORAN PENJUALAN BARANG",0,10,'C');
$pdf->SetFont('Arial','B',10);
// $pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->Cell(10,0.7,"Dari Tanggal : ".tgl_indo($_POST['dari']) ." - Sampai : ".tgl_indo($_POST['sampai']),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Faktur', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Model', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Total', 1, 1, 'C');
$pdf->SetFont('Arial','',10);

$no=1;
$grand_total = 0;
$dari   = $_POST['dari'];
$sampai = $_POST['sampai'];
$query=mysqli_query($koneksi,"SELECT
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
                                        WHERE p.tanggal BETWEEN '".$_POST["dari"]."' AND '".$_POST["sampai"]."' 
                                         GROUP BY no_det_penjualan ORDER BY p.tanggal DESC");
while($lihat=mysqli_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
     $pdf->Cell(4, 0.8, $lihat['kd_transaksi'],1, 0, 'C');
     $pdf->Cell(4, 0.8, tgl_indo($lihat['tanggal']), 1, 0,'C');
     $pdf->Cell(5, 0.8, $lihat['nama_barang'],1, 0, 'C');
     $pdf->Cell(4, 0.8, $lihat['model'], 1, 0,'C');
     $pdf->Cell(2, 0.8, $lihat['jumlah'],1, 0, 'C');
     $pdf->Cell(4, 0.8, Rp($lihat['grand_total']), 1, 1,'C');
     $grand_total += $lihat['grand_total'];
	 $no++;
}
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 0.8, " Total Pemasukkan ", 1, 0,'C');          
$pdf->Cell(4, 0.8, Rp($grand_total), 1, 0,'C');
$pdf->SetFont('Arial','B',10);
$pdf->ln(1);
$pdf->MultiCell(19.5,2,'Pekalongan, '.tgl_indo(date("Y-m-d")).'',0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->ln(1);
$pdf->SetFont('Arial','U',10);
$pdf->MultiCell(19.5,0.8,' '.$nama.' ',0,'L');
$pdf->Output("Laporan Penjualan.pdf","I");

?>
