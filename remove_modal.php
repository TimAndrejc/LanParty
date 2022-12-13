<?php
if(isset($_GET['remove'])){
    if($_SESSION['id'] == $_GET['remove']){
        header("Location: index.php");
        die();
    };

    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_GET['remove']]);
    if($stmt->rowCount() == 0){
        header("Location: index.php");
        die();
    }
    $user = $stmt->fetch();
  echo"<script> Swal.fire({
    title: 'Odstrani ".$user['username']."?',
    text: 'Si prepričan/a da želiš odstraniti igralca iz ekipe?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ja!',
    cancelButtonText: 'Prekliči'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Odstranjen/a!',
        '".$user['username']." je bil/a odstranjen/a iz ekipe.',
        'success',
      )
      $.ajax({
        url: 'remove.php',
        type: 'POST',
        data: {
          id: ".$_GET['remove'].",
          team: ".$_GET['id']."
        }
      });
      setTimeout(function(){
        window.location.href = 'team.php?id=".$_GET['id']."';
      }, 2000);
    }
  })</script>";
}