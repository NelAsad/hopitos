<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small>LABORATOIRE</small></h3>
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
                            <button type="button" class="btn btn-secondary labo_btn_insert_examen_resultat">Inserer resultats</button>
                            <button type="button" class="btn btn-secondary labo_btn_voir_resultat">Voir resultats</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /page content -->
</div>


<!-- Insert labo resultat -->
<div id="insert_resultat_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Insertion des resultats</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <ul class="to_do" id="body_modal_voir_insert_modal">
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_valider_insertion_resultat">Valider</button>
            </div>
        </div>
    </div>
</div>