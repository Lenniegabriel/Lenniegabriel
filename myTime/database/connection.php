<?php
    $serverName = "mysql:host=localhost;dbname=ktutimetable";
    $userName = "root";
    $password = "";
    try{
        $conn = new PDO($serverName, $userName, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){

    }


