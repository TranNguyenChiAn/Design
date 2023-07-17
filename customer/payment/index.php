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
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Payment </title>
    <style>
        .payment {
            height: 100%;
            width: 30%;
            border: 2px solid #d7d2d2;
            background-color: white;
            padding: 20px 40px;
            color: black;
            margin: 11px 0 0 -10px;
        }

         body {
             background-color: #F5F4F8;
         }
        .order_detail {
            margin: 2% 0 0 3%;
            width: 100%;
            border: 2px solid #d7d2d2;
            background-color: white;
            padding: 20px 40px;
            color: black;
        }
    </style>
</head>
<body>
<?php
$id = $_GET['id'];
include_once "../layout/header.php";
//Mo ket noi
include_once "../connect/open.php";
$count_money = 0;
//Query
$sql = "SELECT order_details.clothes_id, order_details.order_id, order_details.price, order_details.quantity,
		        clothes.image AS image, clothes.name AS clothe_name, clothes.description,
		        orders.receiver_name, orders.receiver_phone,orders.receiver_address, orders.status
        FROM order_details
        INNER JOIN clothes ON clothes.id = order_details.clothes_id
        INNER JOIN orders ON orders.id = order_details.order_id
        WHERE order_details.order_id = '$id'";
//Chạy query
$order_details = mysqli_query($connect, $sql);
//Query
$sql = "SELECT * FROM orders
        WHERE id = '$id'";
//Chạy query
$orders = mysqli_query($connect, $sql);
//Đóng kết nối
include_once '../connect/close.php';
?>
<p class="table_title"> Temporary Bill </p>
<section id="main_content" class="main_content" style="display: flex; justify-content: space-around">
    <div>
        <div class="order_detail">
            <?php
            foreach ($orders as $order){
                ?>
                <div style="display: flex; justify-content: space-between">
                    <div>
                        <h3 style="margin: 0 0"> Delivery address </h3>
                        Receiver Name: <?= $order['receiver_name']; ?><br>
                        Receiver Phone: <?= $order['receiver_phone']; ?><br>
                        Receiver Address:<?= $order['receiver_address']; ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="order_detail">
            <h2> Product </h2>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <?php
                foreach ($order_details as $order_detail){
                    ?>
                    <tr style="margin-top: 20px;">
                        <td width="200px">
                            <img width="90px" src="../../image/<?= $order_detail['image']?>">
                        </td>
                        <td>
                            <h3><?= $order_detail['clothe_name']?></h3>
                        </td>
                        <td width="120px" >
                            Amount: <?= $order_detail['quantity'] ?><br>
                            Price: $<?= $order_detail['price'] ?><br>
                            <p style="color: #231ec2">
                            Cost:
                            $<?php
                            //Tính thành tiền của từng sp có trong trong carts
                            $money = $order_detail['price'] * $order_detail['quantity'];
                            //Tính tổng tiền của các sp có trong trong carts
                            $count_money += $money;
                            echo $money;
                            ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <p></p>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="3" style="display: flex; justify-content: space-between;color: firebrick; font-weight: bold">
                        <span> Total </span>
                        <span>
                            <?php
                            echo "$" . $count_money;
                            ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="payment">
        <form>
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <td>
                    <input type="radio" name="payment" value="0" required> COD </input><br>
                    <span style="color: grey; margin: 0 0 0 24px"> Thanh toán bằng tiền mặt </span>
                </td>
                <td>
                    <img width="32px" src="../../image/money-back-guarantee.png">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="payment" value="1"> MOMO </input><br>
                    <span style="color: grey; margin: 0 0 0 24px"> Thanh toán qua Momo </span>
                </td>
                <td>
                    <img width="32px" src="../../image/momo.png">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="payment" value="2"> Chuyển khoản </input><br>
                    <span style="color: grey; margin: 0 0 0 24px"> Thanh toán bằng Napas </span>
                </td>
                <td>
                    <img width="36px" src="../../image/Napas.png">
                </td>
            </tr>
        </table>
            <button style="width: 60px" type="submit" class="button add">
                <a style="color: white" class="link" href="../carts/order.php">
                    Next
                </a>
            </button>
    </form>
        <br>

    </div>

</section>

</body>
</html>
