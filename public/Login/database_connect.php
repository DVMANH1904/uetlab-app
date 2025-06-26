<?php
$host = 'localhost';  
$port = 3306;
$dbname = 'login';
$username = 'admin';   
$password = '270502';  

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection Successfuly\n";
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
