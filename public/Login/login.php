<?php
include 'database_connect.php';
include 'functions.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $message = login($email, $password);
        if ($message == 'Login successful') {
            header("Location: /Admin");
        }
        else {
            // header('Location: index.php');
            echo "<script>alert('$message');</script>";
            echo "<script>window.location.href = 'index.php';</script>";
        }
    }
    session_start();
    $_SESSION['name'] = $user['name'];
    header("Location: /Admin");
    exit;
?>
