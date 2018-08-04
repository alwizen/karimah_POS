<?php 
include '../../koneksi.php';

$tgl1 = $_GET['tgl_awal'];
$tgl2 = $_GET['tgl_akhir'];

if (empty($_GET['tgl_awal'])) {
    echo '<script>
            alert("Tanggal Awal Harus Diisi!");
            history.back();
          </script>';
} elseif (empty($_GET['tgl_akhir'])) {
    echo '<script>
            alert("Tanggal Akhir Harus Diisi!");
            history.back();
          </script>';
?>
<?php
}  else {
?>
<html>
     <head>
        <title> TOKO AULIA </title>
        <link href="../image/shop.png" rel="icon" type="image/png">
        <style>
            .paper{
                width:90%;
				margin-left: 5%;
				margin-right: 5%;
            }
            .btn-cetak{
                border:none;
                background-color:blue;
                color:white;
                padding:5px;
                font-size:18pt;
                font-wight:bold;
                padding-right:10pt;
                padding-left:10pt;
            }
            .tabel{
                border-collape:collape;
                width:100%;
            }
            .tabel tr th{
                vertical-align:top;
                border:1px solid black;
                font-weight:bold;
				font-size:12px;
            }
            .tabel tr td{
                border:1px solid black;
				font-size:12px;
            }


        </style>
    </head>
    <body onload="window.print();">
        <div class="paper">

            <center>
                <h1>TOKO AULIA</h1>
                <h4> Wonokerto Kec. Wiradesa Kab. Pekalongan <br> Kode Pos : 51152, Telp/Fax : (0265) 425211</h4>
            </center> 
            <hr color="black"/>
            <hr color="black"/>
            <h4 align = 'center'>Laporan Penjualan Barang</h4>
            <br>
            <label>Tangggal Priode : <?php echo tgl_indo($_GET['tgl_awale']); ?> S/d <?php echo tgl_indo($_GET['tgl_akhire']); ?></label>

            <table class="tabel" cellspacing="0" cellpadding="4">
                <tr>
                    <th>No</th>
                    <th>Kode Faktur Penjualan</th>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Sub Harga</th>
                    
                </tr>
                 <?php
                $no =1;
                $total = 0;
                
                $sql = mysql_query("select * from tb_kategori,tb_barang,tb_dtl_penjualan,tb_penjualan "
                        . "where "
                        . "tb_kategori.kd_kategori=tb_barang.kd_kategori and "
                        . "tb_barang.kd_barang=tb_dtl_penjualan.kd_barang and "
                        . "tb_penjualan.kd_penjualan=tb_dtl_penjualan.kd_penjualan  and "
                        . "tb_penjualan.tgl_penjualan between '$tgl1' and '$tgl2' order by tb_dtl_penjualan.id_dtl_penjualan asc ")or die(mysql_error());
                 while ($row = mysql_fetch_array($sql)) {
                      
                 ?>
                
                <tr>
                    <td align="center"><?php echo "$no"; ?></td>
                    <td align="center"><?php echo "$row[kd_penjualan]"; ?></td>
                    <td align="center"><?php echo tgl_indo($row['tgl_penjualan']); ?></td>
                    <td align="center"><?php echo $row['nm_kategori']; ?></td>
                    <td align="center"><?php echo $row['nm_barang']; ?></td>
                    <td align="center"><?php echo $row['jml_penjualan']; ?></td>
                    <td align="right"><?php echo Rp($row['hrg_barang']); ?></td>
                    <td align="right"><?php echo Rp($row['sub_harga']); ?></td>
                    
                </tr>
                <?php
                $no++;
                 $total = $total + $row['sub_harga'];
               
                 }
                 
                ?>
                 <tr>
                     <td align="center" colspan="7"><b> TOTAL <b></td>
                                 <td align="right" ><b> <?php echo Rp($total); ?></b></td>
                    </tr>

            </table>
            <br>
            <br>
            <table style="width: 100%;">
                <tr align = 'center'>
                    <td style="padding-left: 50%;">Pekalongan,  <?php echo tgl_indo(date("Y-m-d")) ?> </td>
                </tr>
                <tr align = 'center'>
                    <td style="padding-left: 50%;">Yang Bertanda Tangan</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr align = 'center'>
                    <td style="padding-left: 50%;"><b>        ( 
                        Tia
                            )</b></td>
                </tr>
            </table>
        </div>
    </body>
</html>

<?php
}
?>