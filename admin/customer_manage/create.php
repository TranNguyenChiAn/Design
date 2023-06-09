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
        body {
            background-color: #F5F4F8;
        }
    </style>
    <title> Add a customer </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
include_once "../connect/open.php";
$sql = "SELECT * FROM customers";
$customers = mysqli_query($connect, $sql);
include_once "../connect/close.php";
?>
<section class="main_content">
    <div class="form_change">
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> Add a customer </figure>
        <form method="post" action="store.php">
            <!--ID: <input type="number" name="id"><br>-->
            Name: <input type="text" name="name"><br>
            Email: <input type="email" name="email"><br>
            Password: <input type="password" name="password"><br>
            Phone: <input type="text" name="phone"><br>
            Gender: <input type="radio" name="gender" value="0"> Female
                    <input type="radio" name="gender" value="1"> Male <br>
            Address:  <input type="text" name="address"><br>
            <br>
            <button class="btn add btn-primary" type="submit"> Add </button>
        </form>
    </div>
</section>
</body>
</html>

