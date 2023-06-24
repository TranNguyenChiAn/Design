<?php
//Lấy dữ liệu ở ô input có name="name"
$name = $_POST['clothe_name'];
$material = $_POST['material'];
$size = $_POST['size'];
$color = $_POST['color'];
$description = $_POST['description'];
$category_id = $_POST['category_id'];
$producer_id = $_POST['producer_id'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
//lấy tên ảnh
$image = $_FILES['image']['name'];
//query

//Mở kết nối
include_once '../connect/open.php';
//Query để thêm dữ liệu lên DB
$sql = "INSERT INTO clothes(name, material, size, color, description, category_id, producer_id, quantity, price, image) 
        VALUES ('$name', '$material', '$size', '$color', '$description', '$category_id', '$producer_id', '$quantity', '$price', '$image')";
//Chạy query
mysqli_query($connect, $sql);
//Đóng kết nối
include_once '../connect/close.php';
// lưu ảnh vào thư mục image
//lấy đc đường dẫn hiện tại của ảnh
//kiểm tra ảnh đã tồn tại chưa
if(!file_exists("../..image/" . $image)){
    $path = $_FILES['image']['tmp_name'];
    //lưu ảnh từ đường dẫn hiện tại vào folder
    move_uploaded_file($path, "../../image/" . $image);
}

// Quay về trang index
header('Location:../clothes_manage/index.php');
?>

