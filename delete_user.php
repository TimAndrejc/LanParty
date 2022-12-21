<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('Location: index.php');
    exit;
}
if(!isset($_POST['user'])){
    header('Location: index.php');
    exit;
}
require_once 'connection.php';
$query = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_POST['user']]);
header('Location: admin.php');
exit;