<?php 

class Specialization_Model extends CI_Model{
    
    public function get_all(){
        $table = 'tbl_specializations';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }

    public function get_all_sub(){
        $table = 'tbl_sub_specializations';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }

    public function get_all_fos(){
        $table = 'tbl_field_of_studies';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }

    public function get_all_eas(){
        $table = 'tbl_degree_levels';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }

    public function get_all_salary(){
        $table = 'tbl_salaries';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }


    public function get_all_work_exp(){
        $table = 'tbl_work_exp';

        $query = $this->db->select('*');
        $query = $this->db->from($table);

        $result = $query->get()->result();

        return $result;
    }
}

?>