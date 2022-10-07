<?php

class Consultation_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Renvoie la liste des fiches pour la datatable
     * @return array fiche
     */
    function xhr_consultation_DataTable($etape = null)
    {
        $query = '';
        $output = array();
        $query .= 'SELECT * FROM transfert_visite tr LEFT OUTER JOIN visite vst ON tr.fk_visite = vst.pk_visite LEFT OUTER JOIN patient pt ON vst.fk_patient = pt.patient_id LEFT OUTER JOIN visite_signe_vitaux vsv ON vst.pk_visite = vsv.pk_visite_signe_vitaux LEFT OUTER JOIN signe_vitaux sv ON vsv.fk_signe_vitaux = sv.pk_signe_vitaux ';

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY fiche_id DESC ';
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

            $sub_array = array();
            $sub_array[] = $row["fiche_id"];
            $sub_array[] = $row["patient_fiche_numero"];
            $sub_array[] = $row["patient_nom"];
            $sub_array[] = $row["patient_postnom"];
            $sub_array[] = $row["patient_prenom"];
            $sub_array[] = $row["patient_sexe"];
            $sub_array[] = $row["fiche_ouverture_date"];
            $data[] = $sub_array;
        }

        if ($etape != null) {
            $query_to_get_all = "SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id WHERE fiche_etape = " . $etape;
        } else {
            $query_to_get_all = "SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id";
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records($query_to_get_all),
            "data" => $data
        );

        echo json_encode($results);
    }

    /**
     * Commencer consultation 
     */
    public function commencer_consultation($fiche_id, $symptomes, $diagnostic)
    {
        $query = "UPDATE fiche SET symptomes = :symptomes, diagnostic = :diagnostic, fiche_etape = '2'  WHERE fiche_id = :fiche_id";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':symptomes' => $symptomes,
            ':diagnostic' => $diagnostic,
            ':fiche_id' => (int) $fiche_id
        ));

        return $result;
    }

    /**
     * Completer consultation 
     */
    public function completer_consultation($fiche_id, $traitement, $prescription)
    {

        $query = "UPDATE fiche SET traitement = :traitement, pres_medicale = :pres_medicale, fiche_cloture_date = NOW(), fiche_etape = '3'  WHERE fiche_id = :fiche_id";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':traitement' => $traitement,
            ':pres_medicale' => $prescription,
            ':fiche_id' => (int) $fiche_id
        ));

        return $result;
    }

    /**
     * Renvoie une fiches
     * @return array fiche
     */
    public function get_fiche($fiche_id)
    {
        $query = "SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id LEFT OUTER JOIN users u ON f.fiche_fk_users_id = u.users_id LEFT OUTER JOIN personnel pers ON u.agent_id = pers.id_agent  WHERE fiche_id = :fiche_id ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fiche_id' => $fiche_id
        ));

        $fiche = $statement->fetch();
        $statement->closeCursor();
        return $fiche;
    }

    /**
     * Demander examen au labo
     */
    public function demander_examen($demande_data)
    {

        $query = "SELECT COUNT(*) FROM examen WHERE exam_etape != '4' AND fk_fiche_id =" . (int) $demande_data['fk_fiche_id'];
        $demandes_nbre =  $this->db->query($query)->fetchColumn();

        if ($demandes_nbre > 0) {
            return 'une_demande_existe_deja_pour_cette_fiche';
        } else {

            $query = "INSERT INTO examen (fk_fiche_id, fk_patient_id, fk_demandeur_id, exam_date_demande, exam_service) VALUES (:fk_fiche_id, :fk_patient_id, :fk_demandeur_id, NOW(), :exam_service) ";
            $statement = $this->db->prepare($query);

            $result = $statement->execute(array(
                ':fk_fiche_id' => $demande_data['fk_fiche_id'],
                ':fk_patient_id' => $demande_data['fk_patient_id'],
                ':fk_demandeur_id' => Session::get('user_id'),
                ':exam_service' => $demande_data['exam_service']
            ));

            if ($result) {

                $query2 = "UPDATE examen SET ";

                $i = 0;

                foreach ($_POST as $key => $value) {
                    // $i++;

                    //pour eviter de prendre les fk et le service
                    if ($key == "fk_fiche_id" || $key == "fk_patient_id" || $key == "exam_service" || $key == "autres_examens") {
                        //$query2 .= $key." = 'x_dem' ";

                    } else {
                        $query2 .= $key . " = 'x_dem', ";

                        // if ($i < sizeof($_POST) ) {
                        //     $query2 .= " , ";
                        // }
                    }
                }

                $query2 .= "autres_examens = :autres_examens WHERE fk_fiche_id = :fk_fiche_id ";

                $statement2 = $this->db->prepare($query2);

                $result2 = $statement2->execute(array(
                    ':fk_fiche_id' => $demande_data['fk_fiche_id'],
                    ':autres_examens' => $demande_data['autres_examens']
                ));

                return $result2;
            } else {
                return false;
            }
        }
    }

    // Demande imagerie
    function demande_exam_image($demande_data)
    {
        $query = "INSERT INTO examen (fk_fiche_id, fk_patient_id, fk_demandeur_id, exam_date_demande, exam_service) VALUES (:fk_fiche_id, :fk_patient_id, :fk_demandeur_id, NOW(), :exam_service) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':fk_fiche_id' => $demande_data['fk_image_fiche_id'],
            ':fk_patient_id' => $demande_data['fk_image_patient_id'],
            ':fk_demandeur_id' => Session::get('user_id'),
            ':exam_service' => 'IMAGERIE'
        ));

        if ($result) {

            $query2 = "UPDATE examen SET radiographie = :radiographie, echographie = :echographie, irm = :irm, endoscopie = :endoscopie, scanner = :scanner  WHERE fk_fiche_id = :fk_fiche_id";

            $statement2 = $this->db->prepare($query2);

            $result2 = $statement2->execute(array(
                ':radiographie' => (isset($demande_data['radiographie'])) ? "x_dem" : null,
                ':echographie' => (isset($demande_data['echographie'])) ? "x_dem" : null ,
                ':irm' => (isset($demande_data['irm'])) ? "x_dem" : null,
                ':endoscopie' => (isset($demande_data['endoscopie'])) ? "x_dem" : null,
                ':scanner' => (isset($demande_data['scanner'])) ? "x_dem" : null,
                ':fk_fiche_id' => $demande_data['fk_image_fiche_id']
            ));

            return $result2;
        } else {
            return false;
        }
    }


    /**
     * supprimer une demande d'examens
     */
    public function supprimer_demande_exam($fiche_id)
    {
        $query = "UPDATE examen SET exam_etape = '4' WHERE fk_fiche_id = :fk_fiche_id ";

        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':fk_fiche_id' => $fiche_id
        ));

        return $result;
    }

    /**
     * Renvoie un examen avec tout les details
     * @return array exam
     */
    function get_exam($fiche_id, $exam_etape)
    {
        $query = "SELECT * FROM examen e LEFT OUTER JOIN patient p ON e.fk_patient_id = p.patient_id LEFT OUTER JOIN fiche f ON p.patient_id = f.fk_patient_id LEFT OUTER JOIN users u ON u.users_id = e.fk_demandeur_id  WHERE exam_etape = :exam_etape AND fk_fiche_id = :fk_fiche_id ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':exam_etape' => $exam_etape,
            ':fk_fiche_id' => $fiche_id
        ));

        $exam = $statement->fetch();
        $statement->closeCursor();
        return $exam;
    }

    /**
     * Renvoie un examen avec tout les details
     * @return boolean result
     */
    public function ajouter_resultats_a_la_fiche($fiche_id, $resultats_labo_en_string)
    {
        $query = "UPDATE fiche SET resultat_labo = :resultat_labo  WHERE fiche_id = :fiche_id";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':resultat_labo' => $resultats_labo_en_string,
            ':fiche_id' => (int) $fiche_id
        ));

        return $result;
    }
}
