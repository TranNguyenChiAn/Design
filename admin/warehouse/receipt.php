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
    <title> Receipt </title>
    <style>
        body {
            background-color: #F5F4F8;
            font-family:Arial;
        }

        tbody, td, tfoot, th, thead, tr {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<h1 align="center" style="margin: 100px 0 50px 0; color: black"> My Receipt </h1>
<form method="post" action="print.php">
    <table class="demo_bill" border="0" cellpadding="1" cellspacing="0" width="80%" align="center">
        <tr style="text-align: center; height: 40px; border-bottom: 1px solid black">
            <th style="text-align: center; width: 130px"> ID </th>
            <th style="text-align: center; width: 130px"> Image</th>
            <th style="text-align: center; width: 130px"> Name </th>
            <th width="70px"> Import </th>
        </tr>

        <?php
            //Mở kết nối
            include_once '../connect/open.php';
            $count_money = 0;
            //Trong trường hợp chưa có carts ở trên session
            $receipt = array();
            //Lấy carts từ session về trong trường hợp đã có carts
            if(isset($_SESSION['receipt'])){
                $receipt = $_SESSION['receipt'];
            }else{
                echo "deo co cc gi ca";
            }
            foreach ($receipt as $id => $quantity){
                //Sql lấy thông tin sp theo id
                $sql = "SELECT * FROM clothes WHERE id = '$id'";
                //Chạy query
                $clothes = mysqli_query($connect, $sql);
                foreach ($clothes as $clothe){
        ?>

                <tr>
                    <td>
                        <?= $clothe['id']; ?>
                    </td>
                    <td align="center" style="vertical-align: center; height: 140px;">
                        <img src="../../image/<?= $clothe['image']; ?>" width="90px" height="auto">
                    </td>
                    <td>
                        <span>
                            <?= $clothe['name']; ?>
                        </span>
                    </td>
                    <td align="center">
                        <input type="hidden" name="id" value="<?= $clothe['id']; ?>">
                        <input style="width: 50px" type="number" min="1" max="<?= $clothe['quantity']?>" value="<?= $quantity ?>" name="quantity[<?= $id; ?>]">
                    </td>
                </tr>

                <?php
            }
        }
            ?>

    </table>
</form>
<div class="cart_action">
    <!--Link để quay về trang danh sách sản phẩm-->
    <button style="border-radius: 0px" class="button">
        <a style="background-color:#6868de;color: white;" class="link" href="import.php">Product List</a>
    </button>
    <button style="border-radius: 0px" class="button update">
        <a style="color: white;" class="link" href="print.php"> Print </a>
    </button>
</div>

</body>
</html>