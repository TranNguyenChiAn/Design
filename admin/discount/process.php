<?php
$discount = $_POST['discount'];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['myCheckbox'])){
            foreach($_POST['myCheckbox'] as $result) {
                //Query để lấy dữ liệu từ bảng classes trên db về
                $sql = "UPDATE clothes SET price = price - (price * ('$discount'/100)) WHERE id = '$result'";
                //Chạy query
                $clothes = mysqli_query($connect, $sql);
                echo $result . ", ";
                echo $discount;
            }
        }
    }
    //header("Location: index.php");
?>
