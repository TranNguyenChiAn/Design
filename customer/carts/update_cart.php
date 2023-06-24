<?php
session_start();
//Lấy mảng quantity gồm id sản phẩm và số lượng
$quantities = $_POST["quantity"];
//foreach để lấy id và quantity
foreach ($quantities as $id => $quantity) {
        //Update quantity của các sản phẩm có id tương ứng trên carts
        $_SESSION['carts'][$id] = $quantity;
}
//Quay về trang giỏ hàng
header("Location:../carts/index.php");

?>
