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

}