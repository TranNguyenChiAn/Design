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
    <title>Cart</title>
    <style>
        body {
            background-color: #F5F4F8;
            font-family:Arial;
        }

        tbody, td, tfoot, th, thead, tr {
            border: 1px solid black;
        }

        .delete_cart {
            width: border-box;
            height: 50px;
            border-radius: 10px;
            border: 1px solid black;
            background-color: transparent;
            font-weight: bold;
        }

        .delete_cart:hover {
            background-color: #860304;
            cursor: pointer;
            box-shadow: black -3px 3px;
            transform: translate(4px);
            transition: ease;
        }

        .delete_cart:hover .delete{
            color: white;
        }

        .delete {
            text-decoration: none;
            color: #860304;
        }

        .order_button {
            background-color: #2c8c6b;
            color: white;
            border: none;
            width: 100px;
            font-weight: bold;
        }

        .order_button:hover {
            box-shadow: black -3px 3px;
            transform: translate(4px);
            transition: ease;
        }
    </style>
</head>
<body>
<h1 align="center" style="margin: 100px 0 50px 0; color: black"> My Shopping Cart</h1>
<form method="post" action="update_cart.php">
    <table class="demo_bill" border="0" cellpadding="0" cellspacing="0" width="90%" align="center">
        <tr style="text-align: center; height: 40px; border-bottom: 1px solid black">
            <th style="width:94px"> Product ID </th>
            <th style="text-align: center; width: 130px"> Image</th>
            <th> Description </th>
            <th width="160px"> Each Price </th>
            <th width="70px"> Quantity </th>
            <th style="text-align: center; width: 100px"> Count </th>
            <th style="text-align: center; width: 100px"> Remove </th>
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
        </tr>

<?php
    include_once "../layout/header.php";
    //Mở kết nối
    include_once '../connect/open.php';
    $count_money = 0;
    //Trong trường hợp chưa có carts ở trên session
    $carts = array();
    //Lấy carts từ session về trong trường hợp đã có carts
    if(isset($_SESSION['carts'])){
        $carts = $_SESSION['carts'];
    }
    foreach ($carts as $id => $quantity){
    //Sql lấy thông tin sp theo id
    $sql = "SELECT * FROM clothes WHERE id = '$id'";
    //Chạy query
    $clothes = mysqli_query($connect, $sql);
    foreach ($clothes as $clothe){
?>

    <tr>
        <td align="center">
            <?= $id ?>
        </td>
        <td align="center" style="vertical-align: center; height: 140px;">
            <a href="../pages/product_detail.php?id=<?= $clothe['id']; ?>">
                <img src="../../image/<?= $clothe['image']; ?>" width="90px" height="auto">
            </a>
        </td>
        <td>
            <span>
                <?= $clothe['name']; ?>
            </span>
            <br>
            <span style="font-size: 14px;">
                <?= $clothe['description']; ?>
            </span>
        </td>
        <td align="center">
            $<?= $clothe['price']; ?>
        </td>
        <td align="center">
            <form method="post" action="order.php">
                <input type="hidden" name="id" value="<?= $clothe['id']; ?>">
                <input style="width: 50px" type="number" value="<?= $quantity ?>" name="quantity[<?= $id; ?>]">
            </form>
        </td>
        <td align="center">
            $<?php
                //Tính thành tiền của từng sp có trong trong carts
                $money = $clothe['price'] * $quantity;
                //Tính tổng tiền của các sp có trong trong carts
                $count_money += $money;
                echo $money;
            ?>
        </td>

        <!--REMOVE-->
        <td align="center">
            <a style="padding-bottom: 0" href="remove.php?id=<?= $clothe['id'] ?>">
                <img style="width:20px"   src="../../image/cancel.png">
            </a>
        </td>
    </tr>
    <tr>
        <td colspan="7">
            <p></p>
        </td>
    </tr>
        <tr>
            <td colspan="7"></td>
        </tr>
    <?php
            }
        }
    ?>
    <tr>
        <td class="total_cost" colspan="7" align="end">
            Total:
            <?php
                //Hiển thị tổng tiền của các sp có trong carts
                echo "$" . $count_money;
            ?>
        </td>
    </tr>
    <tr>
        <td class="total_cost" colspan="7" align="center">
            <button style="border-radius: 0px" class="button" type="submit">
                <a style="color: white;" class="link" href="update_cart.php">Update cart</a>
            </button>
        </td>
    </tr>
</table>
</form>
<div class="cart_action">
    <!--Link để quay về trang danh sách sản phẩm-->
    <button style="border-radius: 0px" class="button product-list">
        <a style="color: white;" class="link" href="../pages/index.php">Product List</a>
    </button>


    <button style="border-radius: 0px" class="delete_cart">
        <a class="delete" href="delete_cart.php"> Delete cart </a>
    </button>


    <!-- Thanh toan-->
    <button class="order_button">
        <a style="color: white" class="link" href="receive.php"> ORDER </a>
    </button>
</div>

<!-------------------- FOOTER -------------------->
<?php
    include_once '../layout/footer.php';
?>
<!-------------------- END FOOTER -------------------->

</body>
</html>