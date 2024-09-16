<?php

$dsn = 'mysql:dbname=cdpi-sql;host=127.0.0.1;port=8889';
$user = 'root';
$password = 'root';


try {
    $conn = new PDO($dsn, $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }