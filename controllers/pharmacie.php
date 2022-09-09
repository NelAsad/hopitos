<?php

class Pharmacie extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || $etat != 'actif') {
            //Quand la session est off , le user n'est pas un admin ou le user n'est pas actif
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }else{
            //si tout va bien
            Session::set('connect_valide', true);
        }


        /**
         * insertion des js et css particulier pour ce module
         */
        $this->view->js = array('pharmacie/js/default.js');
        $this->view->css = array('pharmacie/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->render('pharmacie/index');
    }

    /**
     * Donne les donnes initiales (DataTables)
     */
    function produit_datatable(){
        $this->model->produit_datatable();
    }

    /**
     * Donne les donnees pour la datatable sortie produits
     */
    function sortie_produits_datatable(){
        $this->model->sortie_produits_datatable();
    }

    /**
     * Ajout d'un nouveau produit
     */
    function add_new_produit(){
        $produit_nom = $_POST['new_produit_nom'];
        $produit_dosage = $_POST['new_produit_dosage'];
        $produit_dosage_unite = $_POST['new_produit_dosage_unite'];
        $produit_pv = $_POST['new_produit_pv'];

        $std = new stdClass();

        $result = $this->model->insert_new_produit($produit_nom,$produit_dosage,$produit_dosage_unite,$produit_pv);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }

        echo json_encode($std);
    }

    /**
     * Renvoie un produit
     */
    function get_produit(){
        $produit_id = $_POST['produit_id'];
        $produit = $this->model->get_produit($produit_id);
        echo json_encode($produit);
    }

    /**
     * Upadate produit
     */
    function update_produit(){
        $produit_id = $_POST['produit_id'];
        $produit_nom = $_POST['produit_nom'];
        $produit_dosage = $_POST['produit_dosage'];
        $produit_dosage_unite = $_POST['produit_dosage_unite'];
        $produit_pv = $_POST['produit_pv'];
        $produit_qte = $_POST['produit_qte'];

        $std = new stdClass();

        $result = $this->model->update_produit($produit_id,$produit_nom,$produit_dosage,$produit_dosage_unite,$produit_pv,$produit_qte);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }

        echo json_encode($std);
    }

    /**
     * Ajout d'une qte pour un produit
     */
    function add_produit_qte(){
        $produit_id = $_POST['produit_id'];
        $produit_qte = $_POST['produit_qte'];
        $std = new stdClass();
        $result = $this->model->add_produit_qte($produit_id,$produit_qte);
        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
    }

    /**
     * Delivrer une qte d'un produit
     */
    function delivrer_produit_qte(){
        $users_id = Session::get('user_id');
        $produit_id = $_POST['produit_id'];
        $produit_qte = $_POST['produit_qte'];
        $quantite_delivree = $_POST['quantite_delivree'];
        $std = new stdClass();
        $result = $this->model->delivrer_produit_qte($produit_id,$quantite_delivree,$users_id);

        if ($result) {
            $result = $this->model->add_produit_qte($produit_id,$produit_qte);
            if ($result) {
                $std->reponse = 'bien';
            } else {
                $std->reponse = 'pas_bien';
            }
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);
    }

}
