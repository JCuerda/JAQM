<?php

class Location_Model extends CI_Model {

    public function get_all(){
        $table = 'tbl_locations';

        $query = $this->db->select('*');
        $query = $this->db->from($table);
        
        $result = $query->get()->result();

        return $result;
    }

}

?>