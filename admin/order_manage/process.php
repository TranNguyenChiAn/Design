<?php
    //Lay id cua don hang
    $id = $_POST['id'];
    //Lay value cua status
    $status = $_POST['status'];
    //Mo ket noi
    include_once "../connect/open.php";
    //Query update status where id = $id de update cua don hang ay
    $sql = "UPDATE orders SET status = '$status' WHERE id='$id'" ;
    //Chay query
    $orders = mysqli_query($connect, $sql);
    //Dong ket noi
    include_once "../connect/close.php";
    //Quay lai trang danh sach
    header("Location: index.php");

?>
