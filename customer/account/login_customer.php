<?php
    //Cho phép làm việc với session
    session_start();
    //Kiểm tra tồn tại số đth trên session hay chưa, nếu đã tồn tại thì cho nhảy sang trang khác
    if(isset($_SESSION['email_customer'])){
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
            background-image: url("../../image/banner.png");
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
            border: none;
            border-bottom: 1px solid #cbc9c9;
            width: 300px;
            height: 40px;border-radius: 6px;
            padding-left: 9px;
        }

        #password_customer {
            border: none;
            border-bottom: 1px solid #cbc9c9;
            width: 300px;
            height: 40px;border-radius: 6px;
            padding-left: 9px;
        }

        #login_button {
            width: 62%;
            height: 33px;
            border-radius: 6px;
            border:none;
            background-color: #2060be;
            font-weight: bold;
            color: white;
            display: block;
            margin-left: 94px;
            font-size: 14px;
        }

        #login_button:hover {
            cursor: pointer;
        }

        .register {
            margin-top: 10px;
            display: flex;
            justify-content: flex-end;
            font-style: italic;
            font-weight: bold;
            color: white;
        }
        #showEye {
            position: absolute;
            margin: 11px 0 0 -40px;
            width: 20px;
        }
        #showEye:hover {
            cursor: pointer;
        }

        #hideEye {
            display: none;
            position: absolute;
            margin: 11px 0 0 -40px;
            width: 20px;
        }
        #hideEye:hover {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="form_login" >
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #e0dddd;"> LOGIN </figure>
    <form align="center" id="form" method="post" action="loginProcess.php">
        <input id="email_customer" type="email" name="email_customer" placeholder="Email" width="500px"><br>
        <br>
        <input  id="password_customer"type="password" name="password" placeholder="Password">
        <img id="showEye" src="../../image/view.png" onclick="passwordShow()">
        <img id="hideEye" src="../../image/hidden.png" onclick="passwordHide()">
        <br>
        <br>
        <button  id="login_button" type="submit"> LOGIN </button>

    </form>
</div>
<div style="width: 500px">
    <a class="register" href="register.php"> Register </a>
</div>

<script type="text/javascript">
    let password = document.getElementById('password_customer');
    let showEye = document.getElementById('showEye');
    let hideEye = document.getElementById('hideEye');

    function black(){
        showEye.style.fill = "#000000";
        hideEye.style.fill = "#000000";
    }
    function white(){
        showEye.style.fill = "#fff";
        hideEye.style.fill = "#fff";
    }

    function passwordShow(){
        password.type = 'text';
        showEye.style.display= "none";
        hideEye.style.display= "inline";
        password.focus();
    }
    function passwordHide(){
        password.type = 'password';
        showEye.style.display= "inline";
        hideEye.style.display= "none";
        password.focus();
    }
</script>

</body>
</html>

