<?php

class Job_Model extends CI_Model{

    public $id;
    public $qualifications = [];
    public $title;
    public $description;

    /**
     * Function that get all the company posted jobs
     * with their respective qualifications ids
     */
    public function get_company_job_listings_qualifications($count_result = false){
        $table = 'tbl_jobs as j';

        // $fields = array(
        //     ' j.company_id', 'j.id', 'j.jq_id', 
        //     'cq.qualification_id','cq.type'
        // );

        $fields = array(
            ' j.company_id', 'j.id', 'j.jq_id', 
            'cq.qualification_id','t.description'
        );

        $related_table = array(
            'tbl_company_qualifications as cq' => 'j.jq_id = cq.jq_id',
            'tbl_qualification_types as t'      => 'cq.type = t.id'
        );

        $this->db->select($fields);
        $this->db->from($table);
        $this->inner_join($related_table);

        $result = $this->db->get()->result();
        
       if($count_result){
            $count = count($result);
            return $count;
       }

        return $result;
    }
    
    /**
     * Record job qualifications
     */
    public function record_job_qualifications($jq_id, $qualifications){
        $table = 'tbl_company_qualifications';

        $datasets = [];
        foreach ($qualifications as $data => $value) {
            
            $fields = array(
                'jq_id'            => $jq_id,
                'qualification_id' => $value,
                'type'             => $this->get_qualification_type($data)->id 
            );

            $datasets[] = $fields;
        }

        $this->db->insert_batch($table, $datasets, TRUE);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Get qualification type using
     * using wildcard string
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
     * Get list of jobs applied by
     * a specific applicant id
     */
    public function get_applied_job($applicant_id){
        $table = 'tbl_company_job_applicants as cja';

        $fields = array(
            'cja.company_id', 'cja.applicant_id', 'cja.date_applied',
            'cja.status', 'j.jq_id', 'j.id', 'j.title'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);

        $related_table = array(
            'tbl_jobs as j' =>'cja.job_id = j.id'
        );

        $this->inner_join($related_table);

        $query = $this->db->where('applicant_id', $applicant_id);

        $result = $query->get()->result();

        return $result;
    }

    /**
     * Get Job Details by Job Id
     * and set private Job property data
     * 
     */
    public function get_job_details($job_id){
        $table = 'tbl_jobs as j';

        $fields = array(
            'c.id as comp_id','j.id','j.jq_id','c.name','j.title','j.description',
            'j.date_posted','j.is_available',
        );

        $related_table = array(
            'tbl_company_details as c' => 'j.company_id = c.id'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);
        $query = $this->inner_join($related_table);
        $query = $this->db->where('jq_id', $job_id);
        $query = $this->db->where('is_available', 'Y');

        $result = $query->get()->row();

        $this->id          = $result->id;
        $this->title       = $result->title;
        $this->description = $result->description;

        return $result;
    }

    /**
     * View Job Details
     */
    public function view_details($job_id){
        $table = 'tbl_jobs as j';

        $fields = array(
            'c.id as comp_id','j.id as job_id','j.jq_id','c.name','j.title','j.description',
            'j.date_posted','j.is_available',
        );

        $related_table = array(
            'tbl_company_details as c' => 'j.company_id = c.id'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);
        $query = $this->inner_join($related_table);
        $query = $this->db->where('j.id', $job_id);
        $query = $this->db->where('is_available', 'Y');

        $result = $query->get()->row();

        return $result;
    }

    /**
     * Check if the applicant already applied to
     * the specific job to avoid duplication
     */
    public function is_application_exist($applicant_id, $job_id){
        $table = 'tbl_company_job_applicants';

        $query = $this->db->select(['job_id', 'applicant_id']);
        $query = $this->db->from($table);
        $query = $this->db->where([
                    'applicant_id' => $applicant_id,
                    'job_id'       => $job_id
                ]);

        $result = $query->get()->result();
        
        return (count($result)) > 0 ? true : false;
    }

    /**
     * Record Job Applicants
     */
    public function record_application($applicant_id, $job_id, $company_id){
        
        $table = 'tbl_company_job_applicants';

        $fields = array(
            'company_id'   => $company_id,
            'job_id'       => $job_id,
            'applicant_id' => $applicant_id
        );
        
        $this->db->insert($table, $fields);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;

    }

    /**
     * Private method to make inner join
     * much simpler
     */
    public function inner_join($related_table){
        $join_type = 'inner';
        foreach ($related_table as $left => $right) {
            $this->db->join($left, $right, $join_type);
        }
    }

    /**
     * Get the job id of a job based on
     * qualification id
     */
    public function get_job_id($qualification_id){
        $table = 'tbl_jobs';

        $query = $this->db->select('id');
        $query = $this->db->from($table);
        $query = $this->db->where('jq_id', $qualification_id);

        $result = $query->get()->row();

        return $result;
    }

    /**
     * Get list of jobs posted by company id
     */
    public function get_all_job_by_company_id($company_id){
        $table = 'tbl_jobs';

        $query = $this->db->select('*');
        $query = $this->db->from($table);
        $query = $this->db->where('company_id', $company_id);

        $result = $query->get()->result();

        return $result;
    }

    /**
     * Get list of job qualification and details using
     * job qualification id
     */
    public function get_list_job_qualification_details($jq_id){
        $table = 'tbl_jobs as j';


        $fields = array(
            'j.jq_id','j.title','j.description', 'cq.qualification_id','qt.description as q_description'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);

        $related_table = array(
            'tbl_company_qualifications as cq' => 'j.jq_id = cq.jq_id',
            'tbl_qualification_types as qt'    => 'cq.type = qt.id'
        );

        $this->inner_join($related_table);

        $query = $this->db->where('j.jq_id', $jq_id);

        $result = $query->get()->result();


        return $result;
    }

    /**
     * Get list of job qualification and details using
     * job qualification id
     */
    public function get_job_qualification_details($jq_id){
        $table = 'tbl_company_qualifications as cq';

        $fields = array(
            'cq.id', 'cq.jq_id', 'cq.qualification_id', 'qt.description'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);

        $related_table = array(
            'tbl_qualification_types as qt' => 'cq.type = qt.id'
        );

        $this->inner_join($related_table);

        $query = $this->db->where('cq.jq_id', $jq_id);

        $result = $query->get()->result();

        // return $result;

        //TEST IMPLEMENTATION
        foreach ($result as $r => $value) {
            $this->qualifications[$value->description] = $value->qualification_id;
        }

    }

    /**
     * Get qualification id by using
     * job id
     */
    public function get_qualification_id($job_id){
        $table = 'tbl_jobs';

        $query = $this->db->select('jq_id');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $job_id);

        $result = $query->get()->row();

        return $result->jq_id;
        
    }

    /**
     * Get total number of job posted 
     * by a company
     */
    public function get_job_posted_count($company_id){
        $table = 'tbl_jobs';

        $query = $this->db->select('id');
        $query = $this->db->from($table);
        $query = $this->db->where('company_id', $company_id);
        
        $result = $query->get()->result();

        return (count($result));
    }   

}   

?>