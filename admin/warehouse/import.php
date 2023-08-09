<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if(!isset($_SESSION['email_admin'])){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <style>
        body{
            background-color: #F5F4F8;
        }
    </style>
    <title> Import products </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//Mở kết nối
include_once '../connect/open.php';
//Khai báo biến search
$search = "";
//Lấy giá trị được search về với điều kiện $_GET['search'] tồn tại
if(isset($_GET['search'])) {
    $search = $_GET['search'];
}

//Khai báo số bản ghi 1 trang
$recordOnePage = 6;
//Query để lấy số bản ghi
$sqlCountRecord = "SELECT COUNT(*) AS count_record FROM clothes 
                           WHERE name LIKE '%$search%'
                              OR material LIKE '%$search%'
                              OR color LIKE '%$search%'
                              OR size LIKE '%$search%'";
//Chạy query lấy số bản ghi
$countRecords = mysqli_query($connect, $sqlCountRecord);
//foreach để lấy số bản ghi
foreach ($countRecords as $countRecord){
    $records = $countRecord['count_record'];
}
//Tính số trang
$countPage = ceil($records / $recordOnePage);
//Lấy trang hiện tại (nếu không tồn tại page hiện tại thì page hiện tại = 1)
$page = 1;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}
//Tính bản ghi bắt đầu của trang
$start = ($page - 1) * $recordOnePage;
//Query để lấy dữ liệu từ bảng classes trên db về
$sql = "SELECT clothes.*,categories.name AS category_name, producers.name AS producer_name FROM clothes 
                INNER JOIN categories ON clothes.category_id = categories.id
                INNER JOIN producers ON clothes.producer_id = producers.id 
                WHERE clothes.name LIKE '%$search%' 
                   OR clothes.id LIKE '%$search%'
                   OR clothes.material LIKE '%$search%'
                   OR clothes.color LIKE '%$search%'
                   OR clothes.size LIKE '%$search%'
                   OR categories.name LIKE '%$search%'
                   OR producers.name LIKE '%$search%'
                ORDER BY clothes.quantity ASC
                LIMIT $start, $recordOnePage";
//Chạy query
$clothes = mysqli_query($connect, $sql);
//Đóng kết nối
include_once '../connect/close.php';
?>
<section class="main_content">
    <!--SEARCH-->
    <!--Form để search
            action để trồng tức là khi click vào button sẽ load lại chính trang này-->
    <form style="margin: 20px 0 20px 0" method="get" action="">
        <input class="search" type="text" name="search" value="<?= $search; ?>" placeholder="Search">
    </form>

    <!-- LIST -->
    <p class="table_title"> DISCOUNT </p>
    <p style="color: black"> Chọn sản phẩm muốn nhập thêm </p>
    <form method="post" action="receipt.php">
        <table class="table-admin" border="0" cellspacing="0" cellpadding="10" width="100%" style="font-size: 12px">
            <tr>
<!--                <th class="t-heading" align="left"> Choose </th>-->
                <th class="t-heading" align="left"> ID </th>
                <th class="t-heading" align="left"> Name </th>
                <th class="t-heading" align="left"> Image </th>
                <th class="t-heading" align="left"> Size </th>
                <th class="t-heading" align="left"> Color </th>
                <th class="t-heading" align="left"> Quantity </th>
                <th class="t-heading" align="left"> Price </th>
                <th class="t-heading" align="center"> Import </th>
            </tr>
            <?php
            foreach($clothes as $clothe) {
                ?>
                <tr class="record">
<!--                    <td>-->
<!--                        <input type="checkbox" name="myCheckbox[]" value="--><?php //= $clothe['id']?><!--">-->
<!--                    </td>-->
                    <td>
                        <?= $clothe['id']?>
                    </td>
                    <td>
                        <?= $clothe['name']?>
                    </td>
                    <td>
                        <img width="50px" src="../../image/<?= $clothe['image'] ?>">
                    </td>
                    <td>
                        <?= $clothe['size']?>
                    </td>
                    <td>
                        <?= $clothe['color']?>
                    </td>
                    <td>
                        <?= $clothe['quantity']?>
                    </td>
                    <td>
                        <?= $clothe['price']?>
                    </td>
                    <td>
                        <a href="process.php?id=<?= $clothe['id']?>">
                            Import
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <button type="submit" class="btn add btn-primary">
            Import
        </button>
    </form>
    <br>
    <!--FOOTER-->
    <?php
    //Nhúng footer
    include_once '../layout/footer.php';
    ?>
    <section class="main_content">
        <br>

</body>
</html>


