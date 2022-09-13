<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Consultation
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Fiches ouvertes</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Consultations en cours</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Consultations terminees aujourd'hui</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Toutes les consultations terminées</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <table style=" width: 100% ;" id="table_fiche_en_cours_etape_2" class="table">
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
                        <div class="tab-pane" id="tab_3">
                            <table style=" width: 100% ;" id="table_fiches_cloturees" class="table">
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_4">
                            <table style=" width: 100% ;" id="table_toutes_les_fiches_cloturees" class="table">
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

<!-- modal commencer consultation -->
<div class="modal fade" id="commencer_consultation_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Consultation</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Num consultation</td>
                                    <td>
                                        <span id="start_consulation_fiche_id"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Num fiche</td>
                                    <td>
                                        <span id="start_consulation_patient_fiche_numero"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nom</td>
                                    <td>
                                        <span id="start_consulation_patient_nom"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Post-Nom</td>
                                    <td>
                                        <span id="start_consulation_patient_postnom"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prenom</td>
                                    <td>
                                        <span id="start_consulation_patient_prenom"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Poids</td>
                                    <td>
                                        <span id="start_consulation_patient_poids"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tension</td>
                                    <td>
                                        <span id="start_consulation_patient_tension"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Heure d'ouverture</td>
                                    <td>
                                        <span id="start_consulation_date_ouverture"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Heure de cloture</td>
                                    <td>
                                        <span id="start_consulation_date_cloture"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-md-6" style="border-left: solid black 1px;">
                        <form class="ui mini form" id="form_commencer_consultation">
                            <input type="hidden" id="hidden_commencer_consultation_fiche_id">
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
                <button type="button" class="btn btn-primary" id="btn_done_commencer_consultation">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal_completer_consultation -->
<div class="modal fade" id="completer_consultation_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Consultation</h4>
            </div>
            <div class="modal-body">
                <form class="ui mini form" id="form_completer_consultation">
                    <input type="hidden" id="hidden_completer_consultation_fiche_id">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Traitement</label>
                            <textarea class="77advanced_textarea form-control" rows="7" id="completer_consultation_traitement"></textarea>
                        </div>
                        <div class="col-xs-12">
                            <label>Prescriptions</label>
                            <textarea class="77advanced_textarea form-control" rows="7" id="completer_consultation_prescription" placeholder="Prescriptions"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_completer_consultation">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal_voir_consultation -->
<div class="modal fade" id="voir_consultation_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Consultation</h4>
            </div>
            <div class="modal-body">
                <table class="ui small table">
                    <tbody>
                        <tr>
                            <td>Num consultation</td>
                            <td>
                                <span id="show_consulation_fiche_id"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Num fiche</td>
                            <td>
                                <span id="show_consulation_patient_fiche_numero"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nom</td>
                            <td>
                                <span id="show_consulation_patient_nom"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Post-Nom</td>
                            <td>
                                <span id="show_consulation_patient_postnom"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td>
                                <span id="show_consulation_patient_prenom"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Poids</td>
                            <td>
                                <span id="show_consulation_patient_poids"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Tension</td>
                            <td>
                                <span id="show_consulation_patient_tension"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Heure d'ouverture</td>
                            <td>
                                <span id="show_consulation_date_ouverture"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Heure de cloture</td>
                            <td>
                                <span id="show_consulation_date_cloture"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div>
                    <input type="hidden" id="hidden_voir_consultation_fiche_id">

                    <span>Anamnèse</span>
                    <div class="callout callout-default shwo_fiche_box" id="voir_consultation_syptomes"></div>

                    <span>Diagnostic</span>
                    <div id="voir_consultation_diagnostic" class="callout callout-default shwo_fiche_box"></div>

                    <span>Resultats Labo</span>
                    <div id="voir_consultation_resultat_labo" class="callout callout-default shwo_fiche_box"></div>

                    <span>Traitement</span>
                    <div id="voir_consultation_traitement" class="callout callout-default shwo_fiche_box"></div>

                    <span>Prescription</span>
                    <div id="voir_consultation_precription" class="callout callout-default shwo_fiche_box"></div>

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


