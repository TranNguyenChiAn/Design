<?php
$id = $_GET['id'];
header("location.reload()");
include_once '../connect/open.php';
$sql = "SELECT * FROM orders WHERE id = '$id'";
$orders = mysqli_query($connect, $sql);
foreach($orders as $order) {
    if ($order['status'] == 0) {
        header("location.reload()");
        $sql = "UPDATE orders SET status = 3 WHERE id = '$id'";
        mysqli_query($connect, $sql);
    } else {
        header("location.reload()");
    }
}
header("Location: history_order.php");
?>
<script>
    alert('Cancel successful');
</script>