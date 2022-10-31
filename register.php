<?php
require_once 'header.php';
?>
<form action="push_registration.php" method="post"> 
<section class="intro">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card gradient-custom" style="border-radius: 1rem;">
              <div class="card-body p-5 text-white" style="padding:0">
                <div class="my-md-5">
                  <div class="text-center pt-1">
                 <i class="fa-solid fa-gamepad fa-3x"></i>
                    <h1 class="fw-bold my-5 text-uppercase">registracija</h1>
                  </div>
                  <div class="form-outline form-white mb-4">
                    <input type="email" name="email" id="typeEmail" maxlength="50"  autocomplete="email" placeholder="Napiši email ..." class="form-control form-control-lg active" />
                    <label class="form-label" for="typeEmail">Email</label>
                  </div>
                  <div class="form-outline form-white mb-4">
                    <input type="text" name="username" id="typeEmail" maxlength="15" placeholder="Napiši uporabniško ime ..." class="form-control form-control-lg active" />
                    <label class="form-label" for="typeEmail">Uporabniško ime</label>
                  </div>
                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePassword" placeholder="Napiši geslo ..." name="password" class="form-control form-control-lg active" />
                    <label class="form-label" for="typePassword">Geslo</label>
                  </div>
                  <div class="text-center py-5">
                    <button class="btn btn-light btn-lg btn-rounded px-5" type="submit">Registracija</button>
                  </div>
                </div>
                <div class="text-center">
                <p class="mb-0"><a href="login.php" class="text-white fw-bold">Že imaš račun?</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
<form>

<?php
require_once 'footer.php';
?>