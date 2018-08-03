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
        $kelas = $this->model_pg->get_mapel_by_kelas($id);

		$data = array(
            'kelas' => $kelas,
            'mapel' => $this->model_pg->get_mapel_by_kelas_id($kelas->id_kelas)
        );
		$idsiswa = $this->session->userdata('id_siswa');
		if($idsiswa != NULL){
        	$siswa = $this->model_pg->get_data_user($idsiswa);
        	$data['siswa'] = $siswa;
        }
       // return $this->output
       //     ->set_content_type('application/json')
       //     ->set_status_header(500)
       //     ->set_output(json_encode($data));

		$this->load->view("pg_user/kelas", $data);
	}
}