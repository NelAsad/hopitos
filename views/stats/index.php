
<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

    <div class="ui segment blue">

        <div class="ui secondary pointing menu">
            <a class="active item green tab_item" data-tab="first">
                <i class="money icon"></i>
                Finances
            </a>
            <a class="item green tab_item" data-tab="second">
                <i class="stethoscope icon"></i>
                Consultations
            </a>
            <!-- <a class="item green tab_item" data-tab="third">
                <i class="medkit icon"></i>
                Laboratoire
            </a> -->
        </div>
        <div class="ui bottom attached active tab segment" data-tab="first">
            <div class="ui segment blue">
                <form method="GET" class="ui mini form" >
                    <div class="inline fields">
                        <div class="three wide field" id="search_pour_date_block">
                            <input type="date" id="date_pour_search_d_un_jour"/>
                        </div>
                        <div class="three wide field search_pour_periode_block">
                            <input type="date" id="date_debut_pour_search_d_un_jour"/>
                        </div>
                        <div class="three wide field search_pour_periode_block">
                            <input type="date" id="date_fin_pour_search_d_un_jour"/>
                        </div>
                        <div class="three wide field">
                            <select class="//dropdown"  id="search_type">
                                <option value="">Type de recherche</option>
                                <option value="1">Pour une date</option>
                                <option value="2">Pour une période</option>
                            </select>
                        </div>
                        <div class="four wide field">
                            <button type="submit" id="btn_search_stat" class="ui right labeled icon fluid mini button green"><i class="search icon"></i> Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            <table id="table_finances" class="ui small green celled table">
                <thead>
                    <tr>
                        <th width="9%">NOMBRE FICHES</th>
                        <th width="12%">MONTANT TOTAL FICHE</th>
                        <th width="16%">MONTANT TOTAL LABORATOIRE</th>
                        <th width="15%">TOTAL FICHE & LABORATOIRE</th>
                        <th width="19%">MONTANT TOTAL AUTRES PAYEMENTS</th>
                        <th>TOTAL</th>
                        <th>DEPENSES</th>
                        <th>SOLDE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="9%">
                            <span id="span_nbre_fiche"></span>
                        </td>
                        <td width="12%">
                            <span id="span_total_fiche"></span>  fc
                        </td>
                        <td width="16%">
                            <span id="span_total_labo"></span> fc
                        </td>
                        <td width="15%">
                            <span id="span_total_fiche_and_labo"></span> fc
                        </td>
                        <td width="19%">
                            <span id="span_total_autres_peyements"></span> fc
                        </td>
                        <td>
                            <span id="span_total_all"></span> fc
                        </td>
                        <td>
                            <span id="span_total_depenses"></span> fc
                        </td>
                        <td>
                            <span id="span_total_solde"></span> fc
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="ui bottom attached tab segment" data-tab="second">
            <div class="ui segment blue">
                <form method="GET" class="ui mini form" >
                    <div class="inline fields">
                        <div class="three wide field" id="search_pour_date_block_consultation">
                            <input type="date" id="date_pour_search_d_un_jour_consultation"/>
                        </div>
                        <div class="three wide field search_pour_periode_block_consultation">
                            <input type="date" id="date_debut_pour_search_d_un_jour_consultation"/>
                        </div>
                        <div class="three wide field search_pour_periode_block_consultation">
                            <input type="date" id="date_fin_pour_search_d_un_jour_consultation"/>
                        </div>
                        <div class="three wide field">
                            <select class="//dropdown"  id="search_type_consultation">
                                <option value="">Type de recherche</option>
                                <option value="1">Pour une date</option>
                                <option value="2">Pour une période</option>
                            </select>
                        </div>
                        <div class="three wide field">
                            <select class="//dropdown"  id="search_medecin_consultation">
                                <option value="">Tous les médecin</option>
                                <?php
                                    foreach ($this->medecins as $medecin) {
                                ?>
                                        <option value="<?php echo $medecin['users_id'] ?>"><?php echo $medecin['prenom'].' '.$medecin['nom'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="four wide field">
                            <button type="submit" id="btn_search_stat_consultation" class="ui right labeled icon fluid mini button green"><i class="search icon"></i> Rechercher</button>
                        </div>
                    </div>
                </form>
            </div>
            <table id="table_consultation_info" class="ui small green celled table">
                <thead>
                    <tr>
                        <th>Nombre de consultations</th>
                        <th>Montant total pour les consultations</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span id="span_nbre_consultations"></span>
                        </td>
                        <td>
                            <span id="span_motant_total_consultation"></span> fc
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- <div class="ui bottom attached tab segment" data-tab="third">
            <div>
                Les differentes panel avec les statistiques du laboratoire (nbre de demandes traitees et par quel laboratin etc)
            </div>
        </div> -->
    </div>
</div>
<!-- /page content -->
