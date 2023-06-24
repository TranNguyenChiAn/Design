<?php
//Lấy dữ liệu ở ô input có name=""
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    //Mở kết nối
    include_once '../connect/open.php';
    //Query để thêm dữ liệu lên DB
    $sql = "INSERT INTO customers(name, email, password, phone, gender, address) 
            VALUES ('$name','$email','$password', '$phone','$gender', '$address')";
    //Chạy query
    mysqli_query($connect, $sql);
    //Đóng kết nối
    include_once '../connect/close.php';
    // Quay về trang index
    header('Location:../customer_manage/index.php');
?>
