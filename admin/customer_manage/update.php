<?php
//Lấy dữ liệu
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$address = $_POST['address'];
//Mở kết nối
include_once '../connect/open.php';
//Query để update dữ liệu
$sql = "UPDATE customers SET name = '$name', email = '$email', password = '$password', phone = '$phone', gender = '$gender', address = '$address' WHERE id = '$id'";
mysqli_query($connect, $sql);
//Quay về trang danh sách
header('Location:../customer_manage/index.php');
?>
