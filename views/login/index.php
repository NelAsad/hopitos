<!-- 
/**
 * Copyright (c) 2019, Innovate For Future Tech.
 * Powered by Elysée Asad Luboya
 * Soft-Mat
 * 
 * @package   Soft-Mat
 * @author    Elysée Asad Luboya (email:nel7luboya@gmail.com, Tél:+243 819664909)
 * @copyright Copyright (c) 2019, Innovate For Future Tech.  (http://innovateforfuture.com)
 * @since     Version 1.3.0
 */
 -->

<!DOCTYPE html>
<html lang="fr">

<head>
  <title>HOSPITALIA</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/ico" href="<?php echo URL; ?>public/template/production/images/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/templates/login/css/main.css">
  <!--===============================================================================================-->
</head>

<body>

  <div class="limiter">
    <div class="container-login100" style="background-image: url('http://localhost/hopitos/public/templates/login/images/fond11.jpg'); background-size:cover;">
      <div class="wrap-login100" style="border-radius: 0px;">
        <form action="<?php echo URL; ?>login/connect" method="POST" class="login100-form validate-form">

        <?php
              if (isset($this->notification)) {
                  if ($this->notification == 'c_pas_ton_compte') {
                      $message = '
                          <div role="alert" class="alert alert-danger alert-dismissible">
                              <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                              Le login et le mot de passe saisis ne correspondent à aucun compte.
                          </div>
                              ';
                      echo $message;
                  }
                  if ($this->notification == 'champs_vide') {
                      $message = '
                          <div role="alert" class="alert alert-danger alert-dismissible">
                              <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                              Veillez remplir tout les champs.
                          </div>
                              ';
                      echo $message;
                  }
              }
        ?>


          <div class="wrap-input100 validate-input" data-validate="Entrez votre login">
            <span class="btn-show-pass">
              <i class="fa fa-user"></i>
            </span>
            <input class="input100" type="text" name="login" value="<?php if(isset($this->login)) echo $this->login; ?>" >
            <span class="focus-input100" data-placeholder="Login"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate="Entrez votre mot de passe">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Mot de passe"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn" style="border-radius: 0px;">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                Connexion
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo URL; ?>public/templates/login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/vendor/daterangepicker/moment.min.js"></script>
  <script src="<?php echo URL; ?>public/templates/login/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="<?php echo URL; ?>public/templates/login/js/main.js"></script>

</body>

</html>