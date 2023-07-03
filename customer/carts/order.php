<?php
session_start();
//Kiểm tra đã account chưa
if(isset($_SESSION['id'])){
    //Lấy ngày hiện tại
    $date_buy = date('Y-m-d');
    //Lấy status (status mặc định là 0 tương ứng với trạng thái chờ xác nhận của đơn hàng)
    $status = 0;
    //Lấy id của customer
    $customer_id = $_SESSION['id'];
//    Lay thong tin tu form receive
    $receiver_name = $_POST['receiver_name'];
    $receiver_phone = $_POST['receiver_phone'];
    $receiver_address = $_POST['receiver_address'];
    //Mở kết nối
    include_once '../connect/open.php';
    //Query thêm dữ liệu lên bảng orders
    $sqlInsertOrder = "INSERT INTO orders(date_buy, status, customer_id, receiver_name, receiver_phone, receiver_address) 
                       VALUES ('$date_buy', '$status', '$customer_id', '$receiver_name', '$receiver_phone', '$receiver_address')";
    //Chạy query insert dữ liệu lên bảng orders
    mysqli_query($connect, $sqlInsertOrder);
    //query lấy order_id lớn nhất của customer đang account hiện tại
    $sqlMaxOrderId = "SELECT MAX(id) AS max_order_id FROM orders WHERE customer_id = '$customer_id'";
    //Chạy query lấy max_order_id
    $maxOrderIds = mysqli_query($connect, $sqlMaxOrderId);
    //foreach để lấy max_order_id
    foreach ($maxOrderIds as $maxOrderId){
    $order_id = $maxOrderId['max_order_id'];
    //Lấy giỏ hàng về
    $cart = $_SESSION['carts'];

    foreach ($cart as $clothes_id => $quantity){
        //Lấy dữ liệu để insert lên bảng order_details
        //Query để lấy price của product
        $sqlSelectPrice = "SELECT price FROM clothes WHERE id = '$clothes_id'";
        //Chạy query lấy price của product
        $clothePrices = mysqli_query($connect, $sqlSelectPrice);
        //foreach để lấy price
        foreach ($clothePrices as $clothePrice) {
            $price = $clothePrice['price'];
            //Query insert dữ liệu lên bảng order_details
            $sqlInsertOrderDetail = "INSERT INTO order_details(order_id, clothes_id, price, quantity ) 
                                 VALUES ('$order_id', '$clothes_id', '$price', '$quantity')";
            //Chạy query insert order_detail
            mysqli_query($connect, $sqlInsertOrderDetail);
            $sqlUpdateQuantity = "UPDATE clothes SET quantity = quantity - '$quantity'";
            //Chạy query insert order_detail
            mysqli_query($connect, $sqlUpdateQuantity);
        }
        }
    }
    //Xóa carts
    unset($_SESSION['carts']);
    //Quay về trang giỏ hàng
    header("Location: ../pages/index.php");

} else {
    //Quay về trang account
    header("Location:../account/login_customer.php");
}
?>