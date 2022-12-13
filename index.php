<?php require_once 'header.php'; 
if(isset($_GET['prijava'])){
    echo "<script>Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Prijava uspešna!',
        background: '#fff',
        showConfirmButton: false,
        timer: 1000
      });</script>";
  }

?>
<div class="slideshow-container" style="width:100%">


  <div class="mySlides fade" style="width:100%" >

    <img src="pics/1.png" style="width:100%">
  </div>

  <div class="mySlides fade" >

    <img src="pics/2.png" style="width:100%">

  </div>

  <div class="mySlides fade" >

    <img src="pics/3.png" style="width:100%">

  </div>


  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>


<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
<script src="js/custom.js"></script>



<?php require_once 'footer.php'; 
?>
