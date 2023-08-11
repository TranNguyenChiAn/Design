<?php
    //Lấy dữ liệu
    $id = $_POST['id'];
    $name = $_POST['clothe_name'];
    $material = $_POST['material'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $producer_id = $_POST['producer_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    if(isset($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
    }

    //Mở kết nối
    include_once '../connect/open.php';
    //Query để update dữ liệu
    $sql = "UPDATE clothes SET name = '$name', material = '$material', size = '$size', color = '$color', description = '$description', category_id = '$category_id',
    producer_id = '$producer_id', quantity = '$quantity', price = '$price', image = '$image' WHERE id = '$id'";
    //Chạy query
    mysqli_query($connect, $sql);

    //Kiểm tra ảnh đã tồn tạo trong folder chưa
    if(!file_exists('../../../image/' . $image)) {
        //Lay path cua anh
        $path = $_FILES['image']['tmp_name'];
        //Luu anh
        move_uploaded_file($path, "../../image/" . $image);
        echo $path;
    }
    //Quay về trang danh sách
    header('Location:../clothes_manage/index.php');

?>
