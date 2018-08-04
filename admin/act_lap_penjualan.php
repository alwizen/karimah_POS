<?php
// Range.php
if(isset($_POST["From"], $_POST["to"]))
{
  include '../koneksi.php';
  include '../assets/fungsi_rupiah.php';
  include '../assets/fungsi_tanggal.php';
  $result = '';
  $query = "SELECT 
          p.kd_transaksi, 
          p.tanggal,
          jumlah,
          nama_barang,
          SUM(dp.jumlah*dp.harga) as grand_total 
          FROM penjualan p 
          LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan 
          LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
          WHERE p.tanggal BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."' 
          GROUP BY p.no_penjualan ORDER BY p.tanggal ASC";



  $sql = mysqli_query($koneksi, $query);
  $result .='
  <table class="table table-bordered">
  <tr>
  <th>Kode Transaksi</th>
  <th>Tanggal</th>
  <th>Nama barang</th>
  <th>Jumlah</th>
  <th>Grand Total</th>
  </tr>';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
      $result .='
      <tr>
      <td>'.$row["kd_transaksi"].'</td>
      <td>'.tgl_indo($row["tanggal"]).'</td>
      <td>'.$row["nama_barang"].'</td>
      <td>'.$row["jumlah"].'</td>
      <td>'.Rp($row["grand_total"]).'</td>
      </tr>';
    }
  }
  else
  {
    $result .='
    <tr>
    <td colspan="5">Item Not Found</td>
    </tr>';
  }
  $result .='</table>';
  echo $result;
}
?>