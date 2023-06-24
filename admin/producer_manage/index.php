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
        <title> Manage Producers </title>
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
    $recordOnePage = 3;
    //Query để lấy số bản ghi
    $sqlCountRecord = "SELECT COUNT(*) AS count_record FROM producers WHERE name LIKE '%$search%'";
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
    $sql = "SELECT * FROM producers WHERE name LIKE '%$search%' OR id LIKE '%$search%' LIMIT $start, $recordOnePage
            ";
    //Chạy query
    $producers = mysqli_query($connect, $sql);
    //Đóng kết nối
    include_once '../connect/close.php';
    ?>
    <section class="main_content">
    <!-- SEARCH -->
    <form style="margin: 20px 0 20px 0" method="get" action="">
        <input class="search" type="text" name="search" value="<?= $search; ?>" placeholder="Search">
    </form>

    <!-- LIST -->
    <p class="table_title"> MANAGE PRODUCER </p>
    <table class="table-admin" border="0" cellspacing="0" cellpadding="10" width="100%">

        <tr>
            <th class="t-heading" align="left"> ID </th>
            <th class="t-heading" align="left"> Name </th>
            <th class="t-heading" width="100px"> Action </th>
        </tr>
        <?php
        foreach($producers as $producer) {
            ?>
            <tr class="record">
                <td>
                    <?= $producer['id']?>
                </td>
                <td>
                    <?= $producer['name']?>
                </td>
                <td  style="display: flex; justify-content: space-around">
                    <a class="edit" href="edit.php?id=<?= $producer['id'] ?>">
                        <img width="30px" src="../../image/edit.png">
                    </a><br>
                    <a class="delete" href="destroy.php?id=<?= $producer['id'] ?>">
                        <img width="32px" src="../../image/delete.png">
                    </a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>

    <button class="btn add">
        <a class="link_in_button" href="create.php"> Add a record </a>
    </button>
    <br>

    <!--FOOTER-->
    <?php
    //Nhúng footer
    include_once '../layout/footer.php';
    ?>
</section>
</body>
</html>


