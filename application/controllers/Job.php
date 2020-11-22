<?php 
/**
 * Author : S4Lv4T0r3
 * Date   : January 13, 2019
 */
class Job extends CI_Controller{

    public function is_already_applied(){

        $applicant_id = $this->input->post('applicantId');
        $job_id       = $this->input->post('jobId');

        $already_applied = $this->job_model->is_application_exist($applicant_id, $job_id);
        
        if($already_applied){
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }
    }

    public function get_job_details($jq_id){

        $this->job_model->get_job_details($jq_id);
        $this->job_model->get_job_qualification_details($jq_id);

        $data['job']                = $this->job_model;
        $data['specialization']     = $this->specialization_model->get_all();
        $data['sub_specialization'] = $this->specialization_model->get_all_sub();
        $data['fos']                = $this->specialization_model->get_all_fos();
        $data['eas']                = $this->specialization_model->get_all_eas();

        $data['work_exps']          = $this->specialization_model->get_all_work_exp();
        $data['salaries']           = $this->specialization_model->get_all_salary();
        echo json_encode($data);
    }
}

?>