<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        body {
            margin:0;
            color: #6868de;
        }
        .navbar {
            position: absolute;
            display: block;
            padding: 0;
        }
        .navbar_menu {
            height: 645px;
            position: absolute;
            padding-left: 0;
            list-style-type: none;
            background-color: #FFFFFF;
            color: #6868de;
            display: flex;
            justify-content: space-around;
            flex-direction: column;
            border-bottom-right-radius: 10px;
            border-top-right-radius: 10px;
        }

        .choice{
            width: 200px;
            height: 50px;
            color: #6868de;
            text-decoration: none;
            padding-left: 28%;
            padding-top: 10px;
        }

        .choice:hover {
            border-radius: 5px;
            background-color: #ddddf1;
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .link_in_menu {
            text-decoration: none;
            color: #6868de;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
    <div class="navbar">
        <ul class="navbar_menu">
            <li style="margin-left: 45px">
                <img width="100px" src="../../image/celement cat.png">
            </li>
            <li class="choice">
                <a class="link_in_menu" href="../category_manager/index.php"> Category </a>
            </li>
            <li  class="choice">
                <a class="link_in_menu" href="../clothes_manage/index.php"> Clothes </a>
            </li>
            <li  class="choice">
                <a class="link_in_menu" href="../producer_manage/index.php"> Producer </a>
            </li>
            <li  class="choice">
                <a class="link_in_menu" href="../customer_manage/index.php"> Customer </a>
            </li>
            <li  class="choice">
                <a class="link_in_menu" href="../order_manage/index.php"> Order </a>
            </li>
            <li  class="choice">
                <a class="link_in_menu" href="../account/logout_admin.php"> Logout </a>
            </li>
        </ul>
    </div>
</header>

</body>
</html>



