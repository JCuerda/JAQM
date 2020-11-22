<?php

class Rate_Model extends CI_Model{


    public function get_all(){
        $table = 'tbl_subscription_types';

        $query = $this->db->select('*');
        $query = $this->db->from($table);
        
        $result = $query->get()->result();
        
        return $result;
    }

    public function get($rate_id){
        $table = 'tbl_subscription_types';

        $query = $this->db->select('*');
        $query = $this->db->from($table);
        $query = $this->db->where('id', $rate_id);

        $result = $query->get()->row();

        return $result;
    }

    public function update_rate($id, $description, $max_post, $pricing){
        $table = 'tbl_subscription_types';

        $fields = array(
            'description' => htmlspecialchars(html_escape($description)),
            'max_post'    => htmlspecialchars(html_escape($max_post)),
            'pricing'     => htmlspecialchars(html_escape($pricing))
        );
        
        $this->db->where('id', $id);
        $this->db->update($table, $fields);

        $affectedRows = $this->db->affected_rows();

        return ($affectedRows >= 0) ? true : false;
    }

}


?>