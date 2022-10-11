<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consultation
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Fiches ouvertes</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="table_fiche_juste_ouvertes" class="table">
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
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->
    </section>
</div>
</div>

<!-- modal commencer consultation -->
<div class="modal fade" id="commencer_consultation_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Consultation</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12" style="border-left: solid black 1px;">
                        <form class="ui mini form" id="form_commencer_consultation">
                            <input type="hidden" id="hidden_commencer_consultation_transfert_id">
                            <div class="row">
                                <div class="col-xs-12">
                                    <label>Anamnèse</label>
                                    <textarea style="resize: none;" class="form-control" rows="7" id="commencer_consultation_symptomes"></textarea>
                                </div>
                                <div class="col-xs-12">
                                    <label>Diagnostic</label>
                                    <textarea style="resize: none;" class="form-control" rows="7" id="commencer_consultation_diagnostic" placeholder="Diagnostic"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_commencer_consultation" data-dismiss="modal">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal demander examens -->
<div class="modal fade" id="demander_examens_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Demander des examens</h4>
            </div>
            <div class="modal-body">
                <form class="ui form" id="form_demande_exam">
                    <input type="hidden" id="hidden_demande_transfert_id" name="hidden_demande_transfert_id">
                    <div class="row" id="list_demande_examen"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_demande_exam" data-dismiss="modal">Demander</button>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<!-- Modal voir diagnostic -->
<div class="modal fade" id="voir_diagnostic_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Diagnostic</h4>
            </div>
            <div class="modal-body">

                <input type="hidden" id="hidden_diagnostic_transfert_id" name="hidden_diagnostic_transfert_id">
                <div id="body_modal_diagnostic">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>