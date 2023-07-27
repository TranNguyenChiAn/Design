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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
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

        .menu_button {
            text-decoration: none;
            border: none;
            margin: 18px 0 0 0;
            background-color: white;
            width: 108px;
            border-top-right-radius: 9px;
            border-top-left-radius: 9px;
        }
        .menu_button:hover {
            cursor: pointer;
            background-color: #cbc9c9;
        }
        .notification {
            margin: 0 0 0 1%;
            width: 17%;
            height: 120px;
            border-radius: 6px;
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
    <div>
        <button class="menu_button">
            <a class="link_in_button" style="color:#6868de;" target="display" href="statistic/sales.php">
                Daily
            </a>
        </button>
        <button class="menu_button">
            <a class="link_in_button" style="color:#6868de;" target="display" href="statistic/sale_monthly.php">
                Monthly
            </a>
        </button>

    </div>
    <div style="display: flex; justify-content: start">
        <iframe name = "display" style="margin: 0 0 0 0; width: 81%; height: 460px" src="statistic/sales.php" ></iframe>
        <iframe class="notification" src="statistic/today.php" ></iframe>
    </div>

    <iframe style="margin: 6px 0 0 0; width: 81%; height: 460px" src="statistic/status.php" ></iframe>
    <iframe style="margin: 6px 0 0 0; width: 81%; height: 460px" src="statistic/product.php" ></iframe>

</section>

</body>
</html>

