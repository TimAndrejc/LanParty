<?php
if(isset($_GET['delete'])){
    $query = "SELECT * FROM teams WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['id']]);
    $team = $stmt->fetch();
    $redirect = "team.php?id=".$_GET['id'];
    if($_SESSION['id'] != $team['creator_id']){
      if(!isset($_SESSION['admin'])){
        header("Location: index.php");
        die();
      }
      $redirect = "admin.php";
    }


  echo"<script> Swal.fire({
    title: 'Izbris ekipe?',
    text: 'Si prepričan/a da želiš izbrisati ekipo?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ja!',
    cancelButtonText: 'Prekliči'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: 'Izbrisano!',
        text: 'Skupina je bila izbrisana.',
        icon: 'success',
        showConfirmButton: false,
        allowOutsideClick: false,
      })
      $.ajax({
        url: 'delete_team.php',
        type: 'POST',
        data: {
          team: ".$_GET['id']."
        }
      });
      setTimeout(function(){
        window.location.href = 'index.php';
      }, 2000);
     
    }else{
        window.location.href = '".$redirect."';
    }
  })</script>";
}