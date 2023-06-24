<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if (!isset($_SESSION['email'])) {
    //Quay về trang account
    header("Location: ../account/login_customer.php");
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
    <title> History Order </title>
</head>
<body>
<?php
include_once "../layout/header.php";
//mo ket noi
include_once "../connect/open.php";
$id = $_GET['id'];
//Query
$sql = "SELECT orders.id, orders.date_buy, orders.status, orders.customer_id,
                customers.name AS customer_name
        FROM orders
        INNER JOIN customers ON customers.id = orders.customer_id
        WHERE orders.customer_id = '$id'
        ORDER BY id DESC" ;
//Chay query
$orders = mysqli_query($connect, $sql);
$customers = mysqli_query($connect, $sql);

//Dong ket noi
include_once '../connect/close.php';
?>
<div style="position: relative; top: 48px">
<h2 style="color: black;margin-left: 40%" class="table_title"> ALL ORDERS </h2>
<table class="table-admin" width="100%" border="1" cellspacing="0" cellpadding="5px">
    <tr>
        <th class="t-heading"> Order ID </th>
        <th class="t-heading"> Date buy</th>
        <th class="t-heading"> Customer ID </th>
        <th class="t-heading"> Customer Name </th>
        <th class="t-heading"> Status </th>
        <th class="t-heading"> Detail </th>
    </tr>
    <?php
    foreach ($orders as $order){
        ?>
        <tr class="record">
            <td align="center"> <?= $order['id']?> </td>
            <td align="center"> <?= $order['date_buy']?> </td>
            <td align="center">
                <?= $order['customer_id']?>
            </td>
            <td align="center">
                <?= $order['customer_name']?>
            </td>
            <td style="display: flex; justify-content: space-evenly" align="center">
                <?php
                if($order['status'] == 0) { ?>
                    <button style="width: 100px;background-color: #bd9718" class="button"> Pending </button>
                    <?php
                }elseif ($order['status'] == 1) { ?>
                    <button style="width: 100px;background-color: #231ec2" class="button"> Delivery </button>
                    <?php
                }elseif ($order['status'] == 2) { ?>
                    <button style="width: 100px;background-color: #14934b" class="button"> Completed </button>
                    <?php
                }elseif ($order['status'] == 3) { ?>
                    <button style="width: 100px;background-color: #eb1f27" class="button"> Canceled </button>
                    <?php
                }
                ?>
            </td>
            <td  align="center">
                <a href="history_order_detail.php?id=<?= $order['id']; ?>">
                    <img width="32px" src="../../image/add.png">
                </a>
            </td>
        <?php
    }
    ?>
        </tr>
</table>
</div>
</body>
</html>

