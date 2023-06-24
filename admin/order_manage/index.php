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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <style>
        body{
            background-color: #F5F4F8;
        }
        .status {
            width: 100px;
            height: 40px;
            border-radius: 5px;
            border: none;
            color: #fefeff;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
    <title> Order </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//mo ket noi
include_once "../connect/open.php";
//Query
$sql = "SELECT orders.id, orders.date_buy, orders.status, orders.customer_id,
                customers.name AS customer_name
        FROM orders
        INNER JOIN customers ON customers.id = orders.customer_id
        ORDER BY id DESC" ;
//Chay query
$orders = mysqli_query($connect, $sql);
$customers = mysqli_query($connect, $sql);

//Dong ket noi
include_once '../connect/close.php';
?>
<section class="main_content">
<p style="margin-top: 50px" class="table_title"> ORDERS </p>
<table class="table-admin" width="100%" border="0" cellspacing="0" cellpadding="5px">
    <tr>
        <th class="t-heading" align="center"> Order ID </th>
        <th class="t-heading" align="center"> Date buy</th>
        <th class="t-heading" align="center"> Customer Name </th>
        <th class="t-heading" align="center"> Status </th>
        <th class="t-heading" align="center"> Action </th>
    </tr>
    <?php
    foreach ($orders as $order){
        ?>
        <tr class="record">
            <td> <?= $order['id']?> </td>
            <td> <?= $order['date_buy']?> </td>
            <td>
                    <?= $order['customer_name']?>
            </td>
            <td>
               <?php
                    if($order['status'] == 0) { ?>
                        <button style="background-color: #ecce5d" class="status"> Pending </button>
               <?php
                    }elseif ($order['status'] == 1) { ?>
                        <button style="background-color: #231ec2" class="status"> Delivery </button>
               <?php
                    }elseif ($order['status'] == 2) { ?>
                        <button style="background-color: #1a6e3e" class="status"> Completed </button>
               <?php
                    }elseif ($order['status'] == 3) { ?>
                        <button style="background-color: #eb1f27" class="status"> Canceled </button>
               <?php
                    }
               ?>
            </td>
            <td>
                <a class="edit" href="edit_order.php?id=<?= $order['id']?>">
                    <img width="30px" src="../../image/edit.png">
                </a>
                <a class="delete" href="delete.php?id=<?= $order['id']?>">
                    <img width="30px" src="../../image/delete.png">
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</section>
</body>
</html>

