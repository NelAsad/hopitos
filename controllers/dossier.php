<?php

class Dossier extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege !='1' && $privilege !='3') || $etat != 'actif') {
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
        $this->view->js = array('dossier/js/default.js');
        $this->view->css = array('dossier/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->render('dossier/index');
    }

    /**
     * Donne les donnes initiales pour la datatables (fiches du dossier by patient_id)
     */
    function fiches_dossier_by_patient_id_datatable(){
            // ici je recupere les bonnes informations datables pour juste la page dossier_resultat_patient_id
            $this->model->xhr_get_patient_fiches_DataTable($_POST['search_text'],$_POST['search_type']);   
    }

    function dossier_fiches_DataTable(){
        $this->model->xhr_get_dossier_fiches_DataTable($_POST['search_text']);
    }


    /**
     * Cherche toutes les consultation d'un patient (la fiche complete ou generale)
     */
    function get_all_fiches_patient() {

        $search_text = $_GET['search_text'];
        $search_type = $_GET['search_type'];

        if($search_type=="dossier_id"){
            //recupere_toutes_les_fiches_du_dossier
            $params = array('text' => $search_text, 'type' => $search_type );
            $this->view->parametres = $params;//renvoie a nouveau les parametres (pour la datatable)
            $this->view->resultat_patient_d_un_dossier_own_js = true; // l'option pour chager le js propre a cette page depuis le footer
            $this->view->render('dossier/resultat_patients_d_un_dossier');
        }else{
            //recupere_toutes_les_fiches_du_patient (les differentes consultations)
            $params = array('text' => $search_text, 'type' => $search_type );
            $this->view->parametres = $params;//renvoie a nouveau les parametres (pour la datatable)
            $this->view->dossier_resultat_patient_id_own_js = true; // l'option pour chager le js propre a cette page depuis le footer
            $this->view->render('dossier/dossier_resultat_patient_id');
        }

        
    }

}
