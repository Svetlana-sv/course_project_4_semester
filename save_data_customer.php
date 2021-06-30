<?php
$connection = include 'connect_db.php';

$customer_id = $_GET['customer_id'];
$last_name = $_GET['last_name'];
$first_name = $_GET['first_name'];
$middle_name = $_GET['middle_name'];
$city = $_GET['city'];
$street = $_GET['street'];
$house = $_GET['house'];
$flat = $_GET['flat'];
$floor = $_GET['floor'];


$sql = $connection->query("UPDATE customers SET last_name='$last_name', first_name='$first_name',middle_name='$middle_name',city='$city',
    street='$street',house='$house',flat='$flat',floor='$floor' WHERE customer_id = '$customer_id';");

mysqli_close($connection);

?>
