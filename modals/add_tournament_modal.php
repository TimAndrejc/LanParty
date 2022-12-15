<?php
if(isset($_GET['add_to_tourney'])){
    $query = "SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $team = $stmt->fetch();
    if($_SESSION['id'] != $team['creator_id']){
        header("Location: index.php");
        die();
    }


  echo"<script> Swal.fire({
    title: 'Prijava ekipe',
    text: 'Če želite kasneje spremeniti soigralce, se morate najprej odjaviti!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ja!',
    cancelButtonText: 'Prekliči'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Prijavljeno!',
        text: 'Ekipa je bila prijavljena.',
        icon: 'success',
        showConfirmButton: false,
        allowOutsideClick: false,
      })
      $.ajax({
        url: 'add_to_tourney.php',
        type: 'POST',
        data: {
          team: ".$_GET['id']."
        }
      });
      setTimeout(function(){
        window.location.href = 'team.php?id=".$_GET['id']."';
      }, 2000);
     
    }else{
        window.location.href = 'team.php?id=".$_GET['id']."';
    }
  })</script>";
}