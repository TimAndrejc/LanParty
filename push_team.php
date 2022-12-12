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
try {
    require_once 'connection.php';
    $TeamName = $_POST['TeamName'];
    $TeamName = trim($TeamName);
    $TeamName = strip_tags($TeamName);
    $TeamName = stripslashes($TeamName);
    $TeamName = htmlspecialchars($TeamName);
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
    header("Location: index.php?TeamCreated=success");
    exit();
} catch (PDOException $e) {
    header("Location: index.php?TeamCreated=failed");
    exit();
}
