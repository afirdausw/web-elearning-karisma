<?php

/**
 *
 */
class Model_paud extends CI_Model
{

    function get_seri_video(){
        $this->db->select('*');
        $this->db->from('seri_video_paud');
        $query = $this->db->get();
        return $query->result();
    }

}