<!-- Modal demander examens -->
<div class="modal fade" id="demander_examens_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Demander des examens</h4>
            </div>
            <div class="modal-body">
                <form class="ui form" id="form_demande_exam">

                    <div class="row">
                        <div class="col-xs-12">
                            <label>Service</label>
                            <input class="form-control" type="text" id="exam_service" name="exam_service">
                            <!-- les champs caches -->
                            <input type="hidden" id="fk_fiche_id" name="fk_fiche_id">
                            <input type="hidden" id="fk_patient_id" name="fk_patient_id">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <h4 class="ui dividing header">HEMATOLOGIE</h4>
                            <label for="hemato_Hbg">Hbg</label>
                            <input type="checkbox" id="hemato_Hbg" name="hemato_Hbg">
                            &nbsp;<label for="hemato_GB">GB</label>
                            <input type="checkbox" id="hemato_GB" name="hemato_GB">
                            &nbsp;<label for="hemato_VS">VS</label>
                            <input type="checkbox" id="hemato_VS" name="hemato_VS">
                            &nbsp;<label for="hemato_FL_E">FL %E</label>
                            <input type="checkbox" id="hemato_FL_E" name="hemato_FL_E">
                            &nbsp;<label for="hemato_FL_B">FL %B</label>
                            <input type="checkbox" id="hemato_FL_B" name="hemato_FL_B">
                            &nbsp;<label for="hemato_FL_L">FL %L</label>
                            <input type="checkbox" id="hemato_FL_L" name="hemato_FL_L">
                            &nbsp;<label for="hemato_FL_M">FL %M</label>
                            <input type="checkbox" id="hemato_FL_M" name="hemato_FL_M">
                            &nbsp;<label for="hemato_TS">TS</label>
                            <input type="checkbox" id="hemato_TS" name="hemato_TS">
                            &nbsp;<label for="hemato_TC">TC</label>
                            <input type="checkbox" id="hemato_TC" name="hemato_TC">
                            &nbsp;<label for="hemato_GS">GS</label>
                            <input type="checkbox" id="hemato_GS" name="hemato_GS">
                            &nbsp;<label for="hemato_HTC">HTC</label>
                            <input type="checkbox" id="hemato_HTC" name="hemato_HTC">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="ui dividing header">PARASITOLOGIE</h4>
                            <h5 class="ui dividing header">A. Sang</h5>
                            <label for="parasito_GE">GE</label>
                            <input type="checkbox" id="parasito_GE" name="parasito_GE">
                            <label for="parasito_GF">GF</label>
                            <input type="checkbox" id="parasito_GF" name="parasito_GF">
                            <label for="parasito_CATT">CATT</label>
                            <input type="checkbox" id="parasito_CATT" name="parasito_CATT">
                            <label for="parasito_frais_mince">Frais Mince</label>
                            <input type="checkbox" id="parasito_frais_mince" name="parasito_frais_mince">
                            <h5 class="ui dividing header">B. Selles</h5>
                            <label for="parasito_selles_exam_direct">Examen direct</label>
                            <input type="checkbox" id="parasito_selles_exam_direct" name="parasito_selles_exam_direct">
                            <h5 class="ui dividing header">C. Urines</h5>
                            <label for="parasito_urines_sediment">Sédiment</label>
                            <input type="checkbox" id="parasito_urines_sediment" name="parasito_urines_sediment">
                            <h5 class="ui dividing header">D. Frottis Vaginal & Uretral</h5>
                            <label for="parasito_PVUF">A Frais</label>
                            <input type="checkbox" id="parasito_PVUF" name="parasito_PVUF">
                            <h5 class="ui dividing header">E. ECR</h5>
                            <label for="parasito_ecr_element">Elément</label>
                            <input type="checkbox" id="parasito_ecr_element" name="parasito_ecr_element">
                            <h5 class="ui dividing header">E. Bactériologie</h5>
                            <label for="parasito_bacterio_nature_produit">Nature du produit</label>
                            <input type="checkbox" id="parasito_bacterio_nature_produit" name="parasito_bacterio_nature_produit">
                            <label for="parasito_bacterio_gramme">Gramme</label>
                            <input type="checkbox" id="parasito_bacterio_gramme" name="parasito_bacterio_gramme">
                            <label for="parasito_bacterio_ziehl">Ziehl</label>
                            <input type="checkbox" id="parasito_bacterio_ziehl" name="parasito_bacterio_ziehl">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="ui dividing header">BIO-CHIMIE</h4>
                            <label for="bio_nature_produit">Nature du produit</label>
                            <input type="checkbox" id="bio_nature_produit" name="bio_nature_produit">
                            <label for="bio_glucose">Glucose</label>
                            <input type="checkbox" id="bio_glucose" name="bio_glucose">
                            <label for="bio_bilirubine">Bilirubine</label>
                            <input type="checkbox" id="bio_bilirubine" name="bio_bilirubine">
                            <label for="bio_albumine">Albumine</label>
                            <input type="checkbox" id="bio_albumine" name="bio_albumine">
                            <label for="bio_acetone">Acétone</label>
                            <input type="checkbox" id="bio_acetone" name="bio_acetone">
                            <label for="bio_PH">PH</label>
                            <input type="checkbox" id="bio_PH" name="bio_PH">
                            <label for="bio_nitrite">Nitrite</label>
                            <input type="checkbox" id="bio_nitrite" name="bio_nitrite">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="ui dividing header">IMMINO SEROLOGIE</h4>
                            <label for="is_test_grossesse">Test de grossesse ?</label>
                            <input type="checkbox" id="is_test_grossesse" name="is_test_grossesse">
                            <label for="is_widal_TO">Widal TO</label>
                            <input type="checkbox" id="is_widal_TO" name="is_widal_TO">
                            <label for="is_TH">TH</label>
                            <input type="checkbox" id="is_TH" name="is_TH">
                            <label for="is_CATT">CATT</label>
                            <input type="checkbox" id="is_CATT" name="is_CATT">
                            <label for="is_HBS">HBS</label>
                            <input type="checkbox" id="is_HBS" name="is_HBS">
                            <label for="is_HC">HC</label>
                            <input type="checkbox" id="is_HC" name="is_HC">
                            <label for="is_P120">P120</label>
                            <input type="checkbox" id="is_P120" name="is_P120">
                        </div>
                        <div class="col-xs-12">
                            <hr>
                            <label for="imagerie">Imagerie</label> &nbsp; &nbsp;
                            <input type="checkbox" id="imagerie" name="imagerie">
                            <hr>
                        </div>
                    </div>

                    <div class="field">
                        <label>Autres Examens</label>
                        <textarea class="form-control" name="autres_examens" id="autres_examens" cols="30" rows="5" placeholder="Autres Examens"></textarea>
                    </div>

                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" id="btn_done_demande_exam">Demander</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->


