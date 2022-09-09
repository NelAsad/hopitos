<?php
/**
 * Copyright (c) 2019, Innovate For Future Tech.
 * Powered by Elysée Asad Luboya
 * Soft-Mat
 * 
 * @package   Soft-Mat
 * @author    Dread Luiz Kiamputu & Elysée Asad Luboya (email:nel7luboya@gmail.com, Tél:+243 819664909)
 * @copyright Copyright (c) 2019, Innovate For Future Tech.  (http://innovateforfuture.com)
 * @since     Version 1.3.0
 */

class Login_model extends Model{

    function __construct() {
        parent:: __construct();
    }


    /**
     * Check pour la connexion
     * @param type $login_ou_email
     * @param type $password
     */
    public function connect($login, $password) {
        $query = "SELECT * FROM users WHERE login = :login AND password = :password";
        
        $statement = $this->db->prepare($query);

        $statement->bindValue(':login', $login);
        $statement->bindValue(':password', $password);
        
        $statement->execute();
        $user_data = $statement->fetch();
        
        return $user_data;
    }

}
