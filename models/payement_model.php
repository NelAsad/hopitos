<?php

class Payement_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie la liste des payements pour la datatable
     */
    function payement_datatable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM payement ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE pay_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR pay_motif LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR pay_date LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR num_facture LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR utilise LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR fk_pay_patient_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR fk_pay_exam_id LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY pay_id DESC ';
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
        $sub_array[] = $row["pay_id"];
        $sub_array[] = ($row["pay_motif"] == 1) ? 'Frais de fiche' : 'Frais de laboratoire';
        $sub_array[] = $row["pay_montant"];
        $sub_array[] = $row["pay_date"];
        $sub_array[] = $row["num_facture"];
        $sub_array[] = $row["fk_pay_patient_id"];
        // $sub_array[] = $row["fk_pay_user_id"];
        $sub_array[] = "
            <a style='cursor: pointer;' class='btn_imprimer_recu' id='". $row["pay_id"] ."' motif='". $row["pay_motif"] ."' title='Imprimer le recu'><i class='fa fa-print'></i></a>
                       ";
        $data[] = $sub_array;
        }

        $results = array(
        "draw" => intval($_POST["draw"]),
        "recordsTotal" => $filtered_rows,
        "recordsFiltered" => $this->get_total_all_records("SELECT * FROM payement"),
        "data" => $data
        );

        echo json_encode($results);

    }


    /**
     * Renvoie une congiguration partant de son Id
     * @return array config
     */
    public function get_config_by_id($config_id) {

        $query = "SELECT * FROM configs WHERE config_id = :config_id ";

        $statement = $this->db->prepare($query);
            $statement->execute(array(
                ':config_id' => $config_id
            ));

        $config = $statement->fetch();
        $statement->closeCursor();
        return $config;
    }

    /**
     * Enregiste un payement dans la bd
     */
    public function done_payement($new_payement_motif,$new_payement_patient_id,$montant_frais,$facture_numero,$new_payement_demande_id,$users_id,$pay_description = '') {
        $query = "INSERT INTO payement (pay_motif,pay_montant,pay_date,num_facture,fk_pay_patient_id,fk_pay_exam_id,fk_pay_user_id,pay_description) VALUES (:pay_motif,:pay_montant,NOW(),:num_facture,:fk_pay_patient_id,:fk_pay_exam_id,:fk_pay_user_id,:pay_description) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':pay_motif' => $new_payement_motif,
            ':pay_montant' => $montant_frais,
            ':num_facture' => $facture_numero,
            ':fk_pay_patient_id' => $new_payement_patient_id,
            ':fk_pay_exam_id' => $new_payement_demande_id,
            ':fk_pay_user_id' => $users_id,
            ':pay_description' => $pay_description
        ));

        return $result;
    }


    /**
     * Renvoie un examen avec tout les details
     * @return array exam
     */
    function get_exam($exam_id){
        $query = "SELECT * FROM examen e LEFT OUTER JOIN patient p ON e.fk_patient_id = p.patient_id LEFT OUTER JOIN users u ON u.users_id = e.fk_demandeur_id WHERE exam_id = :exam_id";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':exam_id' => $exam_id
        ));

        $exam = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $exam;
    }

    /**
     * Renvoie un examen avec tout les details
     * @return array exam
     */
    function get_config_by_name($nom_exam){
        $query = "SELECT * FROM configs WHERE config_nom = :config_nom ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':config_nom' => $nom_exam
        ));

        $config = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $config;
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

    // Get one payement
    function get_payement($pay_id){
        $query = "SELECT * FROM payement p LEFT OUTER JOIN patient pa ON p.fk_pay_patient_id = pa.patient_id LEFT OUTER JOIN examen e ON p.fk_pay_exam_id = e.exam_id LEFT OUTER JOIN users u ON p.fk_pay_user_id = u.users_id WHERE pay_id = :pay_id ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(':pay_id' => $pay_id));
        $patient = $statement->fetch();
        $statement->closeCursor();
        return $patient;
    }

    // get payement for laboratoire
    function get_payement_labo($pay_id){
        $query = "SELECT * FROM payement p LEFT OUTER JOIN examen e ON p.fk_pay_exam_id = e.exam_id LEFT OUTER JOIN patient pa ON e.fk_patient_id = pa.patient_id LEFT OUTER JOIN users u ON p.fk_pay_user_id = u.users_id WHERE pay_id = :pay_id ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(':pay_id' => $pay_id));
        $patient = $statement->fetch();
        $statement->closeCursor();
        return $patient;
    }


}
