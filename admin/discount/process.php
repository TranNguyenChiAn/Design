<?php
$discount = $_POST['discount'];
echo $discount . ", ";
//Mở kết nối
include_once '../connect/open.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
   if(isset($_POST['myCheckbox'])){
      foreach($_POST['myCheckbox'] as $result) {
         //Query update data
         $sql = "UPDATE clothes SET price = price - (price * ('$discount'/100)) WHERE id = '$result'";
         //Chạy query
         mysqli_query($connect, $sql);
         header("Location: index.php");
      }
   }
}
?>
