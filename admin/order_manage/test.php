<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if (!isset($_SESSION['email'])) {
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
    <style>
        body {
            max-width: 1000px;
            background-color: #F5F4F8;
        }
        .edit_order {
            margin-top: 20px;
            margin-left: 50px;
            width: 900px;
            border: 1px solid #d7d2d2;
            border-radius: 10px;
            background-color: white;
            padding: 20px 40px;
        }

        .status {
            position: center;
            height: 30px;
            width: 200px;
            border-radius: 4px;
            padding-left: 20px;
        }

        .confirm_order {
            position: center;
            width: 100px;
            top: 0;
            margin-left: 80%;
        }
    </style>
    <title> Order Details </title>
</head>
<body>
<?php
//Lấy id của sp
$id = $_GET['id'];
//Mo ket noi
include_once "../connect/open.php";
//Query
$sql = "SELECT order_details.clothes_id, order_details.order_id, order_details.price, order_details.quantity,
		        clothes.image, clothes.name, clothes.description
        FROM order_details
        INNER JOIN clothes ON clothes.id = order_details.clothes_id
        WHERE order_details.order_id = '$id'
        GROUP BY order_details.clothes_id";
//Chạy query
$order_details = mysqli_query($connect, $sql);
$orders = mysqli_query($connect, $sql);
$clothes = mysqli_query($connect, $sql);
//Query người nhận
$sql = "SELECT customers.name, customers.phone, customers.address 
        FROM customers
        INNER JOIN orders ON orders.customer_id = customers.id
        WHERE orders.customer_id = customers.id
        GROUP BY orders.customer_id";
//Chạy query
$customers = mysqli_query($connect, $sql);

//Đóng kết nối
include_once '../connect/close.php';
?>
<p class="table_title"> EDIT ORDER</p>
<div class="edit_order">
    <?php
    foreach ($order_details as $order_detail){
        foreach ($customers as $customer) {
    ?>
    <div style="display: flex; justify-content: space-between">
        <div>
            <h3 style="margin: 0 0"> Delivery address </h3>
            Receiver Name: <?= $customer['name']; ?><br>
            Receiver Phone: <?= $customer['phone']; ?><br>
            Receiver Address:<?= $customer['address']; ?>
        </div>
        <div>
            <form method="post" action="process.php">
                <input type="hidden" name="id" value="<?= $order_detail['order_id']; ?>">
                <select class="status" name="status">
                    <option value="0"> Pending </option>
                    <option value="1"> Delivery </option>
                    <option value="2"> Completed </option>
                    <option value="3"> Canceled </option>
                </select>
                <button type="submit" style=" width: 50px; height: 34px" class="btn">
                    OK
                </button>
            </form>
        </div>
    </div>
            <?php
        }
    }
    ?>

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <?php
        foreach ($clothes as $clothe) {
            foreach ($order_details as $order_detail){
                ?>
        <tr>
            <td width="220px">
                <img width="180px" src="../../image/<?= $clothe['image']?>">
            </td>
            <td>
                <h3><?= $clothe['name']?></h3>
                <p style="font-size: 13px; width: 60%"><?= $clothe['description'] ?></p>
            </td>
            <td width="20%" >
                Amount: <?= $order_detail['quantity'] ?><br>
                Price $<?= $order_detail['price'] ?>
            </td>
        </tr>

        <?php
            }
        }
        ?>
    </table>
</div>

</body>
</html>

