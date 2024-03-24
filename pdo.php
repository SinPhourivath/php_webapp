<?php
    $dsn = "mysql:host=localhost;dbname=note_app";
    $user = "root";
    $pass = "";
    try {
        $pdo = new PDO($dsn, $user, $pass);
    } catch (PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>