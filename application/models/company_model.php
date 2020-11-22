<?php

class Company_Model extends CI_Model{

    public $comp_id;
    public $id;
    public $jq_id;
    public $name;
    public $title;
    public $description;
    public $date_posted;
    public $is_available;
    public $percentage_match;

    /**
    * Get the Company Id using the Job Id
    * @param $job_id - Job Id which whill be used in getting the Company Id
    * @return Object - Company Details
    */
    public function get_company_details($company_id){
        $table = 'tbl_company_details';

        $query = $this->db->select('*');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $company_id);

        $result = $query->get()->row();

        return $result;
    }
    
    /**
     * Get the Company Id using the Job Id
     * @param $job_id - Job Id which whill be used in getting the Company Id
     * @return string - Company ID
     */
    public function get_company_id($job_id){

        $table = 'tbl_jobs';

        $query = $this->db->select('company_id');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $job_id);

        $result = $query->get()->row();

        return $result;

    }

    /**
     * Store the Job Details to the Database
     * @param $company_id  - The company ID
     * @param $job_id      - The Job Id
     * @param $jq_id       - The Job Qualificatin ID
     * @param $position    - The Job Position
     * @param $description - The Job Description
     * @return boolean - True if success otherwise false
     */
    public function post_job($company_id, $job_id, $jq_id, $position, $description){
        $table = 'tbl_jobs';

        $fields = array(
            'id'          => $job_id,
            'company_id'  => $company_id,
            'jq_id'       => $jq_id,
            'title'       => $position,
            'description' => $description
        );

        $this->db->insert($table, $fields);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Get the list of Job Qualifications
     * @param $jq_id - The Job Qualification ID
     * @return Object - Job Qualifications
     */
    public function get_company_qualifications_ids($jq_id){

        $table = 'tbl_company_qualifications';

        $query = $this->db->select(['id', 'type']);
        $query = $this->db->from($table);
        $query = $this->db->where('jq_id', $jq_id);

        $result = $query->get()->result();

        return $result;

    }

    /**
     * Update Job Descriptions and Details
     * @param $job_id      - The Id of the job which will be editted
     * @param $position    - Job Position
     * @param $description - Job Description
     * @return boolean - True if success otherwise false
     */
    public function update_job_details($job_id, $position, $description){
        $table = 'tbl_jobs';

        $fields = array(
            'title'      => $position,
            'description'   => html_escape($description)
        );

        $this->db->set($fields);
        $this->db->where('id', $job_id);
        $this->db->update($table);

        $affectedRows = $this->db->affected_rows();
        
        return ($affectedRows >= 0) ? true : false;

    }

    /**
     * Update Job Qualification Details 
     * @param $jq_id   - job qualification id
     * @param $q_list  - qualfication list
     * @param $q_ids   - qualification ids
     * @return boolean - True if success otherwise false
     */
    public function update_job_qualification_details($jq_id, $q_list, $q_ids){

        $table = 'tbl_company_qualifications';

        $datasets = [];

        foreach ($q_list as $data => $value) {
            $fields = [];
            foreach ($q_ids as $i) {
               $type = $this->get_qualification_type($data)->id;
               if($type === $i->type) {
                    $fields = array(
                        'id'               => $i->id,
                        'jq_id'            => $jq_id,
                        'qualification_id' => $value,
                        'type'             => $type
                    );
               }
            }

            $datasets[] = $fields;
        }

        $this->db->update_batch($table, $datasets, 'id');

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows >= 0) ? true : false;

    }

    /**
     * Get Qualification type based on wildcard
     * @param $wildcard - Keyword used to check the qualification
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
     * Get list of applicants that applied to the company
     * @param $company_id - ID of the company
     * @return Object - Applicant Details
     */
    public function get_list_of_applicants($company_id){
        $table = 'tbl_company_job_applicants as cja';

        $fields = array(
            'cja.id', 'cja.applicant_id', 'cja.status', 'ad.first_name', 
            'ad.last_name', 'ad.middle_name', 'j.title','cja.date_applied','ad.resume', 'cja.status'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);

        $related_tables = array(
            'tbl_applicant_details as ad' => 'cja.applicant_id = ad.id',
            'tbl_jobs as j'               => 'cja.job_id = j.id'
        );

        $this->inner_join($related_tables);

        $query = $this->db->where('cja.company_id', $company_id);
        $query = $this->db->order_by('cja.date_applied', 'DESC');
        $result = $query->get()->result();
        
        return $result;

    }

    /**
     * Private method to used to shortcut Inner Join Syntax
     * @param $related_tables - Array of tableds and relations
     */
    private function inner_join($related_tables){
        foreach ($related_tables as $left => $right) {
            $this->db->join($left, $right, 'inner');
        }
    }

    /**
     * Mark applicant as Shortlisted
     * @param $applicant_id - the ID of the applicant to be update
     * @return boolean True if success otherwise false
     */
    public function shortlist_applicant($applicant_id){
        $table = 'tbl_company_job_applicants';

        $status = 'Shortlisted';

        $this->db->set('status', $status);
        $this->db->where('applicant_id', $applicant_id);
        $this->db->update($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Mark applicant as Interviewed
     * @param $applicant_id - the ID of the applicant to be update
     * @return boolean True if success otherwise false
     */
    public function interview_applicant($applicant_id){
        $table = 'tbl_company_job_applicants';

        $status = 'Interview';

        $this->db->set('status', $status);
        $this->db->where('applicant_id', $applicant_id);
        $this->db->update($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Update the Company Profile
     * @param $company_id - The Company Id
     * @param $name       - Name of the Company
     * @param $address    - Address of the Company
     * @param $contact    - Contact Number of the company
     * @param description - Company Descripions
     * @return boolean True if success otherwise false
     */
    public function update_profile($company_id, $name, $address, $contact, $description){
        $table = 'tbl_company_details';

        $fields = array(
            'name'           => $name,
            'address'        =>$address,
            'contact_number' => $contact,
            'description'    => $description
        );

        $this->db->set($fields);
        $this->db->where('id', $company_id);
        $this->db->update($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Save Company Details
     * @param $company_id - The Company Id
     * @param $name       - Name of the Company
     * @param $address    - Address of the Company
     * @param $contact    - Contact Number of the company
     * @param description - Company Descripions
     * @return boolean True if success otherwise false
     */
    public function add_comapny_profile($company_id, $name, $address, $contact, $description){
        $table = 'tbl_company_details';

        $fields = array(
            'id'             => $company_id,
            'name'           => $name,
            'address'        =>$address,
            'contact_number' => $contact,
            'description'    => $description
        );

        $this->db->insert($table, $fields);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Get the type of Subscription the company is currently using
     * @param $company_id - the Id of the company to be checked
     */
    public function get_subscription_type($company_id){
        $table = 'tbl_company_details as cd';

        $fields = array(
            'cd.subscription_type','st.description' , 'st.max_post', 'st.pricing'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);
        $related_tables = array(
            'tbl_subscription_types as st' => 'cd.subscription_type = st.id'
        );
        $query = $this->inner_join($related_tables);
        $query = $this->db->where('cd.id', $company_id);

        $result = $query->get()->row();

        return $result;
        
    }

    /**
     * Get all the registered companies
     * @param $limited - which will be used to determine
     *                  if full or limited set will be retrieve
     */
    public function get_all($limited = false, $advertisement = false){
        $table = 'tbl_company_details as cd';

        $fields = array(
            'cd.id', 'cd.name', 'cd.description', 'cd.address', 'cd.contact_number', 
            'st.description as subscription', 'cd.logo', 'cd.ads_position','cd.date_registered', 'cd.is_active'
        );

        $query = $this->db->select($fields);
        $query = $this->db->from($table);
        
        $related_tables = array(
            'tbl_subscription_types as st' => 'st.id = cd.subscription_type'
        );
        
        $this->inner_join($related_tables);

        if($advertisement){
            $query = $this->db->order_by('cd.ads_position', 'ASC');
        } else if(!$advertisement){
            $query = $this->db->order_by('cd.date_registered', 'ASC');
        }

        if($limited){
            $query = $this->db->limit(5);
        }

        $result = $query->get()->result();

        return $result;

    }

    /**
     * Register new Company
     */
    public function register_company($company_id, $email, $password){
        $table = 'tbl_company';

        $hashed = $this->protect_password($password);
        $fields = array(
            'id' => $company_id,
            'username' => $email,
            'password' => $hashed 
        );

        $this->db->insert($table, $fields);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    /**
     * Record Initial Company Details
     */
    public function record_initial_details($company_id, $email, $type = null){
        $table = 'tbl_company_details';
        
        $registration_time = $this->get_datetime_now();
        $vcode             = $company_id . md5($registration_time);
        $fields = array(
            'id'                => $company_id,
            'verification_code' => $vcode,
            'subscription_type' => $type,
            'date_registered'   => date_format(new DateTime($registration_time),"Y-m-d H:i:s")
        );

        $this->db->insert($table, $fields);
        $affectedRows = $this->db->affected_rows();

        if($affectedRows === 1){
            $status = $this->send_verification_code($email,$vcode);
            return ($status == true) ? true : false;
        }
    }

    /**
     * Function that send Verification Email
     */
    public function send_verification_code($email, $vcode){
    
        $this->load->library('email');

        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_user']    = 'jaqm.system@gmail.com';
        $config['smtp_pass']    = '123qweasdzxc.';
        $config['mailtype']     = 'html';
        $config['charset']      = 'iso-8859-1';
        $config['smtp_timeout'] = '7';
        $config['wordwrap']     = TRUE;
        $config['newline']      = "\r\n";
        
        $this->email->initialize($config);
        $this->email->set_mailtype('html');
        $this->email->from('admin@jaqm.com', "JAQM SYSTEM");
        $this->email->to($email);
        $this->email->subject("Please Verify your JAQM Account");

        $message = $this->generate_email_message($email, $vcode);
        $this->email->message($message);
        if(!$this->email->send()){
            return false;
        } else {
            return true;
        }
    }   

    public function complete_email_verification($email, $vcode){
        $table = 'tbl_company_details';

        $company_id = $this->get_company_id_by_email($email);

        $query = $this->db->select('verification_code');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $company_id);

        $result = $query->get()->row();

        if(count($result) > 0){
            return $result->verification_code;
        } else {
            return false;
        }

    }

    public function update_client_status($email){
        $table = 'tbl_company';

        $this->db->set(['is_verified' => 'Y']);
        $this->db->where('username', $email);
        $this->db->update($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }
    /**
     * Get Company Id by Email Address
     */
    public function get_company_id_by_email($email){
        $table = 'tbl_company';

        $query = $this->db->select('id');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $email);

        $result = $query->get()->row();

        return $result->id;
    }

    /**
     * Function that generate HTML message
     * to be sent to the company email provided
     */
    private function generate_email_message($email, $vcode){
        $message  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               ';
        $message .= '<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<head>';
        $message .= '<meta name="viewport" content="width=device-width" />';
        $message .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $message .= '<title>JAQM</title>';
        $message .= '<style type="text/css">';
        $message .= 'img { max-width: 100%; }';
        $message .= 'body { -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; }';
        $message .= 'body {background-color: #f6f6f6;}';
        $message .= '@media only screen and (max-width: 640px) {';
        $message .= '  body { padding: 0 !important;}';
        $message .= '  h1 { font-weight: 800 !important; margin: 20px 0 5px !important; }';
        $message .= '  h2 { font-weight: 800 !important; margin: 20px 0 5px !important;}';
        $message .= '  h3 { font-weight: 800 !important; margin: 20px 0 5px !important;}';
        $message .= '  h4 { font-weight: 800 !important; margin: 20px 0 5px !important;}';
        $message .= '  h1 {font-size: 22px !important;}';
        $message .= '  h2 {font-size: 18px !important;}';
        $message .= '  h3 {font-size: 16px !important;}';
        $message .= '  .container {padding: 0 !important; width: 100% !important;}';
        $message .= '  .content {padding: 0 !important;}';
        $message .= '  .content-wrap {padding: 10px !important;}';
        $message .= '  .invoice {width: 100% !important;}';
        $message .= '}';
        $message .= '</style>';
        $message .= '</head>';
        $message .= '<body style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">';
        $message .= '<table class="body-wrap" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>';
        $message .= '		<td class="container" width="600" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">';
        $message .= '			<div class="content" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">';
        $message .= '				<table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">';
        $message .= '							<meta itemprop="name" content="Confirm Email" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;" /><table width="100%" cellpadding="0" cellspacing="0" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= '										Please confirm your email address by clicking the link below.';
        $message .= '									</td>';
        $message .= '								</tr><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= '										We may need to send you critical information about our service and it is important that we have an accurate email address.';
        $message .= '									</td>';
        $message .= '								</tr><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" itemprop="handler" itemscope itemtype="http://schema.org/HttpActionHandler" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= '										<a href="'. base_url('company/verify_email/'.urlencode($email).'/'.$vcode) .'" class="btn-primary" itemprop="url" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #f5707a; margin: 0; border-color: #f5707a; border-style: solid; border-width: 10px 20px;">Confirm email address</a>';
        $message .= '									</td>';
        $message .= '								</tr><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= '										&mdash; JAQM';
        $message .= '									</td>';
        $message .= '								</tr></table></td>';
        $message .= '					</tr></table><div class="footer" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">';
        $message .= '					<table width="100%" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top"> <a href="#" style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">Unsubscribe</a></td>';
        $message .= '						</tr></table></div></div>';
        $message .= '		</td>';
        $message .= '		<td style="font-family: "Helvetica Neue",Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>';
        $message .= '	</tr></table></body>';
        $message .= '</html>';

        return $message;
    }

    /**
     * Method that hashes the password
     * before storing it to the database
     */
     public function protect_password($password){
        $newPassword = password_hash($password, PASSWORD_DEFAULT);
        return $newPassword;
     }

     /**
      * Get Current Datetime
      */
     private function get_datetime_now(){
        
        date_default_timezone_set('Asia/Manila');
        $date = date('m/d/Y h:i:s a', time());

        return $date;
     }

     /**
      * Check if Company Login Exist
      */
    public function check_company_if_exist($email){
        $table = 'tbl_company';
        
        $query = $this->db->select('username');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $email);

        $result = $query->get()->row();

        return (count($result) > 0) ? true : false;
    }

    public function login_company_account($email, $password){
        $table = 'tbl_company as c';
        
        $stored_password = $this->get_password($email);
        if($stored_password !== false){
            $is_matched = $this->compare_password($password, $stored_password);
            if($is_matched){
                
                $query = $this->db->select(['c.id', 'c.username', 'c.role', 'cd.name']);
                $query = $this->db->from($table);
                $related_tables = array(
                    'tbl_company_details as cd' => 'c.id = cd.id'
                );
                $query = $this->inner_join($related_tables);
                $query = $this->db->where(['username' => $email, 'is_verified' => 'Y']);

                $result = $query->get()->row();
                return (count($result) > 0) ? $result : null;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Function to get Store Password
     * using email address
     */
    public function get_password($email){
        $table = 'tbl_company';

        $query = $this->db->select('password');
        $query = $this->db->from($table);
        $query = $this->db->where('username', $email);

        $result = $query->get()->row();

        if(count($result) >0){
            return $result->password;
        } else {
            return false;
        }
    }

    /**
     * Verify if the Inputted password
     * matched the stored hashed password
     */
    public function compare_password($password, $stored_password){
        return password_verify($password, $stored_password);
    }

    /**
     * Store Company Logo
     */
    public function store_logo($company_id, $data){
        $table = 'tbl_company_details';

        $fields = array(
            'logo' => $data['upload_data']['file_name']
        );

        $this->db->set($fields);
        $this->db->where('id', $company_id);
        $this->db->update($table);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    public function get_logo($company_id){
        $table = 'tbl_company_details';

        $query = $this->db->select('logo');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $company_id);

        $result = $query->get()->row();

        return $result;
    }

    public function update_ads_postion($positions){
        $table = 'tbl_company_details';

        $ds = [];

        foreach($positions as $p => $value){
            $fields = array(
                'id'           => $p,
                'ads_position' => $value
            );

            $ds[] = $fields;
        }

        $this->db->update_batch($table, $ds, 'id');

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows > 0) ? true : false;
    }

    public function get_company_status($company_id){
        $table = 'tbl_company_details';

        $query = $this->db->select('is_active');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $company_id);

        $result = $query->get()->row();

        return $result;
    }

    public function update_subscription($company_id, $rate_id){
        $table = 'tbl_company_details';

        $fields = array(
            'subscription_type' => $rate_id
        );

        $this->db->set($fields);
        $this->db->where('id', $company_id);
        $this->db->update($table);

        $affectedRow = $this->db->affected_rows();

        return ($affectedRow > 0) ? true : false;
    }

    public function check_if_subscribe($company_id){
        $table = 'tbl_company_details';

        $query = $this->db->select('subscription_type');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $company_id);

        $result = $query->get()->row();

        return $result;
    }

    public function delete_job($company_id , $job_id, $jq_id){
    
        $is_success = $this->delete_company_qualifications($jq_id);
        if($is_success){
            $is_second_segment_deleted = $this->delete_company_job_applicant($company_id, $job_id);
            if($is_second_segment_deleted){
                $is_third_segment_deleted = $this->delete_job_applicant_favorite($job_id);
                if($is_third_segment_deleted){
                   return $this->remove_job($company_id, $job_id, $jq_id);
                }
            }
        } 

        return false;
    }

    private function delete_company_qualifications($where){

        $table = 'tbl_company_qualifications';

        $this->db->where('jq_id', $where);
        $this->db->delete($table);

        $affectedRow = $this->db->affected_rows();

        return ($affectedRow >= 0) ? true : false;
    }

    private function delete_company_job_applicant($company_id, $job_id){
        $table = 'tbl_company_job_applicants';
        $this->db->where('job_id', $job_id);
        $this->db->where('company_id', $company_id);
        $this->db->delete($table);

        $affectedRow = $this->db->affected_rows();
        return ($affectedRow >= 0) ? true : false;
    }

    private function delete_job_applicant_favorite($job_id){
        $table = 'tbl_applicant_favorite_jobs';
        $this->db->where('job_id', $job_id);
        $this->db->delete($table);

        $affectedRow = $this->db->affected_rows();

        return ($affectedRow >= 0) ? true : false;
    }

    private function remove_job($company_id, $job_id, $jq_id){

        $this->db->where('id', $job_id);
        $this->db->where('jq_id', $jq_id);
        $this->db->where('company_id', $company_id);
        $this->db->delete('tbl_jobs');

        $affectedRow = $this->db->affected_rows();

        return ($affectedRow >= 0) ? true : false;
    }
}

?>