<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if (!isset($_SESSION['email_admin'])) {
    //Quay về trang account
    header("Location: ../account/login_admin.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #F5F4F8;
        }

        #notice {
            position: absolute;
            margin: 18px 0 0 82%;
            width: 180px;
            height: 120px;
        }
    </style>
    <title> Homepage </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";

?>
<section style="margin: 0 0 0 210px" class="main_content">
    <!--<iframe id="notice" src="statistic/today.php" ></iframe>-->
    <iframe style="margin: 0 0 0 0; width: 81%; height: 460px" src="statistic/sales.php" ></iframe>
    <iframe style="margin: 6px 0 0 0; width: 81%; height: 460px" src="statistic/status.php" ></iframe>
    <iframe style="margin: 6px 0 0 0; width: 81%; height: 460px" src="statistic/product.php" ></iframe>
    <iframe style="margin: 6px 0 0 0; width: 81%; height: 460px" src="statistic/today.php" ></iframe>
</section>

</body>
</html>

