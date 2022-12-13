<?php
include_once 'header.php';
if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}
if(!isset($_POST['TeamName'])){
    header("Location: create_team.php");
    exit();
}
if(strlen($_POST['TeamName']) < 3){
    header("Location: create_team.php?TeamCreated=short");
    exit();
}
try {
    require_once 'connection.php';
    $TeamName = $_POST['TeamName'];
    $TeamName = trim($TeamName);
    $TeamName = strip_tags($TeamName);
    $TeamName = stripslashes($TeamName);
    $TeamName = htmlspecialchars($TeamName);

    $query = "SELECT * FROM teams WHERE name = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$TeamName]);
    if($stmt->rowCount() > 0){
        header("Location: create_team.php?TeamCreated=taken");
        exit();
    }
    $query = "SELECT * FROM teams WHERE creator_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    if($stmt->rowCount() > 0){
        header("Location: index.php?TeamCreated=already");
        exit();
    }
    $query ="INSERT INTO teams (name, creator_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$TeamName, $_SESSION['id']]);
    $team_id = "SELECT * FROM teams WHERE creator_id = ? && name = ?";
    $stmt = $pdo->prepare($team_id);
    $stmt->execute([$_SESSION['id'], $TeamName]);
    $team_id = $stmt->fetch();
    $query = "INSERT INTO user_teams (user_id, team_id) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id'], $team_id['id']]);
    $query ="SELECT * FROM teams WHERE creator_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_SESSION['id']]);
    $team = $stmt->fetch();
    $team = $team['id'];
    header("Location:team.php?id=$team&TeamCreated=success");
    exit();
} catch (PDOException $e) {
    header("Location: create_team.php?TeamCreated=failed");
    exit();
}
