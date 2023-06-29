<?php
    //Cho phép làm việc với session
    session_start();
    //Kiểm tra tồn tại số đth trên session hay chưa, nếu đã tồn tại thì cho nhảy sang trang khác
    if(isset($_SESSION['email_admin'])){
        //Sang trang danh sách lớp
        header("Location:../order_manage/index.php");
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
    <title> Login Admin </title>
    <style>
        body {
            background-image: url(../../image/sky.jpg);
            background-repeat:no-repeat;
            background-size: cover;
        }

        .form_login {
            background-color: transparent;
            box-shadow: 0 18px 200px -60px black;
            border-radius: 30px;
            width: 500px;
            margin: 100px 100px 0px 380px;
            border: none;
            padding: 10px;
            backdrop-filter: blur(20px);
            font-size: 20px;
        }


        #email_admin {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #cbc9c9;
            width: 300px;
            height: 40px;
        }

        #password_admin {
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

    </style>
</head>
<body>
<div class="form_login" >
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> ADMIN LOGIN </figure>
    <form align="center" id="form" method="post" action="loginProcess.php">
        <input id="email_admin" type="email" name="email_admin" placeholder="Email" width="500px"><br>
        <br>
        <input  id="password_admin"type="password" name="password" placeholder="Password"><br>
        <br>
        <button  id="login_button" type="submit"> LOGIN </button>
    </form>
</div>
</body>
</html>

