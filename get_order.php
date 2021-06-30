<?php
     $connection = include 'connect_db.php';

     $customer_id=$_GET['customer_id'];

     $sql = $connection->query("SELECT order_data,payment_method,delivery_data,order_price FROM orders WHERE customer_id='$customer_id'");

     $data = array();

     while ($row = $sql->fetch_assoc()){
         array_push($data,$row);
     }

    
     echo json_encode(array('orders' => $data));
 
     mysqli_close($connection);
?>