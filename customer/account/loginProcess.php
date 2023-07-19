<?php
//Cho phép làm việc với section
session_start();
// Lấy dữ liệu từ form
$email = $_POST['email_customer'];
$password = $_POST['password'];
$password_md5 = md5($password);
$hash_password = md5($password_md5);
////Mở kết nối
include_once '../connect/open.php';
//viết query
$sql = "SELECT *, COUNT(id) AS count_account FROM customers WHERE email='$email' AND password='$hash_password'";
//chạy query
$accounts = mysqli_query($connect, $sql);
//Đóng kết nối
include_once '../connect/close.php';
//Kiểm tra query này trả về bao nhiêu bản ghi. Nếu trả về 0, account sai. Nếu trả về 1, account đúng
foreach($accounts AS $account){
    $id = $account['id'];
    $count_account = $account['count_account'];
}
if($count_account == 0) {
    // Quay lại trang account
    header("Location: login_customer.php");
}else {
    //Lưu id, số đth lên section
    $_SESSION['id'] = $id;
    $_SESSION['email_customer'] = $email;
    // Sang trang danh sách
    header("Location: ../pages/index.php");
}
?>
