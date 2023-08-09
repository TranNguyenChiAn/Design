<?php
//$import = $_POST['import'];
////Mở kết nối
//include_once '../connect/open.php';

//if($_SERVER['REQUEST_METHOD'] == "POST"){
//   if(isset($_POST['myCheckbox'])){
//      foreach($_POST['myCheckbox'] as $result) {
//         //Query update data
//         $sql = "UPDATE clothes SET quantity = quantity + '$import' WHERE id = '$result'";
//         //Chạy query
//         mysqli_query($connect, $sql);
//
//         if(isset($_SESSION['receipt'])){
//            //Kiểm tra đã tồn tại sp trên'receipt hay chưa
//            if(isset($_SESSION['receipt'][$result])){
//               //Tăng quantity lên 1
//               $_SESSION['receipt'][$result] = $import;
//            } else {
//               //Thêm sp có id vừa được lấy lên'receipt với quantity = 1
//               $_SESSION['receipt'][$result] = $import;
//            }
//         } else {
//            //Tạo receipt
//            $_SESSION['receipt'] = array();
//            //Thêm sp có id vừa được lấy lên'receipt với quantity = 1
//            $_SESSION['receipt'][$result] = $import;
//         }
//
//      }
//   }
//}

session_start();
//Lấy id product được thêm lên carts
$id = $_GET['id'];
//Kiểm tra đã tồn tại carts trên session chưa
if (isset($_SESSION['receipt'])) {
   //Kiểm tra đã tồn tại sp trên carts hay chưa
   if (isset($_SESSION['receipt'][$id])) {
      //Tăng quantity lên 1
      $_SESSION['receipt'][$id]++;
   } else {
      //Thêm sp có id vừa được lấy lên carts với quantity = 1
      $_SESSION['receipt'][$id] = 1;
   }
} else {
   //Tạo carts
   $_SESSION['receipt'] = array();
   //Thêm sp có id vừa được lấy lên carts với quantity = 1
   $_SESSION['carts'][$id] = 1;
}
header("Location: receipt.php");
?>
