<?php

class Laboratoire_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * Renvoie la liste des demandes d'examen pour la datatable
     * @return array fiche
     */
    function xhr_labo_dataTables($etape = null, $date_de_reponse = null)
    {

        $query = '';
        $output = array();
        $query .= 'SELECT * FROM examen e LEFT OUTER JOIN patient p ON e.fk_patient_id = p.patient_id LEFT OUTER JOIN fiche f ON e.fk_fiche_id = f.fiche_id LEFT OUTER JOIN users u ON u.users_id = e.fk_demandeur_id ';

        if ($etape != null) {
            $query .= ' WHERE exam_etape = ' . $etape . ' ';

            if (isset($_POST["search"]["value"])) {
                $query .= 'AND ';
                $query .= ' ( exam_id LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR p.patient_nom LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR p.patient_prenom LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR p.patient_postnom LIKE "%' . $_POST["search"]["value"] . '%" ';
                // $query .= 'OR u.prenom LIKE "%'.$_POST["search"]["value"].'%" ';
                // $query .= 'OR u.nom LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR p.patient_fiche_numero LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR e.exam_service LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR e.exam_date_demande LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        } else {
            if (isset($_POST["search"]["value"])) {
                $query .= ' WHERE exam_id LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR p.patient_nom LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR p.patient_prenom LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR p.patient_postnom LIKE "%' . $_POST["search"]["value"] . '%" ';
                // $query .= 'OR u.prenom LIKE "%'.$_POST["search"]["value"].'%" ';
                // $query .= 'OR u.nom LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR p.patient_fiche_numero LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR e.exam_service LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR e.exam_date_demande LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
        }

        if ($date_de_reponse != null) {
            $query .= ' AND e.exam_date_reponse LIKE "%' . $date_de_reponse . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY exam_id DESC ';
        }

        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();


        foreach ($result as $row) {


            //les boutons d'action
            if ($etape != null) {
                switch ($etape) {
                    case '1':
                        $action_btns = "
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_commencer_exam_appeler_patient'  nom='" . $row["patient_nom"] . "' postnom='" . $row["patient_postnom"] . "' prenom='" . $row["patient_prenom"] . "'  patient_id='" . $row["patient_id"] . "' exam_id='" . $row["exam_id"] . "' title='Appeler le patient'><i class='fa fa-microphone'></i></a>
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_show_inserer_exam_modal' id='" . $row["exam_id"] . "' statut='" . $row["patient_statut"] . "' title='Inserer les resultats'><i class='fa fa-edit'></i></a>
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_show_inserer_exam_image_modal' id='" . $row["exam_id"] . "' title='Inserer les resultats imagerie'><i class='fa fa-heartbeat'></i></a>
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_show_resultat_exam_image_modal' id='" . $row["exam_id"] . "' title='Voir resultat imagerie'><i class='fa fa-eye'></i></a>
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_declasser_demande' id='" . $row["exam_id"] . "' title='Declasser la demande'><i class='fa fa-remove'></i></a>
                        ";
                        break;

                    case '2':
                        $action_btns = "
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_show_exam_modal' id='" . $row["exam_id"] . "' title='Voir les details'><i class='fa fa-eye'></i></a>
                        ";
                        break;

                    case '3':
                        $action_btns = "
                            <a style='cursor: pointer;' class='btn btn-default btn-xs btn_show_exam_motif_declassement_modal' id='" . $row["exam_id"] . "' title='Voir les details'><i class='fa fa-eye'></i></a>
                        ";
                        break;

                    default:
                        # code...
                        break;
                }
            }


            $sub_array = array();
            $sub_array[] = $row["exam_id"]; //l'id de la demande examen
            // $sub_array[] = $row["prenom"]." ".$row["nom"]; // demandeur
            $sub_array[] = $row["patient_nom"] . " " . $row["patient_postnom"]; // patient
            $sub_array[] = $row["patient_fiche_numero"]; //numero de la fiche du patient
            $sub_array[] = $row["exam_date_demande"]; // heure de demande examens
            $sub_array[] = $row["exam_service"]; // le service d'ou provient la demande
            $sub_array[] = $action_btns;
            $data[] = $sub_array;
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM examen e LEFT OUTER JOIN patient p ON e.fk_patient_id = p.patient_id LEFT OUTER JOIN fiche f ON e.fk_fiche_id = f.fiche_id LEFT OUTER JOIN users u ON u.users_id = e.fk_demandeur_id "),
            "data" => $data
        );

        echo json_encode($results);
    }


    /**
     * Renvoie un examen avec tout les details
     * @return array exam
     */
    function get_exam($exam_id)
    {
        $query = "SELECT * FROM examen e LEFT OUTER JOIN patient p ON e.fk_patient_id = p.patient_id LEFT OUTER JOIN fiche f ON p.patient_id = f.fk_patient_id LEFT OUTER JOIN users u ON u.users_id = e.fk_demandeur_id  WHERE exam_id = :exam_id ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':exam_id' => $exam_id
        ));

        $statement->setFetchMode(PDO::FETCH_OBJ);
        $exam = $statement->fetch();
        $statement->closeCursor();
        return $exam;
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
