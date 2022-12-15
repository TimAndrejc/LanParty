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
    if($_SESSION['id'] != $team['creator_id']){
        header("Location: index.php");
        die();
    }
    $conf = 1;
    if($team['confirmed'] == 1){
        $conf = 0;
    }
    $query = "UPDATE teams SET confirmed = ? WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$conf, $_POST['team']]);
    header("Location: index.php");
    die();
}