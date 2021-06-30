<?php
$connection = include 'connect_db.php';


$id = $_GET['product_id'];



$sql = $connection->query("DELETE FROM products WHERE product_id = '$id'");

mysqli_close($connection);
?>
