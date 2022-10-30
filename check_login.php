<?php
session_start();
require_once 'connection.php';


if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
$password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    
    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];        
            $_SESSION['username'] = $user['username'];      
            header("Location: index.php");
            die();
        }
    }
}
header("Location: login.php?error=error");
?>