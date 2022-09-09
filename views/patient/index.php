

<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

	<div class="ui segment blue">

		<div class="ui secondary tabular pointing menu">
			<a class="active item green tab_item" data-tab="first">
				<i class="group icon"></i>
				Patients
			</a>
			<a class="item green tab_item" data-tab="second">
				<i class="add user icon"></i>
				Ajouter un patient
			</a>
		</div>

		<div class="ui bottom attached	active tab segment" data-tab="first">
            <div>
                <table id="table_patients" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Post-Nom</th>
                            <th>Sexe</th>
                            <th>Statut</th>
                            <th>Date naissance</th>
                            <th width="7%">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
		</div>
        <div class="ui bottom attached tab segment" data-tab="second">
            <div>
                <div class="ui two column green segment">
                    <form class="ui mini form" id="form_add_new_patient">
                        <h4 class="ui dividing header">Nouveau Patient</h4>
                        <div class="field">
                            <div class="three fields">
                                <div class="field">
                                    <label>Prénom</label>
                                    <input type="text" id="new_patient_prenom" placeholder="Prénom">
                                </div>
                                <div class="field">
                                    <label>Nom</label>
                                    <input type="text" id="new_patient_nom" placeholder="Nom">
                                </div>
                                <div class="field">
                                    <label>Post-Nom</label>
                                    <input type="text" id="new_patient_postnom" placeholder="Post-Nom">
                                </div>
                            </div>
                        </div>
                        <div class="three fields">
                            <div class="field">
                                <label>Date de naissance</label>
                                <input type="date" id="new_patient_date_naissance">
                            </div>
                            <div class="field">
                                <label>Sexe</label>
                                <select class="dropdown" id="new_patient_sexe">
                                    <option value="M">Masculin</option>
                                    <option value="F">Feminin</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Adresse</label>
                                <input type="text" id="new_patient_adresse" placeholder="Adresse">
                            </div>
                        </div>
                        <div class="four fields">
                            <div class="field">
                                <label>Statut</label>
                                <select class="dropdown" id="new_patient_statut">
                                    <option value="familleConv">Famille Conventionne</option>
                                    <option value="conventionne">Conventionne</option>
                                    <option value="simple">Simple</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Num. du dossier</label>
                                <input type="text" id="new_patient_dossier_num" placeholder="Numero du dossier">
                            </div>
                            <div class="field">
                                <label>Num. de la fiche</label>
                                <input type="text" id="new_patient_fiche_num" placeholder="Numero de la fiche">
                            </div>
                            <div class="field" id="bloc_titulaire_toggle">
                                <label>Titulaire</label>
                                <input type="text" id="new_patient_titulaire_id" placeholder="Identifiant du titulaire" value="0">
                            </div>
                        </div>
                        <div class="three fields" id="bloc_conv_toggle">
                            <div class="field">
                                <label>Affiliation</label>
                                <input type="text" id="new_patient_affiliation" placeholder="Affiliation">
                            </div>
                            <div class="field">
                                <label>Code_convention</label>
                                <input type="text" id="new_patient_code_conv" placeholder="Code Convention" value="0">
                            </div>
                            <div class="field">
                                <label>Occupation</label>
                                <input type="text" id="new_patient_occupation" placeholder="Occupation">
                            </div>
                        </div>

                        <div class="ui green inverted button" id="btn_add_new_patient">
                            <i class="save icon"></i>
                            Enregistrer
                        </div>
                    </form>
                </div>
            </div>
        </div>

	</div>
</div>
<!-- /page content -->


<!-- Modal_show_patient -->
<div class="ui modal" id="patient_show_modal">
    <i class="close icon"></i>
    <div class="header">
        Patient
    </div>
    <div class="content">
        <div class="ui grid">
            <div class="six wide column">
                <div class="ui card">
                    <div class="image">
                        <img src="<?php echo URL; ?>/public/images/kari.jpg">
                    </div>
                    <div class="content">
                        <h4>
                            <span id="show_patient_prenom_et_nom"></span>
                        </h4>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="ten wide column">
                <table class="ui small table">
                    <tbody>
                        <tr>
                            <td>Identifiant</td>
                            <td>
                                <span id="show_patient_id"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Numero de la fiche</td>
                            <td>
                                <span id="show_patient_fiche_numero"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Numero du dossier</td>
                            <td>
                                <span id="show_patient_dossier_numero"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Nom</td>
                            <td>
                                <span id="show_patient_nom"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Post-Nom</td>
                            <td>
                                <span id="show_patient_postnom"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Prenom</td>
                            <td>
                                <span id="show_patient_prenom"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Sexe</td>
                            <td>
                                <span id="show_patient_sexe"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Date de naissance</td>
                            <td>
                                <span id="show_patient_date_naissance"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Adresse</td>
                            <td>
                                <span id="show_patient_adresse"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Statut</td>
                            <td>
                                <span id="show_patient_statut"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Conventionne id</td>
                            <td>
                                <span id="show_patient_fk_patient_conv"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Affiliation</td>
                            <td>
                                <span id="show_patient_affiliation"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Code Convention</td>
                            <td>
                                <span id="show_patient_code_convention"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Occupation</td>
                            <td>
                                <span id="show_patient_occupation"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Date d'enregistrement</td>
                            <td>
                                <span id="show_patient_save_date"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Enregistre(e) par</td>
                            <td>
                                <span id="show_patient_fk_users_id"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- Modal_update_patient -->
