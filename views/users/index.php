<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Gestion du personnel
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
                          <li class="active"><a href="#tab_1" data-toggle="tab">Informations de l'agent</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                              <form class="ui mini form" id="formulaire_ajout_personnel">

                                  <div id="ajout_personnel_message"></div>

                                  <h4>Identité</h4>
                                  <div class="row">

                                      <input type="hidden" id="hidden_update_personnel_id">

                                      <div class="col-xs-4">
                                          <label>Prénom</label>
                                          <input class="form-control" type="text" id="pers_prenom" name="pers_prenom" placeholder="Prénom" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Nom</label>
                                          <input class="form-control" type="text" id="pers_nom" name="pers_nom" placeholder="Nom" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Postnom</label>
                                          <input class="form-control" type="text" id="pers_postnom" name="pers_postnom" placeholder="Postnom" required>
                                      </div>

                                      <div class="col-xs-4">
                                          <label>Sexe</label>
                                          <select class="form-control" class="dropdown" id="pers_sexe">
                                              <option value="m">Masculin</option>
                                              <option value="f">Feminin</option>
                                          </select>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Telephone</label>
                                          <input class="form-control" type="text" id="pers_tel" name="pers_tel" placeholder="Téléphone" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Email</label>
                                          <input class="form-control" type="email" id="pers_email" name="pers_email" placeholder="Email" required>
                                      </div>

                                      <div class="col-xs-4">
                                          <label>Lieu de naissance</label>
                                          <input class="form-control" type="text" id="pers_nais" name="pers_nais" placeholder="Lieu de naissance" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Date de naissance</label>
                                          <input class="form-control" type="date" id="pers_date_nais" name="pers_date_nais" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Adresse</label>
                                          <input class="form-control" type="text" id="pers_adresse" name="pers_adresse" placeholder="Adresse" required>
                                      </div>
                                  </div>

                                  <h4>Profession</h4>
                                  <div class="row">
                                      <div class="col-xs-4">
                                          <label>Fonction</label>
                                          <input class="form-control" type="text" id="pers_fonction" name="pers_fonction" placeholder="Fonction" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Site</label>
                                          <input class="form-control" type="text" id="pers_site" name="pers_site" placeholder="Site" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Matricule</label>
                                          <input class="form-control" type="text" id="pers_matricule" name="pers_matricule" placeholder="Matricule" required>
                                      </div>
                                  </div>

                                  <h4>Famille</h4>
                                  <div class="row">
                                      <div class="col-xs-4">
                                          <label>Etat civil</label>
                                          <select class="form-control" class="dropdown" id="pers_etat_civil">
                                              <option value="celibataire">Celibataire</option>
                                              <option value="marie">Marié(e)</option>
                                              <option value="marie">Divorcé(e)</option>
                                          </select>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Nombre d'enfants</label>
                                          <input class="form-control" type="text" id="pers_nbre_enfant" name="pers_nbre_enfant" placeholder="Nombre enfants" required>
                                      </div>
                                      <div class="col-xs-4">
                                          <label>Epoux</label>
                                          <input class="form-control" type="text" id="pers_epoux" name="pers_epoux" placeholder="Epoux" required>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-xs-6">
                                          <div class="btn btn-primary btn-block" id="save_personnel_btn" style="margin-top: 30px;">Ajouter agent</div>
                                      </div>
                                      <div class="col-xs-6">
                                          <div class="btn btn-warning btn-block" id="update_personnel_btn" style="margin-top: 30px;">Modifier agent</div>
                                      </div>
                                  </div>

                              </form>

                              <div class="box box-solid">
                                  <div class="box-header with-border">
                                      <h3 class="box-title"></h3>
                                  </div>
                                  <div class="box-body">
                                      <table id="personnel_table" class="table table-striped">
                                          <thead class="bg-primary">
                                              <tr>
                                                  <th>Id</th>
                                                  <th>Nom</th>
                                                  <th>Postnom</th>
                                                  <th>Prenom</th>
                                                  <th>Sexe</th>
                                                  <th>Téléphone</th>
                                                  <th>Site</th>
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