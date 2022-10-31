<?php 

if(isset($_POST['id'])){
 
    require_once 'connection.php';
    $query ="SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['id']]);
    if($stmt -> rowCount() == 0){
        header("Location: index.php");
        die();
    }
    $team = $stmt->fetch();
    $query = "SELECT * FROM user_teams WHERE user_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['user_id']]);

    if($stmt->rowCount() == 0){
        header("Location: index.php");
    }
    
    include 'header.php';
    echo $team['name'];

    include_once 'footer.php';
}else{
    header("Location: index.php");
    die();
}