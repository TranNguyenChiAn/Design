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
                background-image: url(https://th.bing.com/th/id/R.f520ddbe809906ae310b89a0549128f4?rik=3KYSKU8YeR9deg&riu=http%3a%2f%2fimages.wisegeek.com%2fsky.jpg&ehk=k%2fISf4oS00sJNOQIZp6ThaOTECIHp3p1vSxXwAuSCqA%3d&risl=&pid=ImgRaw&r=0);
                background-repeat:no-repeat;
                background-size: cover;
            }

            .form_register {
                background-color: transparent;
                box-shadow: 0 18px 200px -60px black;
                border-radius: 30px;
                width: 500px;
                margin: 100px 100px 0px 380px;
                border: none;
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
                margin: 10px 0 0 0;
            }

            .add {
                margin-top: 20px;
                margin-left: 78%;
                background-color: #6868de;
                color: white;
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
            Password: <input class="input_register" type="password" name="password" placeholder="Password"><br>
            Phone: <input class="input_register" type="text" name="phone" placeholder="Phone"><br>
            Gender: <input type="radio" name="gender" value="0"> Female
                    <input type="radio" name="gender" value="1"> Male <br>
            Address:  <input class="input_register" type="text" name="address" placeholder="Address"><br>
            <br>
            <button class="button add" type="submit"> Register </button>
        </form>
    </div>
</body>
</html>
