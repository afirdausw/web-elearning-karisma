<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_profil extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	public function toogle_premium($data)
	{
		$this->db->where('id_siswa', $data["id_siswa"]);
		$query = $this->db->update("siswa", $data);

		return $query;
	}

    public function get_data_user_pretest($id_pretest){
		$this->db->select('*');
		$this->db->from('siswa_pretest');
		$this->db->where('id_siswa_pretest', $id_pretest);

		$query = $this->db->get();
		return $query->row();
    }

}
