
<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

	<div class="ui segment blue">

		<div class="ui secondary tabular pointing menu">
			<a class="active item green tab_item" data-tab="first">
				<i class="file icon"></i>
				Nouvelle demandes d'examen
			</a>
			<a class="item green tab_item" data-tab="second">
				<i class="check circle icon"></i>
				Demandes satisfaites du jour
			</a>
			<a class="item green tab_item" data-tab="third">
				<i class="check circle icon"></i>
				Toutes les demandes satisfaites
			</a>
			<a class="item green tab_item" data-tab="four">
				<i class="remove icon"></i>
				Demandes declassees du jour
			</a>
			<a class="item green tab_item" data-tab="five">
				<i class="remove icon"></i>
				Toutes les demandes declassees
			</a>
		</div>

		<div class="ui bottom attached active tab segment" data-tab="first">
            <div>
                <table id="table_nouvelles_demandes" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>N° Examen</th>
                            <th>Demandeur</th>
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
		<div class="ui bottom attached tab segment" data-tab="second">
            <div>
                <table style=" width: 100% ;" id="table_demandes_satisf_du_jour" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>N° Examen</th>
                            <th>Demandeur</th>
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
		<div class="ui bottom attached tab segment" data-tab="third">
            <div>
                <table style=" width: 100% ;" id="table_demandes_satisf_all" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>N° Examen</th>
                            <th>Demandeur</th>
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
		<div class="ui bottom attached tab segment" data-tab="four">
            <div>
                <table style=" width: 100% ;" id="table_demandes_declassees_today" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>N° Examen</th>
                            <th>Demandeur</th>
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
		<div class="ui bottom attached tab segment" data-tab="five">
            <div>
                <table style=" width: 100% ;" id="table_demandes_declassees_all" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>N° Examen</th>
                            <th>Demandeur</th>
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
	</div>
</div>
<!-- /page content -->


