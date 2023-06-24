<?php
// start session
session_start();
// get the product id
$id = $_GET['id'];
//Mở kết nối
include_once '../connect/open.php';
//Query
$sql = "DELETE FROM orders WHERE id = '$id'";
$orders = mysqli_query($connect, $sql);
header("Location: index.php");
?>