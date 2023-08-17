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
            border-radius: 18px;
            width: 496px;
            margin: 10% 0 0 30%;
            border: 1px solid #6e6d6d;
            padding: 10px;
            backdrop-filter: blur(30px);
            font-size: 20px;
        }

        #email_customer {
            border: none;
            border-bottom: 1px solid #e0dddd;
            border-radius: 6px;
            padding-left: 9px;
            width: 300px;
            height: 40px;
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

    </style>
</head>
<body>
<div class="form_login" >
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #e0dddd;"> Enter Email </figure>
    <form align="center" id="form" method="post" action="process.php">
        <input id="email_customer" type="email" name="email_customer" placeholder="Email">
        <br>
        <br>
        <button  id="login_button" type="submit"> Submit </button>
        <br>
    </form>
</div>

</body>
</html>

