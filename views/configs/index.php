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
                          <li class="active"><a href="#tab_1" data-toggle="tab">Les configurations</a></li>
                          <li><a href="#tab_2" data-toggle="tab">Ajouter Une configurations</a></li>
                          <li><a href="#tab_3" data-toggle="tab">Effectuer une depense</a></li>
                          <li><a href="#tab_4" data-toggle="tab">Les Depenses</a></li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                            <table id="table_configs" class="ui small green celled table">
                                <thead>
                                    <tr>
                                        <th>Identifiant</th>
                                        <th>Nom</th>
                                        <th>Valeur</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                          <div class="tab-pane" id="tab_2">
                            <div class="ui two column green segment">
                                <form class="ui mini form" id="form_add_new_config">
                                    <h4 class="ui dividing header">Nouvelle Configuration</h4>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <label>Type de la configuration</label>
                                            <select class="form-control" id="config_type">
                                                <option value="1">Frais</option>
                                                <option value="-">--Autres--</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Code de la configuration</label>
                                            <input class="form-control" type="text" id="config_id" placeholder="Code de la configuration">
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Nom de la configuration</label>
                                            <input class="form-control" type="text" id="config_nom" placeholder="Nom de la configuration">
                                        </div>
                                        <div class="col-xs-3">
                                            <label>Valeur de la configuration</label>
                                            <input class="form-control" type="text" id="config_val" placeholder="Valeur de la configuration">
                                        </div>
                                    </div>

                                    <div class="btn btn-primary btn-block" id="btn_add_new_config" style="margin-top: 30px;">
                                        <i class="save icon"></i>
                                        Enregistrer
                                    </div>
                                </form>
                            </div>
                          </div>
                          <div class="tab-pane" id="tab_3">
                            <div class="ui two column green segment">
                                <form class="ui mini form" id="form_add_new_depense">
                                    <h4 class="ui dividing header">Effectuer une depense</h4>

                                    <div class="row">
                                        <div class="col-xs-6">
                                            <label>Motif de la depense</label>
                                            <input class="form-control" type="text" id="new_depense_motif" placeholder="Motif de la depense">
                                        </div>
                                        <div class="col-xs-6">
                                            <label>Montant</label>
                                            <input class="form-control" type="text" id="new_depense_montant" placeholder="Montant">
                                        </div>
                                    </div>

                                    <div class="btn btn-primary btn-block" id="btn_done_new_depense" style="margin-top: 30px;">
                                        <i class="save icon"></i>
                                        Valider
                                    </div>
                                </form>
                            </div>
                          </div>
                          <div class="tab-pane" id="tab_4">
                            <table id="table_depenses" class="ui small green celled table" width="100%">
                                <thead>
                                    <tr>
                                        <th>Identifiant</th>
                                        <th>Motif</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Auteur</th>
                                    </tr>
                                </thead>
                            </table>
                          </div>
                      </div>
                      <!-- /.tab-content -->
                  </div>
                  <!-- nav-tabs-custom -->
              </div>
              <!-- /.col -->
      </section>
  </div>

<!-- modal declasser examen -->
<div class="ui modal" id="update_config_val_modal">
    <i class="close icon"></i>
    <div class="header">
        Modifier la valeur de la configuration
    </div>
    <div class="content">
        <form class="ui small form" id="form_update_config_val">
            <div class="field">
                <input type="hidden" id="hidden_update_config_val_id" name="hidden_update_config_val_id">
                
                <label for="update_config_new_value">Nouvelle valeur</label>
                <input type="text" name="update_config_new_value" id="update_config_new_value" placeholder="Nouvelle valeur" />
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_update_config_val">
            Valider
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>
