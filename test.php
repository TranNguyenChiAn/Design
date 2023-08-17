<form method="post" action="">
    <input type="text" name="pass">
    <input type="submit">
</form>
<?php
$password = $_POST['pass'];
echo md5(md5($password));
?>

