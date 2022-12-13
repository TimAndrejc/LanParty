<?php 
if(!isset($_GET['id'])){
    header('Location: login.php');
    exit;
}
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
$query = "SELECT * FROM user_teams WHERE team_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$_GET['id']]);

echo'<section class="intro">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5" style="margin-bottom:2rem">
      <div class="card gradient-custom" style="border-radius: 1rem;">
        <div class="card-body p-5 text-white" style="padding:0">
          <div class="my-md-5">
            <div class="text-center pt-1">
            <i class="bi bi-people-fill fa-3x"></i>
              <h1 class="fw-bold my-5 text-uppercase">'.$team['name'].'</h1>
            </div>';
            foreach($stmt as $teammates)
            {
                $query ="SELECT* FROM users WHERE id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$teammates['user_id']]);
                $teamamates = $stmt->fetch();

            echo '
            <div class="form-outline form-white mb-4">
            '.$teamamates['username'].' <a href ="remove.php" class ="link-light" /><div style = "float:right; "><i class="bi bi-x"></i></div> </a>
            </div><hr>';
            };
            echo'
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section>';
   




include_once 'footer.php';
