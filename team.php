<?php 

if(isset($_GET['id'])){
    include 'header.php';
    require_once 'connection.php';
    $query ="SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    if($stmt -> rowCount() == 0){
        header("Location: index.php");
        die();
    }
    
    $team = $stmt->fetch();
    $query = "SELECT * FROM user_teams WHERE user_id = ? && team_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id'], $_GET['id']]);

    if($stmt->rowCount() == 0){
        header("Location: index.php");
    }

   
    echo $team['name'];

    include_once 'footer.php';
}else{
    header("Location: index.php");
    die();
}