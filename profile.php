<?php
include_once 'header.php';
require_once 'connection.php';
if(isset($_GET['id'])){
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_GET['id']]);
  $user = $stmt->fetch();
}else if (isset($_SESSION['id'])){
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$_SESSION['id']]);
  $user = $stmt->fetch();
}else{
  header("Location: index.php");
  exit();
}

?>
<section class="intro">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5" style="margin-bottom:2rem">
            <div class="card gradient-custom" style="border-radius: 1rem;">
              <div class="card-body p-5 text-white" style="padding:0">
                <div class="my-md-5">
                  <div class="text-center pt-1">
                 <i class="bi bi-person-badge fa-3x"></i>
                    <h1 class="fw-bold my-5"><?php echo"".$user['username']."#".$user['tag'];?></h1>
                </div>
              </div>
            <div style ="text-align:center; margin: 0 auto">
            <?php
            if(isset($_SESSION['id'])){
              if($_SESSION['id'] == $user['id']){
                echo '<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://localhost/LanParty/profile.php?id='.$_SESSION['id'].'" alt="profile" style="max-height: 200px; max-width:200px; object-fit: contain; border-radius:8px">';
              }
            }
            ?>
            </div>
</div>
          </div>
        </div>
    </div>
  </div>
  </section>
<?php
include_once 'footer.php';
?>