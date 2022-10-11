<?php

class Patient extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege !='1' && $privilege !='2') || $etat != 'actif') {
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
        $this->view->js = array('patient/js/default.js');
        $this->view->css = array('patient/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {

        $this->view->medecins = $this->model->get_users_by_privilege(3);

        $this->view->render('patient/index');
    }

    /**
     * Donne les donnes initiales pour la gestion des patients (DataTables)
     */
    function patient_datatable(){
        $this->model->xhr_patient_DataTable();
    }

    

    /**
     * Ouvrir une fiche
     */
    function ouvrir_une_fiche(){
        $patient_id = $_POST['patient_id'];
        $poids = $_POST['poids'];
        $tension = $_POST['tension'];
        $temperature = $_POST['temperature'];
        $fk_agent = $_POST['medecin_consultant_id'];

        $std = new stdClass();

        $fk_visite = $this->model->insert_visite($patient_id);
        $fk_signe_vitaux = $this->model->insert_signe_vitaux($poids,$tension,$temperature);
        $result = $this->model->insert_visite_signe_vitaux($fk_signe_vitaux, $fk_visite);
        $result = $this->model->insert_transfert_visite($fk_agent, $fk_visite);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }

        echo json_encode($std);
    }


}
