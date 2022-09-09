

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo URL; ?>public/images/favicon.ico" type="image/ico" />

    <title>HOSPITALIA</title>

    <!-- Semantic CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/frameworks/semantic/semantic.min.css" />

    <!-- Datatables CSS -->
    <link href="<?php echo URL; ?>public/frameworks/vendors/datatable.net-semantic/css/dataTables.semanticui.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo URL; ?>public/css/main.css" />
    <!-- Sweet alert CSS-->
    <link rel="stylesheet" href="<?php echo URL; ?>public/librairies/sweetalert/Resources/Public/Assets/sweetalert2.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="<?php echo URL; ?>public/librairies/toastr/build/toastr.css">

    <!-- Style propre au module-->
    <?php
        if (isset($this->css)) {
            foreach ($this->css as $css) {
                echo '<link href="' . URL . 'views/' . $css . '" rel="stylesheet"/>';
            }
        }
        ?>
</head>

<body>

    <div class="ui left fixed vertical secondary pointing menu" style="overflow:inherit;">
        <div class="item" style="margin:0px;padding:0px;">
            <a href="<?php echo URL; ?>">
                <img class="ui image" src="<?php echo URL; ?>public/images/logo1.jpg">
            </a>
        </div>

        <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '2'): ?>
            <div class="ui horizontal divider">
                <i class="home icon blue"></i>
            </div>
            <a href="<?php echo URL; ?>patient" class="<?php if(NAVBAR_LINK=='patient') echo 'active '; ?> item brown sidebar_item">Patients
                <i class="group icon violet "></i>
            </a>
        <?php endif; ?>

        <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '5'): ?>
            <div class="ui horizontal divider">
                <i class="credit card icon blue"></i>
            </div>
            <a href="<?php echo URL; ?>payement" class="<?php if(NAVBAR_LINK=='payement') echo 'active '; ?> item brown sidebar_item">Payement
                <i class="dollar icon violet "></i>
            </a>
        <?php endif; ?>

        <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '3'): ?>
            <div class="ui horizontal divider">
                <i class="stethoscope icon blue"></i>
            </div>
            <a href="<?php echo URL; ?>consultation" class="<?php if(NAVBAR_LINK=='consultation') echo 'active '; ?> item brown sidebar_item">Consultation
                <i class="stethoscope icon orange"></i>
            </a>
            <a href="<?php echo URL; ?>dossier" class="<?php if(NAVBAR_LINK=='dossier') echo 'active '; ?> item brown sidebar_item">Gestion Dossiers
                <i class="folder open icon teal"></i>
            </a>
        <?php endif; ?>

        <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '4'): ?>
            <div class="ui horizontal divider">
                <i class="medkit icon blue"></i>
            </div>
            <a href="<?php echo URL; ?>laboratoire" class="<?php if(NAVBAR_LINK=='laboratoire') echo 'active '; ?>item brown sidebar_item">Laboratoire
                <i class="medkit icon purple"></i>
            </a>
        <?php endif; ?>

        <?php if (Session::get('privilege') == '1' || Session::get('privilege') == '4'): ?>
            <div class="ui horizontal divider">
                <i class="plus square icon blue"></i>
            </div>
            <a href="<?php echo URL; ?>pharmacie" class="<?php if(NAVBAR_LINK=='pharmacie') echo 'active '; ?>item brown sidebar_item">Pharmacie
                <i class="plus square icon green"></i>
            </a>
        <?php endif; ?>

        <?php if (Session::get('privilege') == '1'): ?>
            <div class="ui horizontal divider">
                <i class="cogs icon blue"></i>
            </div>
            <a href="<?php echo URL; ?>users" class="<?php if(NAVBAR_LINK=='users') echo 'active '; ?>item brown sidebar_item">Utilisateurs
                <i class="user md icon green"></i>
            </a>
            <a href="<?php echo URL; ?>configs" class="<?php if(NAVBAR_LINK=='configs') echo 'active '; ?>item brown sidebar_item">Configurations
                <i class="cogs icon purple"></i>
            </a>
            <a href="<?php echo URL; ?>stats" class="<?php if(NAVBAR_LINK=='stats') echo 'active '; ?>item brown sidebar_item">Statistiques
                <i class="bar chart icon orange"></i>
            </a>
        <?php endif; ?>

        <!-- le btn logout -->
        <a style="border-top:1px solid red; background:#ffe4e4; position: absolute; left: 0px; bottom: 0px; width:100%;" href="<?php echo URL;?>home/logout" class="item blue sidebar_item">Déconnexion
            <i class="power icon red"></i>
        </a>
    </div>