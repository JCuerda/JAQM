<?php

/**
 * Author : s4Lv4t0r3
 * Date   : January 13, 2019
 */
class Company extends CI_Controller{


    //FIXME: ADD TO SESSION -REMOCVE THIS TEMP VARIABLES
    // private $company_id = 'JQINC';
    private $company_id;

    function __construct(){
        parent::__construct();
        if($this->session->userdata('id')){
            $this->company_id = $this->session->userdata('id');
        }
    }

    /**
     * Function to whether necessary session variables
     * are already set
     */
    private function check_session(){
        
        if(!$this->session->userdata('id')){
            redirect(base_url('login'));
        } else if($this->session->userdata('role') !== 'Employer'){
            redirect(base_url('login'));
        } else {
            $this->company_id = $this->session->userdata('id');
        }
    }

    /**
     * Main Entry poin of the Company Module
     */
    public function index(){
        $this->check_session();
        $data['title']      = 'Dashboard';
        $data['location']   = 'company/index';
        $data['script']     = base_url('assets/build/js/company.js');
        $data['applicants'] = $this->company_model->get_list_of_applicants($this->company_id);
        $this->load->view('layouts/backend/company/home', $data);
    }

    /**
     * Load Post Job View
     */
    public function post(){
        $this->check_session();
        $data['title']              = 'Post Job';
        $data['script']             = base_url('assets/build/js/company.js');
        $data['location']           = 'company/post_job';
        $data['specialization']     = $this->specialization_model->get_all();
        $data['sub_specialization'] = $this->specialization_model->get_all_sub();
        $data['fos']                = $this->specialization_model->get_all_fos();
        $data['eas']                = $this->specialization_model->get_all_eas();
        $data['locations']          = $this->location_model->get_all();
        $data['salaries']           = $this->salary_model->get_all();    
        $data['work_exps']          = $this->specialization_model->get_all_work_exp();
        $this->load->view('layouts/backend/company/home', $data);
    }

    /**
     * Save Job Post
     */
    //TODO: Add Subscribe Panel for payment
    public function save_job_post(){

        $this->check_session();
        $subscription_type = $this->company_model->get_subscription_type($this->company_id);
        //TODO: add subscription check
        $current_count = $this->job_model->get_job_posted_count($this->company_id);
        $company_details = $this->company_model->get_company_details($this->session->userdata('id'));
        $this->validate_job_post();

        if($this->form_validation->run() === FALSE){
            $error = array(
                'key' => 'error',
                'message' => validation_errors()
            );
            echo json_encode($error);
        } else if($company_details->name == '' || $company_details->address =='' || $company_details->contact_number ===''){
            $error = array(
                'key' => 'error',
                'message' => 'Please update your company details first before posting a job'
            );
            echo json_encode($error);
        } else if($subscription_type->subscription_type === '9'){
            $error = array(
                'key' => 'subs_error',
                'message' => 'Please subscribe to our service before posting a job!'
            );
            echo json_encode($error); exit;
        } else if($current_count < $subscription_type->max_post) {
            $job_id = strtoupper(random_string('alnum', 10));
            $jq_id  = strtoupper(random_string('alnum', 10));
    
            $position       = $this->input->post('position');
            $qualifications = $this->input->post('qualifications');
            $description    = $this->input->post('description');
    
            $is_job_posted = $this->company_model->post_job($this->company_id, $job_id, $jq_id, $position, $description);
    
            if($is_job_posted){
                $is_jq_recorded = $this->job_model->record_job_qualifications($jq_id, $qualifications);
                echo ($is_jq_recorded === true) ? json_encode(true) : json_encode(false);
            } else {
                echo json_encode(false);
            }
        } else {
            $error = array(
                'key' => 'error',
                'message' => 'You reached your limit of job post. Thank you!'
            );

            echo json_encode($error);
        }
      
    }

    /**
     * Validation Method
     */
    public function validate_job_post(){
        $this->form_validation->set_rules('position', 'Position', 'required');
        // $this->form_validation->set_rules('qualifications', 'Qualifications', 'required|callback_validate_qualifications');
        $this->form_validation->set_rules('description', 'Description', 'required');
    }

