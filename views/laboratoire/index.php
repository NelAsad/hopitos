<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Laboratoire
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Nouvelle demande d'examen</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Demandes satisfaites du jour</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Toutes les demandes satisfaites</a></li>
                        <li><a href="#tab_4" data-toggle="tab">Demandes declassees du jour</a></li>
                        <li><a href="#tab_5" data-toggle="tab">Toutes les demandes declassées</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="table_nouvelles_demandes" class="table">
                                <thead>
                                    <tr>
                                        <th>N° Examen</th>
                                        <!-- <th>Demandeur</th> -->
                                        <th>Patient</th>
                                        <th>Numero de la fiche</th>
                                        <th>Heure de demande</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_2">
                            <table style=" width: 100% ;" id="table_demandes_satisf_du_jour" class="table">
                                <thead>
                                    <tr>
                                        <th>N° Examen</th>
                                        <!-- <th>Demandeur</th> -->
                                        <th>Patient</th>
                                        <th>Numero de la fiche</th>
                                        <th>Heure de demande</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <table style=" width: 100% ;" id="table_demandes_satisf_all" class="table">
                                <thead>
                                    <tr>
                                        <th>N° Examen</th>
                                        <!-- <th>Demandeur</th> -->
                                        <th>Patient</th>
                                        <th>Numero de la fiche</th>
                                        <th>Heure de demande</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_4">
                            <table style=" width: 100% ;" id="table_demandes_declassees_today" class="table">
                                <thead>
                                    <tr>
                                        <th>N° Examen</th>
                                        <!-- <th>Demandeur</th> -->
                                        <th>Patient</th>
                                        <th>Numero de la fiche</th>
                                        <th>Heure de demande</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab_5">
                            <table style=" width: 100% ;" id="table_demandes_declassees_all" class="table">
                                <thead>
                                    <tr>
                                        <th>N° Examen</th>
                                        <!-- <th>Demandeur</th> -->
                                        <th>Patient</th>
                                        <th>Numero de la fiche</th>
                                        <th>Heure de demande</th>
                                        <th>Service</th>
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

