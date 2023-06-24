<?php
//Lấy id của bản ghi cần xóa
$id = $_GET['id'];
//Mở kết nối
include_once '../connect/open.php';
//Query xóa bản ghi
$sql = "DELETE FROM clothes WHERE id = '$id'";
//chạy query
mysqli_query($connect, $sql);
//Quay về trang danh sách
header('Location:../clothes_manage/index.php');
?>
