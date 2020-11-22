<?php

class Error404 extends CI_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $data['role'] = $this->session->userdata('role');
        $this->output->set_status_header('404');
        $this->load->view('layouts/error404', $data);
    }
}

?>