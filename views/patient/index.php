  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Les patients
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
                          <li class="active"><a href="#tab_1" data-toggle="tab">Inforations du patient</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">

                              <form id="form_add_new_patient">
                                  <div class="box box-danger">
                                      <div class="box-header with-border">
                                          <h3 class="box-title">Nouveau Patient</h3>
                                      </div>
                                      <div class="box-body">
                                          <div class="row">
                                              <input type="hidden" id="hidden_update_patient_id">
                                              <div class="col-xs-4">
                                                  <label>Prenom</label>
                                                  <input class="form-control" type="text" id="new_patient_prenom" placeholder="Prénom">
                                              </div>
                                              <div class="col-xs-4">
                                                  <label>Nom</label>
                                                  <input class="form-control" type="text" id="new_patient_nom" placeholder="Nom">
                                              </div>
                                              <div class="col-xs-4">
                                                  <label>Postnom</label>
                                                  <input class="form-control" type="text" id="new_patient_postnom" placeholder="Post-Nom">
                                              </div>

                                              <div class="col-xs-4">
                                                  <label>Date de naissance</label>
                                                  <input class="form-control" type="date" max="<?= date('Y-m-d'); ?>" id="new_patient_date_naissance">
                                              </div>
                                              <div class="col-xs-4">
                                                  <label>Sexe</label>
                                                  <select class="form-control" class="dropdown" id="new_patient_sexe">
                                                      <option value="M">Masculin</option>
                                                      <option value="F">Feminin</option>
                                                  </select>
                                              </div>
                                              <div class="col-xs-4">
                                                  <label>Adresse</label>
                                                  <input class="form-control" type="text" id="new_patient_adresse" placeholder="Adresse">
                                              </div>

                                              <div class="col-xs-3">
                                                  <label>Statut</label>
                                                  <select class="form-control" class="dropdown" id="new_patient_statut">
                                                      <option value="conventionne">Conventionné</option>
                                                      <option value="simple">Privé</option>
                                                  </select>
                                              </div>

                                              <div class="col-xs-3">
                                                  <label>Num. de la fiche</label>
                                                  <input disabled class="form-control" type="text" id="new_patient_fiche_num" placeholder="Numero de la fiche">
                                              </div>

                                              <div id="bloc_conv_toggle">
                                                  <div class="col-xs-3">
                                                      <label>Num. du dossier</label>
                                                      <input class="form-control" type="text" id="new_patient_dossier_num" placeholder="Numero du dossier">
                                                  </div>
                                                  <div class="col-xs-3">
                                                      <label>Entreprise</label>
                                                      <select class="form-control" id="new_patient_code_conv">
                                                          <?php
                                                            foreach ($this->entreprises as $entreprise) {
                                                            ?>
                                                              <option value="<?php echo $entreprise['id_entreprise'] ?>"><?php echo $entreprise['nom_entreprise'] ?></option>
                                                          <?php
                                                            }
                                                            ?>
                                                      </select>
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="row">
                                              <div class="col-xs-4">
                                                  <button class="btn btn-primary  btn-block" id="btn_add_new_patient" style="margin-top: 30px;">Enregistrer</button>
                                              </div>
                                              <div class="col-xs-4">
                                                  <button class="btn btn-warning btn-block" id="btn_update_patient" style="margin-top: 30px;">Modifier</button>
                                              </div>
                                              <div class="col-xs-4">
                                                  <button class="btn btn-danger btn-block" id="btn_delete_patient" style="margin-top: 30px;">Supprimer</button>
                                              </div>
                                          </div>
                                      </div>
                                      <!-- /.box-body -->
                                  </div>
                              </form>

                              <table id="table_patients" class="table table-striped">
                                  <thead class="bg-primary">
                                      <tr>
                                          <th>Id</th>
                                          <th>Prénom</th>
                                          <th>Nom</th>
                                          <th>Post-Nom</th>
                                          <th>Sexe</th>
                                          <th>Statut</th>
                                          <th>Date naissance</th>
                                          <th width="12%">Actions</th>
                                      </tr>
                                  </thead>
                              </table>
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
  </div>

  <!-- modal voir patient -->
  <div class="modal fade" id="patient_show_modal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <button style="opacity: 1.0;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span style="color: white; opacity: 1.0;" aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Informations du Patient</h4>
              </div>
              <div class="modal-body">
                  <table class="table table-striped">
                      <tbody>
                          <tr>
                              <td>Identifiant</td>
                              <td>
                                  <b><span id="show_patient_id"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Nom</td>
                              <td>
                                  <b><span id="show_patient_nom"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Post-Nom</td>
                              <td>
                                  <b><span id="show_patient_postnom"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Prenom</td>
                              <td>
                                  <b><span id="show_patient_prenom"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Sexe</td>
                              <td>
                                  <b><span id="show_patient_sexe"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Date de naissance</td>
                              <td>
                                  <b><span id="show_patient_date_naissance"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Adresse</td>
                              <td>
                                  <b><span id="show_patient_adresse"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Statut</td>
                              <td>
                                  <b><span id="show_patient_statut"></span></b>
                              </td>
                          </tr>
                          <tr>
                              <td>Date d'enregistrement</td>
                              <td>
                                  <b><span id="show_patient_save_date"></span></b>
                              </td>
                          </tr>
                          <!-- <tr>
                              <td>Enregistre(e) par</td>
                              <td>
                                  <b><span id="show_patient_fk_users_id"></span></b>
                              </td>
                          </tr> -->
                      </tbody>
                  </table>


                  <div id="membre_famille_content">
                      <hr>
                      <h4>Membres de famille</h4>
                      <table class="table table-striped">
                          <thead class="bg-primary">
                              <tr>
                                  <td>Nom</td>
                                  <td>Postonm</td>
                                  <td>Prenom</td>
                                  <td>Sexe</td>
                              </tr>
                          </thead>
                          <tbody id="table_membres_famille_body">

                          </tbody>
                      </table>
                  </div>


              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Fermer</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- modal ouvrir une fiche -->
  <div class="modal fade" id="ouvrir_fiche_modal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Ouverture fiche</h4>
              </div>
              <div class="modal-body">
                  <form class="ui small form" id="form_ouvrir_fiche">
                      <input type="hidden" id="ouvrir_fiche_fk_patient_id">
                      <div class="row">
                          <div class="col-xs-3">
                              <label>Poids</label>
                              <input class="form-control" type="text" id="ouvrir_fiche_poids" placeholder="Poids">
                          </div>
                          <div class="col-xs-3">
                              <label>Tension</label>
                              <input class="form-control" type="text" id="ouvrir_fiche_tension" placeholder="Tension">
                          </div>
                          <div class="col-xs-3">
                              <label>Temperature</label>
                              <input class="form-control" type="text" id="ouvrir_fiche_temperature" placeholder="Temperature">
                          </div>
                          <div class="col-xs-3">
                              <label>Medecin Consultant</label>
                              <select class="form-control" id="ouvrir_fiche_medecin_id">
                                  <?php
                                    foreach ($this->medecins as $medecin) {
                                    ?>
                                      <option value="<?php echo $medecin['users_id'] ?>"><?php echo $medecin['prenom_agent'] . ' ' . $medecin['nom_agent'] ?></option>
                                  <?php
                                    }
                                    ?>
                              </select>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                  <button type="button" class="btn btn-primary" id="btn_done_ouverture_fiche">Valider</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



  <!-- modal ajouter membre famille -->
  <div class="modal fade" id="add_famille_membre_modal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Ajout un membre de la famille</h4>
              </div>
              <div class="modal-body">
                  <form action="">
                      <div class="row">
                          <input type="hidden" id="hidden_famille_patient_id">
                          <div class="col-xs-4">
                              <label>Prenom</label>
                              <input class="form-control" type="text" id="famille_patient_prenom" placeholder="Prénom">
                          </div>
                          <div class="col-xs-4">
                              <label>Nom</label>
                              <input class="form-control" type="text" id="famille_patient_nom" placeholder="Nom">
                          </div>
                          <div class="col-xs-4">
                              <label>Postnom</label>
                              <input class="form-control" type="text" id="famille_patient_postnom" placeholder="Post-Nom">
                          </div>

                          <div class="col-xs-4">
                              <label>Date de naissance</label>
                              <input class="form-control" type="date" id="famille_patient_date_naissance">
                          </div>
                          <div class="col-xs-4">
                              <label>Sexe</label>
                              <select class="form-control" class="dropdown" id="famille_patient_sexe">
                                  <option value="M">Masculin</option>
                                  <option value="F">Feminin</option>
                              </select>
                          </div>
                          <div class="col-xs-4">
                              <label>Adresse</label>
                              <input class="form-control" type="text" id="famille_patient_adresse" placeholder="Adresse">
                          </div>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                  <button type="button" class="btn btn-primary" id="btn_done_add_membre_famille">Ajouter</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- modal voir membres famille -->
  <div class="modal fade" id="voir_famille_membre_modal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Membres de la famille</h4>
              </div>
              <div class="modal-body">
                  <table class="table table-striped">
                      <thead class="bg-primary">
                          <tr>
                              <td>Nom</td>
                              <td>Postonm</td>
                              <td>Prenom</td>
                              <td>Sexe</td>
                          </tr>
                      </thead>
                      <tbody id="table_membres_famille_body">

                      </tbody>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->