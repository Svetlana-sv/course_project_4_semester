<?php 


    $connection = include 'connect_db.php';

    $login = '';
    $password = '';
   
    if (isset($_GET['login'])){
        $login = $_GET['login'];
    }
    if (isset($_GET['password'])){
        $password = $_GET['password'];
    }
   
    $password = md5($password."sdf45sdf9s2sfd6");

    $signup=false;

    if($connection->query("INSERT INTO customers(phone_number, password) VALUES('$login','$password')")){
        $signup=true;
    }
   echo json_encode(array('signup' => $signup));

   mysqli_close($connection);

?>

