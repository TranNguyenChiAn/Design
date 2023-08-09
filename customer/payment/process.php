<?php
session_start();
include_once "../connect/open.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$customer_id = $_SESSION['id'];
//query lấy max_order_id
$sqlMaxOrderId = "SELECT MAX(id) AS max_order_id FROM orders WHERE customer_id = '$customer_id'";
//Chạy query lấy max_order_id
$maxOrderIds = mysqli_query($connect, $sqlMaxOrderId);
foreach ($maxOrderIds as $maxOrderId) {
    $order_id = $maxOrderId['max_order_id'];
    //Query
    $sql = "SELECT clothes_id, order_id, SUM(price * quantity) as cost
            FROM order_details
            WHERE order_id = '$order_id'";
    //Chạy query
    $order_details = mysqli_query($connect, $sql);
    foreach($order_details as $order_detail){
        $count_money = round($order_detail['cost'], 2);

        // start pay
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

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = $count_money;
        $orderId = time() . "";
        $redirectUrl = "http://localhost/Design/customer/mail/sendmail.php";
        $ipnUrl = "http://localhost/Design/customer/mail/sendmail.php";
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

        //Just a example, please check more in there

        //send mail

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';


        $name = $_SESSION['name'];
        $email = $_SESSION['email_customer'];
        $subject = "New order";
        $message = "You have new order from ";
        echo $name, $email, $subject, $message;

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
        $mail->Body = $message . $email;
        $mail->send();

        header('Location: ' . $jsonResult['payUrl']);
        // end pay
    }
}




?>
