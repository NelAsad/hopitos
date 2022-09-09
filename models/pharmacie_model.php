<?php

class Pharmacie_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie la liste des produits pour la datatable
     */
    function produit_datatable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM produit ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE produit_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_nom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_dosage LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_dosage_unite LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_pv LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_qte LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY produit_id DESC ';
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
            $sub_array[] = $row["produit_id"];
            $sub_array[] = $row["produit_nom"];
            $sub_array[] = $row["produit_dosage"].' '.$row['produit_dosage_unite'];
            $sub_array[] = $row["produit_pv"].' fc';
            $sub_array[] = $row["produit_qte"];
            $sub_array[] = "
                            <a style='cursor: pointer;' class='btn_update_produit_modal' id='". $row["produit_id"] ."' title='Mettre à jour le produit'><i class='edit icon'></i></a>
                            <a style='cursor: pointer;' class='btn_add_qte_produit_modal' id='". $row["produit_id"] ."' quantite='". $row["produit_qte"] ."' title='Ajouter une quantité'><i class='plus orange icon'></i></a>
                            <a style='cursor: pointer;' class='btn_sortie_produit_modal' id='". $row["produit_id"] ."' title='Delivrer produit'><i class='send green icon'></i></a>
                        ";
            $data[] = $sub_array;
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM produit"),
            "data" => $data
        );

        echo json_encode($results);

    }


    /**
     * Renvoie la liste des sorties produits pour la datatable
     */
    function sortie_produits_datatable(){
        
        $query = '';
        $output = array();
        $query .= "SELECT * FROM sortie_produit s LEFT OUTER JOIN produit p ON s.sortie_produit_fk_produit_id = p.produit_id ";
        
        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE produit_id LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_nom LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR sortie_produit_qte LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR sortie_produit_datetime LIKE "%'.$_POST["search"]["value"].'%" ';
            $query .= 'OR produit_qte LIKE "%'.$_POST["search"]["value"].'%" ';
        }
        
        if (isset($_POST["order"])) {
            $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir']. ' ';
        }else{
            $query .= 'ORDER BY sortie_produit_id DESC ';
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
            $sub_array[] = $row["produit_id"];
            $sub_array[] = $row["produit_nom"];
            $sub_array[] = $row["sortie_produit_qte"];
            $sub_array[] = $row["sortie_produit_datetime"];

            $data[] = $sub_array;
        }

        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM sortie_produit s LEFT OUTER JOIN produit p ON s.sortie_produit_fk_produit_id = p.produit_id"),
            "data" => $data
        );

        echo json_encode($results);

    }



    /**
     * Ajout new produit
     */
    public function insert_new_produit($produit_nom,$produit_dosage,$produit_dosage_unite,$produit_pv) {
        $query = "INSERT INTO produit (produit_nom,produit_dosage,produit_dosage_unite,produit_pv) VALUES (:produit_nom,:produit_dosage,:produit_dosage_unite,:produit_pv) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':produit_nom' => $produit_nom,
            ':produit_dosage' => $produit_dosage,
            ':produit_dosage_unite' => $produit_dosage_unite,
            ':produit_pv' => $produit_pv
        ));

        return $result;
    }

    /**
     * Renvoie un produit avec tout les details
     */
    public function get_produit($produit_id){
        $query = "SELECT * FROM produit WHERE produit_id = :produit_id";
        $statement = $this->db->prepare($query);
        $statement->execute(array(
            'produit_id' => $produit_id
        ));
        $produit = $statement->fetch();
        return $produit;
    }

    /**
     * Update produit
     */
    public function update_produit($produit_id,$produit_nom,$produit_dosage,$produit_dosage_unite,$produit_pv,$produit_qte){
        $query = "UPDATE produit SET produit_nom = :produit_nom, produit_dosage = :produit_dosage, produit_dosage_unite = :produit_dosage_unite, produit_pv = :produit_pv, produit_qte = :produit_qte WHERE produit_id = :produit_id";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':produit_nom' => $produit_nom,
            ':produit_dosage' => $produit_dosage,
            ':produit_dosage_unite' => $produit_dosage_unite,
            ':produit_pv' => $produit_pv,
            ':produit_qte' => $produit_qte,
            ':produit_id' => $produit_id
        ));
        return $result;
    }

    /**
     * Ajouter une quantite pour un produit
     */
    public function add_produit_qte($produit_id,$produit_qte){
        $query = "UPDATE produit SET produit_qte = :produit_qte WHERE produit_id = :produit_id";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':produit_qte' => $produit_qte,
            ':produit_id' => $produit_id
        ));
        return $result;
    }

    /**
     * Delivrer produit (insert in db)
     */
    function delivrer_produit_qte($produit_id,$quantite_delivree,$users_id){
        $query = "INSERT INTO sortie_produit (sortie_produit_qte,sortie_produit_datetime,sortie_produit_fk_produit_id,sortie_produit_fk_users_id) VALUES (:sortie_produit_qte,NOW(),:sortie_produit_fk_produit_id,:sortie_produit_fk_users_id)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':sortie_produit_qte' => $quantite_delivree,
            ':sortie_produit_fk_produit_id' => $produit_id,
            ':sortie_produit_fk_users_id' => $users_id
        ));
        return $result;
    }



}
