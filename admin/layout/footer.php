<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Hien thi so trang </title>
</head>
<body>

<div align="center">
<!--        for để hiển thị số trang-->
<?php
for($i = 1; $i <= $countPage; $i++){
    ?>
    <a style="text-decoration: none; text-decoration-line: none; font-weight: bold; font-family: '#9Slide03 BoosterNextFYBlack'" class="page_number" href="?page=<?= $i ?>&search=<?= $search ?>">
        &nbsp &nbsp <?= $i ?>  &nbsp;
    </a>

    <?php
}
?>
</div>

</body>
</html>

