<?php

class Utilis extends Controller {

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
        $this->view->js = array('utilis/js/default.js');
        $this->view->css = array('utilis/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        
        $this->view->agents = $this->model->get_personnel();
        $this->view->render('utilis/index');
    }

     /**
     * Donne les donnes initiales (DataTables)
     */
    function users_datatable(){
        $this->model->xhr_users_DataTable();
    }

     /**
     * Insert un nouveau user dans la base
     */
    function new_user() {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $privilege = $_POST['privilege'];
        $etat_user = $_POST['etat_user'];
        $agent_user = $_POST['agent_user'];

        //Insert user
        $result = $this->model->insert_agent($login, $password,$privilege, $etat_user, $agent_user);

        if ($result) {
            echo 'inserted';
        } else {
            echo 'not_inserted';
        }
    }
     /**
     * update user dans la base
     */
    function update_user() {
        $user_id = $_POST['user_id'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $privilege = $_POST['privilege'];
        $etat_user = $_POST['etat_user'];
        $agent_user = $_POST['agent_user'];

        //Insert user
        $result = $this->model->update_user($user_id, $login, $password,$privilege, $etat_user, $agent_user);

        if ($result) {
            echo 'inserted';
        } else {
            echo 'not_inserted';
        }
    }

    // get user by id
    function get_user(){
        $user_id = $_POST['user_id'];
        $result = $this->model->get_user($user_id);

        echo json_encode($result);
    }


}