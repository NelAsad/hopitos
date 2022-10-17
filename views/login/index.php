<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HOSPITALIA | Connexion </title>

    <!-- Bootstrap -->
    <link href="<?php echo URL; ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo URL; ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo URL; ?>public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo URL; ?>public/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo URL; ?>public/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo URL; ?>login/connect" method="POST">
              <h1> MEDICAL CITY ADH </h1>
              
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

              <div>
                <input type="text" class="form-control" name="login" value="<?php if(isset($this->login)) echo $this->login; ?>" placeholder="Nom d'utilisateur" required/>
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required />
              </div>
              <div>
                <button class="btn btn-primary btn-block" type="submit" >Connexion</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div>
                  <!-- <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1> -->
                  <br><br><br><br><br>
                  <p>Designed By Braintis Technology. ©2022 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
  </body>
</html>
