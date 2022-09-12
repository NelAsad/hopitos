<?php

class Users extends Controller {

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
        } else {
            //si tout va bien
            Session::set('connect_valide', true);
        }

        /**
         * insertion des js et css particulier pour ce module
         */
        $this->view->js = array('users/js/default.js');
        $this->view->css = array('users/css/default.css');
    }

    /**
     * Donne la home page du module users
     */
    function index() {

        //recupere la liste des users
        // $this->view->users_list = $this->model->users_list();

        $this->view->render('users/index', false);
    }

    /**
     * Donne les donnes initiales (DataTables)
     */
    function personnel_datatable(){
        $this->model->xhr_personnel_DataTable();
    }

    /**
     * Insert un nouveau user dans la base
     */
    // function new_user() {
    //     $prenom = $_POST['prenom'];
    //     $nom = $_POST['nom'];
    //     $login = $_POST['login'];
    //     $password = $_POST['password'];
    //     $user_titre = $_POST['user_titre'];
    //     $user_poste = $_POST['user_poste'];
    //     $user_sexe = $_POST['user_sexe'];
    //     $confirme_password = $_POST['confirme_password'];
    //     $privilege = $_POST['privilege'];
    //     $etat = $_POST['etat'];

    //     //Insert user
    //     $result = $this->model->insert_user($prenom, $nom,$login, $password, $user_titre, $user_poste, $user_sexe, $privilege, $etat);

    //     if ($result) {
    //         echo 'inserted';
    //     } else {
    //         echo 'not_inserted';
    //     }
    // }

    /**
     * Montre un personnel avec tout les details
     * @param int $id_agent
     */
    function get_personnel() {
        
        $id_agent = $_POST['id_agent'];

        //return all of this agent
        $agent = $this->model->get_personnel($id_agent);

        echo json_encode($agent);
    }

    //validation des modification effectuer
    // function edit_user() {
    //     $users_id = $_POST['hidden_users_id'];
    //     $prenom = $_POST['prenom'];
    //     $nom = $_POST['nom'];
    //     $login = $_POST['login'];
    //     $privilege = $_POST['privilege'];
    //     $etat = $_POST['etat'];
        

    //     //done_edition
    //     $return = $this->model->admin_edit_user($users_id, $prenom, $nom, $login, $privilege, $etat);

    //     if ($return) {
    //         echo 'bien';
    //     } else {
    //         echo 'pas_bien';
    //     }
    // }

    /**
     * Voir son propre profil
     */
    // function profil() {
    //     //return all of this user
    //     $this->view->user = $this->model->get_user(Session::get('user_id'));

    //     $this->view->render('users/profil', false);
    // }

    // function save_profil_edit() {
    //     $user_id = $_POST['hidden_user_id'];
    //     $prenom = $_POST['prenom'];
    //     $nom = $_POST['nom'];
    //     $email = $_POST['email'];
    //     $login = $_POST['login'];
    //     $password = $_POST['password'];
    //     $confirme_password = $_POST['confirme_password'];

    //     if ($prenom == '' || $nom == '' || $login == '' || $password == '' || $confirme_password == '') {
    //         header('location: ' . URL . 'users/profil/?message=champs_vide');
    //     } else {
    //         if ($password != $confirme_password) {
    //             header('location: ' . URL . 'users/profil/?message=confirmation_invalide');
    //         } else {

    //             //done_edition
    //             $return = $this->model->edit_own_account($user_id,$prenom,$nom,$email,$login,$password);

    //             if ($return) {
    //                 header('location: ' . URL . 'users/profil/');
    //             } else {
    //                 header('location: ' . URL . 'users/edit_user/' . $user_id . '/?message=echec');
    //             }
    //         }
    //     }
    // }

    /**
     * make user active
     */
    // function active_user() {

    //     $user_id = $_POST['user_id'];

    //     // make user active
    //     $result = $this->model->active_user($user_id);

    //     if ($result) {
    //         echo 'done';
    //     } else {
    //         echo 'failed';
    //     }
    // }

    /**
     * make user inactive
     */
    // function block_user() {

    //     $user_id = $_POST['user_id'];

    //     // make user inactive
    //     $result = $this->model->block_user($user_id);

    //     if ($result) {
    //         echo 'done';
    //     } else {
    //         echo 'failed';
    //     }
    // }



    ///////////////////////////////
    ////// PERSONNEL //////////////
    ///////////////////////////////

     /**
     * Insert un nouveau user dans la base
     */
    function new_personnel() {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $postnom = $_POST['postnom'];
        $sexe = $_POST['sexe'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $pers_fonction = $_POST['pers_fonction'];
        $pers_site = $_POST['pers_site'];
        $pers_matricule = $_POST['pers_matricule'];
        $etat_civil = $_POST['etat_civil'];
        $nbre_enfant = $_POST['nbre_enfant'];
        $epoux = $_POST['epoux'];
        $nais = $_POST['nais'];
        $date_nais = $_POST['date_nais'];
        $adresse = $_POST['adresse'];

        //Insert user
        $result = $this->model->insert_personnel($prenom, $nom,$postnom, $sexe, $tel, $email, $pers_fonction, $pers_site, $pers_matricule, $etat_civil, $nbre_enfant, $epoux, $nais, $date_nais, $adresse);

        if ($result) {
            echo 'inserted';
        } else {
            echo 'not_inserted';
        }
    }

     /**
     * Insert un nouveau user dans la base
     */
    function update_personnel() {
        $id_agent = $_POST['id_agent'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $postnom = $_POST['postnom'];
        $sexe = $_POST['sexe'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $pers_fonction = $_POST['pers_fonction'];
        $pers_site = $_POST['pers_site'];
        $pers_matricule = $_POST['pers_matricule'];
        $etat_civil = $_POST['etat_civil'];
        $nbre_enfant = $_POST['nbre_enfant'];
        $epoux = $_POST['epoux'];
        $nais = $_POST['nais'];
        $date_nais = $_POST['date_nais'];
        $adresse = $_POST['adresse'];

        //Insert user
        $result = $this->model->update_personnel($id_agent, $prenom, $nom,$postnom, $sexe, $tel, $email, $pers_fonction, $pers_site, $pers_matricule, $etat_civil, $nbre_enfant, $epoux, $nais, $date_nais, $adresse);

        if ($result) {
            echo 'inserted';
        } else {
            echo 'not_inserted';
        }
    }

    //delete agent
    function delete_agent(){
        $id_agent = $_POST['id_agent'];
        $std = new stdClass();

        $result = $this->model->delete_agent($id_agent);

        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        
        echo json_encode($std);
    }

}
