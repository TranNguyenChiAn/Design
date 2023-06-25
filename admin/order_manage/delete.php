<?php
// start session
session_start();
// get the product id
$id = $_GET['id'];
//Mở kết nối
include_once '../connect/open.php';
//Query
$sql = "DELETE FROM order_details WHERE  order_id = '$id'";
$order_details = mysqli_query($connect, $sql);
//Query
$sql = "DELETE FROM orders WHERE id = '$id'";
//Chay query
$orders = mysqli_query($connect, $sql);

header("Location: index.php");
?>