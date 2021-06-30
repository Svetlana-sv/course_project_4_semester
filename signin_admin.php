<?php 

    session_start();
    $connection = include 'connect_db.php';
     

    $login = '';
    $password = '';
    
    echo $login; 

    if (isset($_GET['login'])){
        $login = $_GET['login'];
    }
    if (isset($_GET['password'])){
        $password = $_GET['password'];
    }

    $password = md5($password."sdf45sdf9s2sfd6");

    $sql = $connection->query("SELECT * FROM administrators WHERE login = '$login' AND password = '$password'");

//SELECT * FROM customers WHERE phone_number = '' or 1=1 /*

    if ($row = $sql->num_rows > 0) {
        $_SESSION["login"] = true;
    }else{
        $_SESSION["login"] = false;
    }

    echo json_encode(array('login'=>$login,'password'=>$password,'session'=> $_SESSION['login']));

    mysqli_close($connection);
?>