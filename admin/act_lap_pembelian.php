<?php
// Range.php
if(isset($_POST["From"], $_POST["to"]))
{
  include '../koneksi.php';
  include '../assets/fungsi_rupiah.php';
  include '../assets/fungsi_tanggal.php';
  $result = '';
  $query ="SELECT 
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
          WHERE p.tanggal BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."' 
          GROUP BY p.kd_pembelian ORDER BY p.tanggal DESC";
  $sql = mysqli_query($koneksi, $query);
  $result .='
  <table class="table table-bordered">
  <tr>
  <th>Kode Pembelian</th>
  <th>Tanggal</th>
  <th>Nama barang</th>
  <th>Supplier</th>
  <th>Harga Beli</th>
  <th>Jumlah</th>
  <th>Grand Total</th>
  </tr>';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
      $result .='
      <tr>
      <td>'.$row["kd_pembelian"].'</td>
      <td>'.tgl_indo($row["tanggal"]).'</td>
      <td>'.$row["nama_barang"].'</td>
      <td>'.$row["nama_supplier"].'</td>
      <td>'.Rp($row["harga_beli"]).'</td>
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