<?php

class Utilis_model extends Model {

    function __construct() {
        parent:: __construct();
    }

        /**
     * Renvoie la liste des users pour la datatable
     * @return array usersList
     */
    function xhr_users_DataTable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM users ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE users_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR login LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY users_id DESC ';
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
        $sub_array[] = $row["users_id"];
        $sub_array[] = $row["login"];
        $sub_array[] = $row["privilege"];
        $sub_array[] = $row["etat"];
        $sub_array[] = "
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_update_user_modal' id='". $row["users_id"] ."' title='Mettre a jour'><i class='fa fa-edit'></i></a>
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_delete_personnel' id='". $row["users_id"] ."' title='Supprimer'><i class='fa fa-remove'></i></a>
                    ";
        $data[] = $sub_array;
        }

        $results = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => $this->get_total_all_records("SELECT * FROM users"),
        "data" => $data
        );

        echo json_encode($results);

    }

    /**
     * Renvoie tous les 
     * @param int $id_agent
     * @return Array agent
     */
    public function get_personnel() {
        $query = "SELECT * FROM personnel";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $agent = $statement->fetchAll();
        $statement->closeCursor();
        return $agent;
    }
    /**
     * Renvoie un agent avec tout se details
     * @param int $id_agent
     * @return Array agent
     */
    public function get_user($user_id) {
        $query = "SELECT * FROM users WHERE users_id = :user_id ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':user_id' => $user_id
        ));
        $agent = $statement->fetch();
        $statement->closeCursor();
        return $agent;
    }

    // insert agent
    function insert_agent($login, $password,$privilege, $etat, $agent_id){
        $query = "INSERT INTO users (login,password,privilege,etat,agent_id) VALUES (:login,:password,:privilege,:etat,:agent_id)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':login' => $login,
            ':password' => $password,
            ':privilege' => $privilege,
            ':etat' => $etat,
            ':agent_id' => $agent_id
        ));

        return $result;
    }

    // update agent
    function update_user($user_id, $login, $password,$privilege, $etat, $agent_id){
        $query = "UPDATE users SET login = :login, password = :password, privilege = :privilege, etat = :etat, agent_id = :agent_id WHERE users_id = :users_id";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':login' => $login,
            ':password' => $password,
            ':privilege' => $privilege,
            ':etat' => $etat,
            ':agent_id' => $agent_id,
            ':users_id' => $user_id
        ));

        return $result;
    }


}
