<?php
require_once 'connection.php';

if ( !empty($_POST['email'])
        && !empty($_POST['password']) && !empty($_POST['username'])){

    $email = $_POST['email'];
    $email = htmlspecialchars($email);
    $email = trim($email);
    $email = strip_tags($email);
    $email = stripslashes($email);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_POST['password'];

    $username = $_POST['username'];
    $username = trim($username);
    $username = strip_tags($username);
    $username = stripslashes($username);
    $username = htmlspecialchars($username);

            $query = "SELECT * FROM users WHERE email=?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() == 0) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (id, username, email, password, confirmed) VALUES (NULL, ?,?, ?, 0)";

            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $email, $pass]);
            header("Location: login.php?success=awaitEmail");
            }
            else{
                header("Location: register.php?error=AlreadyExists");
            }
    
}
else {
    header("Location: register.php");
}

?>