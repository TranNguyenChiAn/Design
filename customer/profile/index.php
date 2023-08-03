<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if (!isset($_SESSION['email_customer'])) {
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
            margin-top: 6%;
        }
        .history_order {
            width: 180px;
            margin: 6px 30px 0 0;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #d2c7fd;
            background-color: transparent;
            border-top-right-radius: 9px;
            border-top-left-radius: 9px;
            border-bottom: none;
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
    $email = $_SESSION['email_customer'];
    $sql = "SELECT * FROM customers WHERE email='$email'";
    $customers = mysqli_query($connect, $sql);
    foreach ($customers as $customer) {
?>
<div class="user_customer">
    <div style="color: black; width: 300px; display: flex; align-items: center; margin: 30px 0 0 100px">
        <img style="width:64px" src="../../image/user-profile.png">
        <!--ID: <?= $customer['id']; ?> <br>-->
        <p style="margin-left: 10px"><?= $customer['name']; ?></p><br>
    </div>

    <div style="margin: 20px 0 0 100px; color: black">
        Email: <?= $customer['email']; ?><br>
        Phone: <?= $customer['phone']; ?><br>
        Address: <?= $customer['address']; ?><br>
        <?php
            }
        ?>
    </div>
    <div style="display:flex;margin: 18px 0 0 90px; justify-content: flex-start">
        <div class="history_order">
            <a style="font-weight: bold" class="link" href="history_order.php">
                History orders
            </a>
        </div>
        <div class="history_order">
            <a style="font-weight: bold" class="link" href="change_password.php">
                Change password
            </a>
        </div>
    </div>
</div>


</body>
</html>

