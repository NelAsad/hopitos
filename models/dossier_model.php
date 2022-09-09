<?php

class Dossier_model extends Model {

    function __construct() {
        parent:: __construct();
    }


    /**
     * Renvoie la liste des users pour la datatable
     * @return array usersList
     */
    function xhr_get_patient_fiches_DataTable($search_text,$search_type){

        $query = '';
        $output = array();

        $query .= ' SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id ';

        if($search_type == "patient_id"){
            $query .= ' WHERE fk_patient_id = \''.$search_text.'\' ';
        }
        if($search_type == "fiche_id"){
            $query .= ' WHERE patient_fiche_numero =  \''.$search_text.'\' ';
        }
        
        if (isset($_POST["search"]["value"])) {
            $query .= ' AND ( fiche_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR fiche_ouverture_date LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR fiche_cloture_date LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR fiche_fk_users_id LIKE "%'.$_POST["search"]["value"].'%" )';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY fiche_id DESC ';
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
        $sub_array[] = $row["fiche_id"];
        $sub_array[] = $row["patient_nom"];
        $sub_array[] = $row["patient_postnom"];
        $sub_array[] = $row["patient_prenom"];
        $sub_array[] = $row["fiche_ouverture_date"];
        $sub_array[] = $row["fiche_cloture_date"];
        $sub_array[] = "
            <a style='cursor: pointer;' class='btn_show_consultation_modal_dossier' id='". $row["fiche_id"] ."' title='Voir les details'><i class='eye icon'></i></a>
            <a style='cursor: pointer;' class='btn_imprimer_fiche' id='". $row["fiche_id"] ."' title='Imprimer'><i class='print green icon'></i></a>
                       ";
        $data[] = $sub_array;

        }

        $results = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => $this->get_total_all_records("SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id"),
        "data" => $data
        );

        echo json_encode($results);

    }

    /**
     * Renvoie la liste des fiches d'un dossier pour la datatable
     * @return array usersList
     */
    function xhr_get_dossier_fiches_DataTable($dossier_numero){

        $query = '';
        $output = array();
        $query .= 'SELECT * FROM patient WHERE patient_dossier_numero = \''.$dossier_numero.'\' ';
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'AND ( patient_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_nom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_prenom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_postnom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR patient_fiche_numero LIKE "%'.$_POST["search"]["value"].'%" )';
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
        $sub_array = array();
        $sub_array[] = $row["patient_id"];
        $sub_array[] = $row["patient_prenom"];
        $sub_array[] = $row["patient_nom"];
        $sub_array[] = $row["patient_postnom"];
        $sub_array[] = $row["patient_fiche_numero"];
        $sub_array[] = "
                <a href='". URL ."dossier/get_all_fiches_patient/?search_text=".$row["patient_id"]."&search_type=patient_id' title='Voir la fiche'><i class='file icon'></i></a>
                    ";
        $data[] = $sub_array;
        }

        $results = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => $this->get_total_all_records('SELECT * FROM patient WHERE patient_dossier_numero = \''.$dossier_numero.'\' '),
        "data" => $data
        );

        echo json_encode($results);

    }

}
