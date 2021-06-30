<?php
     $connection = include 'connect_db.php';

     $sql = $connection->query("select p.product_id, p.product_name, p.product_discription, t.shop_name,c.category_name,p.product_image,p.price,p.quantity_name,p.category_id,p.shop_id from products p 
     join shops t on p.shop_id =t.shop_id 
     join categories c on p.category_id =c.category_id ");
   
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
    
     echo json_encode(array('products' => $data, 'categories' => $data2, 'shops' => $data3));
    
 
     mysqli_close($connection);
?>