<?php
    session_start();
    unset($_SESSION['carts']);
    header("Location:../carts/index.php");
?>
