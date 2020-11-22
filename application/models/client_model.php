<?php 
/**
 * Author : s4Lv4t0r3
 * Date   : January 13, 2019
 */
class Client_Model extends CI_Model{

    /**
     * Record profile data to the database
     */
    public function add_profile_data($id, $aq_id, $first_name, $last_name, 
    $middle_name, $address, $contact, $email, $prim_educ, $sec_educ, $ter_educ, $course){
       
        $table = 'tbl_applicant_details';

        $fields = array(
            'id'             => $id,
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'middle_name'    => $middle_name,
            'prim_educ'      => $prim_educ,
            'sec_educ'       => $sec_educ,
            'ter_educ'       => $ter_educ,
            'course'         => $course,
            'aq_id'          => $aq_id,
            'email_address'  => $email,
            'contact_number' => $contact,
            'address'        => $address
        );

        $this->db->insert($table, $fields, true);

        $affectedRow = $this->db->affected_rows();

        return $affectedRow;
    }

    /**
     * Update basic user information
     * of the user profile
     */
    public function update_basic_information($client_id, $first_name, $last_name, $middle_name, 
    $address, $contact_number, $email){

        $table = 'tbl_applicant_details';

        $fields = array(
            'first_name'     => $first_name,
            'last_name'      => $last_name,
            'middle_name'    => $middle_name,
            'address'        => $address,
            'contact_number' => $contact_number,
            'email_address'  => $email
        );

        $this->db->set($fields);
        $this->db->where('id', $client_id);
        $this->db->update($table);
       
        $affectedRow = $this->db->affected_rows();

        return ($affectedRow > 0) ? true : false;
    }

    /**
     * Update Educational Attainment Section
     * of the user profile
     */
    public function update_educational_attainment($client_id, $prim_educ, $sec_educ, $ter_educ, $course){

        $table = 'tbl_applicant_details';

        $fields = array(
            'prim_educ' => $prim_educ,
            'sec_educ'  => $sec_educ,
            'ter_educ'  => $ter_educ,
            'course'    => $course
        );

        $this->db->set($fields);
        $this->db->where('id', $client_id);
        $this->db->update($table);

        $affectedRow = $this->db->affected_rows();

        return $affectedRow;
    }

