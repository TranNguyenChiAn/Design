<?php
//Lấy dữ liệu
$id = $_POST['id'];
$name = $_POST['name'];
//Mở kết nối
include_once '../connect/open.php';
//Query để update dữ liệu
$sql = "UPDATE categories SET name = '$name' WHERE id = '$id'";
//Chạy query
mysqli_query($connect, $sql);
//Quay về trang danh sách
header('Location:../category_manager/index.php');
?>
