<?php
        $servername = "localhost";
        $database = "food_deliverydb";
        $username = "root";
        $password = "";
        
    
        // Создаем соединение
        $conn = mysqli_connect($servername, $username, $password, $database);
        $fds = $conn->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
       // mysql_set_charset("utf8");
        // Проверяем соединение
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $conn;
?>