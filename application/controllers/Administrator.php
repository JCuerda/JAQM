<?php 
/**
 * Author : S4Lv4T0r3
 * Date   : January 13, 2019
 */
class Administrator extends CI_Controller {

    /**
     * Main Aministrator Constructor which
     * will be used in loading necessary models
     */
    function __construct(){
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('rate_model');
        $this->load->model('company_job_model');
    }

    /**
     * Check Current Session if already set
     */
    public function check(){
        if(!$this->session->userdata('role')){
            redirect(base_url('administrator/login'));
        } else if($this->session->userdata('role') !== 'Administrator'){
            redirect(base_url('home'));
        }
    }

    /**
     * Main Entry Point of the Administrator Module
     */
    public function index(){
        $this->check();

        $data['title']         = 'Dashboard';
        $data['location']      = 'administrator/dashboard';
        $data['script']        = null;
        $data['company_count'] = $this->admin_model->get_company_count();
        $data['client_count']  = $this->admin_model->get_client_count();
        $data['job_count']     = $this->admin_model->get_job_count();
        $data['company']       = $this->company_model->get_all(true);
        $data['applicants']    = $this->client_model->get_all(true);
        
        $this->load->view('layouts/backend/administrator/home', $data);
    }

    /**
     * Get List of all Registerd Companies in the system
     */
    public function companies(){
        $data['title']      = 'Companies';
        $data['location']   = 'administrator/companies';
        $data['script']     =  base_url('assets/build/js/administrator.js');
    
        $data['companies']  = $this->company_model->get_all();
        $this->load->view('layouts/backend/administrator/home', $data);
    }
    
    /**
     * Get all the list of Applicant Register to the system
     */
    public function applicants(){
        $data['title']      = 'Users';
        $data['location']   = 'administrator/applicants';
        $data['script']     =  base_url('assets/build/js/administrator.js');
    
        $data['applicants']  = $this->client_model->get_all();
        $this->load->view('layouts/backend/administrator/home', $data);
    }

    /**
     * View Current Rates Specified in the Rates Section
     */
    public function rates(){
        $this->check();
        $data['location'] = 'administrator/rates';
        $data['title']    = 'Subscription Rates';

        $data['script']   = base_url('assets/build/js/administrator.js');
        $data['rates']    = $this->rate_model->get_all();

        $this->load->view('layouts/backend/administrator/home', $data);
    }

    /**
     * Administrator Login Page
     */
    public function login(){
        
        if($this->session->userdata('role') == 'Administrator'){
            redirect(base_url('administrator'));
        }

        $data['script']   = base_url('assets/build/js/administrator.js');
        $this->load->view('administrator/login', $data);
    }

    /**
     * Main Login Process
     */
    public function process_login(){
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $result = $this->admin_model->login_account($username, $password);

        if($result === 'WrongUsername'){
            $error = array(
                'key' => 'error',
                'message' => 'Username does not exist!'
            );
            echo json_encode($error);
        } else if($result === 'WrongPassword'){
            $error = array(
                'key' => 'error',
                'message' => 'Passwrod does match!'
            );
            echo json_encode($error);
        } else {
            $admin = $this->admin_model->get_info($username);

            $details = array(
                'id'    => $admin->username,
                'role'  => $admin->role
            );

            $this->session->set_userdata($details);

            echo json_encode(true);
        }
    }

    /**
     * Just a simple Logout Method
     */
    public function logout(){
        $data = array(
            'id', 'role',
        );
        $this->session->unset_userdata($data);
        redirect(base_url('home/login'));
    }

    /**
     * Advertise Page
     */
    public function advertise(){
        $this->check();
        $data['location']   = 'administrator/advertise';
        $data['title']      = 'Advertise Company';
        
        $data['script']     = base_url('assets/build/js/administrator.js');

        $data['companies']  = $this->company_model->get_all(false, true);

        $this->load->view('layouts/backend/administrator/home', $data);
    }

    /**
     * Update Company Position
     * for advertisement Purposes
     */
    public function save_ads(){
        $pos = $this->input->post('positions');

        foreach($pos as $p)
        {
            $positions[$p[0]] = $p[1];
        }
        $this->company_model->update_ads_postion($positions);
    }

    public function get_all_jobs($company_id){
        $jobs = $this->job_model->get_all_job_by_company_id($company_id);
        if(!empty($jobs)){
            echo json_encode($jobs);
        } else {
            echo json_encode(false);
        }
    }

