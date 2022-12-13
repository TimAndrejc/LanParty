
<?php
require_once 'connection.php';
if(isset($_POST['id']) && isset($_POST['team'])){
    $query = "DELETE FROM user_teams WHERE user_id = ? && team_id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['id'], $_POST['team']]);
    header("Location: team.php?id=".$_POST['team']);
    die();
}