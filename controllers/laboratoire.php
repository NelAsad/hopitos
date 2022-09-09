<?php

class Laboratoire extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege !='1' && $privilege !='4') || $etat != 'actif') {
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
        $this->view->js = array('laboratoire/js/default.js');
        $this->view->css = array('laboratoire/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->render('laboratoire/index');
    }

    /**
     * Donne les donnes initiales: les nouvelles demandes d'examen (DataTables)
     */
    function labo_nouvelles_demandes(){
        $this->model->xhr_labo_dataTables('1');
    }
    /**
     * Donne les donnes initiales: les demandes d'examen satisfaites du jour (DataTables)
     */
    function labo_demandes_sat_today(){
        $today_date = date("Y-m-d", time());
        $this->model->xhr_labo_dataTables('2', $today_date);
    }
    /**
     * Donne les donnes initiales: les demandes d'examen (toutes les demandes) (DataTables)
     */
    function labo_demandes_sat_all(){
        $this->model->xhr_labo_dataTables('2');
    }
    /**
     * Donne les donnes initiales: les demandes d'examen declassees du jour (DataTables)
     */
    function labo_demandes_declasees_today(){
        $today_date = date("Y-m-d", time());
        $this->model->xhr_labo_dataTables('3', $today_date);
    }
    /**
     * Donne les donnes initiales: les demandes d'examen declassees (toutes les demandes) (DataTables)
     */
    function labo_demandes_declasees_all(){
        $this->model->xhr_labo_dataTables('3');
    }


    /**
     * Donne un examen avec tout les details
     */
    function get_exam(){
        $exam_id = $_POST['exam_id'];
        //return all of this exam
        $exam = $this->model->get_exam($exam_id);
        echo json_encode($exam);
    }

    /**
     * Declasse demande d'examen
     */
    function declasser_exam(){
        $exam_id = $_POST['exam_id'];
        $motif_declasse = $_POST['motif_declasse'];
        //appel de la methode cote model
        $result = $this->model->declasser_exam($exam_id,$motif_declasse);
        echo json_encode($result);

    }

    /**
     * Save exman resultat
     */
    function done_resultat_exam(){

        $data = $_POST;

        $result = $this->model->inserer_resultats_examens($data);
        echo json_encode($result);

    }


    /**
     * donne les frais actifs pour la consultation du patient
     */
    function get_patient_frais_labo_actif(){
        $exam_id = $_POST['exam_id'];
        $pay_motif = 2;
        
        $result = $this->model->get_patient_frais_labo_actif($exam_id,$pay_motif);
        
        echo json_encode($result);
    }


    /**
     * labo show resultats apres insertion
     */
    function show_resultat_after_insert(){

    }


}
