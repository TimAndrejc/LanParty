<?php
include 'header.php';
if(!isset($_SESSION['admin'])){
    header('Location: index.php');
    exit;
}
require_once 'connection.php';

$query = "SELECT * FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();
$userCount = $stmt->rowCount();
$query = "SELECT * FROM teams WHERE confirmed = 1";
$stmt = $pdo->prepare($query);
$stmt->execute();
$stp = $stmt->rowCount();
$teams = $stmt->fetchAll();
$query = "SELECT * FROM teams WHERE confirmed = 0";
$stmt = $pdo->prepare($query);
$stmt->execute();
$teams2 = $stmt->fetchAll();
?>
<div class="container" style ="color:white">
    <div class="row">
        <div class="col-md-12">
            <h1>Uporabniki - <?php echo $userCount; ?></h1>
            <h1>Ekipe - <?php echo $stp; ?></h1>
            <table class="table" style ="color:white">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Ustvarjalec</th>
                        <th>Izbris</th>
                        <th>Ogled</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($teams as $team){
                        $query = "SELECT * FROM users WHERE id = ?";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$team['creator_id']]);
                        $user = $stmt->fetch();
                        echo '<tr>';
                        echo '<td>'.$team['name'].'</td>';
                        echo '<td>'.$user['username'].'</td>';
                        echo '<td><button class="btn btn-danger" onclick="deleteTeam('.$team['id'].')">Izbris</button></td>';
                        echo '<td><a href="team.php?id='.$team['id'].'" class="btn btn-primary">Ogled</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

