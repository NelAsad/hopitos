<?php

class Model {

    function __construct() {
         $this->db = new Database();
    }

    /**
     * Renvoie le nombre d'enregistrement total (pour la datatable)
     */
    function get_total_all_records($query) {
        $sth2 = $this->db->prepare($query);
        $sth2->execute();
        return $sth2->rowCount();
    }

    /**
     * Get user by privilege
     */
    function get_users_by_privilege($privilege){
        $query = "SELECT * FROM users u LEFT OUTER JOIN personnel p ON u.agent_id = p.id_agent WHERE privilege = :privilege ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            'privilege' => $privilege
        ));
        $medecins = $statement->fetchAll();
        $statement->closeCursor();
        return $medecins;
    }

}
