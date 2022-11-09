<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';

    date_default_timezone_set('Asia/Bangkok');

    try {
        $conn = new PDO("mysql:host=$servername;dbname=futsal", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
        //echo "Connection successful";
    }
    catch (PDOException $e) {
        echo "Connection failed". $e->getMessage();
    }
