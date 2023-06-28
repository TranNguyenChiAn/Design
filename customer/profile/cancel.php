<?php
$id = $_GET['id'];
include_once '../connect/open.php';
$sql = "UPDATE orders SET status = 3 WHERE id = '$id'";
mysqli_query($connect, $sql);
header("Location: index.php");
?>
