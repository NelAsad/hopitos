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
                          <li class="active"><a href="#tab_1" data-toggle="tab">Patients</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">

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
                                            <input class="form-control"  type="text" id="new_patient_nom" placeholder="Nom">
                                        </div>
                                        <div class="col-xs-4">
                                            <label>Postnom</label>
                                            <input class="form-control"  type="text" id="new_patient_postnom" placeholder="Post-Nom">
                                        </div>

                                        <div class="col-xs-4">
                                            <label>Date de naissance</label>
                                            <input class="form-control"  type="date" id="new_patient_date_naissance">
                                        </div>
                                        <div class="col-xs-4">
                                            <label>Sexe</label>
                                            <select class="form-control"  class="dropdown" id="new_patient_sexe">
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
                                                <option value="familleConv">Famille Conventionne</option>
                                                <option value="conventionne">Conventionne</option>
                                                <option value="simple">Simple</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Num. du dossier</label>
                                            <input class="form-control" type="text" id="new_patient_dossier_num" placeholder="Numero du dossier">
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Num. de la fiche</label>
                                            <input class="form-control" type="text" id="new_patient_fiche_num" placeholder="Numero de la fiche">
                                        </div>
                                        <div class="col-xs-3" id="bloc_titulaire_toggle">
                                            <label>Titulaire</label>
                                            <input class="form-control" type="text" id="new_patient_titulaire_id" placeholder="Identifiant du titulaire" value="0">
                                        </div>

                                        <div id="bloc_conv_toggle">
                                            <div class="col-xs-4">
                                                <label>Affiliation</label>
                                                <input class="form-control" type="text" id="new_patient_affiliation" placeholder="Affiliation">
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Code_convention</label>
                                                <input class="form-control" type="text" id="new_patient_code_conv" placeholder="Code Convention" value="0">
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Occupation</label>
                                                <input class="form-control" type="text" id="new_patient_occupation" placeholder="Occupation">
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

                              <table id="table_patients" class="table ">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Prénom</th>
                                          <th>Nom</th>
                                          <th>Post-Nom</th>
                                          <th>Sexe</th>
                                          <th>Statut</th>
                                          <th>Date naissance</th>
                                          <th width="10%">Actions</th>
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
      </section>
  </div>

  <!-- modal voir patient -->
  <div class="modal fade" id="patient_show_modal">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Patient</h4>
        </div>
        <div class="modal-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Identifiant</td>
                        <td>
                            <span id="show_patient_id"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Numero de la fiche</td>
                        <td>
                            <span id="show_patient_fiche_numero">123213val</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Numero du dossier</td>
                        <td>
                            <span id="show_patient_dossier_numero"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td>
                            <span id="show_patient_nom"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Post-Nom</td>
                        <td>
                            <span id="show_patient_postnom"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Prenom</td>
                        <td>
                            <span id="show_patient_prenom"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Sexe</td>
                        <td>
                            <span id="show_patient_sexe"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Date de naissance</td>
                        <td>
                            <span id="show_patient_date_naissance"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Adresse</td>
                        <td>
                            <span id="show_patient_adresse"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Statut</td>
                        <td>
                            <span id="show_patient_statut"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Conventionne id</td>
                        <td>
                            <span id="show_patient_fk_patient_conv"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Affiliation</td>
                        <td>
                            <span id="show_patient_affiliation"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Code Convention</td>
                        <td>
                            <span id="show_patient_code_convention"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Occupation</td>
                        <td>
                            <span id="show_patient_occupation"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Date d'enregistrement</td>
                        <td>
                            <span id="show_patient_save_date"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Enregistre(e) par</td>
                        <td>
                            <span id="show_patient_fk_users_id"></span>
                        </td>
                    </tr>
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

  <!-- modal ouvrir une fiche -->
  <div class="modal fade" id="ouvrir_fiche_modal">
    <div class="modal-dialog">
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
                                    <option value="<?php echo $medecin['users_id'] ?>"><?php echo $medecin['prenom'].' '.$medecin['nom'] ?></option>
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