a<?php
//Cho phép làm việc với session
session_start();
//Kiểm tra đã tồn tại số đth trên session hay chưa, nếu chưa tồn tại thì cho quay về account
if(!isset($_SESSION['email_admin'])){
    //Quay về trang account
    header("Location: ../account/login_admin.php");
}

?>
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
        body{
            background-color: #F5F4F8;
        }
    </style>
    <title> Manage Clothes </title>
</head>
<body>
<?php
include_once "../layout/navigation.php";
//Mở kết nối
include_once '../connect/open.php';
?>

<section class="main_content">
    <!-- LIST -->
    <p class="table_title"> DISCOUNT </p>
    <form method="post" action="process.php">
        <table class="table-admin" border="0" cellspacing="0" cellpadding="10" width="100%" style="font-size: 12px">
            <tr>
                <th></th>
                <th class="t-heading" align="left"> ID </th>
                <th class="t-heading" align="left"> Name </th>
                <th class="t-heading" align="left"> Image </th>
                <th class="t-heading" align="left"> Size </th>
                <th class="t-heading" align="left"> Color </th>
                <th class="t-heading" align="left"> Import </th>
                <th class="t-heading" align="left"> Price </th>
                <th></th>
            </tr>
            <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset($_POST['myCheckbox'])){
                    foreach($_POST['myCheckbox'] as $result){
                        //Query để lấy dữ liệu từ bảng classes trên db về
                        $sql = "SELECT * FROM clothes WHERE id = '$result'";
                        //Chạy query
                        $clothes = mysqli_query($connect, $sql);
                        foreach($clothes as $clothe) {
                            ?>
                            <tr class="record">
                                <td>
                                    <input type="checkbox" name="myCheckbox[]" value="<?= $clothe['id']?>" checked>
                                </td>
                                <td>
                                    <?= $clothe['id']?>
                                </td>
                                <td>
                                    <?= $clothe['name']?>
                                </td>
                                <td>
                                    <img width="50px" src="../../image/<?= $clothe['image'] ?>">
                                </td>
                                <td>
                                    <?= $clothe['size']?>
                                </td>
                                <td>
                                    <?= $clothe['color']?>
                                </td>
                                <td>
                                    <input type="number" name="import" min="10">
                                </td>
                                <td>
                                    <?= $clothe['price']?>
                                </td>
                            </tr>
            <?php
                        }
                    }
                }
            }
            ?>
        </table>

        <button type="submit" class="btn add btn-primary">
            Import
        </button>
    </form>
    <br>
    <section class="main_content">
        <br>

</body>
</html>

<?php
/*$discount = $_POST['discount'];
$sql = "UPDATE clothes SET price = price - (price * ('$discount'/100))";
$clothes = mysqli_query($connect, $sql);
header("Locaction: index.php");
*/?>
