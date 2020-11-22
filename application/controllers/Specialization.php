<?php
/**
 * Author : S4Lv4T0r3
 * Date   : January 13, 2019
 */
class Specialization extends CI_Controller{


    public function get(){
        $data['specialization']     = $this->specialization_model->get_all();
        $data['sub_specialization'] = $this->specialization_model->get_all_sub();

        // $organized_spec     = $this->organize_specialization($specialization, $sub_specialization);
        echo json_encode($data);
    }

    public function organize_specialization($specialization, $sub_specialization){

    }


}

?>