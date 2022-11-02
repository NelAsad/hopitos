<?php

class Consultation_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Renvoie la liste des transferts
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
     * Commencer consultation
     */
    public function commencer_consultation($transfert_id, $symptomes, $diagnostic)
    {
        $query = "INSERT INTO diagnostic (note_plainte, note_diagnostic, fk_transfert) VALUES (:note_plainte, :note_diagnostic, :fk_transfert)";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':note_plainte' => $symptomes,
            ':note_diagnostic' => $diagnostic,
            ':fk_transfert' => (int) $transfert_id
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
    public function get_actes()
    {
        $query = "SELECT * FROM actes a LEFT OUTER JOIN tarif t ON a.fk_tarif = t.pk_tarif ";

        $statement = $this->db->prepare($query);
        $statement->execute();
        $actes = $statement->fetchAll();
        $statement->closeCursor();
        return $actes;
    }

    /**
     * Diagnostic
     */
    public function get_diagnostic($diagnostic_id)
    {
        $query = "SELECT * FROM diagnostic WHERE pk_diagnostic = :pk_diagnostic ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':pk_diagnostic' => (int) $diagnostic_id
        ));
        $diagnostic = $statement->fetch();
        $statement->closeCursor();
        return $diagnostic;
    }

    /**
     * Diagnostic examens demandés
     */
    public function diagnostic_examen_demandes($diagnostic_id)
    {
        $query = "SELECT * FROM demande_labo dl LEFT OUTER JOIN actes ac ON dl.fk_acte = ac.pk_acte WHERE fk_diagnostic = :fk_diagnostic ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fk_diagnostic' => (int) $diagnostic_id
        ));
        $examens = $statement->fetchAll();
        $statement->closeCursor();
        return $examens;
    }

    /**
     * Diagnostic prescriptions
     */
    public function diagnostic_prescription($diagnostic_id)
    {
        $query = "SELECT * FROM prescription WHERE fk_diagnostic = :fk_diagnostic ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':fk_diagnostic' => (int) $diagnostic_id
        ));
        $prescriptions = $statement->fetchAll();
        $statement->closeCursor();
        return $prescriptions;
    }





    /**
     * Demande examen
     */
    public function insert_demande_labo($diagnostic_id, $acte)
    {
        $query = "INSERT INTO demande_labo (fk_diagnostic, fk_acte) VALUES (:fk_diagnostic, :fk_acte)";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':fk_diagnostic' => $diagnostic_id,
            ':fk_acte' => (int) $acte
        ));

        return $result;
    }
    /**
     * Prescription
     */
    public function isnert_diagnostic_prescrire($med, $posologie, $dosage, $prescription_diagnostic_id)
    {
        $query = "INSERT INTO prescription (medicament, dosage, posologie, fk_diagnostic) VALUES (:medicament, :dosage, :posologie, :fk_diagnostic)";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':medicament' => $med,
            ':dosage' => $dosage,
            ':posologie' => $posologie,
            ':fk_diagnostic' => (int) $prescription_diagnostic_id
        ));

        return $result;
    }

}