    /**
     * A basic Validataion Callback Method
     */
    public function validate_qualifications($qualifications){
        if(empty($qualifications)){
            $this->form_validation->set_message('validate_qualifications', 'Qualification field should not be left blank');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Load Company Profile
     */
    public function profile(){
        $this->check_session();
        $data['title']    = 'Company Profile';
        $data['script']   = base_url('assets/build/js/company.js');
        $data['location'] = 'company/profile';

        $data['company']  = $this->company_model->get_company_details($this->company_id);
        $this->load->view('layouts/backend/company/home', $data);
    }

    /**
     * Load List of users applied to the job
     * posted by the logged Company 
     */
    public function applicants(){
        $this->check_session();
        $data['title']      = 'Applicants';
        $data['script']     = base_url('assets/build/js/company.js');
        $data['location']   = 'company/applicants';

        $data['applicants'] = $this->company_model->get_list_of_applicants($this->company_id);

        $this->load->view('layouts/backend/company/home', $data);
    }

    /**
     * View all the job post made
     *  the company
     */
    public function job_listing(){
        $this->check_session();
        $data['company_id'] = $this->session->userdata('id');
        $data['title']    = 'Job Listing';
        $data['script']   = base_url('assets/build/js/company.js');
        
        $data['jobs']     = $this->job_model->get_all_job_by_company_id($this->company_id);

        $data['specialization']     = $this->specialization_model->get_all();
        $data['sub_specialization'] = $this->specialization_model->get_all_sub();
        $data['fos']                = $this->specialization_model->get_all_fos();
        $data['eas']                = $this->specialization_model->get_all_eas();

        $data['location'] = 'company/job_lists';
        $this->load->view('layouts/backend/company/home', $data);

    }

    /**
     * Update job details
     */
    public function update_job(){
        $this->check_session();
        $job_id         = $this->input->post('id');

        $jq_id          = $this->job_model->get_qualification_id($job_id);

        $position       = $this->input->post('position');
        $qualifications = $this->input->post('qualifications');

        $description    = $this->input->post('description');

        $q_ids          = $this->company_model->get_company_qualifications_ids($jq_id);
        $q_list         = $this->organize_qualifications($qualifications);

        $is_job_details_updated = $this->company_model->update_job_details($job_id, $position, $description);

        if($is_job_details_updated) {
            $is_updated = $this->company_model->update_job_qualification_details($jq_id, $q_list,$q_ids);
            echo ($is_updated === true) ? json_encode(true) : json_encode(false);
        } else {
            echo json_encode(false);
        }
       
    }

    /**
     * Create a data structure to
     * better handle the job finding algorithm
     * @params $qualifications - List of all the qualfications which will
     *                          be sorted according to its criteria
     */
    private function organize_qualifications($qualifications){
        $q_list = [];
        
        foreach ($qualifications as $item => $value) {
            $q_list[$item] = $value;
        }

        return $q_list;
    }

    /**
     * Force Download Method
     */
    public function download($filename){
        $this->load->helper('download');
        $path = base_url('assets/uploads/'.$filename);
        force_download($path);
    }

    /**
     * Upadate a specific applicant status as Shorlisted
     */
    public function mark_as_shortlisted(){
        $this->check_session();
        $applicant_id = $this->input->post('applicant_id');
        $is_marked    = $this->company_model->shortlist_applicant($applicant_id);

        echo ($is_marked === true) ? json_encode(true) : json_encode(false);

    }
    /**
     * Upadate a specific applicant status as Interview
     */
    public function mark_as_interview(){
        $this->check_session();
        $applicant_id = $this->input->post('applicant_id');
        $is_marked    = $this->company_model->interview_applicant($applicant_id);

        echo ($is_marked === true) ? json_encode(true) : json_encode(false);
    }

    /**
     * Update company profile information
     */
    public function update_profile(){
        $this->check_session();
        $name        = $this->input->post('name');
        $address     = $this->input->post('address');
        $contact     = $this->input->post('contact');
        $description = $this->input->post('description');

        $is_updated = $this->company_model->update_profile($this->company_id, $name, $address, $contact, $description);

        echo ($is_updated === true) ? json_encode(true) : json_encode(array('key' => 'error', 'message' => 'Error Updating company details.'));
    }

    /**
     * Add Company Details
     */
    public function add_profile(){
        $this->check_session();
        $company_id  = strtoupper(random_string('alnum', 10));
        $name        = $this->input->post('name');
        $address     = $this->input->post('address');
        $contact     = $this->input->post('contact');
        $description = $this->input->post('description');

        $is_inserted = $this->company_model->add_comapny_profile($this->company_id, $name, $address, $contact, $description);
        echo ($is_inserted === true) ? json_encode(true) : json_encode(array('key' => 'error', 'message' => 'Error Inserting company details.'));
    }

    /**
     * Company Login Route
     * Loads the company login form
     */
    public function login(){
        $data['script'] = base_url('assets/build/js/account.js');
        $this->load->view('company/company_login', $data);
    }

    /**
     * Company Login Process
     */
    public function company_login(){
        
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');

        $this->validate_company_login();
        
        $is_account_exist = $this->company_model->check_company_if_exist($email);
        if($this->form_validation->run() === FALSE){
            $error = array(
                'key'       => 'error',
                'message'   => validation_errors()
            );

            echo json_encode($error);

        } else if(!$is_account_exist){
            $error = array(
                'key'       => 'error',
                'message'   => 'Account does not exist'
            );

            echo json_encode($error);
        } else {
            $company = $this->company_model->login_company_account($email, $password);

            if($company !== false){
                $is_company_active = $this->company_model->get_company_status($company->id);
                if($company === null){
                    $error = array(
                        'key'       => 'error',
                        'message'   => 'Verify your account first before signing in'
                    );
        
                    echo json_encode($error);
                } else if($company === false){
                    $error = array(
                        'key'       => 'error',
                        'message'   => 'Wrong Username or password!'
                    );
        
                    echo json_encode($error);
                } else if($is_company_active->is_active === 'N'){
                    $error = array(
                        'key'       => 'error',
                        'message'   => 'Your company status is currently deactivated. Please contact the administrator!'
                    );
        
                    echo json_encode($error);
                } else {
                    $data = array(
                        'id'    => $company->id,
                        'email' => $company->username,
                        'name'  => $company->name,
                        'role'  => $company->role
                    );
                    $this->session->set_userdata($data);
                    echo json_encode(true);
                }
            } else {
                $error = array(
                    'key' => 'error',
                    'message' => 'Wrong Username or Password!'
                );

                echo json_encode($error); exit;
            }
        }
    }

    public function validate_company_login(){
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    }

    public function logout(){
        $data = array(
            'id', 'name','email', 'role'
        );
        $this->session->unset_userdata($data);
        redirect(base_url('home/login'));
    }

    /**
     * Function to Confirm Email Address
     */
    public function verify_email($email , $code){
        $e      = urldecode($email);
        $vcode  = $this->company_model->complete_email_verification($e, $code);  
        if($vcode !== false){
            if(strcmp($vcode, $code) === 0){
                $status = $this->company_model->update_client_status($e);
                if($status == 'true'){
                    redirect(base_url('company/login?verify=success'));
                } else {
                    redirect(base_url('/'));
                }
            } else {
                $error = array(
                    'key'       => 'error',
                    'message'   => 'Verification Code Error!'
                );
                echo json_encode($error);
            }
        } else {
            $error = array(
                'key'       => 'error',
                'message'   => 'Verification Code Error!'
            );
            echo json_encode($error);
        }
    }

    /**
     * Function that lets company
     * upload their company logo to the system
     */
    public function upload_logo(){
        $this->check_session();
        $data['filename']   = $this->company_model->get_logo($this->company_id);
        $data['location']   = 'company/upload';
        $data['title']      = 'Upload';
        $data['script']     = base_url('assets/build/js/company.js');
        $this->load->view('layouts/backend/company/home', $data);
    }

    /**
     * POST Method that records
     * the company logo to the web server
     */
    public function process_logo(){
        $config['upload_path']   = 'assets/uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;

        date_default_timezone_set('Asia/Manila');
        $date = date('m/d/y h:i:s a', time());
        
        $newFilename = md5($date);
        $config['file_name'] = $newFilename;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('company_logo'))
        {
            $error = array('key' => 'error','message' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $is_recorded = $this->company_model->store_logo($this->company_id, $data);
            if($is_recorded) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        }
    }

    public function pricing(){
        $this->check_session();
        $this->load->model('rate_model');
        
        $company_id         = $this->session->userdata('id');
        $subscription_type  = $this->company_model->check_if_subscribe($company_id);

        if($subscription_type->subscription_type === '9'){
            $data['title']      = 'JAQM Subscription Pricing List';
        } else {
            $data['title']        = 'Upgrade Subscription';
            $data['subscription'] = $this->company_model->get_subscription_type($company_id);
        }

        $data['company_id'] = $company_id;
        $data['rates']      = $this->rate_model->get_all();
        $data['location']   = 'company/pricing';
        $data['script']     = base_url('assets/build/js/company.js');
        $this->load->view('layouts/backend/company/home', $data);
    }

    public function subscribe(){
        
        $company_id = $this->input->post('company_id');
        $rate_id    = $this->input->post('rate_id');

        $is_updated = $this->company_model->update_subscription($company_id, $rate_id);
        if(!$is_updated){
            $error = array(
                'key' => 'error',
                'message' => 'Error placing your subscription!'    
            );

            echo json_encode($error); exit;
        } else {
            echo json_encode(true); exit;
        }
    }

    public function delete(){
        $company_id = $this->input->post('company_id');
        $job_id = $this->input->post('job_id');
        $jq_id = $this->input->post('jq_id');

        $is_deleted = $this->company_model->delete_job($company_id, $job_id, $jq_id);
        if(!$is_deleted){
            $error = array(
                'key' => 'error',
                'message' => 'Error deleting the job!'
            );
            echo json_encode($error);
        } else {
            echo json_encode(true);
        }
    }
}

?>