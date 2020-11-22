
<?php
/**
 * Author : S4Lv4T0r3
 * Date   : January 13, 2019
 */
class Client extends CI_Controller {

    /**
     * Varialble to hold Client ID
     */
    private $id;

    /**
     * Controller Constructor
     */
    public function __construct(){

        parent::__construct();
        $this->load->model('company_job_model');
        if(!$this->session->userdata('id')){
            redirect(base_url('login'));
        } else if($this->session->userdata('role') !== 'Applicant'){
            redirect(base_url('login'));
        } else {
            $this->id = $this->session->userdata('id');
        }
    }

    /**
     * client
     * homepage of client
     */
    public function index(){

        $data['title']    = 'Dashboard';
        $data['location'] = 'client/index';
        $data['script']   = base_url('assets/build/js/client.js');

        $data['jobs']     = $this->job_model->get_applied_job($this->id);
        $this->load->view('layouts/backend/client/home', $data);
    }

    /**
     * client/search
     * Method to search jobs based on the users current qualifications
     */
    public function search(){

        $data['title']           = 'Jobs Listings';
        $data['location']        = 'client/findnow';
        $data['script']          = base_url('assets/build/js/client.js');
        $client_id               = $this->id;
        $qualification_id        = $this->client_model->get_qualification_id($client_id);
        $applicant_qualification = $this->client_model->get_applicant_qualifications($qualification_id->aq_id);
        $job_qualifications      = $this->job_model->get_company_job_listings_qualifications();
        $jobs                    = $this->organize_qualification_by_job_id($job_qualifications);
        $temp_jobs               = $this->filter_job($jobs, $applicant_qualification);

        $data['jobs']            = $this->sort_job($temp_jobs);

        $total_rows              = count($data['jobs']);
        $data['links']           = $this->paginate_result($total_rows);
        $data['companies']       = $this->company_model->get_all(false, true);
        $this->load->view('layouts/backend/client/home', $data);
    }

    public function sort_job($jobs){
        // $sorted_list = [];

        for ($i = 0; $i < count($jobs); $i++) {
            for ($j = 0; $j < count($jobs); $j++) {
                if($jobs[$i]->percentage_match >= $jobs[$j]->percentage_match){
                    $temp = $jobs[$i];
                    $jobs[$i] = $jobs[$j];
                    $jobs[$j] = $temp;
                } 
                // if($i == 0){
                //     $sorted_list[$i] = $jobs[$i];
                // } else if($jobs[$i - 1]->percentage_match >= $jobs[$i]->percentage_match){
                //     $temp = $sorted_list[$i - 1];
                //     $sorted_list[$i - 1] = $jobs[$i];
                //     $sorted_list[$i] = $temp;
                // }
                // foreach($jobs[$j] as $key => $data){
                //     if($key === 'percentage_match'){
                //         if(count($sorted_list) == 0){
                //             $sorted_list[$i] = $jobs[$j];
                //         } else if ($data >= $sorted_list[$i]->percentage_match){
                //             $temp = $sorted_list[$i];
                //             $sorted_list[$i] = $jobs[$j];
                //             $sorted_list[$i + 1] = $temp;
                //         } 
                //         else {
                //             array_push($sorted_list, $jobs[$j]);
                //         }
                //     }
                //}
            }
        }
        // for ($j = 0; $j < count($jobs); $j++) {
        //     foreach($jobs[$j] as $key => $data){
        //         if($key === 'percentage_match'){
        //             if(count($sorted_list) == 0){
        //                 $sorted_list[$j] = $jobs[$j];
        //             } else if ($data >= $sorted_list[$j - 1]->percentage_match){
        //                 $temp = $sorted_list[$j - 1];
        //                 $sorted_list[$j - 1] = $jobs[$j];
        //                 $sorted_list[$j] = $temp;
        //             } else {
        //                 array_push($sorted_list, $jobs[$j]);
        //             }
        //         }
        //     }
        // }
        // return $sorted_list;
        return $jobs; 
    }

