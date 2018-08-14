<link rel="stylesheet" href="../../css/bootstrap.min.css">
<title>Graphic Penjualan</title>
 <style type="text/css">
        #chart-container {
            margin-top: 50px;
            width: 600px;
            height: auto;
        }
        .body {
            margin-top: 100px;
        }
    </style>
<?php 
include '../../koneksi.php';
$query = "SELECT
        nama_barang,
		SUM(jumlah) as jml
		FROM penjualan p 
		LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan 
		LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
		GROUP by nama_barang ORDER BY p.kd_transaksi ASC";
$result = mysqli_query($koneksi, $query);
?>
<script type="text/javascript" src="../../js/gChart.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['nama_barang', 'jml'],
            <?php 
                          while ($row = mysqli_fetch_array($result)) {
                            echo "['" . $row["nama_barang"] . "', " . $row["jml"] . "],";
                          }
                          ?>
        ]);
        var options = {
            title: 'Persentase Barang Laku',

            pieHole: 0.2
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }
</script>
<body>

    </div>
     <h1 class="text-danger" style="text-align: center; text-transform: uppercase;"><u>Grafik Penjualan </u></h1>
        <div class="container">
            <a href="../index.php" class="btn btn-primary"><span class="glyphicon glyphicon-home"></span> Kembali Ke Halaman Utama</a>
       </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
    <div id="chart-container">
        <div id="piechart" style="width: 800px; height: 400px;"></div>
    </div>
    </div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div id="chart-container">
        <canvas id="mycanvas"></canvas>
    </div>
</div>


    <!-- javascript -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/gChart.js"></script>
    <script src="../../js/chart.js"></script>
    <script src="app.js"></script>
</body>

</html>