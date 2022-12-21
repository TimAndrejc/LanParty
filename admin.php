<?php
include 'header.php';
if(!isset($_SESSION['admin'])){
    header('Location: index.php');
    exit;
}
require_once 'connection.php';

$query = "SELECT * FROM teams WHERE confirmed = 1";
$stmt = $pdo->prepare($query);
$stmt->execute();
$stp = $stmt->rowCount();
$teams = $stmt->fetchAll();
$query = "SELECT * FROM teams WHERE confirmed = 0";
$stmt = $pdo->prepare($query);
$stmt->execute();
$teams2 = $stmt->fetchAll();
$query = "SELECT* FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();
$userCount = $stmt->rowCount();
require_once 'modals/delete_modal.php';
?>

<div class="container" style ="color:white">
    <div class="row">
        <div class="col-md-12">
            <br>
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
                        echo '<td><a href="admin.php?delete=true&id='.$team['id'].'"><button class="btn btn-danger">Izbris</button></a></td>';
                        echo '<td><a href="team.php?id='.$team['id'].'" class="btn btn-primary">Ogled</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table><br>
            <h1>Ne potrjene ekipe - <?php echo count($teams2); ?></h1>
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
                    foreach($teams2 as $team){
                        $query = "SELECT * FROM users WHERE id = ?";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute([$team['creator_id']]);
                        $user = $stmt->fetch();
                        echo '<tr>';
                        echo '<td>'.$team['name'].'</td>';
                        echo '<td>'.$user['username'].'</td>';
                        echo '<td><a href="admin.php?delete=true&id='.$team['id'].'"><button class="btn btn-danger">Izbris</button></a></td>';
                        echo '<td><a href="team.php?id='.$team['id'].'" class="btn btn-primary">Ogled</a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table><br>
            <h1>Uporabniki - <?php echo $userCount ?></h1>
            <table class="table" style ="color:white">
                <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Ustvarjalec</th>
                        <th>Izbris</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($users as $user){
                        echo '<tr>';
                        echo '<td>'.$user['username'].'</td>';
                        echo '<td>'.$user['email'].'</td>';
                        echo '<td><a href="admin.php?deleteUser=true&userId='.$user['id'].'"> <button class="btn btn-danger">Izbris</button></a></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

