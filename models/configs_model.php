<?php

class Configs_model extends Model {

    function __construct() {
        parent:: __construct();
    }


    /**
     * Renvoie la liste des configurations- pour la datatable
     */
    function xhr_configs_DataTable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM configs ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE config_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR config_nom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR config_val LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR config_type LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY config_id DESC ';
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
        $sub_array[] = $row["config_id"];
        $sub_array[] = $row["config_nom"];
        $sub_array[] = $row["config_val"];
        $sub_array[] = $row["config_type"];
        $sub_array[] = "
            <a style='cursor: pointer;' class='btn_update_config_modal' id='". $row["config_id"] ."' title='Mettre a jour la valeur'><i class='edit orange icon'></i></a>
                    ";
        $data[] = $sub_array;
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM configs"),
            "data" => $data
        );

        echo json_encode($results);
    }

    /**
     * Renvoie la liste des configurations- pour la datatable
     */
    function xhr_depenses_Datatable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM depense ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE depense_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR depense_motif LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR depense_montant LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR depense_datetime LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY depense_id DESC ';
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
            $sub_array[] = $row["depense_id"];
            $sub_array[] = $row["depense_motif"];
            $sub_array[] = $row["depense_montant"];
            $sub_array[] = $row["depense_datetime"];
            $sub_array[] = $row["fk_users_id"];
            $data[] = $sub_array;
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM depense"),
            "data" => $data
        );

        echo json_encode($results);
    }

    /**
     * Ajout new configs
     */
    public function insert_new_config($config_id,$config_type,$config_nom,$config_val) {
        $query = "INSERT INTO configs (config_id,config_nom,config_val,config_type) VALUES (:config_id,:config_nom,:config_val,:config_type) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':config_id' => $config_id,
            ':config_nom' => $config_nom,
            ':config_val' => $config_val,
            ':config_type' => $config_type
        ));
        return $result;
    }

    /**
     * Update valeur d'une config
     */
    function update_config_val($config_id,$config_new_val){
        $query = "UPDATE configs SET config_val = :config_val WHERE config_id = :config_id ";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':config_id' => $config_id,
            ':config_val' => $config_new_val
        ));
        return $result;
    }

    ////////// DEPENSES /////////////

    function add_depense($new_depense_motif,$new_depense_montant,$users_id){
        $query = "INSERT INTO depense (depense_motif,depense_montant,depense_datetime,fk_users_id) VALUES (:depense_motif,:depense_montant,NOW(),:fk_users_id) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':depense_motif' => $new_depense_motif,
            ':depense_montant' => $new_depense_montant,
            ':fk_users_id' => $users_id
        ));
        return $result;
    }

}
