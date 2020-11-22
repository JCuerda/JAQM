<?php
/**
 * Written By: s4Lv4t0r3
 * Date : January 13, 2019
 */
class Account_Model extends CI_Model{

    /**
     * Record COmpany Login credentials
     * to the database
     * @param string email
     * @param string password
     */
    public function store_login_credentials($email, $password){
        
        $table = 'tbl_applicants';
        
        $id       = $this->store_applicant_details($email);
        $is_empty = ($id !== '') ? false : true;
        
        if(!$is_empty) {
            $pass = $this->encrypt_password($password);
        
            $fields = array(
                'id'       => $id,
                'username' => html_escape($email),
                'password' => $pass
            );

            $this->db->insert($table, $fields);
            $affectedRows = $this->db->affected_rows();

            return ($affectedRows > 0) ? true : false;
        }
       
        return 'UserRegistrationError';
    }

    /**
     * Record applicant login credentials
     * to the database
     * @param email
     */
    public function store_applicant_details($email){
        $table = 'tbl_applicant_details';
        
        $id = strtoupper(random_string('alnum', 10));

        $fields = array(
            'id'            => $id,
            'email_address' => html_escape($email)
        );

        $this->db->insert($table, $fields);
        
        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? $id : '';
    }

    /**
     * Verify if the password entered matched
     * the password in the database
     */
    public function verify_login($email, $password){
        $table = 'tbl_applicants';

        $query = $this->db->select('password');
        $query = $this->db->from($table);
        $query = $this->db->where('username', html_escape($email));

        $result = $query->get()->row();

        return $this->verify_password(html_escape($password), $result->password);
    }

    /**
     * Verify if the email address entered exist
     * in the database
     */
    public function verify_email($email){
        $table = 'tbl_applicants';
        
        $query = $this->db->select('username');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $email);

        $result = $query->get()->row();
        
        return (!empty($result)) ? true : false;
    }

    /**
     * Function used to check if the password entered
     * matched the hashed password stored in the
     * database
     */
    private function verify_password($input, $storedPassword){
        return password_verify($input, $storedPassword);
    }

    /**
     * Function to hash the password entered
     */
    private function encrypt_password($password){
        $hashedPass = password_hash($password, PASSWORD_DEFAULT);
        return $hashedPass;
    }

    /**
     * Functin that checks if the given email
     * exist
     */
    public function check_if_email_exist($emai){
        $table = 'tbl_applicant_details';

        $escape_email = html_escape($emai);

        $query = $this->db->select('email_address');
        $query = $this->db->from($table);
        $query = $this->db->where('email_address', $escape_email);

        $result = $query->get()->row();

        return (count($result) === 1) ? true : false;
    }

    /**
     * Functin that checks if the given company 
     * email exist 
     */
    public function check_company_email_exists($email){
        $table = 'tbl_company';

        $escape_email = html_escape($email);

        $query = $this->db->select('username');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $escape_email);

        $result = $query->get()->row();

        return (count($result) === 1) ? true : false;
    }

}

?>