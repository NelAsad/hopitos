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
     * Donne les donnes initiales pour la consultation etape2 (DataTables)
     */
    function consultation_etape2_datatable(){
        $this->model->xhr_consultation_DataTable('2');
    }
    /**
     * Donne les donnes initiales pour la consultation etape3 (DataTables) // les consultations terminees du jour
     */
    function consultation_etape3_datatable(){
        $today_date = date("Y-m-d", time());
        $this->model->xhr_consultation_DataTable('3');
    }
    /**
     * Donne les donnes initiales pour la consultation (toutes les fiches) (DataTables) //consultats terminees pour toutes dates
     */
    function consultation_toutes_les_fiches_datatable(){
        $this->model->xhr_consultation_DataTable('3');
    }


    /**
     * Done commencer consultation
     */
    function commencer_consultation(){

        $fiche_id = $_POST['fiche_id'];
        $symptomes = $_POST['symptomes'];
        $diagnostic = $_POST['diagnostic'];

        $std = new stdClass();

        //result_boolean
        $result = $this->model->commencer_consultation($fiche_id,$symptomes,$diagnostic);

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

        $fiche_id = $_POST['fiche_id'];
        $traitement = $_POST['traitement'];
        $prescription = $_POST['prescription'];

        $std = new stdClass();

        //result_boolean
        $result = $this->model->completer_consultation($fiche_id,$traitement,$prescription);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);
    }

    /**
     * Donne une fiche avec tout les details
     */
    function get_fiche(){
        $fiche_id = $_POST['fiche_id'];

        //return all of this fiche
        $fiche = $this->model->get_fiche($fiche_id);

        echo json_encode($fiche);
    }

    /**
     * Imprimer la fiche
     */
    function print_fiche(){

        $fiche_id = $_GET['ident_asadienne'];

        //return all of this fiche
        $this->view->fiche = $this->model->get_fiche($fiche_id);

        $this->view->render('consultation/print_fiche',true);

    }

    /**
     * Demande des examens au labo
     */
    function demander_exam(){
        if (sizeof($_POST) < 4) {
            echo json_encode('aucun_choix');
        } else {
            $result = $this->model->demander_examen($_POST);
            echo json_encode($result);
        }
    }
    /**
     * Demande des examens au images
     */
    function demande_exam_image(){
        $result = $this->model->demande_exam_image($_POST);
        echo json_encode($result);
    }

    /**
     * Donne un examen avec tout les details
     */
    function get_exam(){
        $fiche_id = $_POST['fiche_id'];
        $exam_etape = $_POST['exam_etape'];
        //return all of this exam
        $exam = $this->model->get_exam($fiche_id,$exam_etape);
        echo json_encode($exam);
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
