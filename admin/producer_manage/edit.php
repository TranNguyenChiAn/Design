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
    </style>
    <title>Update Producer</title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//Lấy id của bản ghi đang cần sửa
$id = $_GET['id'];
//Mở kết nối
include_once '../connect/open.php';
//Query lấy dữ liệu ở bảng PK (bảng classes)
$sql = "SELECT * FROM producers";
$producers = mysqli_query($connect,$sql);
//Chạy query
$producers = mysqli_query($connect, $sql);
//Query lấy dữ liệu của bản ghi đang được update (bản ghi ở bảng students)
$sqlSelectProducer = "SELECT * FROM producers WHERE id = '$id'";
//Chạy query
$producers = mysqli_query($connect, $sqlSelectProducer);
//Đóng kết nối
include_once '../connect/close.php';

?>
<section class="main_content">
<div class="form_change">
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> UPDATE </figure>
    <form method="post" action="update.php">
        <?php
        //Đổ dữ liệu bản ghi trước khi sửa
        foreach ($producers as $producer){
            ?>
            <input type="hidden" name="id" value="<?= $producer['id'] ?>">
            Name: <input type="text" name="name" value="<?= $producer['name'] ?>"><br>

            <?php
        }
        ?>
        <button class="btn update btn-primary">Update</button>
    </form>
</div>
</section>

</body>
</html>

