<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestion des utilisateurs
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
                          <li class="active"><a href="#tab_1" data-toggle="tab">Informations de l'utilisateur</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                              <form class="ui mini form" id="formulaire_ajout_personnel">

                                  <div id="ajout_personnel_message"></div>

                                  <div class="row">

                                      <input type="hidden" id="hidden_update_userid">

                                      <div class="col-xs-4">
                                          <label>Login</label>
                                          <input class="form-control" type="text" id="login" name="login" placeholder="Login" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Mot de passe</label>
                                          <input class="form-control" type="password" id="password" name="password" placeholder="Mot de passe" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Privilege</label>
                                          <select class="form-control" class="dropdown" id="privilege">
                                              <option value="1">Adminin</option>
                                              <option value="2">Laborantin</option>
                                              <option value="2">Consultant</option>
                                              <option value="2">Reception</option>
                                          </select>
                                      </div>

                                      <div class="col-xs-6">
                                          <label>Etat</label>
                                          <select class="form-control" class="dropdown" id="etat_user">
                                              <option value="actif">Actif</option>
                                              <option value="inactif">Inactif</option>
                                          </select>
                                      </div>
                                      <div class="col-xs-6">
                                          <label>Agent</label>
                                          <select class="form-control" class="dropdown" id="agent_user">
                                            <?php
                                            foreach ($this->agents as $agent) {
                                                ?>
                                                    <option value="<?php echo $agent['id_agent'] ?>"><?php echo $agent['nom_agent'] ?> <?php echo $agent['postnom_agent'] ?> <?php echo $agent['prenom_agent'] ?></option>
                                                <?php
                                            }
                                            ?>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-xs-6">
                                          <div class="btn btn-primary btn-block" id="save_user_btn" style="margin-top: 30px;">Ajouter utilisateur</div>
                                      </div>
                                      <div class="col-xs-6">
                                          <div class="btn btn-warning btn-block" id="update_user_btn" style="margin-top: 30px;">Modifier utilisateur</div>
                                      </div>
                                  </div>

                              </form>

                              <div class="box box-solid">
                                  <div class="box-header with-border">
                                      <h3 class="box-title"></h3>
                                  </div>
                                  <div class="box-body">
                                      <table id="users_table" class="table table-striped">
                                          <thead class="bg-primary">
                                              <tr>
                                                  <th>Id</th>
                                                  <th>Login</th>
                                                  <th>Privilege</th>
                                                  <th>etat</th>
                                                  <th>Actions</th>
                                              </tr>
                                          </thead>
                                      </table>
                                  </div>
                                  <!-- /.box-body -->
                              </div>

                          </div>
                          <!-- /.tab-pane -->
                      </div>
                      <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
              </div>
              <!-- /.col -->
          </div>
    </section>
    <!-- /.content -->
</div>