<?php

session_start();
$connection = include 'connect_db.php';


$login = '';
$password = '';

$data = array();

if (isset($_GET['login'])) {
    $login = $_GET['login'];
}
if (isset($_GET['password'])) {
    $password = $_GET['password'];
}

$password = md5($password . "sdf45sdf9s2sfd6");

$sql = $connection->query("SELECT * FROM customers WHERE phone_number = '$login' AND password = '$password'");

$row = $sql->fetch_assoc();


if ($row) {
    $_SESSION["login"] = true;
    $data = $row;
} else {
    $_SESSION["login"] = false;
}

echo json_encode(array('data' => $data, 'session' => $_SESSION['login']));