<!-- Modal inserer resultat examen -->
<div class="ui modal" id="inserer_examens_modal">
    <i class="close icon"></i>
    <div class="header">
        Inserer les resultats des examens
    </div>
    <div class="content">
        <form class="ui mini form" id="form_inserer_exam">
            
            <div class="field">
                <div id="exam_show_service" class="ui segment shwo_fiche_box"></div>
                <!-- les champs caches -->
                <input type="hidden" id="hidden_exam_id" name="hidden_exam_id">
            </div>
            <h4>Examens de routine</h4>
            <div class="field">
                <div class="four fields">
                    <div class="field ">
                        <h4 class="ui dividing header">HEMATOLOGIE</h4>
                        <label for="hemato_Hbg">Hbg</label>
                        <input type="text" id="hemato_Hbg" name="hemato_Hbg" >
                        <label for="hemato_GB">GB</label>
                        <input type="text" id="hemato_GB" name="hemato_GB" >
                        <label for="hemato_VS">VS</label>
                        <input type="text" id="hemato_VS" name="hemato_VS" >
                        <label for="hemato_FL_E">FL %E</label>
                        <input type="text" id="hemato_FL_E" name="hemato_FL_E" >
                        <label for="hemato_FL_B">FL %B</label>
                        <input type="text" id="hemato_FL_B" name="hemato_FL_B" >
                        <label for="hemato_FL_L">FL %L</label>
                        <input type="text" id="hemato_FL_L" name="hemato_FL_L" >
                        <label for="hemato_FL_M">FL %M</label>
                        <input type="text" id="hemato_FL_M" name="hemato_FL_M" >
                        <label for="hemato_TS">TS</label>
                        <input type="text" id="hemato_TS" name="hemato_TS" >
                        <label for="hemato_TC">TC</label>
                        <input type="text" id="hemato_TC" name="hemato_TC" >
                        <label for="hemato_GS">GS</label>
                        <input type="text" id="hemato_GS" name="hemato_GS" >
                        <label for="hemato_HTC">HTC</label>
                        <input type="text" id="hemato_HTC" name="hemato_HTC" >
                    </div>
                    <div class="field ">
                        <h4 class="ui dividing header">PARASITOLOGIE</h4>
                        <h5 class="ui dividing header">A. Sang</h5>
                        <label for="parasito_GE">GE</label>
                        <input type="text" id="parasito_GE" name="parasito_GE" >
                        <label for="parasito_GF">GF</label>
                        <input type="text" id="parasito_GF" name="parasito_GF" >
                        <label for="parasito_CATT">CATT</label>
                        <input type="text" id="parasito_CATT" name="parasito_CATT" >
                        <label for="parasito_frais_mince">Frais Mince</label>
                        <input type="text" id="parasito_frais_mince" name="parasito_frais_mince" >
                        <h5 class="ui dividing header">B. Selles</h5>
                        <label for="parasito_selles_exam_direct">Examen direct</label>
                        <input type="text" id="parasito_selles_exam_direct" name="parasito_selles_exam_direct" >
                        <h5 class="ui dividing header">C. Urines</h5>
                        <label for="parasito_urines_sediment">Sédiment</label>
                        <input type="text" id="parasito_urines_sediment" name="parasito_urines_sediment" >
                        <h5 class="ui dividing header">D. Frottis Vaginal & Uretral</h5>
                        <label for="parasito_PVUF">A Frais</label>
                        <input type="text" id="parasito_PVUF" name="parasito_PVUF" >
                        <h5 class="ui dividing header">E. ECR</h5>
                        <label for="parasito_ecr_element">Elément</label>
                        <input type="text" id="parasito_ecr_element" name="parasito_ecr_element" >
                        <h5 class="ui dividing header">E. Bactériologie</h5>
                        <label for="parasito_bacterio_nature_produit">Nature du produit</label>
                        <input type="text" id="parasito_bacterio_nature_produit" name="parasito_bacterio_nature_produit" >
                        <label for="parasito_bacterio_gramme">Gramme</label>
                        <input type="text" id="parasito_bacterio_gramme" name="parasito_bacterio_gramme" >
                        <label for="parasito_bacterio_ziehl">Ziehl</label>
                        <input type="text" id="parasito_bacterio_ziehl" name="parasito_bacterio_ziehl" >
                    </div>
                    <div class="field">
                        <h4 class="ui dividing header">BIO-CHIMIE</h4>
                        <label for="bio_nature_produit">Nature du produit</label>
                        <input type="text" id="bio_nature_produit" name="bio_nature_produit" >
                        <label for="bio_glucose">Glucose</label>
                        <input type="text" id="bio_glucose" name="bio_glucose" >
                        <label for="bio_bilirubine">Bilirubine</label>
                        <input type="text" id="bio_bilirubine" name="bio_bilirubine" >
                        <label for="bio_albumine">Albumine</label>
                        <input type="text" id="bio_albumine" name="bio_albumine" >
                        <label for="bio_acetone">Acétone</label>
                        <input type="text" id="bio_acetone" name="bio_acetone" >
                        <label for="bio_PH">PH</label>
                        <input type="text" id="bio_PH" name="bio_PH" >
                        <label for="bio_nitrite">Nitrite</label>
                        <input type="text" id="bio_nitrite" name="bio_nitrite" >
                    </div>
                    <div class="field">
                        <h4 class="ui dividing header">IMMINO SEROLOGIE</h4>
                        <label for="is_test_grossesse">Test de grossesse ?</label>
                        <input type="text" id="is_test_grossesse" name="is_test_grossesse" >
                        <label for="is_widal_TO">Widal TO</label>
                        <input type="text" id="is_widal_TO" name="is_widal_TO" >
                        <label for="is_TH">TH</label>
                        <input type="text" id="is_TH" name="is_TH" >
                        <label for="is_CATT">CATT</label>
                        <input type="text" id="is_CATT" name="is_CATT" >
                        <label for="is_HBS">HBS</label>
                        <input type="text" id="is_HBS" name="is_HBS" >
                        <label for="is_HC">HC</label>
                        <input type="text" id="is_HC" name="is_HC" >
                        <label for="is_P120">P120</label>
                        <input type="text" id="is_P120" name="is_P120" >
                    </div>
                </div>
            </div>
            <h4>Autres Examens</h4>
            <div id="laboratoire_autres_examens_liste" class="ui segment shwo_fiche_box"></div>
            <h4>Resultats autres examens</h4>
            <div class="field">
                <!-- <label for="">Autres Examens</label> -->
                <textarea name="laboratoire_autres_examens_resultats" id="laboratoire_autres_examens_resultats" cols="30" rows="10"></textarea>
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_inserer_exam">
            Valider
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- modal declasser examen -->
<div class="ui modal" id="declasser_demande_examen_modal">
    <i class="close icon"></i>
    <div class="header">
        Declasser le demande d'examen
    </div>
    <div class="content">
        <form class="ui small form" id="form_declasser_exam">
            <div class="field">
                <input type="hidden" id="hidden_declasser_exam_id" name="hidden_declasser_exam_id">
                
                <label for="declasser_exam_motif">Motif du declassement</label>
                <textarea name="declasser_exam_motif" id="declasser_exam_motif" cols="30" rows="5" placeholder="Motif du declassement" ></textarea>
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_declasser_exam">
            Valider
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- Modal voir les resultats apres insertion -->
<div class="ui modal" id="voir_exam_apres_insertion_modal">
    <i class="close icon"></i>
    <div class="header">
        Les resultats
    </div>
    <div class="content">
        <div id="les_resultats_apres_insertion" class="ui segment shwo_fiche_box"></div>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- Modal voir le motif du declassement apres insertion -->
<div class="ui modal" id="voir_motif_declassement_apres_insertion_modal">
    <i class="close icon"></i>
    <div class="header">
        Le motif du declassement
    </div>
    <div class="content">
        <div id="le_motif_apres_insertion" class="ui segment shwo_fiche_box"></div>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>