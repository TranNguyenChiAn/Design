<?php
//Lấy dữ liệu ở ô input có name="name"
$name = $_POST['name'];
//Mở kết nối
include_once '../connect/open.php';
//Query để thêm dữ liệu lên DB
$sql = "INSERT INTO categories(name) VALUES ('$name')";
//Chạy query
mysqli_query($connect, $sql);
//Đóng kết nối
include_once '../connect/close.php';
// Quay về trang index
header('Location:../category_manager/index.php');
?>
