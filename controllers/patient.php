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
     * Ajout d'un nouveau patient
     */
    function add_new_patient(){
        
        $users_id = Session::get('user_id');
        
        $prenom = $_POST['new_patient_prenom'];
        $nom = $_POST['new_patient_nom'];
        $postnom = $_POST['new_patient_postnom'];
        $date_naissance = $_POST['new_patient_date_naissance'];
        $sexe = $_POST['new_patient_sexe'];
        $adresse = $_POST['new_patient_adresse'];
        $statut = $_POST['new_patient_statut'];
        $dossier_num = $_POST['new_patient_dossier_num'];
        $fiche_num = $_POST['new_patient_fiche_num'];
        $titulaire_id = $_POST['new_patient_titulaire_id'];
        $affiliation = $_POST['new_patient_affiliation'];
        $code_conv = $_POST['new_patient_code_conv'];
        $occupation = $_POST['new_patient_occupation'];

        $std = new stdClass();

        //Insert patient
        $result = $this->model->insert_patient($prenom, $nom,$postnom,$date_naissance, $sexe, $adresse,$statut,$dossier_num,$fiche_num,$titulaire_id,$affiliation,$code_conv,$occupation,$users_id);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
        
    }

    /**
     * Update d'un patient
     */
    function update_patient(){
        
        $users_id = Session::get('user_id');
        
        $patient_id = $_POST['new_patient_id'];
        $prenom = $_POST['new_patient_prenom'];
        $nom = $_POST['new_patient_nom'];
        $postnom = $_POST['new_patient_postnom'];
        $date_naissance = $_POST['new_patient_date_naissance'];
        $sexe = $_POST['new_patient_sexe'];
        $adresse = $_POST['new_patient_adresse'];
        $statut = $_POST['new_patient_statut'];
        $dossier_num = $_POST['new_patient_dossier_num'];
        $fiche_num = $_POST['new_patient_fiche_num'];
        $titulaire_id = $_POST['new_patient_titulaire_id'];
        $affiliation = $_POST['new_patient_affiliation'];
        $code_conv = $_POST['new_patient_code_conv'];
        $occupation = $_POST['new_patient_occupation'];

        $std = new stdClass();

        //Update patient
        $result = $this->model->update_patient($patient_id, $prenom, $nom,$postnom,$date_naissance, $sexe, $adresse,$statut,$dossier_num,$fiche_num,$titulaire_id,$affiliation,$code_conv,$occupation,$users_id);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
        
    }


    /**
     * Donne un patient avec tout les details
     */
    function get_patient(){
        $patient_id = $_POST['patient_id'];

        //return all of this patient
        $patient = $this->model->get_patient($patient_id);

        echo json_encode($patient);
    }

    /**
     * Donne les frais de payement actifs pour un patient
     */
    function get_patient_frais_fiche_actif(){
        $patient_id = $_POST['patient_id'];
        $pay_motif = 1;
        
        //
        $result = $this->model->get_patient_frais_fiche_actif($patient_id,$pay_motif);
        
        echo json_encode($result);

    }
    

    /**
     * Ouvrir une fiche
     */
    function ouvrir_une_fiche(){
        $patient_id = $_POST['patient_id'];
        $poids = $_POST['poids'];
        $tension = $_POST['tension'];
        $temperature = $_POST['temperature'];
        $medecin_consultant_id = $_POST['medecin_consultant_id'];

        $std = new stdClass();

        $result = $this->model->ouvrir_fiche($patient_id,$poids,$tension,$temperature,$medecin_consultant_id);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);

    }

    //delete patient
    function delete_patient(){
        $patient_id = $_POST['patient_id'];
        $std = new stdClass();

        $result = $this->model->delete_patient($patient_id);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);
    }

}
