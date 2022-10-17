<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small>CONSULTATION</small></h3>
            </div>
            <div class="clearfix"></div>

            <div class="row" style="display: block;">

                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><small>Fiches ouvertes</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="table-responsive">
                                <table id="table_fiche_juste_ouvertes" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>N° Consultation</th>
                                            <th>Fiche</th>
                                            <th>Nom</th>
                                            <th>Post-Nom</th>
                                            <th>Prenom</th>
                                            <th>Sexe</th>
                                            <th>Date d'ouverture</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12" id="show_diagnostic_section">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Diagnostic</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close_link_by_asad"><i class="fa fa-close"></i></a>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <input type="hidden" id="hidden_diagnostic_show_id">
                            <ul class="list-unstyled timeline">
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <a href="" class="tag">
                                                <span>Anamnèse</span>
                                            </a>
                                        </div>
                                        <div class="block_content">
                                            <p class="excerpt" id="show_diagnostic_anamnese">

                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <a href="" class="tag">
                                                <span>Diagnostic</span>
                                            </a>
                                        </div>
                                        <div class="block_content">
                                            <p class="excerpt" id="show_diagnostic_note_diagnostic">

                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-secondary diagnostic_btn_demande_examen">Demander examens au labo</button>
                            <button type="button" class="btn btn-secondary diagnostic_btn_prescrire">Prescrire des medicaments</button>
                            <button type="button" class="btn btn-secondary diagnostic_voir_demande_examen">Voir examens demandés</button>
                            <button type="button" class="btn btn-secondary diagnostic_voir_resultats_demande_examen">Voir les resultats labo</button>
                            <button type="button" class="btn btn-secondary diagnostic_voir_prescrire">Voir les prescriptions</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
</div>

<!-- Commencer consultation -->
<div id="commencer_consultation_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Consultation</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <form id="form_commencer_consultation">
                            <input type="hidden" id="hidden_commencer_consultation_transfert_id">
                            <label for="message">Consultation</label>
                            <textarea id="commencer_consultation_symptomes" required="required" rows="5" class="form-control mb-4" name="message"></textarea>

                            <label for="message">Diagnostic</label>
                            <textarea id="commencer_consultation_diagnostic" required="required" rows="5" class="form-control" name="message"></textarea>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_commencer_consultation">Valider</button>
            </div>

        </div>
    </div>
</div>

<!-- Demander examen -->
<div id="demander_examens_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Demander des examens</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">

                        <form class="ui form" id="form_demande_exam">
                            <input type="hidden" id="hidden_demande_diagnostic_id" name="hidden_demande_diagnostic_id">
                            <ul class="to_do" id="list_demande_examen">

                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_demande_exam">Demander</button>
            </div>

        </div>
    </div>
</div>

<!-- Presciption -->
<div id="do_prescription_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Prescription</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="hidden_prescription_diagnostic_id" name="hidden_prescription_diagnostic_id">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prescription_medicament">Medicament <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="prescription_medicament" name="prescription_medicament">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prescription_posologie">Posologie <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="prescription_posologie" name="prescription_posologie">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="prescription_dosage">Dosage <span style="color: red;">*</span></label>
                            <input class="form-control" type="text" id="prescription_dosage" name="prescription_dosage">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="btn btn-primary form-control" id="ajouter_prescription">Ajouter</button>
                        </div>
                    </div>
                </div>
                <hr>
                <div id="body_modal_prescription">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Medicament</th>
                                <th>Posologie</th>
                                <th>Dosage</th>
                                <th style="width: 40px">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="body_table_prescription">

                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_valider_prescription">Demander</button>
            </div>

        </div>
    </div>
</div>

<!-- Voir les examens demandés -->
<div id="voir_demande_examens_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">les examens demandés</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="to_do" id="body_modal_voir_diagnostic_examens_demandes">
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Voir les prescriptions -->
<div id="voir_prescription_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Prescriptions</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Medicament</th>
                          <th>Posologie</th>
                          <th>Dosage</th>
                        </tr>
                      </thead>
                      <tbody id="body_modal_voir_prescriptions">
                        
                      </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Imprimer</button>
            </div>
        </div>
    </div>
</div>