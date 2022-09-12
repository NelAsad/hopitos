<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pharmacie
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
                        <li class="active"><a href="#tab_1" data-toggle="tab">Les produits</a></li>
                        <li><a href="#tab_2" data-toggle="tab">Ajouter un produit</a></li>
                        <li><a href="#tab_3" data-toggle="tab">Statistiques</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="produits_table" class="table">
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
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <form class="ui mini form" id="form_add_produit">
                                <h4 class="ui dividing header">Nouveau Produit</h4>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <label>Nom du produit</label>
                                        <input class="form-control" type="text" id="new_produit_nom" placeholder="Nom du produit">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>Dosage</label>
                                        <input class="form-control" type="text" id="new_produit_dosage" placeholder="Dosage du produit">
                                    </div>
                                    <div class="col-xs-3">
                                        <label>Unité</label>
                                        <select class="form-control" class="dropdown" id="new_produit_dosage_unite">
                                            <option value="">Veillez choisir l'unité</option>
                                            <option value="ml">ml</option>
                                            <option value="mg">mg</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-3">
                                        <label>Prix de vente</label>
                                        <input class="form-control" type="text" id="new_produit_pv" placeholder="Prix de vente (FC)">
                                    </div>
                                </div>

                                <div class="btn btn-primary btn-block" id="btn_add_new_produit" style="margin-top: 30px;">
                                    <i class="save icon"></i> Ajouter le produit
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <table id="sortie_produits_table" width="100%" class="table">
                                <thead>
                                    <tr>
                                        <th>Identifiant produit</th>
                                        <th>Nom du produit</th>
                                        <th>Quantité</th>
                                        <th>Date de sortie</th>
                                    </tr>
                                </thead>
                            </table>
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


<!-- modal update produit -->
<div class="modal fade" id="update_produit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Mettre à jour le produit</h4>
            </div>
            <div class="modal-body">
                <form class="ui mini form" id="form_update_produit">
                    <input type="hidden" id="hidden_update_produit_id">
                    <div class="row">
                        <div class="col-xs-4">
                            <label>Nom du produit</label>
                            <input class="form-control" type="text" id="update_produit_nom" placeholder="Nom du produit">
                        </div>
                        <div class="col-xs-4">
                            <label>Dosage</label>
                            <input class="form-control" type="text" id="update_produit_dosage" placeholder="Dosage du produit">
                        </div>
                        <div class="col-xs-4">
                            <label>Unité</label>
                            <select class="form-control" class="dropdown" id="update_produit_dosage_unite">
                                <option value="">Veillez choisir l'unité</option>
                                <option value="ml">ml</option>
                                <option value="mg">mg</option>
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <label>Prix de vente</label>
                            <input class="form-control" type="text" id="update_produit_pv" placeholder="Prix de vente (FC)">
                        </div>
                        <div class="col-xs-6">
                            <label>Quantité en stock</label>
                            <input class="form-control" type="number" id="update_produit_qte" placeholder="Prix de vente (FC)">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_add_update_produit">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- modal add qte produit -->
<div class="modal fade" id="add_qte_produit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ajouter une quatité</h4>
            </div>
            <div class="modal-body">
                <form class="ui mini form" id="form_add_qte_produit">
                    <input type="hidden" id="hidden_add_qte_produit_id">
                    <div class="field">
                        <label>Quatité à ajoutée</label>
                        <input class="form-control" type="text" id="add_qte_produit_qte" placeholder="Quatité à ajoutée">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_add_qte_produit">Valider</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- modal add delivrer qte produit -->
<div class="modal fade" id="delivrer_qte_produit_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delivrer une quatité</h4>
            </div>
            <div class="modal-body">
                <form class="ui mini form" id="form_delivrer_qte_produit">
                    <input type="hidden" id="hidden_delivrer_qte_produit_id">
                    <div class="field">
                        <label>Quatité à delivré</label>
                        <input class="form-control" type="text" id="delivrer_produit_qte" placeholder="Quatité à delivré">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary" id="btn_delivrer_qte_produit">Delivrer</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
