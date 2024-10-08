<?php 
    $host = 'localhost';
    $db = 'learning_php';
    $user = 'learning-php';
    $pass = 'php123';

    # data source name
    $dsn = "mysql:host=$host;dbname=$db";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    try {
        $pdoConn = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>