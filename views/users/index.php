  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Gestiond des itulisateurs
          </h1>
          <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">General</li>
      </ol> -->
      </section>

      <!-- Main content -->
      <section class="content">
          <div class="row">
              <div class="col-md-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab">Utilisateur</a></li>
                          <li><a href="#tab_2" data-toggle="tab">Ajouter un utilisateur</a></li>
                          <li><a href="#tab_3" data-toggle="tab">Mon profil</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                            <table id="table_users" class="table">
                                <thead>
                                    <tr>
                                        <th>Prénom</th>
                                        <th>Nom</th>
                                        <th>Privilège</th>
                                        <th>Etat</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($this->users_list as $user) {

                                        if ($user['etat'] == 'actif') {
                                            $etat_class = 'make_user_blocked';
                                            $icon_class = 'green';
                                            $icon_action_class = 'red';
                                            $title = 'Desactiver';
                                        } else {
                                            $etat_class = 'make_user_active';
                                            $icon_class = 'red';
                                            $icon_action_class = 'green';
                                            $title = 'Activer';
                                        }
                                        ?>

                                        <tr>
                                            <td>
                                                <?php echo $user['prenom'] ?>
                                            </td>
                                            <td>
                                                <?php echo $user['nom'] ?>
                                            </td>
                                            <td width="15%">
                                                <?php echo $user['privilege'] ?>
                                            </td>
                                            <td width="10%">
                                                <i class="rss <?php echo $icon_class; ?> icon"></i>
                                                <?php echo $user['etat'] ?>
                                            </td>
                                            <td width="9%">
                                                <a href="#" class="btn_show_user_modal" id="<?php echo $user['users_id'] ?>">
                                                    <i class="eye icon"></i>
                                                </a>
                                                <a href="#" class="btn_edit_user_modal" id="<?php echo $user['users_id'] ?>">
                                                    <i class="edit icon"></i>
                                                </a>
                                                <a href="#" id="<?php echo $user['users_id'] ?>" class="<?php echo $etat_class ?>" title="<?php echo $title ?>">
                                                    <i class="rss <?php echo $icon_action_class; ?> icon"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                          </div>
                          <div class="tab-pane" id="tab_2">
                            <form class="ui mini form" id="formulaire_ajout_user" >

                                <div id="ajout_user_message"></div>

                                <h4 class="ui dividing header">Nouveau Utilisateur</h4>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <label>Prénom</label>
                                        <input class="form-control" type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>Nom</label>
                                        <input class="form-control" type="text" id="nom" name="nom" placeholder="Nom" required>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>Titre</label>
                                        <input class="form-control" type="text" id="user_titre" name="user_titre" placeholder="Titre" required>
                                    </div>

                                    <div class="col-xs-4">
                                        <label>Login</label>
                                        <input class="form-control" type="text" id="login" name="login" placeholder="Login" required>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>Mot de passe</label>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe" required>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>Confirmation mot de passe</label>
                                        <input class="form-control" type="password" id="confirme_password" name="confirme_password" placeholder="Confirmation mot de passe" required>
                                    </div>

                                    <div class="col-xs-4">
                                        <label>Poste / Privilège</label>
                                        <select class="form-control" class="dropdown" id="user_poste">
                                            <option value="2">Receptionniste</option>
                                            <option value="5">Caissier</option>
                                            <option value="3">Medecin Consultant</option>
                                            <option value="1">Laboratin</option>
                                            <option value="4">Administrateur</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>Sexe</label>
                                        <select class="form-control" class="dropdown" id="user_sexe">
                                            <option value="m">Masculin</option>
                                            <option value="f">Feminin</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label>Etat</label>
                                        <select class="form-control" class="dropdown" id="etat">
                                            <option value="inactif">Inactif</option>
                                            <option value="actif">Actif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="btn btn-primary btn-block" id="save_user_btn" style="margin-top: 30px;">Ajouter L'utilisateur</div>
                                </form>
                          </div>
                          <div class="tab-pane" id="tab_3">
                            <div id="third_onglet_content">
                                <div class="ui	green card">
                                    <div class="image">
                                        <img src="<?php echo URL; ?>/public/images/nel2.jpg">
                                    </div>
                                    <div class="content">
                                        <div class="header">
                                            <?php echo Session::get('prenom') . ' ' . Session::get('nom'); ?>
                                        </div>
                                        <div class="meta">
                                            <a>Editer</a>
                                        </div>
                                        <div class="description">
                                            <?php echo Session::get('prenom') . ' ' . Session::get('nom') . ' '; ?>est
                                            <?php echo Session::get('privilege') . ' '; ?>au sein de l'etablissement.
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <span class="right floated">
                                            <i class="user icon"></i>
                                            <?php echo Session::get('login'); ?>
                                        </span>
                                        <span>
                                            <i class="rss icon"></i>
                                            <?php echo Session::get('etat'); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
              </div>
              <!-- /.col -->
      </section>
  </div>


<!-- Modal_show_user -->
<div class="ui modal" id="users_show_modal">
    <i class="close icon"></i>
    <div class="header">
        Utilisateur
    </div>
    <div class="content">
        <div class="ui	green card">
            <div class="image">
                <img src="<?php echo URL; ?>/public/images/nel2.jpg">
            </div>
            <div class="content">
                <div class="header">
                    <span id="users_show_modal_header"></span>
                </div>
                <div class="description">
                    <span id="users_show_modal_nom_complet"></span> est de type 1
                    <span id="users_show_modal_privilege"></span> au sein de l'etablissement.
                </div>
            </div>
            <div class="extra content">
                <span class="right floated">
                    <i class="user icon"></i>
                    <span id="users_show_modal_login"></span>
                </span>
                <span>
                    <i class="rss icon"></i>
                    <span id="users_show_modal_etat"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>


<!-- Modal_edit_user -->
<div class="ui modal" id="users_edit_modal">
    <i class="close icon"></i>
    <div class="header">
        Modifier L'utilisateur
    </div>
    <div class="content">
        <form class="ui mini form">

            <div id="users_edit_modal_message"></div>
            
            <input type="hidden" id="hidden_users_id"/>

            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <label>Prénom</label>
                        <input type="text" id="users_edit_modal_prenom" name="prenom" placeholder="Prénom" required>
                    </div>
                    <div class="field">
                        <label>Nom</label>
                        <input type="text" id="users_edit_modal_nom" name="nom" placeholder="Nom" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="three fields">
                    <div class="field">
                        <label>Login</label>
                        <input type="text" id="users_edit_modal_login" name="login" placeholder="Login" required>
                    </div>
                    <div class="field">
                    <label>Privilège</label>
                    <select class="dropdown" id="users_edit_modal_privilege">
                        <option value="receptionniste">Receptionniste</option>
                        <option value="caissier">Caissier</option>
                        <option value="chef_d_unite">Chef d'unite</option>
                        <option value="administrateur">Administrateur</option>
                    </select>
                </div>
                <div class="field">
                    <label>Etat</label>
                    <select class="dropdown" id="users_edit_modal_etat">
                        <option value="inactif">Inactif</option>
                        <option value="actif">Actif</option>
                    </select>
                </div>
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Annuler
        </button>
        <button class="ui positive button" id="modal_users_btn_update">
            Valider
        </button>
    </div>
</div>