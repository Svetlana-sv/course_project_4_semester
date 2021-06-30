<?php
$connection = include 'connect_db.php';


	

// error_reporting(E_ALL & ~E_NOTICE);

$product_id = $_GET['product_id'];
$product_name = $_GET['product_name'];
$product_discription = $_GET['product_discription'];
$shop_name = $_GET['shop_name'];
$category_name = $_GET['category_name'];
$product_image = $_GET['product_image'];
$price = $_GET['price'];
$quantity_name = $_GET['quantity_name'];


// if (isset($_GET['login'])){
//     $login = $_GET['login'];
// }
// if (isset($_GET['password'])){
//     $password = $_GET['password'];
// }


// $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
// $product_name = isset($_GET['product_name']) ? $_GET['product_name'] : null;
// $product_discription = isset($_GET['product_discription']) ? $_GET['product_discription'] : null;
// $shop_name = isset($_GET['shop_name']) ? $_GET['shop_name'] : null;
// $category_name = isset($_GET['category_name']) ? $_GET['category_name'] : null;
// $product_image = isset($_GET['product_image']) ? $_GET['product_image'] : null;
// $price = isset($_GET['price']) ? $_GET['price'] : null;
// $quantity_name = isset($_GET['quantity_name']) ? $_GET['quantity_name'] : null;


//https://static.tildacdn.com/tild3333-6362-4031-a631-623532386533/banan_1.png
$sql = $connection->query("UPDATE products SET product_name='$product_name', product_discription='$product_discription',shop_id=$shop_name,category_id=$category_name,
    product_image='$product_image',price=$price,quantity_name='$quantity_name' WHERE product_id = '$product_id';");
    

    
// $params;

// if (isset($_GET)){
//     $params = $_GET;
// }
// foreach($params as $key => $t){
//     $j = json_decode($t,true);
// $product_id = $j['product_id'];
// $product_name = $j['product_name'];
// $product_discription = $j['product_discription'];
// $shop_name = $j['shop_name'];
// $category_name = $j['category_name'];
// $product_image = $j['product_image'];
// $price = $j['price'];
// $quantity_name = $j['quantity_name'];
// $sql = $connection->query("UPDATE products SET product_name='$product_name', product_discription='$product_discription',shop_name='$shop_name',category_name='$category_name',
// product_image='$product_image',price='$price',quantity_name='$quantity_name' WHERE product_id = '$product_id';");
// }


// echo $category_name;



// echo $sql;
mysqli_close($connection);
?>
