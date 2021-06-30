<?php
$connection = include 'connect_db.php';


$product_name = $_GET['product_name'];
$product_discription = $_GET['product_discription'];
$shop_name = $_GET['shop_name'];
$category_name = $_GET['category_name'];
$product_image = $_GET['product_image'];
$price = $_GET['price'];
$quantity_name = $_GET['quantity_name'];


$sql = $connection->query("INSERT INTO products(product_name,product_discription,shop_id,category_id,price,product_image,quantity_name) VALUES ('$product_name','$product_discription',$shop_name,$category_name,
    $price,'$product_image','$quantity_name')");

mysqli_close($connection);

?>