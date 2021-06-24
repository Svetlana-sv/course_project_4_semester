<?php
     $connection = include 'connect_db.php';

     $sql = $connection->query("SELECT *,1 as count FROM products");
     $sql1  = $connection->query("SELECT * FROM categories");
     $sql2  = $connection->query("SELECT * FROM shops");

     $data = array();
     $data2 = array(); 
     $data3 = array(); 

     while ($row = $sql->fetch_assoc()){
         array_push($data,$row);
     }

     while ($row = $sql1->fetch_assoc()){
        array_push($data2,$row);
    }

    while ($row = $sql2->fetch_assoc()){
        array_push($data3,$row);
    }
    
     echo json_encode(array('products' => $data, 'category_products' => $data2, 'shops' => $data3));
 
     mysqli_close($connection);
?>