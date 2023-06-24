<?php
session_start();
//Lấy id product được thêm lên carts
$id = $_GET['id'];
//Kiểm tra đã tồn tại carts trên session chưa
if(isset($_SESSION['carts'])){
    //Kiểm tra đã tồn tại sp trên carts hay chưa
    if(isset($_SESSION['carts'][$id])){
        //Tăng quantity lên 1
        $_SESSION['carts'][$id]++;
    } else {
        //Thêm sp có id vừa được lấy lên carts với quantity = 1
        $_SESSION['carts'][$id] = 1;
    }
} else {
    //Tạo carts
    $_SESSION['carts'] = array();
    //Thêm sp có id vừa được lấy lên carts với quantity = 1
    $_SESSION['carts'][$id] = 1;
}
//Nhảy sang trang view carts
header("Location:../carts/index.php");
?>