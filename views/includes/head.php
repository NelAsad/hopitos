<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>MEDICAL CITY </title>

  <!-- Bootstrap -->
  <link href="<?php echo URL; ?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo URL; ?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo URL; ?>public/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo URL; ?>public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="<?php echo URL; ?>public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="<?php echo URL; ?>public/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="<?php echo URL; ?>public/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
  <!-- bootstrap-daterangepicker -->
  <link href="<?php echo URL; ?>public/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?php echo URL; ?>public/vendors/animate.css/animate.min.css" rel="stylesheet">
  <!-- PNotify -->
  <link href="<?php echo URL; ?>public/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="<?php echo URL; ?>public/build/css/custom.min.css" rel="stylesheet">

  <!-- Style propre au module-->
  <?php
  if (isset($this->css)) {
    foreach ($this->css as $css) {
      echo '<link href="' . URL . 'views/' . $css . '" rel="stylesheet"/>';
    }
  }
  ?>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"> <span>MEDICAL CITY ADH</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>JONATAHN MUBAKE</h2>
            </div>
          </div>
          <!-- /menu profile quick info -->
          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a href="<?php echo URL; ?>home"><i class="fa fa-bar-chart"></i> Dashboard </a></li>
                <li><a href="<?php echo URL; ?>patient"><i class="fa fa-users"></i> Patients </a></li>
                <li><a href="<?php echo URL; ?>payement"><i class="fa fa-credit-card"></i> Payements </a></li>
                <li><a href="<?php echo URL; ?>consultation"><i class="fa fa-stethoscope"></i> Consulter </a></li>
                <li><a href="<?php echo URL; ?>dossier"><i class="fa fa-folder-open"></i> Dossier medical </a></li>
                <li><a href="<?php echo URL; ?>laboratoire"><i class="fa fa-medkit"></i> Laboratoire </a></li>
                <li><a href="<?php echo URL; ?>pharmacie"><i class="fa fa-hospital-o"></i> Pharmacie </a></li>
                <li><a href="<?php echo URL; ?>users"><i class="fa fa-slideshare"></i> Personnel </a></li>
                <li><a href="<?php echo URL; ?>utilis"><i class="fa fa-users"></i> Utilisateurs </a></li>
                <li><a href="<?php echo URL; ?>configs"><i class="fa fa-gears"></i> Configurations </a></li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="DECONNEXION" data-placement="top" title="Logout" href="login.html">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  JONATAHN MUBAKE
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Deconnexion</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->