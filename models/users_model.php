<?php


class Users_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie la liste des users pour la datatable
     * @return array usersList
     */
    function xhr_personnel_DataTable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM personnel ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE id_agent LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR nom_agent LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR postnom_agent LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR prenom_agent LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY id_agent DESC ';
        }
        
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start']. ', '.$_POST['length'];
        }  
         
       $sth = $this->db->prepare($query);
       $sth->execute(); 
       $result =  $sth->fetchAll(); 
         
        $data = array();
        $filtered_rows = $sth->rowCount();

        foreach ($result as $row){
        $sub_array = array();
        $sub_array[] = $row["id_agent"];
        $sub_array[] = $row["nom_agent"];
        $sub_array[] = $row["postnom_agent"];
        $sub_array[] = $row["prenom_agent"];
        $sub_array[] = $row["sexe_agent"];
        $sub_array[] = $row["tel_agent"];
        $sub_array[] = $row["site_agent"];
        $sub_array[] = "
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_update_personnel_modal' id='". $row["id_agent"] ."' title='Mettre a jour'><i class='fa fa-edit'></i></a>
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_delete_personnel' id='". $row["id_agent"] ."' title='Supprimer'><i class='fa fa-remove'></i></a>
                    ";
        $data[] = $sub_array;
        }

        $results = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => $this->get_total_all_records("SELECT * FROM personnel"),
        "data" => $data
        );

        echo json_encode($results);

    }


    /**
     * Renvoie la liste des users
     * @return array usersList
     */
    // public function users_list() {

    //     $query = "SELECT * FROM users";

    //     $statement = $this->db->prepare($query);
    //     $statement->execute();
    //     $usersList = $statement->fetchAll();
    //     $statement->closeCursor();
    //     return $usersList;
    // }

    /**
     * Enregiste un utilisateur dans base de dinnees
     * @return boolean
     */
    // public function insert_user($prenom, $nom,$login, $password, $user_titre, $user_poste, $user_sexe, $privilege, $etat) {
    //     $query = "INSERT INTO users (prenom,nom,login,password,user_titre,user_poste,user_sexe,privilege,etat) VALUES (:prenom,:nom,:login,:password,:user_titre,:user_poste,:user_sexe,:privilege,:etat) ";
    //     $statement = $this->db->prepare($query);

    //     $result = $statement->execute(array(
    //         ':prenom' => $prenom,
    //         ':nom' => $nom,
    //         ':login' => $login,
    //         ':password' => $password,
    //         ':user_titre' => $user_titre,
    //         ':user_poste' => $user_poste,
    //         ':user_sexe' => $user_sexe,
    //         ':privilege' => $privilege,
    //         ':etat' => $etat
    //     ));

    //     return $result;
    // }

    /**
     * Renvoie un agent avec tout se details
     * @param int $id_agent
     * @return Array agent
     */
    public function get_personnel($id_agent) {
        $query = "SELECT * FROM personnel WHERE id_agent = :id_agent";
        $statement = $this->db->prepare($query);
        $statement->execute(array(':id_agent' => $id_agent));
        $agent = $statement->fetch();
        $statement->closeCursor();
        return $agent;
    }

    /**
     * Edition d'un compte user par un admin
     * @param int $user_id
     * @param String $nom
     * @param String $prenom
     * @param String $privilege
     * @param String $statut
     * @param String $email
     * @return Bool
     */
    // public function admin_edit_user($users_id, $prenom, $nom, $login, $privilege, $etat) {
    //     $query = "UPDATE users SET prenom = :prenom, nom = :nom, privilege = :privilege, etat = :etat, login = :login WHERE users_id = :users_id";
    //     $statement = $this->db->prepare($query);
    //     $result = $statement->execute(array(
    //         ':prenom' => $prenom,
    //         ':nom' => $nom,
    //         ':privilege' => $privilege,
    //         ':login' => $login,
    //         ':etat' => $etat,
    //         ':users_id' => (int)$users_id
    //     ));

    //     return $result;
    // }
    
    // public function edit_own_account($user_id,$prenom,$nom,$email,$login,$password) {
    //     $query = "UPDATE users SET prenom = :prenom, nom = :nom, login = :login, password = :password, email = :email WHERE user_id = :user_id";
    //     $statement = $this->db->prepare($query);
    //     $result = $statement->execute(array(
    //         ':prenom' => $prenom,
    //         ':nom' => $nom,
    //         ':login' => $login,
    //         ':email' => $email,
    //         ':password' => $password,
    //         ':user_id' => (int)$user_id
    //     ));

    //     return $result;
    // }
    

    /**
     * rendre un user actif
     * @param int $user_id
     * @return Bool
     */
    // public function active_user($user_id) {
    //     $query = "UPDATE users SET etat = 'actif' WHERE users_id = :users_id";

    //     $statement = $this->db->prepare($query);
    //     $statement->bindValue(':users_id', $user_id);
    //     $result = $statement->execute();
    //     return $result;
    // }

    /**
     * rendre un user inactif
     * @param int $user_id
     * @return Bool
     */
    // public function block_user($user_id) {
    //     $query = "UPDATE users SET etat = 'inactif' WHERE users_id = :users_id";

    //     $statement = $this->db->prepare($query);
    //     $statement->bindValue(':users_id', $user_id);
    //     $result = $statement->execute();
    //     return $result;
    // }


    // insert personnel
    function insert_personnel($prenom, $nom,$postnom, $sexe, $tel, $email, $pers_fonction, $site, $matricule, $etat_civil, $nbre_enfant, $epoux, $nais, $date_nais, $adresse){
        $query = "INSERT INTO personnel (nom_agent,postnom_agent,prenom_agent,sexe_agent,tel_agent,email_agent,fonction_agent,site_agent,matricule_agent,etat_civil,nbre_enfant,epoux,nais_agent,date_nais_agent,adresse_agent) VALUES (:nom_agent,:postnom_agent,:prenom_agent,:sexe_agent,:tel_agent,:email_agent,:fonction_agent,:site_agent,:matricule_agent,:etat_civil,:nbre_enfant,:epoux,:nais_agent,:date_nais_agent,:adresse_agent)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':prenom_agent' => $prenom,
            ':nom_agent' => $nom,
            ':postnom_agent' => $postnom,
            ':sexe_agent' => $sexe,
            ':tel_agent' => $tel,
            ':email_agent' => $email,
            ':fonction_agent' => $pers_fonction,
            ':site_agent' => $site,
            ':matricule_agent' => $matricule,
            ':etat_civil' => $etat_civil,
            ':nbre_enfant' => $nbre_enfant,
            ':epoux' => $epoux,
            ':nais_agent' => $nais,
            ':date_nais_agent' => $date_nais,
            ':adresse_agent' => $adresse
        ));

        return $result;
    }

    // update personnel
    function update_personnel($id_agent, $prenom, $nom, $postnom, $sexe, $tel, $email, $fonction, $site, $matricule, $etat_civil, $nbre_enfant, $epoux, $nais, $date_nais, $adresse){
        $query = "UPDATE personnel SET nom_agent = :nom_agent, postnom_agent = :postnom_agent , prenom_agent =:prenom_agent,
        sexe_agent = :sexe_agent, tel_agent = :tel_agent, email_agent = :email_agent, fonction_agent = :fonction_agent,
        site_agent = :site_agent, matricule_agent = :matricule_agent, etat_civil = :etat_civil, nbre_enfant = :nbre_enfant,
        epoux = :epoux, nais_agent = :nais_agent, date_nais_agent = :date_nais_agent, adresse_agent = :adresse_agent WHERE id_agent = :id_agent";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':id_agent' => $id_agent,
            ':prenom_agent' => $prenom,
            ':nom_agent' => $nom,
            ':postnom_agent' => $postnom,
            ':sexe_agent' => $sexe,
            ':tel_agent' => $tel,
            ':email_agent' => $email,
            ':fonction_agent' => $fonction,
            ':site_agent' => $site,
            ':matricule_agent' => $matricule,
            ':etat_civil' => $etat_civil,
            ':nbre_enfant' => $nbre_enfant,
            ':epoux' => $epoux,
            ':nais_agent' => $nais,
            ':date_nais_agent' => $date_nais,
            ':adresse_agent' => $adresse
        ));

        return $result;
    }

    //delete agent
    function delete_agent($id_agent){
        $query = "DELETE FROM personnel WHERE id_agent = :id_agent ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':id_agent' => $id_agent,
        ));

        return $result;
    }

}
