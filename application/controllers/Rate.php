<?php
/**
 * Author : S4Lv4T0r3
 * Date   : January 13, 2019
 */
class Rate extends CI_Controller{

    function __construct(){
        parent::__construct();

        $this->load->model('rate_model');

    }
    public function get($rate_id){
        $rate_details = $this->rate_model->get($rate_id);
        echo json_encode($rate_details);
    }

    public function save(){

        $id          = $this->input->post('id');
        $description = $this->input->post('description');
        $max_post    = $this->input->post('max_post');
        $pricing     = $this->input->post('pricing');

        $is_updated = $this->rate_model->update_rate($id, $description, $max_post, $pricing);
        
        echo ($is_updated === true) ? json_encode(true) : json_encode(false);
    }
}

?>