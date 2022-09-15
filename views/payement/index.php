 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Les Payements
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
                         <li class="active"><a href="#tab_1" data-toggle="tab">Carnet de payement</a></li>
                         <li><a href="#tab_2" data-toggle="tab">Effectuer un payement</a></li>
                         <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                     </ul>
                     <div class="tab-content">
                         <div class="tab-pane active" id="tab_1">
                             <table id="table_payements" class="table">
                                 <thead>
                                     <tr>
                                         <th>Id</th>
                                         <th>Motif</th>
                                         <th>Montant</th>
                                         <th>Date</th>
                                         <th>Facture</th>
                                         <th>ID</th>
                                         <th>Caissier</th>
                                     </tr>
                                 </thead>
                             </table>
                         </div>
                         <!-- /.tab-pane -->
                         <div class="tab-pane" id="tab_2">

                             <div class="box box-danger">
                                 <div class="box-header with-border">
                                     <h3 class="box-title">Nouveau Payement</h3>
                                 </div>
                                 <div class="box-body">
                                     <div class="row">
                                         <form class="ui mini form" id="form_add_payement">
                                             <div class="col-xs-6">
                                                 <label>Motif</label>
                                                 <select class="form-control" id="new_payement_motif">
                                                     <option value="1">Frais Fiche</option>
                                                     <option value="2">Frais Laboratoire</option>
                                                     <option value="3">Autres frais</option>
                                                 </select>
                                             </div>
                                             <div class="col-xs-6" id="bloc_ident_patient">
                                                 <label>Identifiant du patient</label>
                                                 <input class="form-control" type="text" id="new_payement_patient_id" placeholder="Identifiant du patient">
                                             </div>
                                             <div class="col-xs-6" id="bloc_ident_demande">
                                                 <label>Identifiant Demande</label>
                                                 <input class="form-control" type="text" id="new_payement_demande_id" placeholder="Identifiant de la demande">
                                             </div>
                                             <div class="col-xs-6 bloc_autre_payement">
                                                 <label>Motif du payement</label>
                                                 <input class="form-control" type="text" id="new_payement_motif_autre_payement" placeholder="Motif du payement">
                                             </div>
                                             <div class="col-xs-6 bloc_autre_payement">
                                                 <label>Montant du payement</label>
                                                 <input class="form-control" type="number" min="0" id="new_payement_montant_autre_payement" placeholder="Identifiant de la demande">
                                             </div>

                                         </form>
                                     </div>
                                     <div class="btn btn-primary btn-block ol-xs-12" id="btn_add_new_payement" style="margin-top: 30px;">
                                         <i class="save icon"></i>
                                         Valider le payement
                                     </div>
                                     <!-- <button class="btn btn-primary btn-block" id="btn_add_new_patient" style="margin-top: 30px;">Enregistrer</button> -->
                                 </div>
                                 <!-- /.box-body -->
                             </div>
                             <!-- /.box -->
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


 <!-- modal valider payement -->
 <div class="modal fade" id="valider_payement_fiche_modal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Valider le payement ?</h4>
             </div>
             <div class="modal-body">
                 <h3><span id="patient_preview_payement_fiche"></span></h3>
                 <div class="table-responsive">
                     <table class="table table-striped">
                         <tbody>
                             <tr>
                                 <td>Motif : </td>
                                 <td>Frais de fiche</td>
                                 <td></td>
                             </tr>
                             <tr>
                                 <td>Montant : </td>
                                 <td><span id="montant_preview_payement_fiche"></span> FC</td>
                                 <td></td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                 <button type="button" class="btn btn-primary" id="btn_done_payement_fiche" data-dismiss="modal">Valider le payement</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <!-- modal preview payement fiche -->
 <div class="modal fade" id="valider_payement_fiche_modal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Valider le payement ?</h4>
             </div>
             <div class="modal-body" id="preview_fiche_payement_content">
                 <h3><span id="patient_preview_payement_fiche"></span></h3>
                 <div class="table-responsive">
                     <table class="table table-striped">
                         <tbody>
                             <tr>
                                 <td>Motif : </td>
                                 <td>Frais de fiche</td>
                                 <td></td>
                             </tr>
                             <tr>
                                 <td>Montant : </td>
                                 <td><span id="montant_preview_payement_fiche"></span> FC</td>
                                 <td></td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                 <button type="button" class="btn btn-primary" id="btn_done_payement_fiche" data-dismiss="modal">Valider le payement</button>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>


 <!-- modal preview payement consultation -->
 <div class="modal fade" id="valider_payement_labo_modal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Valider le payement ?</h4>
             </div>
             <div class="modal-body" id="preview_consultation_payement_content">
                 <h3><span id="patient_preview_payement_labo"></span></h3>
                 <h4>Motif : Frais de laboratoire</h4>
                 <div class="table-responsive">
                     <table class="table table-striped">
                         <tbody id="payement_labo_table_body">

                         </tbody>
                     </table>
                 </div>
                 <h4>Total à payer : <span id="frais_labo_preview_total_a_payer"></span> FC</h4>
                 <hr>
                 <h4>Autres Examens</h4>
                 <div id="payement_autres_examens_liste" class="callout callout-default shwo_fiche_box"></div>
                 <h4>Montant autres examens</h4>
                 <div>
                     <form class="ui mini form" id="form_prix_autres_examens">
                         <div class="field">
                             <input class="form-control" type="number" min="0" name="payement_input_set_prix_autres_examens" id="payement_input_set_prix_autres_examens">
                         </div>
                     </form>
                 </div>
                 <hr>
                 <h4>TOTAL: <span id="total_avec_autres_payement"></span> FC</h4>
             </div>
         </div>
         <!-- /.modal-content -->
         <div class="modal-footer">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
             <button type="button" class="btn btn-primary" id="btn_done_payement_labo" data-dismiss="modal">Valider le payement</button>
         </div>
     </div>
     <!-- /.modal-dialog -->
 </div>


 <!-- Modal preview autre payement -->
 <div class="modal fade" id="valider_autre_payement_modal">
     <div class="modal-dialog">
         <div class="modal-content" id="preview_autre_payement_content">
             <h3><span id="patient_preview_autre_payement"></span></h3>
             <div class="table-responsive">
                 <table class="table table-striped">
                     <tbody>
                         <tr>
                             <td>Motif : </td>
                             <td id="span_description_autre_payement"></td>
                             <td></td>
                         </tr>
                         <tr>
                             <td>Montant : </td>
                             <td><span id="span_montant_preview_autre_payement"></span> FC</td>
                             <td></td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
         <!-- /.modal-content -->
         <div class="modal-footer">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
             <button type="button" class="btn btn-primary" id="btn_done_autre_payement" data-dismiss="modal">Valider le payement</button>
         </div>
     </div>
     <!-- /.modal-dialog -->
 </div>

