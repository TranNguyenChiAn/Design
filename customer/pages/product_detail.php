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
            background-color: white;
        }
        .out_of_stock {
            width: 60px;
            height: auto;
            position: absolute;
            margin: -24px 0 0 -50px;
            rotate: 30deg;
        }
        .sold_out {
            width: 90px;
            height: auto;
            position: absolute;
            margin: 0 0 0 -90px;
        }
    </style>
    <title> Product's Detail</title>
</head>
<body>
<div>
<?php
    session_start();
    include_once "../layout/header.php";
    //Lấy id của sp
    $id = $_GET['id'];
    //Mở kết nối
    include_once '../connect/open.php';
    //Viết query
    $sql = "SELECT * FROM clothes WHERE id = '$id'";
    //Chạy query
    $clothes = mysqli_query($connect, $sql);
    //Đóng kết nối
    include_once '../connect/close.php';
    foreach ($clothes as $clothe){
?>
        <table style="margin-top: 90px;" width="100%" border="0" cellspacing="0">
            <tr>
                <td width="90px" rowspan="2"></td>
                <td width="480px" rowspan="2">
                    <img src="../../image/<?= $clothe['image']; ?>" width="420px" height="auto">
                    <?php
                    if($clothe['quantity'] < 9 and $clothe['quantity'] > 0){
                        ?>
                        <img class="out_of_stock" src="../../image/out_of_stock.png">
                        <?php
                    }elseif ($clothe['quantity'] == 0){
                        ?>
                        <img class="sold_out" src="../../image/sold_out.png">
                    <?php
                    }
                    ?>
                </td>
                <td style="vertical-align: top; color: black">
                    <p class="product_name_detail"><?= $clothe['name'] ?></p>
                    <p class="product_price_detail">$<?= $clothe['price'] ?></p>
                    <p>Description:</p> <?= $clothe['description']?>
                    <p>Size: <?= $clothe['size']?></p>
                    <p>Color: <?= $clothe['color']?></p>
                </td>
                <td width="100px" rowspan="2"></td>
            </tr>
            <tr>
                <td style="vertical-align: middle">
                    <?php
                        if ($clothe['quantity'] > 0 ){
                    ?>
                    <button class="button add-to-cart">
                        <a style="color: white" class="link" href="../carts/add to cart.php?id=<?= $clothe['id']?>">
                            Add to cart
                        </a>
                    </button>
                    <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
<?php
    }
?>
</div>

</body>
</html>