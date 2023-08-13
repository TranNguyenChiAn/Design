<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$name = "Customer";
$email = $_SESSION['email_customer'];
$subject = "New Order";
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

header('Content-type: text/html; charset=utf-8');

function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
//print_r (json_encode((int)$_POST['total_cost']) * 2350);

    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderInfo = "Thanh toán qua MoMo";
    $amount = json_encode((int)$_POST['total_cost']) * 2350;
    $orderId = time() . "";
    $redirectUrl = "http://localhost/Design/customer/profile/history_order.php";
    $ipnUrl = "http://localhost/Design/customer/profile/history_order.php";
    $extraData = "";

    $requestId = time() . "";
    $requestType = "captureWallet";
    //    $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $secretKey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = execPostRequest($endpoint, json_encode($data));

    $jsonResult = json_decode($result, true);  // decode json

    header('Location: ' . $jsonResult['payUrl']);

// end pay


?>

