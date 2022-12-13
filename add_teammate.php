<?php
require_once 'connection.php'; 

if(isset($_POST['username']) && isset($_POST['tag']) && isset($_POST['team_id'])){
    $username = $_POST['username'];
    $tag = $_POST['tag'];
    $sql = "SELECT * FROM users WHERE username = ? AND tag = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([ $username, $tag]);
    $user = $stmt->fetch();
    $query = "SELECT * FROM user_teams WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$user['id']]);
    if($stmt->rowCount() > 0){
        echo 'false';
        return;
    }
    if($user){
        $sql = "INSERT INTO user_teams (user_id, team_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user['id'], $_POST['team_id']]);
        echo 'true';
    } else {
        echo 'false';
    }
}
