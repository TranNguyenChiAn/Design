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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <style>
        body {
            background-color: #F5F4F8;
        }
        .order_detail {
            margin: 2% 0 0 12%;
            width: 80%;
            border: 1px solid #d7d2d2;
            border-radius: 10px;
            background-color: white;
            padding: 20px 40px;
            color: black;
        }

        .cancel {
            width: 80%;
            margin: 2% 0 0 12%;
            display: flex;
            justify-content: center;
            background-color: #c93939;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            height: 30px;
        }
        .cancel .link {
            color: white;
        }

        .cancel:hover {
            cursor: pointer;
            background-color: firebrick;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            height: 30px;
        }
    </style>
    <script>
        function cancel() {
            let result_1 = "Cancel".link("history_order.php?id=12");
            if(confirm("Bạn có chắc chắn muốn hủy đơn hàng?") == true){
                document.getElementById("demo1").innerHTML = result_1;
            }else{
                document.getElementById("demo1").innerHTML = result_1;
            }
        }
    </script>
    <title> Order Detail </title>
</head>
<body>
<?php
include_once "../layout/header.php";
//Lấy id của sp
$id = $_GET['id'];
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
<p class="table_title"> ORDER DETAIL </p>
<section class="main_content">
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
                <div>
                    <?php
                    if($order['status'] == 0) { ?>
                        <button style="width: 120px;background-color: #d5b33f" class="button"> Pending </button>
                        <?php
                    }elseif ($order['status'] == 1) { ?>
                        <button style="width: 120px;background-color: #231ec2" class="button"> Delivery </button>
                        <?php
                    }elseif ($order['status'] == 2) { ?>
                        <button style="width: 120px;background-color: #14934b" class="button"> Completed </button>
                        <?php
                    }elseif ($order['status'] == 3) { ?>
                        <button style="width: 120px;background-color: #eb1f27" class="button"> Canceled </button>
                        <?php
                    }
                    ?>
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
                        <img width="180px" src="../../image/<?= $order_detail['image']?>">
                    </td>
                    <td>
                        <h3><?= $order_detail['clothe_name']?></h3>
                        <p style="font-size: 13px; width: 75%"><?= $order_detail['description'] ?></p>
                    </td>
                    <td width="120px" >
                        Amount: <?= $order_detail['quantity'] ?><br>
                        Price: $<?= $order_detail['price'] ?><br>
                        <br><br><br>
                        Cost:
                        $<?php
                        //Tính thành tiền của từng sp có trong trong carts
                        $money = $order_detail['price'] * $order_detail['quantity'];
                        //Tính tổng tiền của các sp có trong trong carts
                        $count_money += $money;
                        echo $money;
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p></p>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <div class="total_cost order_detail" style="display: flex; justify-content: space-between; color: firebrick">
        <h3> Total </h3>
        <h3>
            <?php
            echo "$" . $count_money;
            ?>
        </h3>
    </div>
    <div>
        <?php
            foreach ($orders as $order){
                if($order['status'] == 0) {
        ?>
            <button class="cancel" onclick="cancel()">
                <a class="link" href="cancel.php?id=<?= $order['id']; ?>">
                    Cancel
                </a>
            </button>
        <?php
                }
            }
        ?>
    </div>
</section>
<?php
    include_once "../layout/footer.php";
?>
</body>
</html>

