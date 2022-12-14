
<?php
require_once 'connection.php';
session_start();
if(isset($_POST['id']) && isset($_POST['team'])){
    $query = "SELECT * FROM teams WHERE creator_id = ? && id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id'], $_POST['team']]);
    if($stmt->rowCount() == 0){
        header("Location: index.php");
        die();
    }
    $query = "DELETE FROM user_teams WHERE user_id = ? && team_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['id'], $_POST['team']]);
    header("Location: team.php?id=".$_POST['team']);
    die();
}else{
    header("Location: index.php");
    die();
}