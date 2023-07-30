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
$tm = strtotime("today");
$this_month =  date("Y-m", $tm);
//Khai báo biến search
$month = "";
//Lấy giá trị được search về với điều kiện $_GET['search'] tồn tại
if(isset($_POST['month'])) {
    $month = $_POST['month'];
    //Query để lấy dữ liệu từ bảng classes trên db về
    $sql = "SELECT sum(order_details.quantity) as quantity, orders.date_buy
            FROM order_details
            INNER JOIN orders ON order_details.order_id = orders.id
            WHERE orders.status = 2 AND orders.date_buy LIKE '%$month%' 
            GROUP BY orders.date_buy";
    $result = mysqli_query($connect, $sql);
}else{
    //Query để lấy dữ liệu từ bảng classes trên db về
    $sql = "SELECT sum(order_details.quantity) as quantity, orders.date_buy
            FROM order_details
            INNER JOIN orders ON order_details.order_id = orders.id
            WHERE orders.status = 2 AND orders.date_buy LIKE '%$this_month%'  
            GROUP BY orders.date_buy";
    $result = mysqli_query($connect, $sql);
}
//Chay query


foreach ($result as $data) {
    $amount[] = $data['quantity'];
    $date_buy[] = $data['date_buy'];
}
//print_r($date_buy);
?>
<section style="margin: 0 0 0 90px" class="main_content">
    <div id="chart-container">
        <h4 style="margin: 30px 0 18px 40%;"> SOLD PRODUCTS </h4>
        <form method="post" action="">
            Month <input type="month" name="month" value="<?= $month ?>" min="2022-07" max="<?= $this_month ?>">
            <input type="submit">
        </form>
        <canvas id="myChart" style="display: block;width:100%;max-width:600px; margin: 30px 0 0 0;"></canvas>
    </div>
    <script>
        const dateArrayJS = <?php echo json_encode($date_buy)?>;
        console.log(dateArrayJS);

        const data = {
            labels: dateArrayJS,
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
                            unit: 'day'
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

        // function endDateFilter(date){
        //     const endDate = new Date(date.value);
        //     console.log(endDate)
        //     myChart.config.options.scales.x.max = endDate;
        //     myChart.update();
        // }
        //
        //
        // function startDateFilter(date){
        //     const startDate = new Date(date.value);
        //     console.log(startDate)
        //
        //     myChart.config.options.scales.x.min = startDate;
        //     myChart.update();
        // }

    </script>
</section>

</body>
</html>