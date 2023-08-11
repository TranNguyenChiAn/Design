
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

        #new_password {
            border: none;
            border-bottom: 1px solid #cbc9c9;
            border-radius: 6px;
            width: 300px;
            height: 40px;
            padding-left: 9px;
        }

        #old_password {
            border: none;
            width: 500px;
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
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #e0dddd;"> Change Password </figure>
    <form align="center" id="form" method="post" action="change_process.php">
        <input id="old_password" type="password" name="old_password" placeholder="Old Password">
        <img id="showEye" src="../../image/view.png" onclick="oldPasswordShow()">
        <img id="hideEye" src="../../image/hidden.png" onclick="oldPasswordHide()">

        <br>
        <br>

        <input id="new_password" type="password" name="new_password" placeholder="New Password">
        <img id="showEye" src="../../image/view.png" onclick="newPasswordShow()">
        <img id="hideEye" src="../../image/hidden.png" onclick="newPasswordHide()">
        <br>
        <br>
        <button  id="login_button" type="submit"> Change </button>
        <br>
    </form>
</div>
<script type="text/javascript">
    let oldPassword = document.getElementById('old_password');
    let newPassword = document.getElementById('new_password');
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

    function oldPasswordShow(){
        oldPassword.type = 'text';
        showEye.style.display= "none";
        hideEye.style.display= "inline";
        oldPassword.focus();
    }
    function oldPasswordHide(){
        oldPassword.type = 'password';
        showEye.style.display= "inline";
        hideEye.style.display= "none";
        oldPassword.focus();
    }

    function newPasswordShow(){
        newPassword.type = 'text';
        showEye.style.display= "none";
        hideEye.style.display= "inline";
        newPassword.focus();
    }
    function newPasswordHide(){
        newPassword.type = 'password';
        showEye.style.display= "inline";
        hideEye.style.display= "none";
        newPassword.focus();
    }
</script>
</body>
</html>

