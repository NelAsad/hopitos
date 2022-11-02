<?php

class Laboratoire_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * Renvoie la liste des transferts
     * @return array fiche
     */
    function xhr_transfert_DataTable($etape = null)
    {
        $query = '';
        $output = array();
        $query .= 'SELECT * FROM transfert_visite tr LEFT OUTER JOIN visite vst ON tr.fk_visite = vst.pk_visite LEFT OUTER JOIN patient pt ON vst.fk_patient = pt.patient_id LEFT OUTER JOIN visite_signe_vitaux vsv ON vst.pk_visite = vsv.pk_visite_signe_vitaux LEFT OUTER JOIN signe_vitaux sv ON vsv.fk_signe_vitaux = sv.pk_signe_vitaux ';

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY pk_transfert_visite DESC ';
        }

        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();
        $sth->closeCursor();
        $data = array();
        $filtered_rows = $sth->rowCount();

        foreach ($result as $row) {

            $actions = "";

            $query1 = "SELECT * FROM diagnostic WHERE fk_transfert = :fk_transfert ";
            $statement = $this->db->prepare($query1);
            $statement->execute(array(
                ':fk_transfert' => (int) $row["pk_transfert_visite"]
            ));
            $diagnostics = $statement->fetchAll();
            $statement->closeCursor();
            // return $diagnostics;

            $sub_array = array();
            $sub_array[] = $row["pk_transfert_visite"];
            $sub_array[] = $row["patient_fiche_numero"];
            $sub_array[] = $row["patient_nom"];
            $sub_array[] = $row["patient_postnom"];
            $sub_array[] = $row["patient_prenom"];
            $sub_array[] = $row["patient_sexe"];
            $sub_array[] = $row["debut_visite"];
            $actions .= "
                <a style='cursor: pointer;' class='btn btn-default btn-xs btn_commencer_consultation_patient_modal' id='". $row["pk_transfert_visite"] ."' title='Commencer la consultation'><i class='fa fa-edit'></i></a>
                <div class='btn-group'>
                    <button type='button' class='btn btn-default btn-xs dropdown-toggle dropdown-toggle-split' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        <i class='fa fa-stethoscope'></i>
                        <span class='sr-only'>Toggle Dropdown</span>
                    </button>
                <div class='dropdown-menu'>
            ";
            foreach ($diagnostics as $diagnostic) {
                $actions .= "
                    <a class='dropdown-item show_diagnostic_section' id='".$diagnostic['pk_diagnostic']."'>".$diagnostic['note_diagnostic']."</a>
                    <div class='dropdown-divider'></div>
                ";
            }
            $actions .= "
                    </div>
                </div>
            ";
            $sub_array[] = $actions;
            $data[] = $sub_array;
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM transfert_visite tr LEFT OUTER JOIN visite vst ON tr.fk_visite = vst.pk_visite LEFT OUTER JOIN patient pt ON vst.fk_patient = pt.patient_id LEFT OUTER JOIN visite_signe_vitaux vsv ON vst.pk_visite = vsv.pk_visite_signe_vitaux LEFT OUTER JOIN signe_vitaux sv ON vsv.fk_signe_vitaux = sv.pk_signe_vitaux"),
            "data" => $data
        );

        echo json_encode($results);
    }


    /**
     * Renvoie un examen avec tout les details
     * @return array exam
     */
    function get_examens_demandes($diagnostic_id)
    {
        $query = "SELECT * FROM demande_labo dl LEFT OUTER JOIN actes ac ON dl.fk_acte = ac.pk_acte WHERE fk_diagnostic = :fk_diagnostic AND reponse = 0";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fk_diagnostic' => (int) $diagnostic_id
        ));
        $examens = $statement->fetchAll();
        $statement->closeCursor();
        return $examens;
    }

    /**
     * Insert resultat examen
     */
    public function insert_resultat_examen($fk_demande,$note_resultat)
    {
        $query = "INSERT INTO resultat_labo_demande (note_resultat, fk_agent, fk_demande) VALUES (:note_resultat, :fk_agent, :fk_demande)";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':note_resultat' => $note_resultat,
            ':fk_demande' => $fk_demande,
            ':fk_agent' => (int) Session::get('user_id')
        ));

        return $result;
    }

    public function set_demande_satisfaite($fk_demande){
        $query = "UPDATE demande_labo SET reponse = 1 WHERE pk_demande_labo = :pk_demande_labo";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':pk_demande_labo' => $fk_demande
        ));
        return $result;
    }




    /**
     * Renvoie une fiches
     * @return array fiche
     */
    public function get_fiche($fiche_id)
    {

        $query = "SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id LEFT OUTER JOIN users u ON f.fiche_fk_users_id = u.users_id WHERE fiche_id = :fiche_id ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fiche_id' => $fiche_id
        ));

        $fiche = $statement->fetch();
        $statement->closeCursor();
        return $fiche;
    }

    /**
     * Renvoie un examen avec tout les details
     * @return boolean result
     */
    function inserer_resultats_examens($data)
    {
        $query = "UPDATE examen SET ";

        foreach ($data as $key => $value) {
            //pour eviter de prendre l'id
            if ($key == "hidden_exam_id" || $key == "laboratoire_autres_examens_resultats") {
                //$query .= $key." = 'x_dem' ";
            } else {
                $query .= $key . " = '" . $value . "' , ";
            }
        }

        $query .= " autres_examens_resultats = :autres_examens_resultats, exam_etape = '2', exam_date_reponse = NOW(), fk_laborantin_id = :users_id WHERE exam_id = :exam_id ";

        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':exam_id' => $data['hidden_exam_id'],
            ':autres_examens_resultats' => $data['laboratoire_autres_examens_resultats'],
            ':users_id' => Session::get('user_id')
        ));

        if ($result) {
            $query = "UPDATE payement SET utilise = '1' WHERE fk_pay_exam_id = :fk_pay_exam_id ";

            $statement = $this->db->prepare($query);

            $result = $statement->execute(array(
                ':fk_pay_exam_id' => $data['hidden_exam_id']
            ));

            return $result;
        } else {
            return $result;
        }
    }

    /**
     * Declasser une demande d'examen
     * @return boolean result
     */
    function declasser_exam($exam_id, $motif_declasse)
    {
        $query = "UPDATE examen SET exam_etape = '3', motif_declasse = :motif_declasse, exam_date_reponse = NOW(), fk_laborantin_id = :users_id WHERE exam_id = :exam_id ";

        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':exam_id' => $exam_id,
            ':motif_declasse' => $motif_declasse,
            ':users_id' => Session::get('user_id')
        ));

        if ($result) {
            $query = "UPDATE payement SET utilise = '1' WHERE fk_pay_exam_id = :fk_pay_exam_id ";

            $statement = $this->db->prepare($query);

            $result = $statement->execute(array(
                ':fk_pay_exam_id' => $exam_id
            ));

            return $result;
        } else {
            return $result;
        }
    }

    // Insert exam imagerie
    function insert_exam_image_link($exam_id, $target_file, $champ)
    {
        $query = "UPDATE examen SET $champ = :exam_image_link WHERE exam_id = :exam_id ";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':exam_id' => $exam_id,
            ':exam_image_link' => $target_file
        ));
        return $result;
    }
    // Set exam inserted 
    function set_exam_inserted($exam_id)
    {
        $query = "UPDATE examen SET img_inserted = 1 WHERE exam_id = :exam_id ";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':exam_id' => $exam_id
        ));
        return $result;
    }

    /**
     * Renvoie les payement labo actifs d'un patient
     */
    public function get_patient_frais_labo_actif($exam_id, $pay_motif)
    {
        $query = "SELECT * FROM payement WHERE fk_pay_exam_id = :fk_pay_exam_id AND pay_motif = :pay_motif AND utilise = 0 ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fk_pay_exam_id' => $exam_id,
            ':pay_motif' => $pay_motif
        ));
        $pay_actifs = $statement->fetchAll();
        $statement->closeCursor();
        return $pay_actifs;
    }
}
