<?php
session_start();
include_once "../connect/open.php";

$customer_id = $_SESSION['id'];
//query lấy max_order_id
$sqlMaxOrderId = "SELECT MAX(id) AS max_order_id FROM orders WHERE customer_id = '$customer_id'";
//Chạy query lấy max_order_id
$maxOrderIds = mysqli_query($connect, $sqlMaxOrderId);
foreach ($maxOrderIds as $maxOrderId) {
    $order_id = $maxOrderId['max_order_id'];
    //Query
    $sql = "SELECT order_details.order_id, SUM(order_details.price * order_details.quantity) as cost,
                    customers.name as customer_name
            FROM orders
            INNER JOIN order_details ON order_details.order_id = orders.id
            INNER JOIN customers ON orders.customer_id = customers.id
            WHERE order_id = '$order_id'";
    //Chạy query
    $orders = mysqli_query($connect, $sql);
    foreach($orders as $order){
        $count_money = round($order['cost'], 2);

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

        //Just an example, please check more in there

        // end pay
    }
}
header('Location: ' . $jsonResult['payUrl']);

?>