    /**
     * Update client qualifications
     */
    public function update_qualifications($aq_id, $qualifications, $identifier){
        $table = 'tbl_applicant_qualifications';

        $datasets     = [];
      
        foreach ($qualifications as $data => $value) {
            $fields = [];
            foreach($identifier as $i){
                $type = $this->get_qualification_type($data)->id;
                if($type === $i->type){
                    $fields = array(
                        'id'               => $i->id,
                        'aq_id'            => $aq_id,
                        'qualification_id' => $value,
                        'type'             => $type
                    );
                }
            }

            $datasets[] = $fields;
        }

        $affectedRows = $this->db->update_batch($table, $datasets, 'id');
        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Get qualification ID and TYPE
     * of each applicant qualification
     */
    public function get_q_ids($aq_id){
        $table = 'tbl_applicant_qualifications';
        
        $query = $this->db->select(['id', 'type']);
        $query = $this->db->from($table);
        $query = $this->db->where('aq_id', $aq_id);

        $result = $query->get()->result();

        return $result;
    }

    /**
     * Record Applicant Qualifications
     */
    public function add_employee_qualifications($id, $q_list){

        $table = 'tbl_applicant_qualifications';
        $datasets = [];

        foreach ($q_list as $data => $value) {
            
            $fields = array(
                'aq_id'            => $id,
                'qualification_id' => $value,
                'type'             => $this->get_qualification_type($data)->id
            );

            $datasets[] = $fields;
        }

        $this->db->insert_batch($table, $datasets);
        
        $affectedRow = $this->db->affected_rows();
        
        return ($affectedRow > 0) ? true : false;
    }
 
    /**
     * Get Qualification type based on the wildcard provided
     * @param string wilcard
     * @return string which represent the qualifications
     */
    private function get_qualification_type($wildcard){

        $table = 'tbl_qualification_types';

        $query = $this->db->select('id');
        $query = $this->db->from($table);
        $query = $this->db->like('description', $wildcard);

        $result = $query->get()->row();
        
        return $result;
    }

    /**
     * Record Qualification ID
     */
    public function record_qualification_id($id, $qualification_id){
        $table = 'tbl_applicant_details';

        $this->db->set(['aq_id' => $qualification_id]);
        $this->db->where('id', $id);
        $this->db->update($table);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Get Qualification Id based on Client ID provided
     */
    public function get_qualification_id($client_id){
        $table = 'tbl_applicant_details';

        $query = $this->db->select('aq_id');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $client_id);

        $result = $query->get()->row();
        
        return $result;
    }

    /**
     * Get Applicant qualifications based on
     * the stored applicant qualification ID
     */
    public function get_applicant_qualifications($qualification_id){
        $table = 'tbl_applicant_qualifications as aq';

        // $query = $this->db->select('*');
        // $query = $this->db->from($table);
        // $query = $this->db->where('aq_id', $qualification_id);
        $fields = array(
            'aq.id', 'aq.aq_id', 'aq.qualification_id', 'qt.description'
        );
        $query = $this->db->select($fields);
        $query = $this->db->from($table);

        $related_tables = array(
            'tbl_qualification_types AS qt' => 'aq.type = qt.id'
        );

        $query = $this->inner_join($related_tables);
        $query = $this->db->where('aq_id', $qualification_id);
        $result = $query->get()->result();
        return $result;
    }

    /**
     * Get Qualification description
     */
    public function get_qualification_description($id, $type){
        $table = array(
            1 => 'tbl_sub_specializations',
            2 => 'tbl_field_of_studies',
            3 => 'tbl_degree_levels',
            4 => 'tbl_work_exp',
            5 => 'tbl_locations',
            6 => 'tbl_salaries'
        );

        if($type == 1 || $type == 2 || $type == 3 || $type == 4 || $type == 5) {
            $query = $this->db->select('description');
            $query = $this->db->from($table[$type]);
            $query = $this->db->where('id', $id);
    
            $result = $query->get()->row();
    
            return $result;
        } else {
            
            $query = $this->db->select(['from', 'to']);
            $query = $this->db->from($table[$type]);
            $query = $this->db->where('id', $id);
    
            $result = $query->get()->row();
    
            $descri = $result->from .' - '. $result->to.' pesos';

            return $descri;
            // return $result;
        }
    }

    /**
     * Record Applicant Resume
     */
    public function store_resume($id , $details){
        $table = 'tbl_applicant_details';
        
        $fields = array(
            'resume' => $details['upload_data']['file_name']
        );

        $query = $this->db->set($fields);
        $query = $this->db->where('id', $id);
        $query = $this->db->update($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Ger Applicant Details
     */
    public function get($id){
        $table = 'tbl_applicant_details';
        
        $query = $this->db->select('*');
        $query = $this->db->from($table);
        $query = $this->db->where(['id' => $id]);
        $result = $query->get()->row();

        return $result;
    }

    /**
     * Generic Inner Join Method
     */
    public function inner_join($related_tables){
        foreach ($related_tables as $left => $right) {
            $this->db->join($left, $right, 'inner');
        }
    }

    /**
     * Get Applicant Id and Role
     */
    public function get_client_id($email){
        $table = 'tbl_applicants';
        
        $query = $this->db->select(['id','role']);
        $query = $this->db->from($table);
        $query = $this->db->where('username', $email);

        $result = $query->get()->row();
        
        if(!empty($result)) {
            return $result;
        } 
        return false;
    }

    /**
     * Mark Job as a FAVORITE
     */
    public function mark_job_as_favorite($applicant_id, $job_id){
        $table = 'tbl_applicant_favorite_jobs';

        $fileds = array(
            'applicant_id' => html_escape(htmlspecialchars($applicant_id)),
            'job_id'       => html_escape(htmlspecialchars($job_id))
        );

        $this->db->insert($table, $fileds);
        
        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Check if the job is already in the 
     * favorites list
     */
    public function is_already_favortite($id, $job_id){
        $table = 'tbl_applicant_favorite_jobs';

        $query = $this->db->select('*');
        $query = $this->db->from($table);
        $query = $this->db->where([
            'applicant_id' => $id, 
            'job_id'       => $job_id
        ]);

        $result = $query->get()->result();
        
        return (count($result) > 0) ? true : false;
    }

    /**
     * Remove job in the favorites list
     */
    public function remove_job_as_favorite($applicant_id, $job_id){
        $table = 'tbl_applicant_favorite_jobs';

        $query = $this->db->from($table);
        $query = $this->db->where([
            'applicant_id' => $applicant_id, 
            'job_id'       => $job_id
        ]);

        $this->db->delete($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Get List of all favorites job
     */
    public function get_all_favorites($applicant_id){
        $table = 'tbl_applicant_favorite_jobs as afj';

        $fields = array(
            'j.company_id','j.id','j.title'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);

        $related_table = array(
            'tbl_jobs as j' =>'afj.job_id = j.id'
        );

        $this->inner_join($related_table);

        $query = $this->db->where('applicant_id', $applicant_id);

        $result = $query->get()->result();

        return $result;
    }

    /**
     * Get All applicant stored in the 
     * database
     */
    public function get_all($limited = false){
        $table = 'tbl_applicant_details as ad';

        $fields = array(
            'ad.id', 'ad.first_name', 'ad.last_name', 'ad.middle_name', 'ad.course', 'ad.email_address as email', 
            'ad.contact_number', 'ad.address', 'a.date_registered'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);
        
        $this->inner_join(['tbl_applicants as a' => 'a.id = ad.id']);
        
        $query = $this->db->order_by('a.date_registered', 'DESC');
        
        if($limited === true){
            $query = $this->db->limit(5);
        }
        
        $result = $query->get()->result();

        return $result;
    }

    
}

?>