<!-- Modal voir motif declassement -->
<div class="modal fade" id="voir_motif_declassement_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Motif du declassement</h4>
            </div>
            <div class="modal-body">
                <div id="le_motif_du_declassement" class="callout callout-default shwo_fiche_box"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- modal pour voir le resultats des examnes  -->
<div class="modal fade" id="voir_resultat_labo_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Resultat du laboratoire</h4>
            </div>
            <div class="modal-body">
                <form class="ui form" id="form_inserer_resultat_labo_a_la_fiche">

                    <div class="field">
                        <div id="back_exam_service" class="callout callout-default shwo_fiche_box"></div>
                        <!-- les champs caches -->
                        <input class="form-control" type="hidden" id="hidden_back_fiche_id" name="hidden_back_fiche_id">
                    </div>

                    <div>
                        <div>
                            <h4 class="ui dividing header">HEMATOLOGIE</h4>
                            <label for="hemato_Hbg">Hbg</label>
                            <input class="form-control" type="text" id="back_hemato_Hbg" name="hemato_Hbg">
                            <label for="hemato_GB">GB</label>
                            <input class="form-control" type="text" id="back_hemato_GB" name="hemato_GB">
                            <label for="hemato_VS">VS</label>
                            <input class="form-control" type="text" id="back_hemato_VS" name="hemato_VS">
                            <label for="hemato_FL_E">FL %E</label>
                            <input class="form-control" type="text" id="back_hemato_FL_E" name="hemato_FL_E">
                            <label for="hemato_FL_B">FL %B</label>
                            <input class="form-control" type="text" id="back_hemato_FL_B" name="hemato_FL_B">
                            <label for="hemato_FL_L">FL %L</label>
                            <input class="form-control" type="text" id="back_hemato_FL_L" name="hemato_FL_L">
                            <label for="hemato_FL_M">FL %M</label>
                            <input class="form-control" type="text" id="back_hemato_FL_M" name="hemato_FL_M">
                            <label for="hemato_TS">TS</label>
                            <input class="form-control" type="text" id="back_hemato_TS" name="hemato_TS">
                            <label for="hemato_TC">TC</label>
                            <input class="form-control" type="text" id="back_hemato_TC" name="hemato_TC">
                            <label for="hemato_GS">GS</label>
                            <input class="form-control" type="text" id="back_hemato_GS" name="hemato_GS">
                            <label for="hemato_HTC">HTC</label>
                            <input class="form-control" type="text" id="back_hemato_HTC" name="hemato_HTC">
                        </div>
                        <div class="field ">
                            <h4 class="ui dividing header">PARASITOLOGIE</h4>
                            <h5 class="ui dividing header">A. Sang</h5>
                            <label for="parasito_GE">GE</label>
                            <input class="form-control" type="text" id="back_parasito_GE" name="parasito_GE">
                            <label for="parasito_GF">GF</label>
                            <input class="form-control" type="text" id="back_parasito_GF" name="parasito_GF">
                            <label for="parasito_CATT">CATT</label>
                            <input class="form-control" type="text" id="back_parasito_CATT" name="parasito_CATT">
                            <label for="parasito_frais_mince">Frais Mince</label>
                            <input class="form-control" type="text" id="back_parasito_frais_mince" name="parasito_frais_mince">
                            <h5 class="ui dividing header">B. Selles</h5>
                            <label for="parasito_selles_exam_direct">Examen direct</label>
                            <input class="form-control" type="text" id="back_parasito_selles_exam_direct" name="parasito_selles_exam_direct">
                            <h5 class="ui dividing header">C. Urines</h5>
                            <label for="parasito_urines_sediment">Sédiment</label>
                            <input class="form-control" type="text" id="back_parasito_urines_sediment" name="parasito_urines_sediment">
                            <h5 class="ui dividing header">D. Frottis Vaginal & Uretral</h5>
                            <label for="parasito_PVUF">A Frais</label>
                            <input class="form-control" type="text" id="back_parasito_PVUF" name="parasito_PVUF">
                            <h5 class="ui dividing header">E. ECR</h5>
                            <label for="parasito_ecr_element">Elément</label>
                            <input class="form-control" type="text" id="back_parasito_ecr_element" name="parasito_ecr_element">
                            <h5 class="ui dividing header">E. Bactériologie</h5>
                            <label for="parasito_bacterio_nature_produit">Nature du produit</label>
                            <input class="form-control" type="text" id="back_parasito_bacterio_nature_produit" name="parasito_bacterio_nature_produit">
                            <label for="parasito_bacterio_gramme">Gramme</label>
                            <input class="form-control" type="text" id="back_parasito_bacterio_gramme" name="parasito_bacterio_gramme">
                            <label for="parasito_bacterio_ziehl">Ziehl</label>
                            <input class="form-control" type="text" id="back_parasito_bacterio_ziehl" name="parasito_bacterio_ziehl">
                        </div>
                        <div class="field">
                            <h4 class="ui dividing header">BIO-CHIMIE</h4>
                            <label for="bio_nature_produit">Nature du produit</label>
                            <input class="form-control" type="text" id="back_bio_nature_produit" name="bio_nature_produit">
                            <label for="bio_glucose">Glucose</label>
                            <input class="form-control" type="text" id="back_bio_glucose" name="bio_glucose">
                            <label for="bio_bilirubine">Bilirubine</label>
                            <input class="form-control" type="text" id="back_bio_bilirubine" name="bio_bilirubine">
                            <label for="bio_albumine">Albumine</label>
                            <input class="form-control" type="text" id="back_bio_albumine" name="bio_albumine">
                            <label for="bio_acetone">Acétone</label>
                            <input class="form-control" type="text" id="back_bio_acetone" name="bio_acetone">
                            <label for="bio_PH">PH</label>
                            <input class="form-control" type="text" id="back_bio_PH" name="bio_PH">
                            <label for="bio_nitrite">Nitrite</label>
                            <input class="form-control" type="text" id="back_bio_nitrite" name="bio_nitrite">
                        </div>
                        <div class="field">
                            <h4 class="ui dividing header">IMMINO SEROLOGIE</h4>
                            <label for="is_test_grossesse">Test de grossesse ?</label>
                            <input class="form-control" type="text" id="back_is_test_grossesse" name="is_test_grossesse">
                            <label for="is_widal_TO">Widal TO</label>
                            <input class="form-control" type="text" id="back_is_widal_TO" name="is_widal_TO">
                            <label for="is_TH">TH</label>
                            <input class="form-control" type="text" id="back_is_TH" name="is_TH">
                            <label for="is_CATT">CATT</label>
                            <input class="form-control" type="text" id="back_is_CATT" name="is_CATT">
                            <label for="is_HBS">HBS</label>
                            <input class="form-control" type="text" id="back_is_HBS" name="is_HBS">
                            <label for="is_HC">HC</label>
                            <input class="form-control" type="text" id="back_is_HC" name="is_HC">
                            <label for="is_P120">P120</label>
                            <input class="form-control" type="text" id="back_is_P120" name="is_P120">
                        </div>
                    </div>

                    <h4>Autres examens</h4>
                    <div id="back_laboratoire_autres_examens_liste" class="ui segment shwo_fiche_box"></div>
                    <h4>Resultats autres examens</h4>
                    <div class="field">
                        <textarea class="form-control" name="back_autres_examens" id="back_autres_examens" cols="30" rows="5" placeholder="Autres Examens"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_inserer_resultat_a_la_fiche">Ajouter a la fiche</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Modal demander examens -->
