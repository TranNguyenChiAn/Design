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
        <title> Login Admin </title>
        <style>
            body {
                background-image: url("../../image/banner.png");
                background-repeat:no-repeat;
                background-size: cover;
            }
            .form_register {
                background-color: #faf7f7;
                border-radius: 9px;
                width: 500px;
                margin: 10px 100px 0 380px;
                padding: 10px;
                backdrop-filter: blur(20px);
                font-size: 20px;
                color: black;
            }
            .form_register_input {
                margin-left: 30px;
            }
            .input_register {
                width: 300px;
                height: 36px;
                margin: 12px 0 12px 0;
            }

            .register_button {
                width: 90%;
                background-color: #6868de;
                height: 33px;
                border: none;
                border-radius: 6px;
                color: white;
            }
            #showEye {
                position: absolute;
                margin: 22px 0 0 -40px;
                width: 20px;
            }
            #showEye:hover {
                cursor: pointer;
            }

            #hideEye {
                display: none;
                position: absolute;
                margin: 22px 0 0 -40px;
                width: 20px;
            }
            #hideEye:hover {
                cursor: pointer;
            }
        </style>
    </head>
    <body>
    <div class="form_register" >
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> REGISTER </figure>
        <form class="form_register_input" method="post" action="store_register.php">
            <!--ID: <input type="number" name="id"><br>-->
            Name: <input class="input_register" type="text" name="name" placeholder="Name"><br>
            Email: <input class="input_register" type="email" name="email_customer" placeholder="Email"><br>
            Password: <input class="input_register" id="password" type="password" name="password" placeholder="Password">
                        <img id="showEye" src="../../image/view.png" onclick="passwordShow()">
                        <img id="hideEye" src="../../image/hidden.png" onclick="passwordHide()">
            <br>
            Phone: <input class="input_register" type="text" name="phone" placeholder="Phone"><br>
            Gender: <input type="radio" name="gender" value="0"> Female
                    <input type="radio" name="gender" value="1"> Male <br>
            Address:  <input class="input_register" type="text" name="address" placeholder="Address"><br>
            <br>
            <button class="register_button" type="submit"> Register </button>
            <p></p>
        </form>
    </div>

    <script type="text/javascript">
        let password = document.getElementById('password');
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