<!-- Modal inserer resultat examen -->
<div class="modal fade" id="inserer_examens_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Inserer les resultats des examens</h4>
            </div>
            <div class="modal-body">
                <form class="ui mini form" id="form_inserer_exam">

                    <div class="field">
                        <div id="exam_show_service" class="ui segment shwo_fiche_box"></div>
                        <!-- les champs caches -->
                        <input class="form-control" type="hidden" id="hidden_exam_id" name="hidden_exam_id">
                    </div>
                    <h4>Examens de routine</h4>
                    <div class="field">
                        <div class="row">
                            <div class="col-xs-3">
                                <h4 class="ui dividing header">HEMATOLOGIE</h4>
                                <label for="hemato_Hbg">Hbg</label>
                                <input class="form-control" type="text" id="hemato_Hbg" name="hemato_Hbg">
                                <label for="hemato_GB">GB</label>
                                <input class="form-control" type="text" id="hemato_GB" name="hemato_GB">
                                <label for="hemato_VS">VS</label>
                                <input class="form-control" type="text" id="hemato_VS" name="hemato_VS">
                                <label for="hemato_FL_E">FL %E</label>
                                <input class="form-control" type="text" id="hemato_FL_E" name="hemato_FL_E">
                                <label for="hemato_FL_B">FL %B</label>
                                <input class="form-control" type="text" id="hemato_FL_B" name="hemato_FL_B">
                                <label for="hemato_FL_L">FL %L</label>
                                <input class="form-control" type="text" id="hemato_FL_L" name="hemato_FL_L">
                                <label for="hemato_FL_M">FL %M</label>
                                <input class="form-control" type="text" id="hemato_FL_M" name="hemato_FL_M">
                                <label for="hemato_TS">TS</label>
                                <input class="form-control" type="text" id="hemato_TS" name="hemato_TS">
                                <label for="hemato_TC">TC</label>
                                <input class="form-control" type="text" id="hemato_TC" name="hemato_TC">
                                <label for="hemato_GS">GS</label>
                                <input class="form-control" type="text" id="hemato_GS" name="hemato_GS">
                                <label for="hemato_HTC">HTC</label>
                                <input class="form-control" type="text" id="hemato_HTC" name="hemato_HTC">
                            </div>
                            <div class="col-xs-3">
                                <h4 class="ui dividing header">PARASITOLOGIE</h4>
                                <h5 class="ui dividing header">A. Sang</h5>
                                <label for="parasito_GE">GE</label>
                                <input class="form-control" type="text" id="parasito_GE" name="parasito_GE">
                                <label for="parasito_GF">GF</label>
                                <input class="form-control" type="text" id="parasito_GF" name="parasito_GF">
                                <label for="parasito_CATT">CATT</label>
                                <input class="form-control" type="text" id="parasito_CATT" name="parasito_CATT">
                                <label for="parasito_frais_mince">Frais Mince</label>
                                <input class="form-control" type="text" id="parasito_frais_mince" name="parasito_frais_mince">
                                <h5 class="ui dividing header">B. Selles</h5>
                                <label for="parasito_selles_exam_direct">Examen direct</label>
                                <input class="form-control" type="text" id="parasito_selles_exam_direct" name="parasito_selles_exam_direct">
                                <h5 class="ui dividing header">C. Urines</h5>
                                <label for="parasito_urines_sediment">Sédiment</label>
                                <input class="form-control" type="text" id="parasito_urines_sediment" name="parasito_urines_sediment">
                                <h5 class="ui dividing header">D. Frottis Vaginal & Uretral</h5>
                                <label for="parasito_PVUF">A Frais</label>
                                <input class="form-control" type="text" id="parasito_PVUF" name="parasito_PVUF">
                                <h5 class="ui dividing header">E. ECR</h5>
                                <label for="parasito_ecr_element">Elément</label>
                                <input class="form-control" type="text" id="parasito_ecr_element" name="parasito_ecr_element">
                                <h5 class="ui dividing header">E. Bactériologie</h5>
                                <label for="parasito_bacterio_nature_produit">Nature du produit</label>
                                <input class="form-control" type="text" id="parasito_bacterio_nature_produit" name="parasito_bacterio_nature_produit">
                                <label for="parasito_bacterio_gramme">Gramme</label>
                                <input class="form-control" type="text" id="parasito_bacterio_gramme" name="parasito_bacterio_gramme">
                                <label for="parasito_bacterio_ziehl">Ziehl</label>
                                <input class="form-control" type="text" id="parasito_bacterio_ziehl" name="parasito_bacterio_ziehl">
                            </div>
                            <div class="col-xs-3">
                                <h4 class="ui dividing header">BIO-CHIMIE</h4>
                                <label for="bio_nature_produit">Nature du produit</label>
                                <input class="form-control" type="text" id="bio_nature_produit" name="bio_nature_produit">
                                <label for="bio_glucose">Glucose</label>
                                <input class="form-control" type="text" id="bio_glucose" name="bio_glucose">
                                <label for="bio_bilirubine">Bilirubine</label>
                                <input class="form-control" type="text" id="bio_bilirubine" name="bio_bilirubine">
                                <label for="bio_albumine">Albumine</label>
                                <input class="form-control" type="text" id="bio_albumine" name="bio_albumine">
                                <label for="bio_acetone">Acétone</label>
                                <input class="form-control" type="text" id="bio_acetone" name="bio_acetone">
                                <label for="bio_PH">PH</label>
                                <input class="form-control" type="text" id="bio_PH" name="bio_PH">
                                <label for="bio_nitrite">Nitrite</label>
                                <input class="form-control" type="text" id="bio_nitrite" name="bio_nitrite">
                            </div>
                            <div class="col-xs-3">
                                <h4 class="ui dividing header">IMMINO SEROLOGIE</h4>
                                <label for="is_test_grossesse">Test de grossesse ?</label>
                                <input class="form-control" type="text" id="is_test_grossesse" name="is_test_grossesse">
                                <label for="is_widal_TO">Widal TO</label>
                                <input class="form-control" type="text" id="is_widal_TO" name="is_widal_TO">
                                <label for="is_TH">TH</label>
                                <input class="form-control" type="text" id="is_TH" name="is_TH">
                                <label for="is_CATT">CATT</label>
                                <input class="form-control" type="text" id="is_CATT" name="is_CATT">
                                <label for="is_HBS">HBS</label>
                                <input class="form-control" type="text" id="is_HBS" name="is_HBS">
                                <label for="is_HC">HC</label>
                                <input class="form-control" type="text" id="is_HC" name="is_HC">
                                <label for="is_P120">P120</label>
                                <input class="form-control" type="text" id="is_P120" name="is_P120">
                            </div>
                        </div>
                    </div>
                    <h4>Autres Examens</h4>
                    <div id="laboratoire_autres_examens_liste" class="callout callout-default shwo_fiche_box"></div>
                    <h4>Resultats autres examens</h4>
                    <div class="field">
                        <!-- <label for="">Autres Examens</label> -->
                        <textarea class="form-control" name="laboratoire_autres_examens_resultats" id="laboratoire_autres_examens_resultats" cols="30" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_inserer_exam">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- modal inserer resultat imagerie -->
