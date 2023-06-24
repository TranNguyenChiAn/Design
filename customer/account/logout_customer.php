<?php
    //Cho phép dùng session trước
    session_start();
    // Xóa email trên session
    session_destroy();
    header("Location: ../account/login_customer.php");
?>
