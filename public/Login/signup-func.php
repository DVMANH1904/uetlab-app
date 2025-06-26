<?php
include 'database_connect.php'; 
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $message = signup($name, $email, $password);
    if($message='Signup successful'){       
        header('Location: index.php');
    }
}
?>



