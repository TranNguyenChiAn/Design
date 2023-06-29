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
//Khai báo biến search
$search = "";
//Lấy giá trị được search về với điều kiện $_GET['search'] tồn tại
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

//Khai báo số bản ghi 1 trang
$recordOnePage = 9;
//Query để lấy số bản ghi
$sqlCountRecord = "SELECT COUNT(*) AS count_record, orders.id, orders.date_buy, orders.status,
                    customers.name AS customer_name 
                    FROM orders 
                    INNER JOIN customers ON customers.id = orders.customer_id
                    WHERE orders.id LIKE '%$search%' 
                      OR customers.name LIKE '%$search%'
                      OR orders.date_buy LIKE '%$search%'
                      OR orders.status LIKE '%$search%'";
//Chạy query lấy số bản ghi
$countRecords = mysqli_query($connect, $sqlCountRecord);
//foreach để lấy số bản ghi
foreach ($countRecords as $countRecord){
    $records = $countRecord['count_record'];
}
//Tính số trang
$countPage = ceil($records / $recordOnePage);
//Lấy trang hiện tại (nếu không tồn tại page hiện tại thì page hiện tại = 1)
$page = 1;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
//Tính bản ghi bắt đầu của trang
$start = ($page - 1) * $recordOnePage;
//Query để lấy dữ liệu từ bảng classes trên db về
$sql = "SELECT orders.id, orders.date_buy, orders.status, orders.customer_id,
                customers.name AS customer_name
        FROM orders
        INNER JOIN customers ON customers.id = orders.customer_id
        WHERE orders.id LIKE '%$search%' 
             OR customers.name LIKE '%$search%'
             OR orders.date_buy LIKE '%$search%'
             OR orders.status LIKE '%$search%'
        ORDER BY id DESC
        LIMIT $start, $recordOnePage" ;
//Chay query
$orders = mysqli_query($connect, $sql);

//Dong ket noi
include_once '../connect/close.php';
?>
<section class="main_content">
    <!-- SEARCH -->
    <form  style="margin: 20px 0 20px 0" method="get" action="">
        <input class="search" width="30px" type="text" name="search" value="<?= $search; ?>" placeholder="Search">
    </form>
    <p style="margin-top: 30px" class="table_title"> ORDERS </p>
<table class="table-admin" width="100%" border="0" cellspacing="0" cellpadding="5px">
    <tr>
        <th class="t-heading" align="center"> Order ID </th>
        <th class="t-heading" align="center"> Date buy</th>
        <th class="t-heading" align="center"> Customer Name </th>
        <th class="t-heading" align="center"> Status </th>
        <th class="t-heading" style="text-align: center"> Action </th>
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
            <td align="center">
                <a class="edit" href="edit_order.php?id=<?= $order['id']?>">
                    <img width="30px" src="../../image/edit.png">
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</section>
<br>
<!--FOOTER-->
<?php
//Nhúng footer
include_once '../layout/footer.php';
?>
<br>
</body>
</html>

