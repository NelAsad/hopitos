<?php

class Stats extends Controller {

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
        $this->view->js = array('stats/js/default.js');
        $this->view->css = array('stats/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->medecins = $this->model->get_users_by_privilege(3);
        $this->view->render('stats/index');
    }

    /**
     * Donne tout les payements pour une date
     */
    function get_payement_date(){
        $now_date = $_POST['now_date'];

        if ($now_date == null) {
            //recuperation du timestamp acteul (date today)
            $now_date = date("Y-m-d", time());
        }
        
        $payements = $this->model->get_payement_date($now_date);
        echo json_encode($payements);
        
    }

     /**
     * Donne tout les payements pour une periode
     */
    function get_payement_periode(){
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        
        $payements = $this->model->get_payement_periode($date_debut, $date_fin);
        echo json_encode($payements);
    }

    /**
     * Donne les stats pour la consultation (par la fonction d'initialisation) //juste by date
     */
    function get_consultation_stats_date(){
        $now_date = $_POST['now_date'];
        $medecin_id = $_POST['medecin_id'];

        if ($now_date == null) {
            //recuperation du timestamp acteul (date today)
            $now_date = date("Y-m-d", time());
        }

        $consultation_stats = $this->model->get_consultation_stats_date($now_date,$medecin_id);
        echo json_encode($consultation_stats);
    }

    /**
     * Donne les stats pour la consultation pour une periode (avec filtre du medecin)
     */
    function get_consultation_stats_periode(){
        $medecin_consultation_id = $_POST['medecin_consultation_id'];
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];

        $consultation_stats = $this->model->get_consultation_stats_periode($medecin_consultation_id, $date_debut, $date_fin);
        echo json_encode($consultation_stats);
    }

    /**
     * Donne les depenses d'une date
     */
    function get_depenses_date(){
        $now_date = $_POST['now_date'];

        if ($now_date == null) {
            //recuperation du timestamp acteul (date today)
            $now_date = date("Y-m-d", time());
        }
        
        $depenses = $this->model->get_depenses_date($now_date);
        echo json_encode($depenses);
    }

    /**
     * Donne toutes les depenses pour une periode
     */
    function get_depenses_periode(){
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        
        $depenses = $this->model->get_depenses_periode($date_debut, $date_fin);
        echo json_encode($depenses);
    }

}