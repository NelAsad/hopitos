<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HOSPITALIA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URL; ?>public/css/dataTables.bootstrap.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/design/vendors/dist/css/skins/_all-skins.min.css">

  <!-- Custom Theme Style -->
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo URL; ?>public/css/main.css" />
  <!-- Sweet alert CSS-->
  <link rel="stylesheet" href="<?php echo URL; ?>public/librairies/sweetalert/Resources/Public/Assets/sweetalert2.min.css">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/librairies/toastr/build/toastr.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Style propre au module-->
  <?php
  if (isset($this->css)) {
    foreach ($this->css as $css) {
      echo '<link href="' . URL . 'views/' . $css . '" rel="stylesheet"/>';
    }
  }
  ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>H</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MEDICAL CITY</b></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo URL; ?>public/design/vendors/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                <span class="hidden-xs">Nel'Asad Luboya</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo URL; ?>public/design/vendors/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    Nel'Asad Luboya
                    <small>Administrateur</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-primary btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo URL; ?>home/logout" class="btn btn-default btn-flat" style="background: red;">Deconnexion</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo URL; ?>public/design/vendors/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Nel'Asad Luboya</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header"></li>
          

          <li class="<?php if(NAVBAR_LINK=='home') echo 'active '; ?>">
              <a href="<?php echo URL; ?>home">
                <i class="fa fa-users"></i>
                <span>Dashboard</span>
              </a>
            </li>

          <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '2') : ?>
            <li class="<?php if(NAVBAR_LINK=='patient') echo 'active '; ?>">
              <a href="<?php echo URL; ?>patient">
                <i class="fa fa-users"></i>
                <span>Patients</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '5') : ?>
            <li class="<?php if(NAVBAR_LINK=='payement') echo 'active '; ?>">
              <a href="<?php echo URL; ?>payement">
                <i class="fa fa-users"></i>
                <span>Payements</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '3') : ?>
            <li class="treeview <?php if(NAVBAR_LINK=='consultation') echo 'active '; ?>">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Consultation</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo URL; ?>consultation"><i class="fa fa-stethoscope"></i> Consulter</a></li>
                <li><a href="<?php echo URL; ?>dossier"><i class="fa fa-folder-o"></i> Dossier medical</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '4') : ?>
            <li class="<?php if(NAVBAR_LINK=='laboratoire') echo 'active '; ?>">
              <a href="<?php echo URL; ?>laboratoire">
                <i class="fa fa-heartbeat"></i>
                <span>Laboratoire</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '4') : ?>
            <li class="<?php if(NAVBAR_LINK=='pharmacie') echo 'active '; ?>">
              <a href="<?php echo URL; ?>pharmacie">
                <i class="fa fa-medkit"></i>
                <span>Pharmacie</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if (Session::get('privilege') == '1') : ?>
            <li class="<?php if(NAVBAR_LINK=='users') echo 'active '; ?>">
              <a href="<?php echo URL; ?>users">
                <i class="fa fa-user-md"></i>
                <span>Personnel</span>
              </a>
            </li>
          <?php endif; ?>


          <?php if (Session::get('privilege') == '1') : ?>
            <li class="treeview">
              <a href="<?php echo URL; ?>patient">
                <i class="fa fa-wrench"></i>
                <span>Administrateur</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo URL; ?>utilis"><i class="fa fa-users"></i> Utilisateurs</a></li>
                <li><a href="<?php echo URL; ?>configs"><i class="fa fa-cogs"></i> Configurations</a></li>
                <!-- <li><a href="<?php echo URL; ?>stats"><i class="fa fa-area-chart"></i> Statistique</a></li> -->
              </ul>
            </li>
          <?php endif; ?>

          <li>
            <a href="<?php echo URL; ?>home/logout">
              <i class="fa fa-power-off"></i>
              <span>Deconnexion</span>
            </a>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>