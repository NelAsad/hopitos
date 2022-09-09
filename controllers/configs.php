<?php

class Configs extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege !='1') || $etat != 'actif') {
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
        $this->view->js = array('configs/js/default.js');
        $this->view->css = array('configs/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->render('configs/index');
    }

    /**
     * Donne les donnes initiales pour la configuration (DataTables)
     */
    function configs_datatable(){
        $this->model->xhr_configs_DataTable();
    }

    /**
     * Donne les donnes initiales pour la configuration (DataTables)
     */
    function depenses_datatable(){
        $this->model->xhr_depenses_Datatable();
    }

    /**
     * Ajout d'une nouvelle configuration
     */
    function add_new_config(){
        
        $config_type = $_POST['config_type'];
        $config_id = $_POST['config_id'];
        $config_nom = $_POST['config_nom'];
        $config_val = $_POST['config_val'];

        $std = new stdClass();

        //Insert patient
        $result = $this->model->insert_new_config($config_id,$config_type,$config_nom,$config_val);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }

        echo json_encode($std);
        
    }

    /**
     * Update valeur d'une config
     */
    function update_config_val(){

        $config_id = $_POST['config_id'];
        $config_new_val = $_POST['config_new_val'];

        $std = new stdClass();

        //Insert patient
        $result = $this->model->update_config_val($config_id,$config_new_val);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }

        echo json_encode($std);

    }

    //////////// DEPENSES ///////////////////

    function add_depense(){
        $users_id = Session::get('user_id');
        $new_depense_motif = $_POST['new_depense_motif'];
        $new_depense_montant = $_POST['new_depense_montant'];

        $std = new stdClass();

        //Insert patient
        $result = $this->model->add_depense($new_depense_motif,$new_depense_montant,$users_id);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }

        echo json_encode($std);
    }


}
