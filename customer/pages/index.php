<!doctype html>
<html lang="en">
<head>
    <style>
        body{
            background-color: #F5F4F8;
        }
        .search_clothe {
            width: 350px;
            height: 35px;
            border-radius: 20px;
            border: 1px solid #9f9b9b;
            right: 20px;
            padding-left: 20px;
            margin-left: 600px;
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
    <title> Homepage </title>
</head>
<body>
<!-------------------- HEADER -------------------->
<?php
//session_start();
include_once '../layout/header.php';
//Mở kết nối
include_once '../connect/open.php';
//Khai báo biến search
$search = "";
//Lấy giá trị được search về với điều kiện $_GET['search'] tồn tại
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>
<!-------------------- END HEADER -------------------->

</section>
<div>
    <!-------------------- MAIN -------------------->
    <div class="headline">
        <!--SEARCH-->
        <!--Form để search
                action để trồng tức là khi click vào button sẽ load lại chính trang này-->
        <form style="margin: 20px 0 20px 0" method="get" action="">
            <input class="search_clothe" type="text" name="search" value="<?= $search; ?>" placeholder="Search">
        </form>
        <div class="maincontent">
            <?php
                //Khai báo số bản ghi 1 trang
                $recordOnePage = 12;
                //Query để lấy số bản ghi
                $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM clothes";
                //Chạy query lấy số bản ghi
                $countRecords = mysqli_query($connect, $sqlCountRecord);
                //foreach để lấy số bản ghi
                foreach ($countRecords as $countRecord) {
                    $records = $countRecord['count_record'];
                }
                //Tính số trang
                $countPage = ceil($records / $recordOnePage);
                //Lấy trang hiện tại (nếu không tồn tại page hiện tại thì page hiện tại = 1)
                $page = 1;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                }
                //Tính bản ghi bắt đầu của trang
                $start = ($page - 1) * $recordOnePage;
                $sql = "SELECT clothes.* FROM clothes
                        INNER JOIN categories ON clothes.category_id = categories.id
                        WHERE clothes.name LIKE '%$search%'
                            OR clothes.color LIKE '%$search%'
                            OR clothes.size LIKE '%$search%'
                            OR categories.name LIKE '%$search%'
                        LIMIT $start, $recordOnePage";
                $clothes = mysqli_query($connect, $sql);
                include_once '../connect/close.php';
                foreach ($clothes as $clothe){
            ?>
                <div class="col-3" style="">
                    <a href="product_detail.php?id=<?= $clothe['id'] ?>">
                        <img style="width:278px; height: 278px; object-fit: cover" src="../../image/<?= $clothe['image'] ?>" >
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
    <div align="center">
        <!--        form để hiển thị số trang-->
        <?php
        for($i = 1; $i <= $countPage; $i++){
            ?>
            <a style="color: black;text-decoration: none; font-weight: bold; font-family: '#9Slide03 BoosterNextFYBlack'" class="page_number" href="?page=<?= $i ?>">
                &nbsp &nbsp <?= $i ?>  &nbsp;
            </a>

            <?php
        }
        ?>
    </div>
</div>

<!-------------------- FOOTER -------------------->
<?php
include_once '../layout/footer.php';
?>
<!-------------------- END FOOTER -------------------->

</body>
</html>