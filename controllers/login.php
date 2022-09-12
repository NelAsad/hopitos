<?php
/**
 * Copyright (c) 2019, Innovate For Future Tech.
 * Powered by Elysée Asad Luboya
 * Soft-Mat
 * 
 * @package   Soft-Mat
 * @author    Dread Luiz Kiamputu & Elysée Asad Luboya (email:nel7luboya@gmail.com, Tél:+243 819664909)
 * @copyright Copyright (c) 2019, Innovate For Future Tech.  (http://innovateforfuture.com)
 * @since     Version 1.3.0
 */

class Login extends Controller {

    function __construct() {
        parent::__construct();

        //initialise la session
        Session::init();
        //redirection si la session est on

        if (Session::get('connect_valide')) {

            header('location: ' . URL . 'home');
        }

        /**
         * insertion des js et css particulier pour ce module
         */
        $this->view->js = array('login/js/default.js');
        $this->view->css = array('login/css/default.css');

    }

    /**
     * Dirige vers la page de connexion
     */
    function index() {
        $this->view->render('login/index', true);
    }

    /**
     * Connexion_au_systeme
     */
    function connect(){

        $login = htmlspecialchars($_POST['login']);
        //$password = sha1(htmlspecialchars($_POST['password']));
        $password = htmlspecialchars($_POST['password']);

        if ($login == '' || $password == '') {
            $notification = "champs_vide";
            $this->view->login = $login;
            $this->view->notification = $notification;
            $this->view->render('login/index', true);
        } else {

            $user_data = $this->model->connect($login, $password);

            if (empty($user_data)) {
                $notification = "c_pas_ton_compte";
                $this->view->login = $login;
                $this->view->notification = $notification;
                $this->view->render('login/index', true);
            } else {

                //definit les variables de session
                Session::set('connected', true);
                Session::set('privilege', $user_data['privilege']);
                // Session::set('prenom', $user_data['prenom']);
                // Session::set('nom', $user_data['nom']);
                // Session::set('titre', $user_data['user_titre']);
                // Session::set('poste', $user_data['user_poste']);
                // Session::set('sexe', $user_data['user_sexe']);
                Session::set('etat', $user_data['etat']);
                Session::set('login', $user_data['login']);
                Session::set('password', $user_data['password']);
                Session::set('user_id', $user_data['users_id']);

                //on redirige vers la home page du compte
                header('location: ' . URL . 'home');
            }
        }

    }

    
}
