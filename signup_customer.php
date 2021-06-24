<?php 


    $connection = include 'connect_db.php';

    $login = '';
    $password = '';
    echo $login,' ',$password;
    if (isset($_GET['login'])){
        $login = $_GET['login'];
    }
    if (isset($_GET['password'])){
        $password = $_GET['password'];
    }
    echo $login,' ',$password;
    $password = md5($password."sdf45sdf9s2sfd6");

    $sql = $connection->query("INSERT INTO customers(phone_number, password) VALUES('$login','$password')");

    echo $login,' ',$password;
