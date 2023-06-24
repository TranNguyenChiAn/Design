<?php
    //Cho phép làm việc với session
    session_start();
    //Kiểm tra tồn tại số đth trên session hay chưa, nếu đã tồn tại thì cho nhảy sang trang khác
    if(isset($_SESSION['email'])){
        //Sang trang danh sách lớp
        header("Location:../pages/index.php");

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
    <title> Login Customer </title>
    <style>
        body {
            background-image: url("../../image/sky.jpg");
            background-repeat:no-repeat;
            background-size: cover;
        }

        .form_login {
            background-color: transparent;
            box-shadow: 0 18px 200px -60px black;
            border-radius: 30px;
            width: 500px;
            margin: 100px 100px 0 380px;
            border: none;
            padding: 10px;
            backdrop-filter: blur(20px);
            font-size: 20px;
        }


        #email_customer {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #cbc9c9;
            width: 300px;
            height: 40px;
        }

        #password_customer {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #cbc9c9;
            width: 300px;
            height: 40px;
        }

        #login_button {
            width: 180px;
            height: 50px;
            border-radius: 10px;
            border:none;
            background-color: #2060be;
            font-weight: bold;
            color: white;
            display: block;
            margin-left: 160px;
        }

        #login_button:hover {
            cursor: pointer;
        }

        .register {
            margin-top: 10px;
            text-decoration: none;
            display: flex;
            justify-content: center;
            font-style: italic;
            font-weight: bold;
            color: #231ec2;
        }

    </style>
</head>
<body>
<div class="form_login" >
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> LOGIN </figure>
    <form align="center" id="form" method="post" action="loginProcess.php">
        <input id="email_customer" type="email" name="email" placeholder="Email" width="500px"><br>
        <br>
        <input  id="password_customer"type="password" name="password" placeholder="Password"><br>
        <br>
        <button  id="login_button" type="submit"> LOGIN </button>

    </form>
</div>
<div>
    <a class="register" href="register.php"> Register </a>
</div>
</body>
</html>