<div class="modal fade" id="demander_examens_image_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Demander des examens d'imagerie</h4>
            </div>
            <div class="modal-body">
                <form class="ui form" id="form_demande_image_exam">

                    <!-- <div class="row">
                        <div class="col-xs-12">
                            <label>Service</label>
                            <input class="form-control" type="text" id="exam_service" name="exam_service"> -->
                            <!-- les champs caches -->
                            <input type="hidden" id="fk_image_fiche_id" name="fk_image_fiche_id">
                            <input type="hidden" id="fk_image_patient_id" name="fk_image_patient_id">
                        <!-- </div>
                    </div> -->

                    <div class="row">
                        <div class="col-xs-2">
                            <label for="radiographie">radiographie</label>&nbsp;&nbsp;
                            <input type="checkbox" id="radiographie" name="radiographie">
                        </div>
                        <div class="col-xs-2">
                            <label for="echographie">Echographie</label>&nbsp;&nbsp;
                            <input type="checkbox" id="echographie" name="echographie">
                        </div>
                        <div class="col-xs-2">
                            <label for="irm">IRM</label>&nbsp;&nbsp;
                            <input type="checkbox" id="irm" name="irm">
                        </div>
                        <div class="col-xs-2">
                            <label for="endoscopie">Endoscopie</label>&nbsp;&nbsp;
                            <input type="checkbox" id="endoscopie" name="endoscopie">
                        </div>
                        <div class="col-xs-2">
                            <label for="scanner">Scanner</label>&nbsp;&nbsp;
                            <input type="checkbox" id="scanner" name="scanner">
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            <button type="button" class="btn btn-primary" id="btn_done_demande_image_exam"  data-dismiss="modal">Demander</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->