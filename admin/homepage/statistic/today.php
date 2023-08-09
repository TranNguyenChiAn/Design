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
    </style>
    <title> Homepage </title>
</head>
<body>
<?php
//mo ket noi
include_once "../../connect/open.php";
$d=strtotime("today");
$date =  date("Y-m-d", $d);
$total = 0;
$cost = 0;
//Query để lấy dữ liệu từ bảng classes trên db về
$sql = "SELECT count(id) as quantity_order, date_buy
        FROM orders
        WHERE date_buy = '$date'
        group by id";
//Chay query
$orders = mysqli_query($connect, $sql);
foreach ($orders as $order) {
    $total += $order['quantity_order'];
}
//Query để lấy dữ liệu từ bảng classes trên db về
$sql = "SELECT orders.status,orders.date_buy, order_details.price, order_details.quantity
        FROM order_details
        INNER JOIN orders ON order_details.order_id = orders.id
        WHERE orders.status = 2 AND orders.date_buy = '$date'";
//Chay query
$order_details = mysqli_query($connect, $sql);
foreach ($order_details as $order_detail) {
    $cost += $order_detail['price'] * $order_detail['quantity'];
}
//dong ket noi
include_once "../../connect/close.php";

?>
    <div id="chart-container">
        <div>
            <h4 style="margin: 18px 0 0 60px">Today</h4>
            <p style="margin: 9px 0 0 18px;font-weight: bold; font-size: 30px; color: green">
                +<?= $total ?> order
            </p>
            <p style="margin: 9px 0 0 18px;font-weight: bold; font-size: 22px; color: green">
                +<?= $cost ?> $
            </p>
        </div>

    </div>
</body>
</html>

