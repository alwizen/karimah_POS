$(document).ready(function () {
    $.ajax({
        url: "http://localhost/karimah/bar/data.php",
        method: "GET",
        success: function (data) {
            console.log(data);
            var nama_barang = [];
            var jumlah = [];

            for (var i in data) {
                nama_barang.push(""+ data[i].nama_barang);
                jumlah.push(data[i].jumlah);
            }

            var chartdata = {
                labels: nama_barang,
                datasets: [{
                    label: 'Pembelian',
                    backgroundColor: 'rgba(101, 200, 190, 0.75)',
                    borderColor: 'rgba(200, 190, 200, 0.75)',
                    hoverBackgroundColor: 'rgba(200, 200, 160, 1)',
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: jumlah
                }]
            };

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