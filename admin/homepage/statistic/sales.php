<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if (!isset($_SESSION['email_admin'])) {
    //Quay về trang account
    header("Location: ../account/login_admin.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
$sql = "SELECT sum(order_details.quantity) as quantity, orders.date_buy
        FROM order_details
        INNER JOIN orders ON order_details.order_id = orders.id
        GROUP BY orders.date_buy
        LIMIT 7";
//Chay query
$result = mysqli_query($connect, $sql);
//
foreach ($result as $data) {
    $amount[] = $data['quantity'];
    $date_buy[] = $data['date_buy'];
}
?>
<section style="margin: 0 0 0 90px" class="main_content">
    <div id="chart-container">
        <h4 style="margin: 30px 0 0 40%;"> Daily Order </h4>
        <canvas id="myChart" style="width:100%;max-width:600px; margin: 30px 0 0 0;"></canvas>
    </div>
    <script>
    let barColors = ["rgb(116,116,227)"];
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: <?php echo json_encode($date_buy)?>,
                datasets: [{
                    label: 'Number of sales',
                    fill: false,
                    lineTension: 0,
                    backgroundColor: barColors,
                    borderColor: "rgba(0,0,255,0.1)",
                    data: <?php echo json_encode($amount)?>,
                }]
            },
            options: {
                legend:{
                    display:true,
                    position:'right',
                    labels:{
                        fontColor:'#000000'
                    }
                },
                title: {
                    display: true,
                    text: 'Order Status',
                    fontSize:25
                }
            }
        });
    </script>
</section>
</body>
</html>

