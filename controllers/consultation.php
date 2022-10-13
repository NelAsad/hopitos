<?php

class Consultation extends Controller {

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
        $this->view->js = array('consultation/js/default.js');
        $this->view->css = array('consultation/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {

        $this->view->render('consultation/index');
    }

    /**
     * Donne les donnes initiales pour la consultation etape1 (DataTables)
     */
    function consultation_etape1_datatable(){
        $this->model->xhr_consultation_DataTable('1');
    }


    /**
     * Done commencer consultation
     */
    function commencer_consultation(){

        $transfert_id = $_POST['transfert_id'];
        $symptomes = $_POST['symptomes'];
        $diagnostic = $_POST['diagnostic'];

        $std = new stdClass();

        //result_boolean
        $result = $this->model->commencer_consultation($transfert_id,$symptomes,$diagnostic);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);

    }


    /**
     * Done completer consultation
     */
    function completer_consultation(){

        $transfert_id = $_POST['transfert_id'];
        $traitement = $_POST['traitement'];
        $prescription = $_POST['prescription'];

        $std = new stdClass();

        //result_boolean
        $result = $this->model->completer_consultation($transfert_id,$traitement,$prescription);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);
    }

    /**
     * Donne tous les actes
     */
    function get_actes(){
        //return all of this fiche
        $actes = $this->model->get_actes();
        echo json_encode($actes);
    }

    /**
     * Demande des examens au labo
     */
    function demande_examen(){
        $diagnostic_id = $_POST['diagnostic_id'];
        $actes = $_POST['actes'];

        foreach ($actes as $acte) {
            $result = $this->model->insert_demande_labo($diagnostic_id, $acte);
        }

        echo json_encode(true);
    }

    /**
     * Demande des examens au images
     */
    function demande_exam_image(){
        $result = $this->model->demande_exam_image($_POST);
        echo json_encode($result);
    }

    /**
     * les diagnostic d'un transfert
     */
    function get_transfert_diagnostics(){
        $transfert_id = $_POST['transfert_id'];
        //return all of this exam
        $diagnostics = $this->model->get_transfert_diagnostics($transfert_id);
        echo json_encode($diagnostics);
    }

    /**
     * diagnostic_prescrire
     */
    function diagnostic_prescrire(){
        $prescription_diagnostic_id = $_POST['prescription_diagnostic_id'];
        $tab_prescription = $_POST['tab_prescription'];

        foreach ($tab_prescription as $row) {
            $result = $this->model->isnert_diagnostic_prescrire($row[0], $row[1], $row[2], $prescription_diagnostic_id);
        }

        echo json_encode(true);
    }


}
