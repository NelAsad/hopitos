<?php

use LDAP\Result;

class Patient_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie la liste des users pour la datatable
     * @return array usersList
     */
    function xhr_patient_DataTable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM patient ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE patient_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_nom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_prenom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_postnom LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY patient_id DESC ';
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

        $display_btn = '';
        if ($row["patient_statut"] != 'conventionne') {
            $display_btn = 'hidden';
        }

        $sub_array = array();
        $sub_array[] = $row["patient_id"];
        $sub_array[] = $row["patient_prenom"];
        $sub_array[] = $row["patient_nom"];
        $sub_array[] = $row["patient_postnom"];
        $sub_array[] = $row["patient_sexe"];
        $sub_array[] = $row["patient_statut"];
        $sub_array[] = $row["patient_date_naissance"];
        $sub_array[] = "
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_ouvrir_fiche_patient' id='". $row["patient_id"] ."' statut='". $row["patient_statut"] ."' title='Ouvrir une fiche'><i class='fa fa-send'></i></a>
                    ";
        $data[] = $sub_array;
        }

        $results = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => $this->get_total_all_records("SELECT * FROM patient"),
        "data" => $data
        );

        echo json_encode($results);

    }

    /**
     * Ouvrir_une_fiche
     */
    public function insert_signe_vitaux($poids,$tension,$temperature) {
        $query = "INSERT INTO signe_vitaux (poids,tension,temperature) VALUES (:poids,:tension,:temperature) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':poids' => $poids,
            ':tension' => $tension,
            ':temperature' => $temperature
        ));
        $result = $this->db->lastInsertId();
        return $result; 
    }
    public function insert_visite($patient_id) {
        $query = "INSERT INTO visite (fk_patient) VALUES (:fk_patient) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':fk_patient' => $patient_id
        ));
        $result = $this->db->lastInsertId();
        return $result; 
    }
    public function insert_visite_signe_vitaux($fk_signe_vitaux, $fk_visite) {
        $query = "INSERT INTO visite_signe_vitaux (fk_signe_vitaux, fk_visite) VALUES (:fk_signe_vitaux, :fk_visite) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':fk_signe_vitaux' => $fk_signe_vitaux,
            ':fk_visite' => $fk_visite
        ));
        $result = $this->db->lastInsertId();
        return $result; 
    }
    public function insert_transfert_visite($fk_agent, $fk_visite) {
        $query = "INSERT INTO transfert_visite (fk_agent, fk_visite, etat_visite) VALUES (:fk_agent, :fk_visite, :etat_visite) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':fk_agent' => $fk_agent,
            ':fk_visite' => $fk_visite,
            ':etat_visite' => 1
        ));
        $result = $this->db->lastInsertId();
        return $result; 
    }


}
