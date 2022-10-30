<?php
require_once 'header.php';
?>

<section class="intro">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card gradient-custom" style="border-radius: 1rem;">
              <div class="card-body p-5 text-white" style="padding:0">
                <div class="my-md-5">
                  <div class="text-center pt-1">
                 <i class="fa-solid fa-gamepad fa-3x"></i>
                    <h1 class="fw-bold my-5 text-uppercase">prijava</h1>
                  </div>
                  <div class="form-outline form-white mb-4">
                    <input type="email" id="typeEmail" class="form-control form-control-lg active" />
                    <label class="form-label" for="typeEmail">Email</label>
                  </div>
                  <div class="form-outline form-white mb-4">
                    <input type="password" id="typePassword" class="form-control form-control-lg active" />
                    <label class="form-label" for="typePassword">Password</label>
                  </div>
                  <div class="text-center py-5">
                    <button class="btn btn-light btn-lg btn-rounded px-5" type="submit">Login</button>
                  </div>
                </div>
                <div class="text-center">
                  <p class="mb-0"><a href="#!" class="text-white fw-bold">Pozabljeno geslo?</a></p>
                </div>

              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>

<?php
require_once 'footer.php';
?>