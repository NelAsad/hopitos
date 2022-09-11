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
      <div class="callout callout-info">
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
                            <th>Id du patient</th>
                            <th>Nom</th>
                            <th>Post-Nom</th>
                            <th>Prenom</th>
                            <th>Numero de la fiche</th>
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




<!-- Modal_voir_consultation -->
<div class="ui modal" id="voir_consultation_modal_dossier">
    <i class="close icon"></i>
    <div class="header">
        Consultation
    </div>
    <div class="content">

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
            <div id="voir_consultation_syptomes" class="ui segment shwo_fiche_box"></div>

            <span>Diagnostic</span>
            <div id="voir_consultation_diagnostic" class="ui segment shwo_fiche_box"></div>

            <span>Resultats Labo</span>
            <div id="voir_consultation_resultat_labo" class="ui segment shwo_fiche_box"></div>

            <span>Traitement</span>
            <div id="voir_consultation_traitement" class="ui segment shwo_fiche_box"></div>

            <span>Prescription</span>
            <div id="voir_consultation_precription" class="ui segment shwo_fiche_box"></div>
        
        </div>

    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- Des champs caches pour la datatable -->
<input type="hidden" id="hidden_search_text" value="<?php echo $this->parametres['text']; ?>">
<input type="hidden" id="hidden_search_type" value="<?php echo $this->parametres['type']; ?>">