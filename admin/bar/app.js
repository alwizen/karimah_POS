$(document).ready(function () {
    $.ajax({
        url: "http://localhost/karimah/admin/bar/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var nama_barang = [];
            var jml = [];

            for (var i in data) {
                nama_barang.push(data[i].nama_barang);
                jml.push(data[i].jml);
            }

            var chartdata = {
                labels: nama_barang,
                
                  datasets: [{
                            label: 'Barang Terjual',
                            data: jml,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
            };
            console.log(chartdata);

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function (data) {
            console.log(data);
        }
    });
});