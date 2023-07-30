<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <style>
        body {
            background-color: white;
        }

        #chart-container {
            width:100%;
            max-width:600px;
        }
    </style>
    <title> Homepage </title>
</head>
<body>
<?php
//mo ket noi
include_once "../../connect/open.php";
//Query để lấy dữ liệu từ bảng classes trên db về
$sql = "SELECT sum(order_details.quantity) as quantity, orders.date_buy as date_buy
        FROM order_details
        INNER JOIN orders ON order_details.order_id = orders.id
        WHERE orders.status = 2
        group by MONTH(orders.date_buy)";
//Chay query
$result = mysqli_query($connect, $sql);

foreach ($result as $data) {
    $amount[] = $data['quantity'];
    $month[] = $data['date_buy'];
    //bỏ cảnh báo
    //error_reporting(E_ALL ^ E_WARNING);
}
?>
<section style="margin: 0 0 0 90px" class="main_content">
    <div id="chart-container">
        <h4 style="margin: 30px 0 18px 40%;"> SOLD PRODUCTS </h4>
        <canvas id="myChart" style="display: block;width:100%;max-width:600px; margin: 30px 0 0 0;"></canvas>
    </div>
    <script>
        const monthArray = <?php echo json_encode($month)?>;
        console.log(monthArray);

        const data = {
            labels: monthArray,
            datasets: [{
                label: 'Number of sold products',
                fill: false,
                lineTension: 0,
                backgroundColor: ['rgb(116,116,227)'],
                borderColor: ['rgba(0,0,255,0.1)'],
                data: <?php echo json_encode($amount)?>,
            }]
        };

        const config = {
            type: 'bar',
            data,
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'month'
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: '#000000'
                    }
                },
                title: {
                    display: true,
                    text: 'Sales',
                    fontSize: 25
                }
            }
        };

        //render chart
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
</section>

</body>
</html>