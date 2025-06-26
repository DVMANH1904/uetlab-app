<?php
function signup($name, $email, $password) {
    global $pdo;

    // check email
    try {
        $stmt = $pdo->prepare("SELECT * FROM `Users` WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) {
            return 'Email already exists';
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Thêm người dùng vào cơ sở dữ liệu
        $stmt = $pdo->prepare("INSERT INTO Users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword]);
        return 'Signup successful';
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
    
}
function login($email, $password) {
    global $pdo;

    if (empty($email) || empty($password)) {
        return 'Email and password are required';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email format';
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM `Users` WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() == 0) {
            return 'Invalid email or password';
        }

        $User = $stmt->fetch(PDO::FETCH_ASSOC);


        if (password_verify($password, $User['password'])) {
            return 'Login successful';
        } else {
            return 'Invalid email or password';
        }
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}
?>