<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if (!isset($_SESSION['email_admin'])) {
    //Quay về trang account
    header("Location: ../../account/login_admin.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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
    $sql = "SELECT COUNT(id) as quantity, status
            FROM orders WHERE status IS NOT NULL
            GROUP BY status";
    //Chay query
    $result = mysqli_query($connect, $sql);
    //đổ dữ liệu
    foreach ($result as $data) {
        //lấy dữ liệu từ db
        $amount[] = $data['quantity'];
        $status[] = $data['status'];
        //bỏ cảnh báo
        error_reporting(E_ALL ^ E_WARNING);
        //loop
        if($status[0] == 0){
            $status[0] = 'Pending';
        }

        elseif($status[0] == 1){
            $status[0] = 'Delivery';
        }
        elseif($status[1] == 1){
            $status[1] = 'Delivery';
        }

        elseif ($status[0] == 2){
            $status[0] = 'Completed';//check
        }
        elseif($status[1] == 2){
            $status[1] = 'Completed';
        }
        elseif($status[2] == 2){
            $status[2] = 'Completed';
        }

        elseif ($status[1] == 3){
            $status[1] = 'Canceled';//check
        }
        elseif($status[2] == 3){
            $status[2] = 'Canceled';
        }
        elseif($status[3] == 3){
            $status[3] = 'Canceled';
        }
    }
?>
<section style="margin: 0 0 0 90px" class="main_content">
    <h4 style="margin: 30px 0 0 33%"> Order Status </h4>
    <div id="chart-container">
        <canvas id="myChart" style="width:100%;max-width:600px; margin: 30px 0 0 0;"></canvas>
    </div>

    <script>
        let barColors = ["rgba(255, 99, 132, 0.5)"];

        const data = {
            labels: <?php echo json_encode($status)?>,
            datasets: [{
                label: 'Number of status',
                fill: false,
                lineTension: 0,
                backgroundColor: barColors,
                borderColor: ['rgba(0,0,255,0.1)'],
                data: <?php echo json_encode($amount)?>,
            }]
        };

        const config = {
            type: 'bar',
            data,
            options: {
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: '#000000'
                    }
                },
                title: {
                    display: true,
                    text: 'Order Status',
                    fontSize: 25
                }
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

</section>

</body>
</html>


