<?php

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
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_show_patient_modal' id='". $row["patient_id"] ."' statut='". $row["patient_statut"] ."'  title='Voir les details'><i class='fa fa-eye'></i></a>
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_update_patient_modal' id='". $row["patient_id"] ."' title='Mettre a jour'><i class='fa fa-edit'></i></a>
            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_add_famille_patient_modal ". $display_btn ." ' id='". $row["patient_id"] ."' title='Ajouter un membre de la famille'><i class='fa fa-user-plus'></i></a>
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
     * Ajout_une_nouveau_patient
     */
    public function insert_patient($prenom, $nom,$postnom,$date_naissance, $sexe, $adresse,$statut,$dossier_num,$fiche_num,$titulaire_id,$affiliation,$code_conv,$occupation,$users_id) {
        $query = "INSERT INTO patient (patient_dossier_numero,patient_fiche_numero,patient_prenom,patient_nom,patient_postnom,patient_date_naissance,patient_sexe,patient_adresse,patient_statut,fk_patient_conv,patient_affiliation,patient_code_convention,patient_occupation,fk_users_id,patient_save_date) VALUES (:patient_dossier_numero,:patient_fiche_numero,:patient_prenom,:patient_nom,:patient_postnom,:patient_date_naissance,:patient_sexe,:patient_adresse,:patient_statut,:fk_patient_conv,:patient_affiliation,:patient_code_convention,:patient_occupation,:fk_users_id,NOW()) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':patient_dossier_numero' => $dossier_num,
            ':patient_fiche_numero' => $fiche_num,
            ':patient_prenom' => $prenom,
            ':patient_nom' => $nom,
            ':patient_postnom' => $postnom,
            ':patient_date_naissance' => $date_naissance,
            ':patient_sexe' => $sexe,
            ':patient_adresse' => $adresse,
            ':patient_statut' => $statut,
            ':fk_patient_conv' => $titulaire_id,
            ':patient_affiliation' => $affiliation,
            ':patient_code_convention' => $code_conv,
            ':patient_occupation' => $occupation,
            ':fk_users_id' => $users_id
        ));

        return $result;
    }

    /**
     * Ajout nouveau patient
     */
    public function add_famille_patient($prenom,$nom,$postnom,$date_naissance,$sexe,$adresse,$titulaire_id,$users_id) {
        $query = "INSERT INTO patient (patient_prenom,patient_nom,patient_postnom,patient_date_naissance,patient_sexe,patient_adresse,patient_statut,fk_patient_conv,fk_users_id,patient_save_date) VALUES (:patient_prenom,:patient_nom,:patient_postnom,:patient_date_naissance,:patient_sexe,:patient_adresse,:patient_statut,:fk_patient_conv,:fk_users_id,NOW()) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':patient_prenom' => $prenom,
            ':patient_nom' => $nom,
            ':patient_postnom' => $postnom,
            ':patient_date_naissance' => $date_naissance,
            ':patient_sexe' => $sexe,
            ':patient_adresse' => $adresse,
            ':patient_statut' => 'familleConv',
            ':fk_patient_conv' => $titulaire_id,
            ':fk_users_id' => $users_id
        ));

        return $result;
    }

    /**
     * Update_patient
     */
    public function update_patient($patient_id, $prenom, $nom,$postnom,$date_naissance, $sexe, $adresse,$statut,$dossier_num,$fiche_num,$titulaire_id,$affiliation,$code_conv,$occupation,$users_id) {
        $query = "UPDATE patient SET patient_dossier_numero = :patient_dossier_numero, patient_fiche_numero = :patient_fiche_numero,
        patient_prenom = :patient_prenom, patient_nom = :patient_nom, patient_postnom = :patient_postnom,
        patient_date_naissance = :patient_date_naissance, patient_sexe = :patient_sexe, patient_adresse = :patient_adresse,
        patient_statut = :patient_statut, fk_patient_conv = :fk_patient_conv, patient_affiliation = :patient_affiliation,
        patient_code_convention = :patient_code_convention, patient_occupation = :patient_occupation, fk_users_id = :fk_users_id,
        patient_save_date = NOW() WHERE patient_id = :patient_id ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':patient_dossier_numero' => $dossier_num,
            ':patient_fiche_numero' => $fiche_num,
            ':patient_prenom' => $prenom,
            ':patient_nom' => $nom,
            ':patient_postnom' => $postnom,
            ':patient_date_naissance' => $date_naissance,
            ':patient_sexe' => $sexe,
            ':patient_adresse' => $adresse,
            ':patient_statut' => $statut,
            ':fk_patient_conv' => $titulaire_id,
            ':patient_affiliation' => $affiliation,
            ':patient_code_convention' => $code_conv,
            ':patient_occupation' => $occupation,
            ':fk_users_id' => $users_id,
            ':patient_id' => $patient_id,
        ));

        return $result;
    }

    /**
     * Renvoie la liste des patients
     * @return array patients
     */
    public function patient_list() {

        $query = "SELECT * FROM patient";

        $statement = $this->db->prepare($query);
        $statement->execute();
        $patients = $statement->fetchAll();
        $statement->closeCursor();
        return $patients;
    }

    /**
     * Renvoie la liste des patients pour la dataTable
     * @return array patients
     */
    public function patient_list_json($search_value,$order,$order_0_column,$order_0_dir,$length,$start,$draw) {

        $query = '';
        $output = array();
        $query .= "SELECT * FROM patient ";

        if ($search_value!=null) {
            $query .= 'WHERE patient_prenom LIKE "%'.$search_value.'%" ';
            $query .= 'OR patient_nom LIKE "%'.$search_value.'%" ';
            $query .= 'OR patient_postnom LIKE "%'.$search_value.'%" ';
        } 

        if ($order!=null) {
            $query .= 'ORDER BY '.$order_0_column.' '.$order_0_dir.' ';
        } 
        else
        {
            $query .= 'ORDER BY patient DESC ';
        } 
        if ($length != -1) {
            $query .= 'LIMIT ' .$start. ', '.$length;
        }


        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $data = array();

        $filtered_rows = $statement->rowCount();

        foreach($result as $row)
        {
            $sub_array = array();

            $sub_array[] = $row["patient_id"];  
            $sub_array[] = $row["patient_prenom"];  
            $sub_array[] = $row["patient_nom"];
            $sub_array[] = $row["patient_postnom"]; 
            $sub_array[] = $row["patient_sexe"];  
            $sub_array[] = $row["patient_statut"];  
            $sub_array[] = $row["patient_date_naissance"];
            $sub_array[] = '<button type="button" name="delete" id="'.$row["numtp"].'" class="btn btn-danger btn-xs delete">Retirer</button>'; 
            $data[] = $sub_array;
        }

        $output = array(
            "draw"			=>	intval($draw),
            "recordsTotal"	=>	$filtered_rows,
            "recordsFiltered"	=>	get_total_all_records($connect),
            "data"				=>	$data
        );

        echo json_encode($output);


        function get_total_all_records($connect)
        { 
            $statement2 = $connect->prepare("SELECT * FROM patient");
            $statement2->execute();
            return $statement2->rowCount();
        }
    }


    /**
     * Renvoie un patient avec tout se details
     * @param int $patient_id
     * @return Array $patient
     */
    public function get_patient($patient_id) {
        $query = "SELECT * FROM patient WHERE patient_id = :patient_id";
        $statement = $this->db->prepare($query);
        $statement->execute(array(':patient_id' => $patient_id));
        $patient = $statement->fetch();
        $statement->closeCursor();
        return $patient;
    }

    // get membre famille
    public function get_membres_famille_patient($patient_id){
        $query = "SELECT * FROM patient WHERE fk_patient_conv = :patient_id AND patient_statut = 'familleConv' ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(':patient_id' => $patient_id));
        $membres = $statement->fetchAll();
        $statement->closeCursor();
        return $membres;
    }

    // get entreprise
    public function get_entreprise(){
        $query = "SELECT * FROM entreprise ";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $entreprises = $statement->fetchAll();
        $statement->closeCursor();
        return $entreprises;
    }



    /**
     * Renvoie les payement fiche actifs d'un patient
     */
    public function get_patient_frais_fiche_actif($patient_id,$pay_motif) {
        $query = "SELECT * FROM payement WHERE fk_pay_patient_id = :fk_pay_patient_id AND pay_motif = :pay_motif AND utilise = 0 ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fk_pay_patient_id' => $patient_id,
            ':pay_motif' => $pay_motif
        ));
        $pay_actifs = $statement->fetchAll();
        $statement->closeCursor();
        return $pay_actifs;
    }


    /**
     * Ouvrir_une_fiche
     */
    public function ouvrir_fiche($patient_id,$poids,$tension,$temperature,$medecin_consultant_id) {
        $query = "INSERT INTO fiche (fk_patient_id,poids,tension,temperature,fiche_ouverture_date,fiche_fk_users_id) VALUES (:fk_patient_id,:poids,:tension,:temperature,NOW(),:fiche_fk_users_id) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':fk_patient_id' => $patient_id,
            ':poids' => $poids,
            ':tension' => $tension,
            ':temperature' => $temperature,
            ':fiche_fk_users_id' => $medecin_consultant_id
        ));

        if ($result) {
            $query = "UPDATE payement SET utilise = '1' WHERE fk_pay_patient_id = :fk_pay_patient_id ";

            $statement = $this->db->prepare($query);

            $result = $statement->execute(array(
                ':fk_pay_patient_id' => $patient_id
            ));

            return $result;
        } else {
            return $result;
        }
        
    }

    //delete patient
    function delete_patient($patient_id){
        $query = "DELETE FROM patient WHERE patient_id = :patient_id ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':patient_id' => $patient_id,
        ));

        return $result;
    }


}
