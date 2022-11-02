<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small>Les patients</small></h3>
            </div>
            <div class="clearfix"></div>

            <div class="row" style="display: block;">

                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><small>Informations du patient</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="table_patients" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
</div>



<!-- modal ouvrir une fiche -->
<div id="ouvrir_fiche_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Ouverture fiche</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="ui small form" id="form_ouvrir_fiche">
                    <input type="hidden" id="ouvrir_fiche_fk_patient_id">
                    <div class="row">
                        <div class="col-3">
                            <label>Poids</label>
                            <input class="form-control" type="text" id="ouvrir_fiche_poids" placeholder="Poids">
                        </div>
                        <div class="col-3">
                            <label>Tension</label>
                            <input class="form-control" type="text" id="ouvrir_fiche_tension" placeholder="Tension">
                        </div>
                        <div class="col-3">
                            <label>Temperature</label>
                            <input class="form-control" type="text" id="ouvrir_fiche_temperature" placeholder="Temperature">
                        </div>
                        <div class="col-3">
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
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_ouverture_fiche">Valider</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->