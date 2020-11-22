<?php 
/**
 * Author : S4Lv4T0r3
 * Date   : January 13, 2019
 */
class Search extends CI_Controller {

    public function index(){
        $data['title']    = 'Search';
        $data['location'] = 'client/search';
        $data['script']   = null;
        $this->load->view('layouts/backend/client/home', $data);
    }
}

?>