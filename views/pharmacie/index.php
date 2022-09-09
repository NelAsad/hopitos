<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">
    <div class="ui segment blue">
        <div class="ui secondary pointing menu">
            <a class="active item green tab_item" data-tab="first">
                <i class="pied piper icon"></i>
                Les produits
            </a>
            <a class="item green tab_item" data-tab="second">
                <i class="plus card icon"></i>
                Ajouter un produit
            </a>
            <!-- <a class="item green tab_item" data-tab="third">
                <i class="send card icon"></i>
                Delivrer produits
            </a> -->
            <a class="item green tab_item" data-tab="fourth">
                <i class="line chart card icon"></i>
                Statistiques
            </a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="first">
            <div>
                <table id="produits_table" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Dosage</th>
                            <th>Prix de vente</th>
                            <th>Quantité</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">
            <div>
                <div class="ui two column green segment">
                    <form class="ui mini form" id="form_add_produit">
                        <h4 class="ui dividing header">Nouveau Produit</h4>
                        <div class="four fields">
                            <div class="field">
                                <label>Nom du produit</label>
                                <input type="text" id="new_produit_nom" placeholder="Nom du produit">
                            </div>
                            <div class="field">
                                <label>Dosage</label>
                                <input type="text" id="new_produit_dosage" placeholder="Dosage du produit">
                            </div>
                            <div class="field">
                                <label>Unité</label>
                                <select class="dropdown" id="new_produit_dosage_unite">
                                    <option value="">Veillez choisir l'unité</option>
                                    <option value="ml">ml</option>
                                    <option value="mg">mg</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Prix de vente</label>
                                <input type="text" id="new_produit_pv" placeholder="Prix de vente (FC)">
                            </div>
                        </div>

                        <div class="ui green inverted button" id="btn_add_new_produit">
                            <i class="save icon"></i> Ajouter le produit
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="ui bottom attached tab segment" data-tab="third">
            <div>
                troisieme
            </div>
        </div> -->
        <div class="ui bottom attached tab segment" data-tab="fourth">
            <div>
                <table id="sortie_produits_table" width="100%" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>Identifiant produit</th>
                            <th>Nom du produit</th>
                            <th>Quantité</th>
                            <th>Date de sortie</th>
                            <!-- <th>Opérateur</th> -->
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- modal update produit -->
<div class="ui modal" id="update_produit_modal">
    <i class="close icon"></i>
    <div class="header">
        Mettre à jour le produit
    </div>
    <div class="content">
        <form class="ui mini form" id="form_update_produit">
            <input type="hidden" id="hidden_update_produit_id">
            <div class="four fields">
                <div class="field">
                    <label>Nom du produit</label>
                    <input type="text" id="update_produit_nom" placeholder="Nom du produit">
                </div>
                <div class="field">
                    <label>Dosage</label>
                    <input type="text" id="update_produit_dosage" placeholder="Dosage du produit">
                </div>
                <div class="field">
                    <label>Unité</label>
                    <select class="dropdown" id="update_produit_dosage_unite">
                        <option value="">Veillez choisir l'unité</option>
                        <option value="ml">ml</option>
                        <option value="mg">mg</option>
                    </select>
                </div>
                <div class="field">
                    <label>Prix de vente</label>
                    <input type="text" id="update_produit_pv" placeholder="Prix de vente (FC)">
                </div>
                <div class="field">
                    <label>Quantité en stock</label>
                    <input type="number" id="update_produit_qte" placeholder="Prix de vente (FC)">
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_add_update_produit">
            Valider
        </button>
        <button class="ui negative button">
            Annuler
        </button>
    </div>
</div>

<!-- modal add qte produit -->
<div class="ui modal" id="add_qte_produit_modal">
    <i class="close icon"></i>
    <div class="header">
        Ajouter une quatité
    </div>
    <div class="content">
        <form class="ui mini form" id="form_add_qte_produit">
            <input type="hidden" id="hidden_add_qte_produit_id">
            <div class="field">
                <label>Quatité à ajoutée</label>
                <input type="text" id="add_qte_produit_qte" placeholder="Quatité à ajoutée">
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_add_qte_produit">
            Ajouter
        </button>
        <button class="ui negative button">
            Annuler
        </button>
    </div>
</div>

<!-- modal add delivrer qte produit -->
<div class="ui modal" id="delivrer_qte_produit_modal">
    <i class="close icon"></i>
    <div class="header">
        Delivrer une quatité
    </div>
    <div class="content">
        <form class="ui mini form" id="form_delivrer_qte_produit">
            <input type="hidden" id="hidden_delivrer_qte_produit_id">
            <div class="field">
                <label>Quatité à delivré</label>
                <input type="text" id="delivrer_produit_qte" placeholder="Quatité à delivré">
            </div>
        </form>
    </div>
    <div class="actions">
        <button type="submit" class="ui positive button" id="btn_delivrer_qte_produit">
            Delivrer
        </button>
        <button class="ui negative button">
            Annuler
        </button>
    </div>
</div>