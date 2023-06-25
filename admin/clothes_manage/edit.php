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
    <title>Update clothe</title>
    <script>
        function checkForBlank() {
            let categoryId = document.getElementById('category_id');
            let invalid = categoryId.value == "- Choose -";

            if (invalid) {
                alert('Please enter first name');
                categoryId.className = 'error';
            }
            else {
                categoryId.className = '';
            }

            return !invalid;

            let producerId = document.getElementById('producer_id');
            let invalids = producerId.value == "- Choose -";

            if (invalids) {
                document.getElementById('producer_id').innerHTML = " * Bạn chưa chọn Producer Id";
                producerId.className = 'error';
            }
            else {
                producerId.className = '';
            }

            return !invalids;
        }
    </script>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//Lấy id của bản ghi đang cần sửa
$id = $_GET['id'];
//Mở kết nối
include_once '../connect/open.php';
//Query lấy dữ liệu ở bảng PK (bảng classes)
$sql = "SELECT * FROM categories";
//Chạy query
$categories = mysqli_query($connect, $sql);

//Query lấy dữ liệu ở bảng PK (bảng classes)
$sql = "SELECT * FROM producers";
//Chạy query
$producers = mysqli_query($connect, $sql);

//Query lấy dữ liệu của bản ghi đang được update (bản ghi ở bảng students)
$sqlSelectClothes = "SELECT * FROM clothes WHERE id = '$id'";
//Chạy query
$clothes = mysqli_query($connect, $sqlSelectClothes);
//Đóng kết nối
include_once '../connect/close.php';

?>
<section class="main_content">
<div class="form_change">
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> UPDATE </figure>
    <form method="post" action="update.php" onsubmit="return checkForBlank()" enctype="multipart/form-data">
        <?php
        //Đổ dữ liệu bản ghi trước khi sửa
        foreach ($clothes as $clothe){
            ?>
            <input type="hidden" name="id" value="<?= $clothe['id'] ?>">
            Name: <input style="margin-bottom: 18px; width: 300px" type="text" name="clothe_name" value="<?= $clothe['name'] ?>"><br>
            Material: <input style="margin-bottom: 18px" type="text" name="material" value="<?= $clothe['material'] ?>"><br>
            Size: <input style="margin-bottom: 18px" type="text" name="size" value="<?= $clothe['size'] ?>"><br>
            Color: <input style="margin-bottom: 18px" type="text" name="color" value="<?= $clothe['color'] ?>"><br>
            Description: <input style="margin-bottom: 18px; width: 300px" type="text" name="description" value="<?= $clothe['description'] ?>"><br>
            Category Name: <select style="margin-bottom: 18px" name="category_id" id="category_id" onchange="checkForBlank()">
                <option> - Choose - </option>
                <?php
                foreach ($categories as $category){
                    ?>
                    <option value="<?= $category['id'] ?>"
                        <?php
                        //Kiểm tra xem class_id của bản ghi trùng với id của class nào thì sẽ selected vào class đó
                        if($clothe['category_id'] == $category['id']){
                            echo 'selected';
                        }
                        ?>
                    >
                        <?= $category['name'] ?>
                    </option>
                    <?php
                }
                ?>
            </select><br>
            Producer Name: <select style="margin-bottom: 18px" name="producer_id" id="producer_id" onchange="checkForBlank()">
                <option> - Choose - </option>
                <?php
                foreach ($producers as $producer){
                    ?>
                    <option value="<?= $producer['id'] ?>"
                        <?php
                        //Kiểm tra xem class_id của bản ghi trùng với id của class nào thì sẽ selected vào class đó
                        if($clothe['producer_id'] == $producer['id']){
                            echo 'selected';
                        }
                        ?>
                    >
                        <?= $producer['name'] ?>
                    </option>
                    <?php
                }
                ?>
            </select><br>
            Quantity: <input style="margin-bottom: 18px" type="text" name="quantity" value="<?= $clothe['quantity'] ?>"><br>
            Price: <input style="margin-bottom: 18px" type="text" name="price" value="<?= $clothe['price'] ?>">$<br>
            Image: <input type="file" name="image" value="<?= $clothe['image'] ?>">
                    <img width="200px" src="../../image/<?= $clothe['image'] ?>"><br>

            <?php
        }
        ?>
        <button class="btn update btn-primary" type="submit">Update</button>
    </form>
</div>
</section>

</body>
</html>

