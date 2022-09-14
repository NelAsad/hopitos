<?php

class Home_model extends Model {

    function __construct() {
        parent:: __construct();
    }

  
    public function get_patient() {
        $query = "SELECT count(*) as total FROM patient";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $total = $statement->fetch();
        $statement->closeCursor();
        return $total;
    }

  
    public function get_personnel() {
        $query = "SELECT count(*) as total FROM personnel";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $total = $statement->fetch();
        $statement->closeCursor();
        return $total;

    }
    
    public function get_fiches() {
        $query = "SELECT count(*) as total FROM fiche";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $total = $statement->fetch();
        $statement->closeCursor();
        return $total;
    }
  
    public function get_exam() {
        $query = "SELECT count(*) as total FROM examen";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $total = $statement->fetch();
        $statement->closeCursor();
        return $total;
    }


}
