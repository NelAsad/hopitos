<?php

class Payement extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege !='1' && $privilege !='5') || $etat != 'actif') {
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
        $this->view->js = array('payement/js/default.js');
        $this->view->css = array('payement/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->render('payement/index');
    }

    /**
     * Donne les donnes initiales (DataTables)
     */
    function payement_datatable(){
        $this->model->payement_datatable();
    }

    /**
     * Donne la config pour le frais de fiche
     */
    function get_config_frais_fiche(){

        $config_id = 1;
        $config = $this->model->get_config_by_id($config_id);

        echo json_encode($config);
    }

    /**
     * Donne un exam by ID
     */
    function get_exam_by_id(){
        $new_payement_demande_id = $_POST['new_payement_demande_id'];
        $examen = $this->model->get_exam($new_payement_demande_id);
        
        echo json_encode($examen);
        
    }

    /**
     * Donne un patient avec tout le
     */
    function get_patient(){
        $patient_id = $_POST['patient_id'];
        $patient = $this->model->get_patient($patient_id);

        echo json_encode($patient);
    }

    /**
     * Donne les montants pour les differentes examens
     */
    function get_montant_frais_by_name(){
        $exam_demandes = $_POST['exam_demandes'];
        $exam_avec_prix = array();

        foreach ($exam_demandes as $key => $nom_exam) {

            $config = $this->model->get_config_by_name($nom_exam);

            if (!empty($config)) {
                $exam_avec_prix[$nom_exam] = $config['config_val'];
            }

        }

        echo json_encode($exam_avec_prix);
    }

    /**
     * Done payement dans la db
     */
    function done_payement(){

        $users_id = Session::get('user_id');

        $new_payement_motif = $_POST['new_payement_motif'];
        $new_payement_patient_id = $_POST['new_payement_patient_id'];
        $new_payement_demande_id = $_POST['new_payement_demande_id'];
        
        $facture_numero = date('d').''.date('m').''.rand(100,999).''.date('Y');

        $std = new stdClass();

        if (isset($_POST['new_payement_motif_autre_payement']) || isset($_POST['new_payement_montant_autre_payement'])) {
            $new_payement_description = $_POST['new_payement_motif_autre_payement'];
            $montant_frais = $_POST['new_payement_montant_autre_payement'];
            $result = $this->model->done_payement($new_payement_motif,$new_payement_patient_id,$montant_frais,$facture_numero,$new_payement_demande_id,$users_id,$new_payement_description);
        } else {
            $montant_frais = $_POST['montant_frais'];
            //result_boolean
            $result = $this->model->done_payement($new_payement_motif,$new_payement_patient_id,$montant_frais,$facture_numero,$new_payement_demande_id,$users_id);
        }

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        } 
        echo json_encode($std);
    }

    
}
