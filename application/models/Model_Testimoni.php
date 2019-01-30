<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Testimoni extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    function fetch_all_siswa()
    {
        $query = $this->db->get('login_siswa')->result();
        return $query;
    }

    function insert_testimonial($data)
    {
    	$query = $this->db->insert('testimoni', $data);
    	return $query;
    }
}

/* End of file Model_Testimoni.php */
/* Location: ./application/models/Model_Testimoni.php */ ?>