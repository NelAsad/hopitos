<?php

class Laboratoire extends Controller
{

    function __construct()
    {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege != '1' && $privilege != '4') || $etat != 'actif') {
            //Quand la session est off , le user n'est pas un admin ou le user n'est pas actif
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        } else {
            //si tout va bien
            Session::set('connect_valide', true);
        }


        /**
         * insertion des js et css particulier pour ce module
         */
        $this->view->js = array('laboratoire/js/default.js');
        $this->view->css = array('laboratoire/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index()
    {
        $this->view->render('laboratoire/index');
    }

    /**
     * Donne les donnes initiales: les nouvelles demandes d'examen (DataTables)
     */
    function xhr_transfert_DataTable()
    {
        $this->model->xhr_transfert_DataTable();
    }

    /**
     * Donne un examen avec tout les details
     */
    function get_examens_demandes()
    {
        $diagnostic_id = $_POST['diagnostic_id'];
        
        $examens = $this->model->get_examens_demandes($diagnostic_id);
        echo json_encode($examens);
    }

    /**
     * insert resultat examen
     */
    function insert_resultat_examen(){
        $tab_resultat = $_POST['tab_resultat'];

        foreach ($tab_resultat as $resultat) {
            $result = $this->model->insert_resultat_examen($resultat[0],$resultat[1]);
            if ($result) {
                $this->model->set_demande_satisfaite($resultat[0]);
            }
        }

        echo json_encode(true);
    }

    /**
     * Declasse demande d'examen
     */
    function declasser_exam()
    {
        $exam_id = $_POST['exam_id'];
        $motif_declasse = $_POST['motif_declasse'];
        //appel de la methode cote model
        $result = $this->model->declasser_exam($exam_id, $motif_declasse);
        echo json_encode($result);
    }

    /**
     * Save exman resultat
     */
    function done_resultat_exam()
    {

        $data = $_POST;

        $result = $this->model->inserer_resultats_examens($data);
        echo json_encode($result);
    }


    /**
     * donne les frais actifs pour la consultation du patient
     */
    function get_patient_frais_labo_actif()
    {
        $exam_id = $_POST['exam_id'];
        $pay_motif = 2;

        $result = $this->model->get_patient_frais_labo_actif($exam_id, $pay_motif);

        echo json_encode($result);
    }


    /**
     * labo show resultats apres insertion
     */
    function show_resultat_after_insert()
    {
    }

    // done insert examen imagerie
    function done_add_resultat_labo()
    {

        $exam_id = $_POST['hidden_image_exam_id'];
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/hopitos/public/images/exam/';

        if (isset($_FILES["radiographie"])) {
            $target_file = $target_dir . basename($_FILES["radiographie"]["name"]);
            move_uploaded_file($_FILES["radiographie"]["tmp_name"], $target_file);
            $this->model->insert_exam_image_link($exam_id, basename($_FILES["radiographie"]["name"]), 'radiographie');
        }

        if (isset($_FILES["echographie"])) {
            $target_file = $target_dir . basename($_FILES["echographie"]["name"]);
            move_uploaded_file($_FILES["echographie"]["tmp_name"], $target_file);
            $this->model->insert_exam_image_link($exam_id, basename($_FILES["echographie"]["name"]), 'echographie');
        }

        if (isset($_FILES["irm"])) {
            $target_file = $target_dir . basename($_FILES["irm"]["name"]);
            move_uploaded_file($_FILES["irm"]["tmp_name"], $target_file);
            $this->model->insert_exam_image_link($exam_id, basename($_FILES["irm"]["name"]), 'irm');
        }

        if (isset($_FILES["endoscopie"])) {
            $target_file = $target_dir . basename($_FILES["endoscopie"]["name"]);
            move_uploaded_file($_FILES["endoscopie"]["tmp_name"], $target_file);
            $this->model->insert_exam_image_link($exam_id, basename($_FILES["endoscopie"]["name"]), 'endoscopie');
        }

        if (isset($_FILES["scanner"])) {
            $target_file = $target_dir . basename($_FILES["scanner"]["name"]);
            move_uploaded_file($_FILES["scanner"]["tmp_name"], $target_file);
            $this->model->insert_exam_image_link($exam_id, basename($_FILES["scanner"]["name"]), 'scanner');
        }

        $result = $this->model->set_exam_inserted($exam_id);

        echo json_encode($result);
    }
}