    /**
     * Pagination Configuration
     */
    private function paginate_result($total_rows){
        $this->load->library('pagination');

        $config['base_url']     = base_url('client/search');
        $config['total_rows']   = $total_rows;
        $config['per_page']     = 2;

        $config['full_tag_open']  = '<ul class="pagination pagination-split pull-right">';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = 'First Page';
        $config['first_tag_open'] = '<li class="disabled">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last Page';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next Page';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Prev Page';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li><a>';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    /**
     * View Job Details By Job Id
     * @param $job_id - ID of the job to be viewed
     */
    public function view_job($job_id){
        $data['title']           = 'Jobs Details';
        $data['location']        = 'client/job_details';
        $data['script']          = base_url('assets/build/js/client.js');
        $data['applicant_id']    = $this->id;
        $data['job_detail']      = $this->job_model->view_details($job_id, true);
        $data['is_favorite']     = $this->client_model->is_already_favortite($this->id, $job_id);
        $data['is_applied']      = $this->job_model->is_application_exist($this->id, $job_id);

        $this->load->view('layouts/backend/client/home', $data);
    }

    /**
     * Upload Resume Function which will be
     * stored in webserver
     */
    public function upload(){
        $config['upload_path']   = 'Viewer/web';
        $config['allowed_types'] = 'pdf';
        $config['max_size']      = 2048;

        date_default_timezone_set('Asia/Manila');
        $date = date('m/d/y h:i:s a', time());

        $newFilename = md5($date);
        $config['file_name'] = $newFilename;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('resume'))
        {
            $error = array('key' => 'error','message' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $is_recorded = $this->client_model->store_resume($this->id, $data);
            if($is_recorded) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        }
    }

    /**
     * Apply Method
     * - Apply to a specific job that matched
     * the applicant's qualifications
     */
    public function apply(){

        $applicant_id = $this->input->post('applicantId');
        $job_id       = $this->input->post('jobId');

        $id           = $this->company_model->get_company_id($job_id);

        $is_recorded  = $this->job_model->record_application($applicant_id, $job_id, $id->company_id);

        if(!$is_recorded){
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    /**
     * client/favorites
     * Loads the list of favorite job
     */
    public function favorites(){
        $data['title']    = 'My Favorites';
        $data['location'] = 'client/favorites';
        $data['jobs']     = $this->client_model->get_all_favorites($this->id);
        $data['script']   = base_url('assets/build/js/client.js');
        $this->load->view('layouts/backend/client/home', $data);
    }

    /**
     * client/show
     * Loads the Profile Informations of the Client
     */
    public function show(){
        $data['title']    = 'My Profile';
        $data['location'] = 'client/show';
        $data['script']   = base_url('assets/build/js/client.js');

        $data['specialization']     = $this->specialization_model->get_all();
        $data['sub_specialization'] = $this->specialization_model->get_all_sub();
        $data['fos']                = $this->specialization_model->get_all_fos();
        $data['eas']                = $this->specialization_model->get_all_eas();
        $data['work_exps']          = $this->specialization_model->get_all_work_exp();

        $data['locations']          = $this->location_model->get_all();
        $data['salaries']           = $this->salary_model->get_all();
        $data['client']         = $this->client_model->get($this->id);
        $raw_qualifications     =  $this->client_model->get_applicant_qualifications($data['client']->aq_id);
        $data['qualifications'] = $this->map_qualifications($raw_qualifications);

        $this->load->view('layouts/backend/client/home', $data);
    }

    /**
     * Add Qualification
     */
    public function add_qualification(){

        $aq_id            = strtoupper(random_string('alnum', 10));
        $qualifications   = $this->input->post('qualifications');
        $q_list           = $this->organize_qualifications($qualifications);

        $is_recorded  = $this->client_model->record_qualification_id($this->id, $aq_id);

        if($is_recorded){
            $is_aq_recorded = $this->client_model->add_employee_qualifications($aq_id, $q_list);
            echo ($is_aq_recorded === true) ? json_encode(true) : json_encode(false);

        } else {
            echo json_encode(false);
        }
    }

    /**
     * Update Applicant Qualifications
     */
    public function update_qualifications(){

        $aq_id          = $this->input->post('aq_id');
        $qualifications = $this->input->post('qualifications');
        $q_ids          = $this->client_model->get_q_ids($aq_id);
        $q_list         = $this->organize_qualifications($qualifications);

        $is_update      = $this->client_model->update_qualifications($aq_id, $q_list,$q_ids);

        if($is_update){
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    /**
     * Organize Qualifications to be added to the Applicant Information
     */
    private function organize_qualifications($qualifications){
        $q_list = [];

        foreach ($qualifications as $item => $value) {
            $q_list[$item] = $value;
        }

        return $q_list;
    }

    /**
     * Mapping Algorithm
     * - Method that maps each qualifications to its parent criteria
     * - Construct a mapped Data Structure for better data handling
     * @param $qualification - List of all the qualification of the logged applicant
     * @return $mapped_data - Mapped Data Structure which will be used in displaying
     *                        qualification data in Applicant Profile
     */
    public function map_qualifications($qualification){

        $mapped_data = [];

        foreach ($qualification as $key) {

            if($key->description == 'Specialization'){

                $description = $this->client_model->get_qualification_description($key->qualification_id, 1)->description;

                $mapped_data['spec'] = array(
                    'id'               => $key->id,
                    'aq_id'            => $key->aq_id,
                    'qualification_id' => $key->qualification_id,
                    'description'      => $description
                );
 
            } else if($key->description == 'Field of Study'){

                $description = $this->client_model->get_qualification_description($key->qualification_id, 2)->description;

                $mapped_data['fos'] = array(
                    'id'               => $key->id,
                    'aq_id'            => $key->aq_id,
                    'qualification_id' => $key->qualification_id,
                    'description'      => $description
                );

            } else if($key->description == 'Degree Level'){

                $description = $this->client_model->get_qualification_description($key->qualification_id, 3)->description;

                $mapped_data['educ'] = array(
                    'id'               => $key->id,
                    'aq_id'            => $key->aq_id,
                    'qualification_id' => $key->qualification_id,
                    'description'      => $description
                );
            }  else if($key->description == 'Work Experience'){
                // $description = $key->qualification_id .'  year experience';
                $description = $this->client_model->get_qualification_description($key->qualification_id, 4)->description;

                $mapped_data['work'] = array(
                    'id'               => $key->id,
                    'aq_id'            => $key->aq_id,
                    'qualification_id' => $key->qualification_id,
                    'description'      => $description
                );
            } else if($key->description == 'Location'){
                $description = $this->client_model->get_qualification_description($key->qualification_id, 5)->description;

                $mapped_data['location'] = array(
                    'id'               => $key->id,
                    'aq_id'            => $key->aq_id,
                    'qualification_id' => $key->qualification_id,
                    'description'      => $description
                );
            } else if($key->description == 'Salary'){
                $description = $this->client_model->get_qualification_description($key->qualification_id, 6);

                $mapped_data['salary'] = array(
                    'id'               => $key->id,
                    'aq_id'            => $key->aq_id,
                    'qualification_id' => $key->qualification_id,
                    'description'      => $description
                );
            }
        }

        return $mapped_data;
    }

    /**
     * Method that records information of the client
     */
    public function record(){

        $id           = $this->id;
        $aq_id        = $this->client_model->get_qualification_id($id)->aq_id; // get the applicant qualification id
        $first_name   = $this->input->post('first_name');
        $last_name    = $this->input->post('last_name');
        $middle_name  = $this->input->post('middle_name');
        $address      = $this->input->post('address');
        $contact      = $this->input->post('contact_number');
        $prim_educ    = $this->input->post('prim_educ');
        $sec_educ     = $this->input->post('sec_educ');
        $ter_educ     = $this->input->post('ter_educ');
        $course       = $this->input->post('course');
        $email        = $this->input->post('email');

        $is_added = $this->client_model->add_profile_data($id, $aq_id, $first_name, $last_name, $middle_name,
        $address, $contact, $email, $prim_educ, $sec_educ, $ter_educ, $course);

        if(!$is_added){
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    /**
     * Mehtod that update clients personal information section
     */
    public function update_personal_info(){
        $client_id      = $this->input->post('client_id');
        $first_name     = $this->input->post('first_name');
        $last_name      = $this->input->post('last_name');
        $middle_name    = $this->input->post('middle_name');
        $address        = $this->input->post('address');
        $contact_number = $this->input->post('contact_number');
        $email          = $this->input->post('email');

        $is_updated = $this->client_model->update_basic_information($client_id, $first_name, $last_name, $middle_name,
        $address, $contact_number, $email);

        if(!$is_updated){
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    /**
     * Method that update clients Eaducational Attainment Section
     */
    public function update_ea(){
        $client_id = $this->input->post('client_id');
        $prim_educ = $this->input->post('prim_educ');
        $sec_educ  = $this->input->post('sec_educ');
        $ter_educ  = $this->input->post('ter_educ');
        $course    = $this->input->post('course');

        $is_updated = $this->client_model->update_educational_attainment($client_id, $prim_educ, $sec_educ, $ter_educ, $course);

        if(!$is_updated){
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    /**
     * Shows a list of jobs applied by the client
     */
    public function applications(){
        $data['title']    = 'My Application';
        $data['script']   = base_url('assets/build/js/client.js');
        $data['location'] = 'client/applications';
        $data['jobs']     = $this->job_model->get_applied_job($this->id);

        $this->load->view('layouts/backend/client/home', $data);
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
    public function filter_job($job_qualifications, $client_qualification){

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
                if($this->check_application($this->id, $jq)){
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
     * Get the total number of qualification count
     */
    private function company_qualification_count(){
        $count = $this->job_model->get_company_job_listings_qualifications(true);
        return $count;
    }

    /**
     * Logout Method
     */
    public function logout(){
        $data = array(
            'id', 'name','email', 'role'
        );
        $this->session->unset_userdata($data);
        redirect(base_url('home/login'));
    }

    /**
     * Mark Certain Job as Favorite
     */
    public function mark_favorite(){
        $applicant_id = $this->input->post('applicant_id');
        $job_id       = $this->input->post('job_id');

        $is_recorded = $this->client_model->mark_job_as_favorite($applicant_id, $job_id);

        echo ($is_recorded === true) ? json_encode(true) : json_encode(false);
    }

    /**
     * Remove a Job to the Favorites List
     */
    public function remove_favorite(){

        $applicant_id = $this->input->post('applicant_id');
        $job_id       = $this->input->post('job_id');
        $is_removed   = $this->client_model->remove_job_as_favorite($applicant_id, $job_id);

        echo ($is_removed === true) ? json_encode(true) : json_encode(false);
    }

    /**
     * View Company Details
     * @param $company_id - The ID of the Company to be Viewed
     */
    public function view_company($company_id){
        $data['title']    = 'The Company';
        $data['location'] = 'client/company_details';
        $data['script']   = base_url('assets/build/js/client.js');
        $data['company']  = $this->company_model->get_company_details($company_id);

        $this->load->view('layouts/backend/client/home', $data);
    }
}

?>