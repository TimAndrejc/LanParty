<?php 
if(!isset($_GET['id'])){
    header('Location: login.php');
    exit;
}
include 'header.php';
require_once 'connection.php';
if(isset($_GET['add'])){
  if($_GET['add'] == 'true'){
    echo "<script>Swal.fire({
      title: 'Poišči igralca',
      input: 'text',
      inputAttributes: {
        autocapitalize: 'off'
      },
      showCancelButton: true,
      confirmButtonText: 'Dodaj',
      cancelButtonText: 'Prekliči',
      showLoaderOnConfirm: true,
      preConfirm: (user) => {
        return fetch(`add.php?user=${user}&team=".$_GET['id']."`)
          .then(response => {
            if (!response.ok) {
              throw new Error(response.statusText)
            }
            return response.json()
          })
          .catch(error => {
          })
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Dodan/a!',
          'Igralec je dodan v ekipo.',
          'success'
        )
      }
    });</script>";
}
}


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
if($team['creator_id'] == $_SESSION['id'] && $st < 5){
  
  include_once 'remove_modal.php';
  include_once 'delete_modal.php';
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
             if($teamamates['id'] != $_SESSION['id'] && $team['creator_id'] == $_SESSION['id']){
              echo'<a href ="team.php?id='.$_GET['id'].'&remove='.$teamamates['id'].'" class ="link-light" /><div style = "float:right; "><i class="bi bi-x"></i></div> </a>';
             }
              echo'
            </div><hr>';
            };
            if($team['creator_id'] == $_SESSION['id'] && $st < 5){
              echo'
              <div class="text-center pt-1">
              <a href="team.php?id='.$_GET['id'].'&add=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-person-plus-fill"></i> Dodaj igralca</a>
              </div>
              <div class = "text-center pt-1">
              <a href="team.php?id='.$_GET['id'].'&delete=true" class="btn btn-outline-light btn-lg" style="border-radius: 2rem;"> <i class="bi bi-trash-fill"></i> Izbriši ekipo</a>
              </div> 
              ';
            }
            echo'
    </div>
  
  </div>
</div>
</div>
</section>';
   




include_once 'footer.php';
