<?php
/**
 * Written by : s4Lv4t0r3
 * Date       : January 13, 2019
 */
class Admin_Model extends CI_Model {

    /**
     * Get Current number of
     * company registered to the
     * system
     */
    public function get_company_count(){
        $table = 'tbl_company_details';

        $count = $this->db->count_all_results($table);
        return $count;
    }

    /**
     * Function that get the current
     * total number of client or applicant
     * registered in the system
     */
    public function get_client_count(){
        $table = 'tbl_applicant_details';
        $count = $this->db->count_all_results($table);
        return $count;
    }

    /**
     * Function that get current numnber of jobs
     * posted in the syste,
     */
    public function get_job_count(){
        $table = 'tbl_jobs';
        $count = $this->db->count_all_results($table);
        return $count;
    }

    /**
     * Funtion that handles administrator login
     */
    public function login_account($username, $password){
        $table = 'tbl_administrator';

        $is_exist = $this->check_username(htmlspecialchars(html_escape($username)));
        
        if($is_exist) {
            $stored_pass = $this->verify_password(htmlspecialchars(html_escape($username)));
            if(password_verify(htmlspecialchars(html_escape($password)), $stored_pass)){
                return true;
            } else {
                return "WrongPassword";
            }
        } else {
            return "WrongUsername";
        }
    }

    /**
     * Function that check if the username
     * exist in the database
     */
    public function check_username($username){
        $table = 'tbl_administrator';

        $query = $this->db->select('username');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $username);

        $result = $query->get()->row();

        return (count($result) > 0) ? true : false;
    }

    /**
     * Get the password stored in the database
     * by the given username
     */
    public function verify_password($username){

        $table = 'tbl_administrator';

        $query = $this->db->select('password');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $username);

        $result = $query->get()->row();

        
        return (count($result) > 0) ? $result->password : '';
    }

    /**
     * Get Administrator necessary details 
     * for state management
     */
    public function get_info($username){
        $table = 'tbl_administrator';

        $query = $this->db->select(['username', 'role']);
        $query = $this->db->from($table);
        $query = $this->db->where('username', $username);

        $result = $query->get()->row();

        
        return $result;
    }


    public function reactivate_company($company_id){
        $table = 'tbl_company_details';

        $this->db->set('is_active', 'Y');
        $this->db->where('id', $company_id);
        $this->db->update($table);

        $affectedRow = $this->db->affected_rows();

        return ($affectedRow > 0) ? true : false;
    }


    public function deactivate_company($company_id){
        $table = 'tbl_company_details';

        $this->db->set('is_active', 'N');
        $this->db->where('id', $company_id);
        $this->db->update($table);

        $affectedRow = $this->db->affected_rows();

        return ($affectedRow > 0) ? true : false;
    }
}

?>