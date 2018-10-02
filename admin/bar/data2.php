<?php 
$connect = mysqli_connect("localhost", "root", "BAba55ko", "karimah");
$query = "SELECT
        nama_barang,
		SUM(jumlah) as jml
		FROM penjualan p 
		LEFT JOIN det_penjualan dp ON p.no_penjualan=dp.no_penjualan 
		LEFT JOIN barang b ON dp.kd_barang=b.kd_barang
		GROUP by nama_barang ORDER BY p.kd_transaksi ASC";
$result = mysqli_query($connect, $query);
?>  
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
        <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
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

      <div style="width:900px;">  
         <div id="piechart" style="width: 800px; height: 400px;"></div>  
      </div>  
