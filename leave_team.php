<?php
session_start();
if(isset($_POST['team'])){
    require_once 'connection.php';
    $query = "SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['team']]);
    $team = $stmt->fetch();
    if($_SESSION['id'] == $team['creator_id']){
        echo "failed";
        die();
    }
    $query = "DELETE FROM user_teams WHERE user_id = ? AND team_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id'], $_POST['team']]);
    if($stmt->rowCount() == 0){
        echo "failed";
        die();
    }
    echo "success";
    die();
}
else{
    header("Location: index.php");
    die();
}