    public function reactivate(){
        $company_id = $this->input->post('company_id');

        $is_activated = $this->admin_model->reactivate_company($company_id);

        if(!$is_activated){
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function deactivate(){
        $company_id = $this->input->post('company_id');

        $is_deactivated = $this->admin_model->deactivate_company($company_id);

        if(!$is_deactivated){
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function view_job($applicant_id){
        $client_id               = htmlspecialchars($applicant_id);
        $qualification_id        = $this->client_model->get_qualification_id($client_id);
        $applicant_qualification = $this->client_model->get_applicant_qualifications($qualification_id->aq_id);
        $job_qualifications      = $this->job_model->get_company_job_listings_qualifications();
        $jobs                    = $this->organize_qualification_by_job_id($job_qualifications);
        $temp_jobs               = $this->filter_job($jobs, $applicant_qualification, $client_id);

        $jobs                   = $this->sort_job($temp_jobs);

        if(!empty($jobs)){
            echo json_encode($jobs);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * Organize Job Qualification by Job Id
     * - Construct a Data Structure for better data handling
     * @param $job_qualifications - List of Job Qualifications per Job
     * @return $job_ids - List of Job Ids
     */
    public function organize_qualification_by_job_id($job_qualifications){

        $jobs       = array();
        $counter    = 0;
        $base_id    = '';
        $job_ids    = [];
        $iterator   = 0;

        foreach($job_qualifications as $jq){
            if($counter === 0){
                $job_ids[$jq->jq_id] = [];
            } else if (!array_key_exists($jq->jq_id, $jobs)){
                $job_ids[$jq->jq_id] = [];
            }
        }

        foreach ($job_qualifications as $jq) {

            if($iterator === 0){

                $base_id = $jq->jq_id;
                if(array_key_exists($base_id, $job_ids)){
                    $job_ids[$base_id][$jq->description] = $jq->qualification_id;
                }
                $iterator++;
            } else {

                if($base_id !== $jq->jq_id){
                    $job_ids[$jq->jq_id][$jq->description] = $jq->qualification_id;
                    $iterator = 0;
                } else {
                    $job_ids[$base_id][$jq->description] = $jq->qualification_id;
                }
            }
        }
        return $job_ids;
    }

        /**
     * Filtering Job Based on Criteria
     * @param $job_qualifications - List of Job Qualifications per Job
     * @param $client_qualification - List of Applicant's Qualifications
     * @return $jobs_details - Details of Jobs that matched the applicant
     */
    public function filter_job($job_qualifications, $client_qualification, $client_id){

        $qualification_count_per_job = $this->count_qualification($job_qualifications);

        $index        = 0;
        $job_ids      = [];
        $job_match    = [];
        $jobs_details = [];
        $matching_percentage = [];
        foreach ($job_qualifications as $jq => $data) {
            $counter   = 0;
            for ($i = 0; $i < count($data); $i++) {
                for ($j = 0; $j  < count($client_qualification); $j++) {
                    if($this->has_qualification($data[array_keys($data)[$i]], array_keys($data)[$i], $client_qualification[$j]->qualification_id, $client_qualification[$j]->description)){
                        $counter++;
                    }
                }
            }

            $count = $qualification_count_per_job[$jq][$index];
            $percentage = ($counter / $count) * 100;
            // $counter / $count) * 100 > 50
            if($percentage > 50){
                if($this->check_application($client_id, $jq)){
                    $matching_percentage[$jq] = $percentage;
                    $job_match[] = $jq;
                }
            }
        }

        if(count($job_match) > 0) {
            for ($i=0; $i < count($job_match); $i++) {
                // $jobs_details[] = $this->job_model->get_job_details($job_match[$i]);
                $company = $this->job_model->get_job_details($job_match[$i]);
               
                $the_company = new Company_Job_Model();
                $the_company->comp_id           = $company->comp_id;
                $the_company->id                = $company->id;
                $the_company->jq_id             = $company->jq_id;
                $the_company->name              = $company->name;
                $the_company->title             = $company->title;
                $the_company->description       = $company->description;
                $the_company->date_posted       = $company->date_posted;
                $the_company->is_available      = $company->is_available;
                $the_company->percentage_match  = $matching_percentage[$company->jq_id];

                $jobs_details[] = $the_company;
            }
        }

        return $jobs_details;
    }

    public function sort_job($jobs){
        for ($i = 0; $i < count($jobs); $i++) {
            for ($j = 0; $j < count($jobs); $j++) {
                if($jobs[$i]->percentage_match >= $jobs[$j]->percentage_match){
                    $temp = $jobs[$i];
                    $jobs[$i] = $jobs[$j];
                    $jobs[$j] = $temp;
                } 
            }
        }
        return $jobs; 
    }

    /**
     * Count the number of Qualifications a certain job has.
     * @param $jobs - Array of Jobs to be count
     * @return $no_of_q_per_job - the number of qualification each job has
     */
    private function count_qualification($jobs){
        $no_of_q_per_job = array();

        foreach ($jobs as $j => $value) {
            $no_of_q_per_job[$j][] = count($value);
        }

        return $no_of_q_per_job;
    }

        /**
     * Check if a certain qualification matched the applicants qualification
     * @param $qualification        - the name of the qualification to be check
     * @param $q_type               - the type of qualification
     * @param $client_qualification - the client qualification to be test against
     * @param $cq_type              - the type of the applicant qualification to test
     * @return Boolean True if the job and the applicant qualification matched.
     */
    private function has_qualification($qualification, $q_type, $client_qualification, $cq_type){


        if($q_type === $cq_type){
            if($q_type === 'Degree Level'){
                return ($client_qualification >= $qualification) ? true : false;
            } else if ($q_type === 'Work Experience'){
                return ($client_qualification >= $qualification) ? true : false;
            } else if ($q_type === 'Salary'){
                return ($client_qualification <= $qualification) ? true : false;
            } else if ($qualification === $client_qualification){
                return true;
            }
        }

        return false;

        // if($q_type === $cq_type){
        //     if($q_type === 'Degree Level'){
        //         return ($client_qualification >= $qualification) ? true : false;
        //     } else if ($qualification === $client_qualification){
        //         return true;
        //     }
        // }

        // if($q_type === $cq_type && $qualification === $client_qualification){
        //     if($q_type === 'Degree Level'){
        //         return ($client_qualification >= $qualification) ? true : false;
        //     }
        //     return true;
        // }
        // return false;
    }

    /**
     * Check If the Applicant is already Applied for the position
     * @param $applicant_id - The ID of the Applicant to check
     * @param $qualification_id - Variable used to get the Job Id of the Job
     * @return Boolean True if already applied otherwise false
     */
    private function check_application($appicant_id, $qualification_id){

        $job_id             = $this->job_model->get_job_id($qualification_id);
        $is_already_applied = $this->job_model->is_application_exist($appicant_id, $job_id->id);

        return ($is_already_applied) ? false : true;
    }

}

?>