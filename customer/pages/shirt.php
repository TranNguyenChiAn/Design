<!doctype html>
<html lang="en">
<head>
    <style>
        body{
            background-color: #F5F4F8;
        }

        .headline {
            text-align: center;
            margin: 100px 0;
        }
        h5 {
            font-size: 20px;
            color: #111;
            text-transform: uppercase;
            display: inline-block; /* cho nó vừa vặn với chữ */
            font-weight: 600;
        }

        h2 {
            font-size: 20px;
            color: #111;
            text-transform: uppercase;
            padding: 16px 14px;
            border: 1px solid #6e6d6d;
            display: inline-block; /* cho nó vừa vặn với chữ */
            font-weight: 600;
        }

        .maincontent{
            display: flex;
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
            margin: 90px 0 0 90px;
        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <title> Shirt </title>

</head>
<body>
<!-------------------- HEADER -------------------->
<?php
    session_start();
    include_once '../layout/header.php';
?>
<!-------------------- END HEADER -------------------->

</section>
<div>
    <!-------------------- MAIN -------------------->
    <div class="headline">
        <h2> SHIRT </h2>
        <div class="maincontent">
            <?php
                //Mở kết nối
                include_once '../connect/open.php';
                $sql = "SELECT clothes.*,categories.id AS category_id, producers.id AS producer_id FROM clothes 
                                INNER JOIN categories ON clothes.category_id = categories.id
                                INNER JOIN producers ON clothes.producer_id = producers.id
                                WHERE categories.name = 'shirts'
                                ORDER BY id ASC";
                $clothes = mysqli_query($connect, $sql);
                foreach ($clothes as $clothe){
            ?>
                <div class="col-3">
                    <a  href="product_detail.php?id=<?= $clothe['id'] ?>">
                        <img style="width:278px; height: 278px; object-fit: cover" src="../../image/<?= $clothe['image'] ?>" alt="BEST SELLER" >

                    <?php
                    if($clothe['quantity'] <= 9 and $clothe['quantity'] > 0){
                        ?>
                        <img class="out_of_stock" src="../../image/out_of_stock.png">
                        <?php
                    }
                    ?>
                    </a>
                    <?php
                    if($clothe['quantity'] > 0){
                        ?>
                        <a href="../carts/add to cart.php?id=<?= $clothe['id']; ?>">
                            <img class="cart_symbol" src="../../image/shopping-cart.png">
                        </a>
                        <?php
                    }else {
                        ?>
                        <img class="sold_out" src="../../image/sold_out.png">
                        <?php
                    }
                    ?>
                    <br>
                    <span class="product_name"><?= $clothe['name'] ?></span>
                    <hr style="width:200px;margin:6px 0">
                    <span class="price">$<?= $clothe['price'] ?></span>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>

<!-------------------- FOOTER -------------------->
<?php
include_once '../layout/footer.php';
?>
<!-------------------- END FOOTER -------------------->

</body>
</html>