<div class="ui modal" id="patient_update_modal">
    <i class="close icon"></i>
    <div class="header">
        Mettre à Jour le Patient
    </div>
    <div class="content">
        
        <form class="ui mini form" id="form_update_patient">
            <h4 class="ui dividing header">Nouveau Patient</h4>
            <input type="hidden" id="hidden_patient_id">
            <div class="field">
                <div class="three fields">
                    <div class="field">
                        <label>Prénom</label>
                        <input type="text" id="update_patient_prenom" placeholder="Prénom">
                    </div>
                    <div class="field">
                        <label>Nom</label>
                        <input type="text" id="update_patient_nom" placeholder="Nom">
                    </div>
                    <div class="field">
                        <label>Post-Nom</label>
                        <input type="text" id="update_patient_postnom" placeholder="Post-Nom">
                    </div>
                </div>
            </div>
            <div class="three fields">
                <div class="field">
                    <label>Date de naissance</label>
                    <input type="date" id="update_patient_date_naissance">
                </div>
                <div class="field">
                    <label>Sexe</label>
                    <select class="dropdown" id="update_patient_sexe">
                        <option value="M">Masculin</option>
                        <option value="F">Feminin</option>
                    </select>
                </div>
                <div class="field">
                    <label>Adresse</label>
                    <input type="text" id="update_patient_adresse" placeholder="Adresse">
                </div>
            </div>
            <div class="four fields">
                <div class="field">
                    <label>Statut</label>
                    <select class="dropdown" id="update_patient_statut">
                        <option value="familleConv">Famille Conventionne</option>
                        <option value="conventionne">Conventionne</option>
                        <option value="simple">Simple</option>
                    </select>
                </div>
                <div class="field">
                    <label>Num. du dossier</label>
                    <input type="text" id="update_patient_dossier_num" placeholder="Numero du dossier">
                </div>
                <div class="field">
                    <label>Num. de la fiche</label>
                    <input type="text" id="update_patient_fiche_num" placeholder="Numero de la fiche">
                </div>
                <div class="field" id="bloc_titulaire_toggle">
                    <label>Titulaire</label>
                    <input type="text" id="update_patient_titulaire_id" placeholder="Identifiant du titulaire">
                </div>
            </div>
            <div class="three fields" id="bloc_conv_toggle">
                <div class="field">
                    <label>Affiliation</label>
                    <input type="text" id="update_patient_affiliation" placeholder="Affiliation">
                </div>
                <div class="field">
                    <label>Code_convention</label>
                    <input type="text" id="update_patient_code_conv" placeholder="Code Convention">
                </div>
                <div class="field">
                    <label>Occupation</label>
                    <input type="text" id="update_patient_occupation" placeholder="Occupation">
                </div>
            </div>
        </form>

    </div>
    <div class="actions">
        <button class="ui positive button" id="done_user_update">
            Valider
        </button>
        <button class="ui negative button">
            Annuler
        </button>
    </div>
</div>

<!-- Modal ouvrir fiche et diriger vers un medecin -->
<div class="ui modal" id="ouvrir_fiche_modal">
    <i class="close icon"></i>
    <div class="header">
        Ouverture fiche
    </div>
    <div class="content">
        <form class="ui small form" id="form_ouvrir_fiche">
            <input type="hidden" id="ouvrir_fiche_fk_patient_id">
            <div class="four fields">
                <div class="field">
                    <label>Poids</label>
                    <input type="text" id="ouvrir_fiche_poids" placeholder="Poids">
                </div>
                <div class="field">
                    <label>Tension</label>
                    <input type="text" id="ouvrir_fiche_tension" placeholder="Tension">
                </div>
                <div class="field">
                    <label>Temperature</label>
                    <input type="text" id="ouvrir_fiche_temperature" placeholder="Temperature">
                </div>
                <div class="field">
                    <label>Medecin Consultant</label>
                    <select id="ouvrir_fiche_medecin_id">
                        <?php
                            foreach ($this->medecins as $medecin) {
                        ?>
                                <option value="<?php echo $medecin['users_id'] ?>"><?php echo $medecin['prenom'].' '.$medecin['nom'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <button class="ui green button" id="btn_done_ouverture_fiche">
            Valider
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>