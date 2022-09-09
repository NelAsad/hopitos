
<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

	<div class="ui segment blue">
		<form action="<?php echo URL; ?>dossier/get_all_fiches_patient/" method="GET" class="ui mini form">
            <div class="inline fields">
                <div class="nine wide field">
                    <input type="text" name="search_text" placeholder="Identifiant du patient"/>
                </div>
                <div class="five wide field">
                    <select class="//dropdown" name="search_type">
                        <option value="patient_id">Identifiant du patient</option>
                        <option value="fiche_id">Numero de la fiche</option>
                        <option value="dossier_id">Numero du dossier</option>
                    </select>
                </div>
                <div class="two wide field">
                    <input type="submit" class="ui button green" id="search_submit_button" value="Rechercher"/>
                </div>
            </div>
        </form>
    </div>
    
    <div class="ui segment blue">
        <img class="ui rounded image" src="<?php echo URL; ?>public/images/fond3.jpg">
    </div>

</div>
<!-- /page content -->