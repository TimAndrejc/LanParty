
<?php
require_once 'header.php';
?>
<form action="push_team.php" method="post">
<section class="intro">
   <div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5" style="margin-bottom:2rem">
            <div class="card gradient-custom" style="border-radius: 1rem;">
            <div class="card-body p-5 text-white" style="padding:0">
                <div class="my-md-5">
                <div class="text-center pt-1">
                    <i class="fa-solid fa-gamepad fa-3x"></i>
                    <h1 class="fw-bold my-5 text-uppercase">registracija ekipe</h1>
                </div>
                <div class="form-outline form-white mb-4">
                    <input type="text" name="TeamName" id="typeEmail" minlength= "3" maxlength="50"   placeholder="Vnesi ime ekipe" class="form-control form-control-lg active" />

                    <label class="form-label text-white" style ="font-weight: bold" for="typeEmail">Ime Ekipe</label>
                </div>
                <div class="text-center py-5" style="padding:5px !important">
                    <button class="btn btn-light btn-lg btn-rounded px-5" type="submit">Ustvari</button>
                  </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</section>
</form>
<?php  
require_once 'footer.php';
?>

