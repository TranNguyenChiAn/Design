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
    <title>Update customer</title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//Lấy id của bản ghi đang cần sửa
$id = $_GET['id'];
//Mở kết nối
include_once '../connect/open.php';
//Query lấy dữ liệu ở bảng PK
$sql = "SELECT * FROM customers";
$customers = mysqli_query($connect,$sql);
//Chạy query
$customers = mysqli_query($connect, $sql);
//Query lấy dữ liệu của bản ghi đang được update (bản ghi ở bảng students)
$sqlSelectCustomers = "SELECT * FROM customers WHERE id = '$id'";
//Chạy query
$customers = mysqli_query($connect, $sqlSelectCustomers);
//Đóng kết nối
include_once '../connect/close.php';

?>
<section class="main_content">
    <div class="form_change">
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> UPDATE </figure>
        <form method="post" action="update.php">
            <?php
            //Đổ dữ liệu bản ghi trước khi sửa
            foreach ($customers as $customer){
                ?>
                <input type="hidden" name="id" value="<?= $customer['id'] ?>">
                Name: <input type="text" name="name" value="<?= $customer['name'] ?>"><br>
                Email: <input type="email" name="email" value="<?= $customer['email'] ?>"><br>
                Password: <input type="password" name="password" value="<?= $customer['password'] ?>"><br>
                Phone: <input type="number" name="phone" value="<?= $customer['phone'] ?>"> <br>
                Gender: <input type="radio" name="gender" value="0" checked> Female
                        <input type="radio" name="gender" value="1"> Male <br>
                Address:  <input type="text" name="address" value="<?= $customer['address'] ?>"><br>
                <?php
            }
            ?>
            <button class="btn update btn-primary">Update</button>
        </form>
    </div>
</section>

</body>
</html>

