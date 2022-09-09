<?php

class Stats_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie tout les payements pour une date
     */
    public function get_payement_date($date) {

        $query = "SELECT * FROM payement WHERE pay_date LIKE '%$date%'";
        return $this->db->query($query)->fetchAll();

    }

    /**
     * Renvoie tout les payements pour une une periode
     */
    public function get_payement_periode($date_debut, $date_fin) {

        $date_debut = $date_debut.' 00:00:00' ;
        $date_fin = $date_fin.' 23:59:59' ;

        $query = "SELECT * FROM payement WHERE pay_date >= '$date_debut' AND pay_date <= '$date_fin'";
        return $this->db->query($query)->fetchAll();

    }

    /**
     * Renvoie les details de la consultation pour une date
     */
    public function get_consultation_stats_date($now_date,$medecin_id){

        $std = new stdClass();

        $query = "SELECT * FROM fiche WHERE fiche_ouverture_date LIKE '%$now_date%' AND fiche_cloture_date != '0000-00-00 00:00:00' ";
        if ($medecin_id != null) {
            $query .= "AND fiche_fk_users_id = '$medecin_id' ";
        }
        $consultations = $this->db->query($query)->fetchAll();

        $query1 = "SELECT * FROM configs WHERE config_id = '1'";
        $info_config_fiche = $this->db->query($query1)->fetchAll();

        $std->consultations = $consultations;
        $std->info_config_fiche = $info_config_fiche;

        return $std;
    }

    /**
     * Renvoie les details de consultations pour une periode
     */
    public function get_consultation_stats_periode($medecin_id, $date_debut, $date_fin){
        $std = new stdClass();

        $query = "SELECT * FROM fiche WHERE fiche_ouverture_date >= '$date_debut' AND fiche_ouverture_date <= '$date_fin' AND fiche_cloture_date != '0000-00-00 00:00:00' ";
        if ($medecin_id != null) {
            $query .= "AND fiche_fk_users_id = '$medecin_id' ";
        }
        $consultations = $this->db->query($query)->fetchAll();

        $query1 = "SELECT * FROM configs WHERE config_id = '1'";
        $info_config_fiche = $this->db->query($query1)->fetchAll();

        $std->consultations = $consultations;
        $std->info_config_fiche = $info_config_fiche;

        return $std;
    }

    /**
     * Renvoie touts les depenses pour une date
     */
    public function get_depenses_date($date) {
        $query = "SELECT * FROM depense WHERE depense_datetime LIKE '%$date%'";
        return $this->db->query($query)->fetchAll();
    }

    /**
     * Renvoie toutes les depenses pour une une periode
     */
    public function get_depenses_periode($date_debut, $date_fin) {

        $date_debut = $date_debut.' 00:00:00' ;
        $date_fin = $date_fin.' 23:59:59' ;

        $query = "SELECT * FROM depense WHERE depense_datetime >= '$date_debut' AND depense_datetime <= '$date_fin'";
        return $this->db->query($query)->fetchAll();

    }


}
