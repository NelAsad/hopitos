 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Resultat dossier patient
          </h1>
          <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">UI</a></li>
        <li class="active">General</li>
      </ol> -->
      </section>

<section class="content">
      <div class="callout callout-default">
        <h4>Reminder!</h4>
        Instructions for how to use modals are available on the
        <a href="http://getbootstrap.com/javascript/#modals">Bootstrap documentation</a>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Modal Examples</h3>
            </div>
            <div class="box-body">
                <table id="table_fiches_dossier_by_patient_id" class="table">
                    <thead>
                        <tr>
                            <th>Fiche Id</th>
                            <th>Nom</th>
                            <th>Post-Nom</th>
                            <th>Prenom</th>
                            <th>Date d'ouverture</th>
                            <th>Date de Cloture</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
          </div>
        </div>
      </div>
</section>

 </div>





<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

    <div class="ui segment blue">
        <div class="ui icon message">

            <i class="search icon"></i>

            <div class="content">
                <div class="header">Importance</div>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
            </div>

        </div>
    </div>

    <div class="ui segment blue">

        

    </div>

</div>
<!-- /page content -->

<div class="modal fade" id="voir_consultation_modal_dossier">
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
<!-- /.modal-->

<!-- Des champs caches pour la datatable -->
<input type="hidden" id="hidden_search_text" value="<?php echo $this->parametres['text']; ?>">
<input type="hidden" id="hidden_search_type" value="<?php echo $this->parametres['type']; ?>">