<!-- RECU -->
 <div id="recu_payement_fiche" >
     <div class="row" style="margin-bottom: 20px;">
         <div class="col-xs-4">
             <img src="<?php echo URL; ?>public/images/logo4.png" alt="" class="img img-responsive">
         </div>
         <div class="col-xs-8 text-center" style="padding-top: 10px;">
             <span>Medical City</span> <br>
             <span>ADH</span> <br>
             <span>Les urgences 24h/7</span>
         </div>
     </div>
     <hr>
     <div align="center" style="margin-bottom: 20px; margin-bottom: 20px;">
         RECU DE PAYEMENT
     </div>
     <hr>
     <div align="center" style="margin-bottom: 20px; margin-bottom: 20px;">
         <span id="recu_patient_identite"></span>
     </div>
     <div align="center">-----------------------------</div>
     <div>
         <div class="table-responsive">
             <table class="table table-striped">
                 <tbody>
                     <tr>
                         <td>Date : </td>
                         <td><span id="recu_payement_fiche_date"></span></td>
                         <td></td>
                     </tr>
                     <tr>
                         <td>Motif : </td>
                         <td><span id="recu_motif_payement"></span></td>
                         <td></td>
                     </tr>
                     <tr>
                         <td>Montant : </td>
                         <td><span id="montant_recu_payement_fiche"></span> FC</td>
                         <td></td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
     <div style="background-color: #fff;" align="center">
         <div id="recu_fiche_barcode"></div>
     </div>
 </div>