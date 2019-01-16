<?php 

/**
* 
*/
class Kelas extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pg');
	}

	function index($id){
        $kelas = $this->Model_pg->get_mapel_by_kelas($id);
        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

		$data = array(
            'kelas' => $kelas,
            'mapel' => $this->Model_pg->get_mapel_by_kelas_id($kelas->id_kelas),
            "kelas_navbar" => $kelas_navbar, 
        );
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa != NULL){
        	$siswa = $this->Model_pg->get_data_user($idsiswa);
        	$data['siswa'] = $siswa;
        }
       // return $this->output
       //     ->set_content_type('application/json')
       //     ->set_status_header(500)
       //     ->set_output(json_encode($data));

		$this->load->view('pg_user/kelas', $data);
	}
}