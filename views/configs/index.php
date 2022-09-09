
<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

    <div class="ui segment blue">

        <div class="ui secondary pointing menu">
            <a class="active item green tab_item" data-tab="first">
                <i class="cogs icon"></i>
                Les configurations
            </a>
            <a class="item green tab_item" data-tab="second">
                <i class="plus card icon"></i>
                Ajouter Une configurations
            </a>
            <a class="item green tab_item" data-tab="third">
                <i class="money icon"></i>
                Effectuer une depense
            </a>
            <a class="item green tab_item" data-tab="fourth">
                <i class="money icon"></i>
                Les Depenses
            </a>
        </div>

        <div class="ui bottom attached active tab segment" data-tab="first">
            <table id="table_configs" class="ui small green celled table">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Valeur</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">
            <div class="ui two column green segment">
                <form class="ui mini form" id="form_add_new_config">
                    <h4 class="ui dividing header">Nouvelle Configuration</h4>
                    <div class="four fields">
                        <div class="field">
                            <label>Type de la configuration</label>
                            <select class="dropdown" id="config_type">
                                <option value="1">Frais</option>
                                <option value="-">--Autres--</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Code de la configuration</label>
                            <input type="text" id="config_id" placeholder="Code de la configuration">
                        </div>
                        <div class="field">
                            <label>Nom de la configuration</label>
                            <input type="text" id="config_nom" placeholder="Nom de la configuration">
                        </div>
                        <div class="field">
                            <label>Valeur de la configuration</label>
                            <input type="text" id="config_val" placeholder="Valeur de la configuration">
                        </div>
                    </div>

                    <div class="ui green inverted button" id="btn_add_new_config">
                        <i class="save icon"></i>
                        Enregistrer
                    </div>
                </form>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="third">
            <div class="ui two column green segment">
                <form class="ui mini form" id="form_add_new_depense">
                    <h4 class="ui dividing header">Effectuer une depense</h4>

                    <div class="two fields">
                        <div class="field">
                            <label>Motif de la depense</label>
                            <input type="text" id="new_depense_motif" placeholder="Motif de la depense">
                        </div>
                        <div class="field">
                            <label>Montant</label>
                            <input type="text" id="new_depense_montant" placeholder="Montant">
                        </div>
                    </div>

                    <div class="ui green inverted button" id="btn_done_new_depense">
                        <i class="save icon"></i>
                        Valider
                    </div>
                </form>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="fourth">
            <table id="table_depenses" class="ui small green celled table" width="100%">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Motif</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Auteur</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>
<!-- /page content -->

<!-- modal declasser examen -->
<div class="ui modal" id="update_config_val_modal">
    <i class="close icon"></i>
    <div class="header">
        Modifier la valeur de la configuration
    </div>
    <div class="content">
        <form class="ui small form" id="form_update_config_val">
            <div class="field">
                <input type="hidden" id="hidden_update_config_val_id" name="hidden_update_config_val_id">
                
                <label for="update_config_new_value">Nouvelle valeur</label>
                <input type="text" name="update_config_new_value" id="update_config_new_value" placeholder="Nouvelle valeur" />
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_done_update_config_val">
            Valider
        </button>
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>
