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
$st = $stmt->rowCount();
if($team['creator_id'] == $_SESSION['id']){
  include_once 'modals/team_creation_modal.php';
  include_once 'modals/remove_modal.php';
  include_once 'modals/delete_modal.php';
  if($st < 5)
  {
    include_once 'modals/add_teammate_modal.php';
  }
  
}else{
  include_once 'modals/leave_modal.php';
}

echo'<section class="intro">
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5" style="margin-bottom:2rem">
      <div class="card gradient-custom" style="border-radius: 1rem;">
        <div class="card-body p-5 text-white" style="padding:0">
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
            <div class="form-outline form-white mb-4"> '.$teamamates['username'].'
            ';
             if($teamamates['id'] != $_SESSION['id'] && $team['creator_id'] == $_SESSION['id'] && $team['confirmed'] == 0){
              echo'<a href ="team.php?id='.$_GET['id'].'&remove='.$teamamates['id'].'" class ="link-light" /><div style = "float:right; "><i class="bi bi-x"></i></div> </a>';
             }
              echo'
            </div><hr>';
            };
            if($team['creator_id'] == $_SESSION['id']){
              if($st < 5)
              {
                echo'
                <div class="text-center pt-1">
                <a href="team.php?id='.$_GET['id'].'&add=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-person-plus-fill"></i> Dodaj igralca</a>
                </div>';
              }else{
              
             
                if($team['confirmed'] == 0){
                  include 'modals/add_tournament_modal.php';
                  echo'
                  <div class="text-center pt-1">
                  <a href="team.php?id='.$_GET['id'].'&add_to_tourney=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-check"></i> Prijava ekipe na turnir</a>
                  </div>';
                }else{
                  include 'modals/remove_from_tourney_modal.php';
                echo'
                <div class="text-center pt-1">
                <a href="team.php?id='.$_GET['id'].'&remove_from_tourney=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-x-circle-fill"></i> Odjava ekipe</a>
                </div>';
                }
              }
              
              echo'
              <div class = "text-center pt-1">
              <a href="team.php?id='.$_GET['id'].'&delete=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-trash-fill"></i> Izbriši ekipo</a>
              </div> 
              ';
            }else
            if($team['creator_id'] != $_SESSION['id']){
              echo'
              <div class="text-center pt-1">
              <a href="team.php?id='.$_GET['id'].'&leave=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-x"></i> Zapusti ekipo</a>
              </div>
              ';
            }
            echo'
    </div>
  
  </div>
</div>
</div>
</section></body>
</html>';
   


