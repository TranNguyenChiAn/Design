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
    <style>
        body {
            background-color: #F5F4F8;
        }
        .user_customer {
            position: absolute;
            background-color: white;
            width: 100%;
            margin-top: 100px;
        }
        .history_order {
            margin: 6px 0 0 90px;
            width: 200px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .history_order:hover {
            background-color: #6868de;
        }

        .history_order:hover .link{
            color: white;
        }
    </style>
    <title> Profile </title>
</head>
<body>
<?php
    include_once "../layout/header.php";
    include_once "../connect/open.php";
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM customers WhERE email='$email'";
    $customers = mysqli_query($connect, $sql);
    include_once "../connect/close.php";
    foreach ($customers as $customer) {
?>
<div class="user_customer">
    <div style="color: black;width: 20%; display: flex; align-items: center; justify-content: space-around; margin-top: 30px">
        <img width="64px" src="../../image/user-profile.png">
        <!--ID: <?= $customer['id']; ?> <br>-->
        <?= $customer['name']; ?><br>
    </div>

    <div style="margin: 20px 0 0 100px; color: black">
        Email: <?= $customer['email']; ?><br>
        Phone: <?= $customer['phone']; ?><br>
        Address: <?= $customer['address']; ?><br>
    </div>
    <div class="history_order">
        <a style="font-weight: bold" class="link" href="history_order.php?id=<?= $customer['id']; ?>">
            History orders
        </a>
    </div>
            <?php
        }
    ?>
</div>
</body>
</html>

