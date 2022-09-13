<?php

class Consultation_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie la liste des fiches pour la datatable
     * @return array fiche
     */
    function xhr_consultation_DataTable($etape = null, $date_des_fiches = null, $users_id = null){
        
        $query = '';
        $output = array();
        $query .= 'SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id ';

        if($etape != null){
            $query .= 'WHERE fiche_etape = '.$etape.' ';

            if (isset($_POST["search"]["value"])) {
                $query .= 'AND ';
                $query .= '( fiche_id LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR patient_nom LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR patient_prenom LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR patient_postnom LIKE "%'.$_POST["search"]["value"].'%" )';
            }
            
        }else{
            if (isset($_POST["search"]["value"])) {
                $query .= 'WHERE fiche_id LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR patient_nom LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR patient_prenom LIKE "%'.$_POST["search"]["value"].'%" ';
                $query .= 'OR patient_postnom LIKE "%'.$_POST["search"]["value"].'%" ';
            }
        }

        if ($date_des_fiches != null) {
            $query .= ' AND fiche_cloture_date LIKE "%'.$date_des_fiches.'%" ';
        }
        if ($users_id != null) {
            $query .= ' AND fiche_fk_users_id = '.$users_id.' ';
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

            //check le nombre de demande d'examens pour chaque fiche
            $query = "SELECT exam_id,exam_etape FROM examen WHERE exam_etape != '4' AND fk_fiche_id = " . (int) $row["fiche_id"];
            $demandes = $this->db->query($query)->fetchAll();// hum logiquement, j'ai prevu une demande.. pas plusieurs

            $nbre_demandes = sizeof($demandes); // le nombre de demandes, mais en general un

            if ($nbre_demandes > 0) { // je m'assure que le tab n'est pas vide
               $exam_etape = $demandes[0]['exam_etape']; // je recupere l'etape de la demande (etat)
               $exam_ident = "Demande : ".$demandes[0]['exam_id']; // je recupere l'id de l'exam pour la caisse
               $exam_fk_patient_id = "Patient : ".$demandes[0]['exam_etape']; // je recupere l'id du patient pour la caisse
            } else {
                $exam_etape = '1'; // car par default une demande a pour 'exam_etape' = 1
                $exam_ident = "";
            }
            

            //je defini la couleur en fonction de l'etat de la demande (satisfaite, declassee, pas encore traitee)
            //et les actions sur la demande
            switch ($exam_etape) {
                case '2':
                    $action_sur_la_demande = "
                        <a class='btn btn-primary btn-xs consultation_voir_resultat_labo' id='". $row["fiche_id"] ."' title='Voir les resultats'><i class='fa fa-eye'></i></a>
                        <a class='btn btn-primary btn-xs consultation_supprimer_demande' id='". $row["fiche_id"] ."' title='Supprimer la demande'><i class='fa fa-file'></i></a>
                    ";
                    $icon_color = "green";
                    $infobulle_etat_demande = "Demande satisfaite";
                    break;
                
                case '3':
                    $action_sur_la_demande = "
                        <a class='btn btn-primary btn-xs consultation_voir_motif_declassement' id='". $row["fiche_id"] ."' title='Voir le motif du declassement'><i class='fa fa-eye'></i></a>
                        <a class='btn btn-primary btn-xs consultation_supprimer_demande' id='". $row["fiche_id"] ."' title='Supprimer la demande'><i class='fa fa-remove'></i></a>
                    ";
                    $icon_color = "red";
                    $infobulle_etat_demande = "Demande declasee";
                    break;
                
                default:
                    $action_sur_la_demande = "
                        <a class='btn btn-primary btn-xs consultation_supprimer_demande' id='". $row["fiche_id"] ."' title='Supprimer la demande'><i class='fa fa-remove'></i></a>
                        <span>".$exam_ident."</span>
                    ";
                    $icon_color = "";
                    $infobulle_etat_demande = "Demande pas encore traitee";
                    break;
            }

            //les boutons d'action
            if ($etape != null) {
                switch ($etape) {
                    case '1':
                        $action_btns = "
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_show_consultation_modal' id='". $row["fiche_id"] ."' title='Voir les details'><i class='fa fa-eye'></i></a>
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_commencer_consultation_patient_modal' id='". $row["fiche_id"] ."' title='commencer la consultation'><i class='fa fa-edit'></i></a>
                            
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_commencer_consultation_appeler_patient' nom='". $row["patient_nom"] ."' postnom='". $row["patient_postnom"] ."' prenom='". $row["patient_prenom"] ."'  patient_id='". $row["patient_id"] ."' id='". $row["fiche_id"] ."' title='Appeler le patient'> <i class='fa fa-microphone'></i> </a>
                        ";
                        break;                    

                    case '2':
                        $action_btns = "
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_show_consultation_modal' id='". $row["fiche_id"] ."' title='Voir les details de la fiche'><i class='fa fa-eye'></i></a>
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_consultation_demander_examens' fiche_id='". $row["fiche_id"] ."' patient_id='". $row["patient_id"] ."' title='Demander des examens au labo'><i class='fa fa-send'></i></a>
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_commencer_consultation_appeler_patient' nom='". $row["patient_nom"] ."' postnom='". $row["patient_postnom"] ."' prenom='". $row["patient_prenom"] ."'  patient_id='". $row["patient_id"] ."' id='". $row["fiche_id"] ."' title='Appeler le patient'> <i class='fa fa-microphone'></i> </a>
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_completer_consultation_patient_modal' id='". $row["fiche_id"] ."' title='completer la fiche'><i class='fa fa-refresh'></i></a>
                            <a class='btn btn-primary btn-xs' title='".$infobulle_etat_demande."'><i class='fa fa-file ".$icon_color."'></i>".$nbre_demandes."</a>
                            ".$action_sur_la_demande."
                        ";
                        break;

                    case '3':
                        $action_btns = "
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_show_consultation_modal' id='". $row["fiche_id"] ."' title='Voir les details'><i class='fa fa-eye'></i></a>
                            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_imprimer_fiche' id='". $row["fiche_id"] ."' title='Imprimer'><i class='fa fa-print'></i></a>
                            <a class='btn btn-primary btn-xs' title='".$infobulle_etat_demande."'><i class='fa fa-file ".$icon_color." '></i>".$nbre_demandes."</a>
                        ";
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }


            $sub_array = array();
            $sub_array[] = $row["fiche_id"];
            $sub_array[] = $row["patient_fiche_numero"];
            $sub_array[] = $row["patient_nom"];
            $sub_array[] = $row["patient_postnom"];
            $sub_array[] = $row["patient_prenom"];
            $sub_array[] = $row["patient_sexe"];
            $sub_array[] = $row["fiche_ouverture_date"];
            $sub_array[] = $action_btns;
            $data[] = $sub_array;
        }

        if ($etape != null) {
            $query_to_get_all = "SELECT * FROM fiche f LEFT OUTER JOIN patient p ON f.fk_patient_id = p.patient_id WHERE fiche_etape = ".$etape;
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
    public function commencer_consultation($fiche_id,$symptomes,$diagnostic) {

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
    public function completer_consultation($fiche_id,$traitement,$prescription) {

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
    public function get_fiche($fiche_id) {

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
     * Demander examen au labo
     */
    public function demander_examen($demande_data){

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
                    
                    }else{
                        $query2 .= $key." = 'x_dem', ";

                        // if ($i < sizeof($_POST) ) {
                        //     $query2 .= " , ";
                        // }
                    }

                }

                $query2 .= "autres_examens = :autres_examens, imagerie = :imagerie WHERE fk_fiche_id = :fk_fiche_id ";

                $statement2 = $this->db->prepare($query2);

                $result2 = $statement2->execute(array(
                    ':fk_fiche_id' => $demande_data['fk_fiche_id'],
                    ':autres_examens' => $demande_data['autres_examens'],
                    ':imagerie' => $demande_data['imagerie']
                ));

                return $result2;
                
            } else {
                return false;
            }

        }
        
    }

    /**
     * supprimer une demande d'examens
     */
    public function supprimer_demande_exam($fiche_id){
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
    function get_exam($fiche_id, $exam_etape){
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
    public function ajouter_resultats_a_la_fiche($fiche_id, $resultats_labo_en_string){
        $query = "UPDATE fiche SET resultat_labo = :resultat_labo  WHERE fiche_id = :fiche_id";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':resultat_labo' => $resultats_labo_en_string,
            ':fiche_id' => (int) $fiche_id
        ));
        
        return $result;
    }

}
