<?php

class Salary_Model extends CI_Model{

    public function get_all(){
        $table = 'tbl_salaries';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }

}

?>