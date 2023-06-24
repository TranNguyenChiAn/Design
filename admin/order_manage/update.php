<?php
//Lấy dữ liệu
$id = $_POST['id'];
$status = $_POST['status'];
//Mở kết nối
include_once '../connect/open.php';
//Query để update dữ liệu
$sql = "UPDATE orders SET status = '$status' WHERE id = '$id'";
mysqli_query($connect, $sql);
//Quay về trang danh sách
header('Location:../order_manage/index.php');
?>
