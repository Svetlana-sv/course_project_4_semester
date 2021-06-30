<?php

session_start();//начало сессии
$connection = include 'connect_db.php';

$login = '';
$password = '';

$data = array();

if (isset($_GET['login'])) {//проверка лолгина пользователя
    $login = $_GET['login'];//получение лолгина пользователя
}
if (isset($_GET['password'])) {//проверка пароля пользователя
    $password = $_GET['password'];//получение пароля пользователя
}

$password = md5($password . "sdf45sdf9s2sfd6");//хеширование пароля

$sql = $connection->query("SELECT * FROM customers WHERE phone_number = '$login' AND password = '$password'");//отправление запроса 

$row = $sql->fetch_assoc();


if ($row) {
    $_SESSION["login"] = true;//если есть совпадения, пользователь считается авторизированным
    $data = $row;//получение данных пользователя из БД
} else {
    $_SESSION["login"] = false;
}

echo json_encode(array('data' => $data, 'session' => $_SESSION['login']));//передача данных клиенту
?>