<div class="modal fade" id="inserer_resultat_examen_image_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Inserer resultat imagerie</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo URL; ?>lobaratoire/done_add_resultat_labo" class="ui small form" id="form_inserer_image_exam" method="POST" enctype="multipart/form-data">
                    <input class="form-control" type="hidden" id="hidden_image_exam_id" name="hidden_image_exam_id">
                    <div class="row">
                        <div class="col-xs-4">
                            <label for="radiographie">Radiographie</label>
                            <input class="form-control" id="radiographie" name="radiographie" type="file">
                        </div>
                        <div class="col-xs-4">
                            <label for="echographie">Echographie</label>
                            <input class="form-control" id="echographie" name="echographie" type="file">
                        </div>
                        <div class="col-xs-4">
                            <label for="irm">IRM</label>
                            <input class="form-control" id="irm" name="irm" type="file">
                        </div>
                        <div class="col-xs-4">
                            <label for="endoscopie">Endoscopie</label>
                            <input class="form-control" id="endoscopie" name="endoscopie" type="file">
                        </div>
                        <div class="col-xs-4">
                            <label for="scanner">Scanner</label>
                            <input class="form-control" id="scanner" name="scanner" type="file">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary" id="btn_done_insert_resultat_imagerie">Valider</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- modal voir resultat imagerie -->
<div class="modal fade" id="voir_resultat_examen_image_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Resultat imagerie</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <h5>Radiographie</h5>
                        <img id="img_radiographie" src="<?php echo URL; ?>public/images/exam/" alt="" class="img img-responsive">
                    </div>
                    <div class="col-xs-6">
                        <h5>Echographie</h5>
                        <img id="img_echographie" src="<?php echo URL; ?>public/images/exam/" alt="" class="img img-responsive">
                    </div>
                    <div class="col-xs-6">
                        <h5>IRM</h5>
                        <img id="img_irm" src="<?php echo URL; ?>public/images/exam/" class="img img-responsive">
                    </div>
                    <div class="col-xs-6">
                        <h5>Endoscopie</h5>
                        <img id="img_endoscopie" src="<?php echo URL; ?>public/images/exam/" alt="" class="img img-responsive">
                    </div>
                    <div class="col-xs-6">
                        <h5>Radiographie</h5>
                        <img id="img_scanner" src="<?php echo URL; ?>public/images/exam/" alt="" class="img img-responsive">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- modal declasser examen -->
<div class="modal fade" id="declasser_demande_examen_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Declasser le demande d'examen</h4>
            </div>
            <div class="modal-body">
                <form class="ui small form" id="form_declasser_exam">
                    <div class="field">
                        <input type="hidden" id="hidden_declasser_exam_id" name="hidden_declasser_exam_id">

                        <label for="declasser_exam_motif">Motif du declassement</label>
                        <textarea class="form-control" name="declasser_exam_motif" id="declasser_exam_motif" cols="30" rows="5" placeholder="Motif du declassement"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_done_declasser_exam">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- Modal voir les resultats apres insertion -->
<div class="modal fade" id="voir_exam_apres_insertion_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Les resultats</h4>
            </div>
            <div class="modal-body">
                <div id="les_resultats_apres_insertion" class="callout callout-default shwo_fiche_box"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal voir le motif du declassement apres insertion -->
<div class="modal fade" id="voir_motif_declassement_apres_insertion_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Le motif du declassement</h4>
            </div>
            <div class="modal-body">
                <div id="le_motif_apres_insertion" class="callout callout-default shwo_fiche_box"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>




<div class="ui modal" id="">
    <i class="close icon"></i>
    <div class="header">

    </div>
    <div class="content">

    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>