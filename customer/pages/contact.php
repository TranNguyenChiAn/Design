<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <style>
        body {
            background-color: #F5F4F8;
        }

        .form_contact {
            position: absolute;
            top: 80px;
            background-color: #ffffff;
            width: 629px;
            height: 713px;
            padding: 10px;
            color: black;
        }

        .contact_submit_button {
            border: none;
            border-radius: 25px;
            height: 50px;
            width: 180px;
            background-color: #1e561e;
            color: white;
        }
    </style>
    <title> Profile </title>
</head>
<body>
<?php
include_once "../layout/header.php";
?>
<div>
    <img style="margin-top: 80px;width:100%"  src="../../image/jisoo_in_dior.png">
    <form class="form_contact">
        <figure class="figure"> Contact Us </figure><br>
        <div  style="margin: 50px 0 0 110px;" >
            Name<br><input class="input" type="text" placeholder="Name" alt="name"><br><br>
            Email<br><input class="input" type="email" placeholder="Email" alt="email"><br><br>
            Phone<br><input class="input" type="number" placeholder="Phone" alt="phone"><br><br>
            <button type="submit" class="contact_submit_button"> CONTACT US</button>
        </div>
        <div style="margin: 30px 0 0 90px">
            <span style="font-size: 22px; font-weight: bold"> Contact:</span> Design@gmail.com
        </div>
    </form>
</div>
<!-------------------- FOOTER -------------------->
<?php
include_once '../layout/footer.php';
?>
<!-------------------- END FOOTER -------------------->

</body>
</html>

