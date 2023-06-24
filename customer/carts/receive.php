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
    <style>
        body {
            background-color: #F5F4F8;
        }

        .form_receiver {
            background-color: #ffffff;
            width:500px;
            height: auto;
            border:1px solid black;
            padding: 10px;
            border-radius: 10px;
            margin: 30px 0 0 33%;
        }
    </style>
    <title> Receiver </title>
</head>
<body>
<?php
include_once "../layout/header.php";
?>
<h2 style="margin: 100px 0 0 36%; color: black; font-weight: bold"> Receiver's Information </h2>
<form class="form_receiver" method="post" action="order.php">
    <br>
    Receiver Name <input type="text" name="receiver_name" ><br><br>
    Receiver Phone <input type="number" name="receiver_phone" ><br><br>
    Receiver Address <input type="text" name="receiver_address"><br><br>
    <button class="button add" type="submit">
        Submit
    </button>
</form>

</body>
</html>
<?php
