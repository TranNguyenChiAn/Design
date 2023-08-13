<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


    $name = "Customer";
    $email = $_SESSION['email_customer'];
    $subject = "New message";
    $message = "You have new order";

    $mail = new PHPMailer(true);

    $mail->SMTPOptions = array(
        'ssl'=> array(
            'verify_peer'=> false,
            'verify_peer_name'=> false,
            'allow_self_signed'=>true
        )
    );

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'trantranchian@gmail.com';
    $mail->Password = 'jdkaueomxvkedeos';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    $mail->setFrom($email, $name);

    $mail->addAddress('trantranchian@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = ("$email ($subject)");
    $mail->Body = $message;
    $mail->send();


?>
<script>
    alert("Order Successful");
    window.location="../profile/history_order.php";
</script>
