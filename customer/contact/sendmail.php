<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['send'])) {
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = "New message";
    $message = htmlentities($_POST['message']);

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

}else{
    echo "Khong nhan duoc";
}
?>
<script>
    alert("Message Sent");
    window.location="form.php";
</script>
