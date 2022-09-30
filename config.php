<?php
    $db_name = "mysql:host=localhost;dbname=inspection-app";
    $username = "root";
    $password = "";

    try{
        $conn = new PDO($db_name, $username, $password);
    } catch(PDOException $e){
        throw new PDOException($e->getMessage());
    }
    
?>