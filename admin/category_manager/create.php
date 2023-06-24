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
    </style>
    <title> Add a categories </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
include_once "../connect/open.php";
$sql = "SELECT * FROM categories";
$categories = mysqli_query($connect, $sql);
include_once "../connect/close.php";
?>
<section class="main_content">
    <div class="form_change" >
        <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> Add a category </figure>
        <form  method="post" action="store.php">
            <!--ID: <input type="number" name="id"><br>-->
            Name: <input type="text" name="name"><br>
            <button class="btn add btn-primary" type="submit"> Add </button>
        </form>
    </div>
</section>


</body>
</html>

