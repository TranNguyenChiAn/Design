<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <style>
        body {
            background-color: #F5F4F8;
        }

        .form_receiver {
            background-color: #ffffff;
            width:500px;
            height: auto;
            border:1px solid black;
            padding: 10px;
            border-radius: 10px;
            margin: 30px 0 0 33%;
        }
    </style>
    <script>
        function validate() {
            let count = 0;  // khai báo số count để đếm số ô input không được bỏ trống

            //NAME
            let name = document.getElementById('receiver_name').value;
            let regName = /^[A-Za-z àÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬđĐèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆìÌỉỈĩĨíÍịỊòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰỳỲỷỶỹỸýÝỵỴ]+$/;

            // Kiểm tra họ tên có bị bỏ trống hay không
            if(name.length == 0) {
                document.getElementById('error_receiver_name').innerHTML = " * Không được bỏ trống ô";
                count++;
            }
            //Kiểm tra họ tên nhập vào có đúng biểu thức chính quy hay không
            else if(regName.test(name) == false) {
                document.getElementById('error_receiver_name').innerHTML = "Họ tên chỉ được chứa chữ cái và dấu cách";
                count++;
            }
            else {
                document.getElementById('error_receiver_name').innerHTML = "";
            }

            //ADRESS
            let address = document.getElementById('receiver_address').value;
            let regAddress = /^[a-zA-Z0-9\-\/àÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬđĐèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆìÌỉỈĩĨíÍịỊòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰỳỲỷỶỹỸýÝỵỴ,]*$/;

            // Kiểm tra họ tên có bị bỏ trống hay không
            if(address.length == 0) {
                document.getElementById('error_receiver_address').innerHTML = " * Không được bỏ trống ô";
                count++;
            }
            else if(regAddress.test(address) == false) {
                document.getElementById('error_receiver_address').innerHTML = "*Khong hop le";
                count++;
            }
            else {
                document.getElementById('error_receiver_address').innerHTML = "";
            }

            //PHONE
            let phone = document.getElementById('receiver_phone').value;
            let regPhone = /^0[0-9]{9}$/;

            // Kiểm tra họ tên có bị bỏ trống hay không
            if(phone.length == 0) {
                document.getElementById('error_receiver_phone').innerHTML = " * Không được bỏ trống ô";
                count++;
            }
            else if(regPhone.test(phone) == false) {
                document.getElementById('error_receiver_phone').innerHTML = "*Chi duoc chua so";
                count++;
            }
            else {
                document.getElementById('error_receiver_phone').innerHTML = "";
            }

            /* Kiểm tra xem có ô input nào bị bỏ trống không. Nếu count ==0 thì là không có ô input nào bị bỏ trống.
            * count != 0 thì suy ra có nhất 1 ô input nào đó bị bỏ trống */

            if(count != 0) {
                return false;
            }
            return true;
        }
    </script>
    <title> Receiver </title>
</head>
<body>
<?php
include_once "../layout/header.php";
?>
<h2 style="margin: 100px 0 0 36%; color: black; font-weight: bold"> Receiver's Information </h2>
<form class="form_receiver" method="post" action="order.php">
    <br>
    Receiver Name <input type="text" id="receiver_name" name="receiver_name" ><br>
    <span id="error_receiver_name"></span><br>
    Receiver Phone <input type="number" id="receiver_phone" name="receiver_phone" ><br>
    <span id="error_receiver_phone"></span><br>
    Receiver Address <input type="text" id="receiver_address" name="receiver_address"><br>
    <span id="error_receiver_address"></span><br>
    <button class="button add" onclick="return validate()" type="submit">
        Submit
    </button>
</form>
<br>

</body>
</html>
