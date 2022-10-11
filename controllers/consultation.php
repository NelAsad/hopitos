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
     * Supprimer une demande
     */
    function supprimer_demande_exam(){
        $fiche_id = $_POST['fiche_id'];

        $result = $this->model->supprimer_demande_exam($fiche_id);
        echo json_encode($result);

    }

    /**
     * Ajouter les resultats du labo a la fiche
     */
    function ajouter_resultats_a_la_fiche(){

        $resultats_en_string = "";
        $fiche_id = $_POST['hidden_back_fiche_id'];

        foreach ($_POST as $key => $value) {
            //pour eviter de prendre l'id
            if ($key == "hidden_back_fiche_id" || $key == "back_autres_examens") {
                //$resultats_en_string .= $key." = 'x_dem' ";
            }else{
                if ($value != "") {
                    $resultats_en_string .= $key." = ".$value." <br>";
                }
            }
        }

        $resultats_en_string .= "<span>Resultats autres examens : </span><br>". $_POST['back_autres_examens'];

        $result = $this->model->ajouter_resultats_a_la_fiche($fiche_id, $resultats_en_string);
        echo json_encode($result);

    }

}
