<!DOCTYPE HTML>
<html>

<head>
<title> ERŠ - LAN Party </title>
<favicon href="pics/logo.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/custom.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"
  rel="stylesheet"
/>

</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-dark" id="neubar">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img style ="width:150px; height: 75px" src="pics/logo2.png"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span>
      </button>
     
      <div class=" collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto "> 
          <?php
          require_once 'connection.php';
          session_start();
          if(!isset($_SESSION['id'])){
          echo'
          <li class="nav-item">
            <a class="nav-link mx-2" href="login.php">Prijava</a>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2" href="register.php">Registracija</a>
            </a>
          </li>';}
          else{
            // pdo check if user is in a team or is the creator of one  
            $sql = "SELECT t.* FROM teams t INNER JOIN user_teams ut ON t.id = ut.team_id  WHERE t.creator_id = ? OR ut.user_id = ?";
            $stmt = $pdo->prepare($sql);
            $id = $_SESSION['id'];
            $stmt->execute([$id, $id]);
            if($stmt -> rowCount() == 0){
              echo'
              <li class="nav-item">
                <a class="nav-link mx-2" href="create_team.php">Ustvari ekipo</a>
                </a>
              </li>';
            }
            else{
              $team = $stmt->fetch();
              echo'
              <li class="nav-item">
                <a class="nav-link mx-2" href="team.php?id='.$team['id'].'">'.$team['name'].'</a>
              </li>';
            }
            echo'
          <li class="nav-item">
            <a class="nav-link mx-2" href="logout.php">Odjava</a>
            </a>
          </li>';
          }

          ?>
          <li class="nav-item">
            <a class="nav-link mx-2" href="info.php">Informacije</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
