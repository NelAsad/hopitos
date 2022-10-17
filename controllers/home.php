<?php

class Home extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || $etat != 'actif') {
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
        $this->view->js = array('home/js/default.js');
        $this->view->css = array('home/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->patients = $this->model->get_patient();
        $this->view->fiches = $this->model->get_fiches();
        $this->view->examens = $this->model->get_exam();
        $this->view->personnel = $this->model->get_personnel();
        $this->view->render('home/index');
    }

    /**
     * pour la deconnection
     */
    function logout() {
        Session::destroy();
        header('location: ' . URL . 'login');
        exit;
    }

}
