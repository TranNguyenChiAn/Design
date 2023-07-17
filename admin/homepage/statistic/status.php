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

foreach ($result as $data) {
    $amount[] = $data['quantity'];
    $status[] = $data['status'];
    if($status[0] == 0 ){
        $status[0] = 'Pending';
    }elseif($status[1] == 1) {
        $status[1] = 'Delivery';
    }elseif($status[2] == 2 ){
        $status[2] = 'Completed';
    }elseif($status[3] == 3) {
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
        let barColors = ["rgba(255, 159, 64, 0.5)",
                         "rgba(5,56,232,0.5)",
                         "rgba(54,161,51,0.5)",
                         "rgba(255, 99, 132, 0.5)"];
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: <?php echo json_encode($status)?>,
                datasets: [{
                    label: 'Number of satus',
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
                    text: 'Daily Income',
                    fontSize:25
                }
            }
        });
    </script>

</section>

</body>
</html>


