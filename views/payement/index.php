
<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

    <div class="ui segment blue">

        <div class="ui secondary pointing menu">
            <a class="active item green tab_item" id="payement_carnet" data-tab="first">
                <i class="folder icon"></i>
                Carnet de payement
            </a>
            <a class="item green tab_item" id="payement_new_payement" data-tab="second">
                <i class="credit card icon"></i>
                Effectuer un payement
            </a>
        </div>
        <div class="ui bottom attached active tab segment" id="payement_first_onglet" data-tab="first">
            <div id="first_onglet_content">
                <table id="table_payements" class="ui small green celled table">
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
        </div>

        <div class="ui bottom attached tab segment" id="payement_second_onglet" data-tab="second">
            <div id="second_onglet_content">
                <div class="ui two column green segment">
                    <form class="ui mini form" id="form_add_payement">
                        <h4 class="ui dividing header">Nouveau Payement</h4>
                        <div class="two fields">
                            <div class="field">
                                <label>Motif</label>
                                <select class="dropdown" id="new_payement_motif">
                                    <option value="1">Frais Fiche</option>
                                    <option value="2">Frais Laboratoire</option>
                                    <option value="3">Autres frais</option>
                                </select>
                            </div>
                            <div class="field" id="bloc_ident_patient">
                                <label>Identifiant du patient</label>
                                <input type="text" id="new_payement_patient_id" placeholder="Identifiant du patient">
                            </div>
                            <div class="field" id="bloc_ident_demande">
                                <label>Identifiant Demande</label>
                                <input type="text" id="new_payement_demande_id" placeholder="Identifiant de la demande">
                            </div>
                            <div class="field bloc_autre_payement">
                                <label>Motif du payement</label>
                                <input type="text" id="new_payement_motif_autre_payement" placeholder="Motif du payement">
                            </div>
                            <div class="field bloc_autre_payement">
                                <label>Montant du payement</label>
                                <input type="number" min="0" id="new_payement_montant_autre_payement" placeholder="Identifiant de la demande">
                            </div>
                        </div>

                        <div class="ui green inverted button" id="btn_add_new_payement">
                            <i class="save icon"></i>
                            Valider le payement
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- modal preview payement fiche -->
<div class="ui modal" id="valider_payement_fiche_modal">
    <i class="close icon"></i>
    <div class="header">
        Valider le payement ?
    </div>
    <div class="content">
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
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_payement_fiche">
            Valider le payement
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- modal preview payement consultation -->
<div class="ui modal" id="valider_payement_labo_modal">
    <i class="close icon"></i>
    <div class="header">
        Valider le payement ?
    </div>
    <div class="content">
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
        <div id="payement_autres_examens_liste" class="ui segment shwo_fiche_box"></div>
        <h4>Montant autres examens</h4>
        <div>
            <form class="ui mini form" id="form_prix_autres_examens">
                <div class="field">
                    <input type="number" min="0" name="payement_input_set_prix_autres_examens" id="payement_input_set_prix_autres_examens">
                </div>
            </form>
        </div>
        <hr>
        <h4 >TOTAL: <span id="total_avec_autres_payement"></span> FC</h4>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_payement_labo">
            Valider le payement
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>

<!-- Modal preview autre payement -->
<div class="ui modal" id="valider_autre_payement_modal">
    <i class="close icon"></i>
    <div class="header">
        Valider le payement ?
    </div>
    <div class="content">
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
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_autre_payement">
            Valider le payement
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>