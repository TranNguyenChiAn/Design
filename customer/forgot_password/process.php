<?php
// Lấy dữ liệu từ form
$email_customer = $_POST['email_customer'];
$hash_new_password = substr(md5(rand(0, 99999999)), 0, 8);
////Mở kết nối
include_once '../connect/open.php';
//viết query
$sql = "SELECT *, COUNT(id) AS count_account FROM customers WHERE email = '$email_customer'";
//chạy query
$accounts = mysqli_query($connect, $sql);
//Kiểm tra query này trả về bao nhiêu bản ghi. Nếu trả về 0, account sai. Nếu trả về 1, account đúng
foreach($accounts AS $account){
    $id = $account['id'];
    $count_account = $account['count_account'];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if($count_account == 0) {
    // Quay lại trang account
    //header("Location: index.php");
    echo $email_customer;
}
else {
    //Query
    $sql = "UPDATE customers SET password = '$hash_new_password' WHERE email = '$email_customer'";
    //Run query
    mysqli_query($connect, $sql);

    $name = "Exme";
    $email = "trantranchian@gmail.com";
    $subject = "Change password";
    $message = "Your new password is " . $hash_new_password;

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
    $mail->Username = 'chiantrannguyen@gmail.com';
    $mail->Password = 'juhvepyeteslrtre';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';

    $mail->setFrom("trantranchian@gmail.com", "Exme");

    $mail->addAddress('chiantrannguyen@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = ("trantranchian@gmail.com ($subject)");
    $mail->Body = $message;
    $mail->send();
}
// Sang trang danh sách
header("Location: change_password.php");
?>

