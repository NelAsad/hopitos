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
                          <li class="active"><a href="#tab_1" data-toggle="tab">Patient</a></li>
                          <li><a href="#tab_2" data-toggle="tab">Ajouter patient</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                              <table id="table_patients" class="ui small green celled table">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Prénom</th>
                                          <th>Nom</th>
                                          <th>Post-Nom</th>
                                          <th>Sexe</th>
                                          <th>Statut</th>
                                          <th>Date naissance</th>
                                          <th width="7%">Actions</th>
                                      </tr>
                                  </thead>
                              </table>
                          </div>
                          <!-- /.tab-pane -->
                          <div class="tab-pane" id="tab_2">
                              <div class="ui two column green segment">
                                  <form class="ui mini form" id="form_add_new_patient">
                                      <h4 class="ui dividing header">Nouveau Patient</h4>
                                      <div class="field">
                                          <div class="three fields">
                                              <div class="field">
                                                  <label>Prénom</label>
                                                  <input type="text" id="new_patient_prenom" placeholder="Prénom">
                                              </div>
                                              <div class="field">
                                                  <label>Nom</label>
                                                  <input type="text" id="new_patient_nom" placeholder="Nom">
                                              </div>
                                              <div class="field">
                                                  <label>Post-Nom</label>
                                                  <input type="text" id="new_patient_postnom" placeholder="Post-Nom">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="three fields">
                                          <div class="field">
                                              <label>Date de naissance</label>
                                              <input type="date" id="new_patient_date_naissance">
                                          </div>
                                          <div class="field">
                                              <label>Sexe</label>
                                              <select class="dropdown" id="new_patient_sexe">
                                                  <option value="M">Masculin</option>
                                                  <option value="F">Feminin</option>
                                              </select>
                                          </div>
                                          <div class="field">
                                              <label>Adresse</label>
                                              <input type="text" id="new_patient_adresse" placeholder="Adresse">
                                          </div>
                                      </div>
                                      <div class="four fields">
                                          <div class="field">
                                              <label>Statut</label>
                                              <select class="dropdown" id="new_patient_statut">
                                                  <option value="familleConv">Famille Conventionne</option>
                                                  <option value="conventionne">Conventionne</option>
                                                  <option value="simple">Simple</option>
                                              </select>
                                          </div>
                                          <div class="field">
                                              <label>Num. du dossier</label>
                                              <input type="text" id="new_patient_dossier_num" placeholder="Numero du dossier">
                                          </div>
                                          <div class="field">
                                              <label>Num. de la fiche</label>
                                              <input type="text" id="new_patient_fiche_num" placeholder="Numero de la fiche">
                                          </div>
                                          <div class="field" id="bloc_titulaire_toggle">
                                              <label>Titulaire</label>
                                              <input type="text" id="new_patient_titulaire_id" placeholder="Identifiant du titulaire" value="0">
                                          </div>
                                      </div>
                                      <div class="three fields" id="bloc_conv_toggle">
                                          <div class="field">
                                              <label>Affiliation</label>
                                              <input type="text" id="new_patient_affiliation" placeholder="Affiliation">
                                          </div>
                                          <div class="field">
                                              <label>Code_convention</label>
                                              <input type="text" id="new_patient_code_conv" placeholder="Code Convention" value="0">
                                          </div>
                                          <div class="field">
                                              <label>Occupation</label>
                                              <input type="text" id="new_patient_occupation" placeholder="Occupation">
                                          </div>
                                      </div>

                                      <div class="ui green inverted button" id="btn_add_new_patient">
                                          <i class="save icon"></i>
                                          Enregistrer
                                      </div>
                                  </form>
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
  </div>