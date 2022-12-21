<?php
session_start();
if(!isset($_SESSION['id'])){
    header('Location: login.php');
    exit;
}
require_once 'connection.php';
if(isset($_POST['team'])){
    $query = "SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['team']]);
    $team = $stmt->fetch();
    $redirect = "Location: index.php";
    if($_SESSION['id'] != $team['creator_id']){
        if(!isset($_SESSION['admin'])){
            header("Location: index.php");
            die();
        }
        $redirect = "Location: admin.php";
    }
    $query = "DELETE FROM user_teams WHERE team_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['team']]);
    $query = "DELETE FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['team']]);
    header($redirect);
    die();
}