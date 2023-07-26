<?php
//Cho phép làm việc với section
session_start();
$email = $_SESSION['email_customer'];
// Lấy dữ liệu từ form
//Old password
$password = $_POST['old_password'];
$password_md5 = md5($password);
$hash_password = md5($password_md5);

//New password
$new_password = $_POST['new_password'];
$new_password_md5 = md5($new_password);
$hash_new_password = md5($new_password_md5);
////Mở kết nối
include_once '../connect/open.php';
//viết query
$sql = "SELECT *, COUNT(id) AS count_account FROM customers WHERE email = '$email' AND password = '$hash_password'";
//chạy query
$accounts = mysqli_query($connect, $sql);
//Kiểm tra query này trả về bao nhiêu bản ghi. Nếu trả về 0, account sai. Nếu trả về 1, account đúng
foreach($accounts AS $account){
    $id = $account['id'];
    $count_account = $account['count_account'];
}
if($count_account == 0) {
    // Quay lại trang account
    header("Location: change_password.php");
}else {
    //Query
    $sql = "UPDATE customers SET password = '$hash_new_password' WHERE email = '$email'";
    //Run query
    mysqli_query($connect, $sql);
}

// Sang trang danh sách
header("Location: index.php");
?>
