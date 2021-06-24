<?php
$connection = include 'connect_db.php';
$params;

    if (isset($_GET)){
        $params = $_GET;
    }

$customer_id = $_GET['customer_id'];
$last_name = $_GET['last_name'];
$first_name = $_GET['first_name'];
$middle_name = $_GET['middle_name'];
$city = $_GET['city'];
$street = $_GET['street'];
$house = $_GET['house'];
$flat = $_GET['flat'];
$floor = $_GET['floor'];
$quantity=0;
$payment_method=$_GET['selectedPay'];
$delivery_data=$_GET['selectedDate'];
$products=$params["products"];
$order_id='';
$order_price=$_GET['summ_price']; 
$sql = $connection->query("INSERT INTO orders(customer_id,order_data,payment_method,delivery_data,order_price) VALUES('$customer_id',CURRENT_DATE(),'$payment_method','$delivery_data',$order_price)");


$sql1 = $connection->query("SELECT order_id FROM orders ORDER BY order_id DESC LIMIT 1");

while ($row = $sql1->fetch_assoc()){
    $order_id=$row['order_id'];
}

foreach($products as $product) {
    $json = json_decode($product,true);
    $count = $json['count'];
    $product_id = $json['product_id'];
    $sql = $connection->query("INSERT INTO orders_products(order_id,product_id,quantity) VALUES($order_id,$product_id,$count)");
    echo $count;
  };


$sql = $connection->query("UPDATE customers SET last_name='$last_name', first_name='$first_name',middle_name='$middle_name',city='$city',
    street='$street',house='$house',flat='$flat',floor='$floor' WHERE customer_id = '$customer_id';");
