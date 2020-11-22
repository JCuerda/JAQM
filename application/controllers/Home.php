<?php
/**
 * Author : s4Lv4t0r3
 * Date   : January 13, 2019
 */
class Home extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        $this->load->model('account_model');
        $this->load->model('rate_model');
    } 

    /**
     * Check if Necessary Session Variables
     * are already set!
     */
    public function check_session(){
        
        $role = $this->session->userdata('role');
       
        if($role === 'Applicant'){
            redirect(base_url('client'));
        } else if($role === 'Administrator'){
            redirect(base_url('administrator'));
        } else if($role === 'Employer'){
            redirect(base_url('company'));
        }
    }

    /**
     * Index Page of the Home Controller
     */
    public function index(){
        redirect(base_url('login'));
    }

    public function login(){
        $this->check_session();
        $data['script'] = base_url('assets/build/js/account.js');
        $this->load->view('layouts/frontend/login', $data);
    }

    /**
     * Main Entry Point for User
     */
    public function login_account(){
        $email = $this->input->post('email');
        $pass  = $this->input->post('pass');
        
        $is_email_exist = $this->account_model->verify_email($email);
        if($is_email_exist) {
            $is_exist = $this->account_model->verify_login($email, $pass);
        
            if($is_exist){
                $client_id = $this->client_model->get_client_id($email);
                if(!empty($client_id->id)){
                    $client = $this->client_model->get($client_id->id);
    
                    $data = array(
                        'id'    => $client->id,
                        'name'  => $client->first_name .' '. $client->last_name,
                        'email' => $client->email_address,
                        'role'  => $client_id->role
                    );
        
                    $this->session->set_userdata($data);
                    echo json_encode(true);
                } else {
                    $error = array(
                        'key' => 'error',
                        'message' => 'Error Occured during registration!'
                    );
                    echo json_encode($error);;
                }
            } else {
                $error = array(
                    'key' => 'error',
                    'message' => 'Wrong username or password!'
                );
                echo json_encode($error);
            }
        } else {
            $error = array(
                'key' => 'error',
                'message' => 'Email does not exists!'
            );
            echo json_encode($error);
        }
    }

    public function sign_up(){
        $this->check_session();
        $data['script'] = base_url('assets/build/js/account.js');
        $this->load->view('layouts/frontend/sign_up', $data);
    }

    /**
     * Function that redirect successful registration
     * to the confirm email view
     */
    public function confirm(){
        $data['email'] = $this->session->userdata('email');
        $this->load->view('layouts/frontend/confirm_email', $data);
        // if($this->session->userdata('email') !== null){
        //     $data['email'] = $this->session->userdata('email');
        //     $this->session->unset_userdata('email');
        //     $this->load->view('layouts/frontend/confirm_email', $data);
        // } else {
        //     redirect(base_url('company'));
        // }
    }   

    /**
     * Store User Credentials to the Database
     */
    public function record_user(){

        $email       = $this->input->post('email');
        $password    = $this->input->post('password');
        $re_password = $this->input->post('re_pass');

        $this->validate_fields();

        if($this->form_validation->run() == FALSE){
            $error = array(
                'key' => 'error',
                'message' => validation_errors()
            );

            echo json_encode($error);

        } else if (strcmp($password, $re_password) != 0){
            
            $error = array(
                'key' => 'error',
                'message' => 'Pasword does not match!'
            );

            echo json_encode($error);

        } else { 
            $is_stored = $this->account_model->store_login_credentials($email, $password);
            
            if($is_stored){

                $success = array(
                    'key'   => 'success',
                    'email' => $email
                );

                $this->session->set_userdata(['email' => $email]);
                echo json_encode($success);

            } else if($is_stored === 'UserRegistrationError'){
                $error = array(
                    'key' => 'error',
                    'message' => 'Something went wrong storing your login credentials!'
                );
                echo json_encode($error);
                
            } else {

                $error = array(
                    'key' => 'error',
                    'message' => 'Something went wrong storing your login credentials!'
                );
                echo json_encode($error);

            }
        }
    }
 
    /**
     * Callback function that is used
     * in validation which check if 
     * applicant email already exist
     */
    public function check_email_validity($email){
        
        $is_exist = $this->account_model->check_if_email_exist($email);

        if($is_exist){
            $this->form_validation->set_message('check_email_validity', 'These Email Address already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Callback function that is used
     * in validation which check if 
     * company email already exist
     */
    public function check_company_email($email){
        
        $is_exist = $this->account_model->check_company_email_exists($email);

        if($is_exist){
            $this->form_validation->set_message('check_company_email', 'Company Email Address already exists!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Validate Fields
     */
    private function validate_fields(){
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_check_email_validity');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('re_pass', 'Re-Password', 'required|min_length[8]');
    }

    private function check_password($password){

    }

    /**
     * Load company  initial registration page
     * //FIXME:
     */
    // public function register_company(){
    //     $this->check_session();
    //     $data['rates']  = $this->rate_model->get_all();
    //     $data['script'] = base_url('assets/build/js/account.js');
    //     $this->load->view('layouts/frontend/company_pricing', $data);
    // }

    /**
     * Load company sign up page
     */
    public function company_signup(){
        $this->check_session();
        $data['script'] = base_url('assets/build/js/account.js');
        $this->load->view('layouts/frontend/company_signup', $data);
    }

    /**
     * Store company login credentials to the
     * database
     */
    public function store_company(){

        $company_id = strtoupper(random_string('alnum', 10));
        $sub        = 9;
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $type       = $sub;

        $this->validate_company_fields();

        if($this->form_validation->run() == FALSE){
            $error = array(
                'key' => 'error',
                'message' => validation_errors()
            );
            echo json_encode($error);
        } else {
            $is_recorded = $this->company_model->register_company($company_id, $email, $password);
            if($is_recorded){
                
                $is_initial_details_stored = $this->company_model->record_initial_details($company_id, $email, $type);
              
                if($is_initial_details_stored){
                    $this->session->set_userdata(['email' => $email]);
                    echo json_encode(true);
                } else {
                    $error = array(
                        'key' => 'error',
                        'message' => 'Error Occured sending verification Email'
                    );

                    echo json_encode($error);
                }
            }
        }
    }

    /**
     * Validate company fields
     */
    private function validate_company_fields(){
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_check_email_validity|callback_check_company_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        // $this->form_validation->set_rules('sub_type', 'Type', 'required|numeric');
    }
}

?>