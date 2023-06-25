<!doctype html>
<html lang="en">
<head>
    <style>
        body{
            background-color: #F5F4F8;
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
    include_once '../layout/header.php';
?>
<!-------------------- END HEADER -------------------->

</section>
    <!-------------------- MAIN -------------------->
    <div class="headline">
            <p class="trend">BEST SELLER</p>
        <div class="maincontent">
            <?php
            //Mở kết nối
            include_once '../connect/open.php';
            //Khai báo số bản ghi 1 trang
            $recordOnePage = 8;
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
            $sql = "SELECT clothes.*, sum(order_details.quantity) FROM clothes 
                    INNER JOIN order_details ON order_details.clothes_id = clothes.id
                    GROUP BY order_details.clothes_id
                    ORDER BY SUM(order_details.quantity) DESC
                    LIMIT $start, $recordOnePage";
            $clothes = mysqli_query($connect, $sql);
            foreach ($clothes as $clothe) {
            ?>
                <div class="col-3" style="">
                    <a  href="product_detail.php?id=<?= $clothe['id'] ?>">
                        <img style="width:278px; height: 278px; object-fit: cover" src="../../image/<?= $clothe['image'] ?>" alt="BEST SELLER" >
                    </a>
                    <a href="../carts/add to cart.php?id=<?= $clothe['id']; ?>">
                        <img class="cart_symbol" src="../../image/shopping-cart.png">
                    </a>
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
    <div class="headline">
            <p class="trend"> new arrivals</p>
        <div class="maincontent">
            <?php
            //Mở kết nối
            include_once '../connect/open.php';
            //Khai báo số bản ghi 1 trang
            $recordOnePage = 8;
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
            $sql = "SELECT clothes.*,categories.id AS category_id, producers.id AS producer_id FROM clothes 
                            INNER JOIN categories ON clothes.category_id = categories.id
                            INNER JOIN producers ON clothes.producer_id = producers.id
                            ORDER BY id ASC
                            LIMIT $start, $recordOnePage";
            $clothes = mysqli_query($connect, $sql);
            include_once '../connect/close.php';
            foreach ($clothes as $clothe){
                ?>
                <div class="col-3" style="">
                    <a  href="product_detail.php?id=<?= $clothe['id'] ?>">
                        <img style="width:278px; height: 278px; object-fit: cover" src="../../image/<?= $clothe['image'] ?>" alt="BEST SELLER" >
                    </a>
                    <a href="../carts/add to cart.php?id=<?= $clothe['id']; ?>">
                        <img class="cart_symbol" src="../../image/shopping-cart.png">
                    </a>
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
<div class="multi-carousel" data-mdb-interval="3000" data-mdb-items="5">
    <div class="d-flex justify-content-center m-2 mb-3">
        <button class="carousel-control-prev btn btn-pink btn-floating mx-3" type="button" tabindex="0" data-mdb-slide="prev">
            <i class="fas fa-angle-left fa-lg"></i>
        </button>
        <button class="carousel-control-next btn btn-pink btn-floating mx-3" type="button" tabindex="0" data-mdb-slide="next">
            <i class="fas fa-angle-right fa-lg"></i>
        </button>
    </div>
    <div class="multi-carousel-inner">
        <div class="multi-carousel-item">
            <div class="card m-2">
                <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Square/img(4).jpg" alt="Card image cap" />
                <div class="card-body">
                    <h5 class="card-title">Moda</h5>
                    <p class="card-text">Plan B</p>
                    <ul class="list-unstyled list-inline my-2">
                        <li class="list-inline-item mx-0"><i class="fas fa-star"></i></li>
                        <li class="list-inline-item mx-0"><i class="fas fa-star"></i></li>
                        <li class="list-inline-item mx-0"><i class="fas fa-star"></i></li>
                        <li class="list-inline-item mx-0"><i class="fas fa-star"></i></li>
                        <li class="list-inline-item mx-0"><i class="fas fa-star-half-alt"></i></li>
                    </ul>
                    <p class="price mb-0">9,99 $</p>
                </div>
            </div>
        </div>
    </div>
</div>
    <div align="center">
        <!--        form để hiển thị số trang-->
        <?php
            for($i = 1; $i <= $countPage; $i++){
                ?>
                <a style="text-decoration: none; text-decoration-line: none; font-weight: bold; font-family: '#9Slide03 BoosterNextFYBlack'" class="page_number" href="?page=<?= $i ?>">
                    &nbsp &nbsp  <?= $i ?>
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