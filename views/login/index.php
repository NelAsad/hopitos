<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HOSPITALIA | CONNEXION</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- <body class="hold-transition login-page" style="background: #e7e7e7;"> -->
<body class="hold-transition login-page" style="background: #2f2772;">
<div class="login-box" >
  <div class="login-logo">
    <img src="<?php echo URL; ?>public/images/logo4.png" alt="" width="80">
    <a href="#" style="color: #fff;"><b>MEDICAL CITY ADH</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="height: 330px; padding-left: 40px; padding-right: 40px;">
    <p class="login-box-msg" style="margin-bottom: 25px; font-size: 20px; padding-bottom: 5px;">BIENVENUE!</p>

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

    <form action="<?php echo URL; ?>login/connect" method="POST">
      <div class="form-group has-feedback">
        <input style="height: 50px;" type="text" class="form-control" name="login" value="<?php if(isset($this->login)) echo $this->login; ?>" placeholder="Nom d'utilisateur">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input style="height: 50px;" type="password" class="form-control" name="password" placeholder="Mot de passe">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12" style="margin-top: 25px;">
          <button style="height: 50px; padding-top: 13px; font-size: 17px;" type="submit" class="btn btn-primary btn-block btn-flat">Connexion</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
  <div style="color: #fff; position: fixed; bottom: 50px; margin-left: 50px;"><p>Designed By Braintis Technology. (c) 2022</p></div>
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo URL; ?>public/design/vendors/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo URL; ?>public/design/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo URL; ?>public/design/vendors/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
