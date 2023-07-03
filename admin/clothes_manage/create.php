<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if(!isset($_SESSION['email_admin'])){
    //Quay về trang account
    header("Location: ../account/login_admin.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <style>
        body {
            background-color: #F5F4F8;
        }
        #image {
            margin-top:30px;
            width:150px;
            height: 150px;
            border:1px solid #b1bac0;
            object-fit: cover;
            position:absolute;
        }

        #imageFile {
            position:absolute;
            margin-top:180px;
            margin-left:30px;
            max-width: 109px;
            height:33px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function chooseFile(fileInput) {
            if (fileInput.files && fileInput.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#image').attr('src', e.target.result);
                }
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
    <title> Add a clothe </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//Open connect
include_once "../connect/open.php";
$sql = "SELECT * FROM categories";
$categories = mysqli_query($connect, $sql);

$sql = "SELECT * FROM producers";
$producers = mysqli_query($connect, $sql);
include_once "../connect/close.php";
?>
<section class="main_content">
<div class="form_change">
    <figure align="center" style="font-weight: bold; font-size: 30px;color: #4d4b4b;"> Add an item </figure>
    <form method="post" action="store.php" enctype="multipart/form-data">
       <input type="hidden" name="id">
       Name: <input style="margin-bottom: 18px" type="text" name="clothe_name"><br>
       Material: <input style="margin-bottom: 18px" type="text" name="material"><br>
       Size: <input style="margin-bottom: 18px; width: 300px" name="size"><br>
       Color:  <input style="margin-bottom: 18px" type="text" name="color"><br>
       Description: <input style="margin-bottom: 18px" type="text" name="description"><br>
       Category ID: <select style="margin-bottom: 18px" name="category_id">
           <option> - Choose - </option>
           <?php
                foreach ($categories as $category){
           ?>
               <option value="<?= $category['id'] ?>">
                   <?= $category['name'] ?>
               </option>

           <?php
                }
           ?>
       </select><br>
        Producer ID: <select style="margin-bottom: 18px" name="producer_id">
           <option> - Choose - </option>
           <?php
               foreach ($producers as $producer){
           ?>
                <option value="<?= $producer['id'] ?>">
                    <?= $producer['name'] ?>
                </option>
           <?php
                }
           ?>
       </select><br>
       Quantity: <input style="margin-bottom: 18px" type="text" name="quantity"><br>
       Price: <input style="margin-bottom: 18px" type="text" name="price"><br>
       Image: <input type="file" name="image" id="imageFile" onchange="chooseFile(this)"
                     accept="image/gif, image/png, image/jpeg">
                <img src="" alt="" id="image" width="200px">
        <br><br><br><br><br><br><br>
       <button class="btn add btn-primary" type="submit"> Add </button>
    </form>
</div>
    <br>
</section>

</body>
</html>

