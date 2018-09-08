<?php

/**
 *
 */
class profil extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pg');
        $this->load->model('model_konten');
        $this->load->model('model_profil');
        $this->load->helper('url');
    }

    public function index()
    {
    	if($this->session->userdata('id_siswa') != NULL){
	    	$siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));

            $kelas_navbar = $this->model_pg->fetch_all_kelas();
	    	$data = array(
	            'siswa' => $siswa,

                "kelas_navbar" => $kelas_navbar, 
	        );

	        $this->load->view('pg_user/profil-siswa', $data);
            
    	}elseif($this->session->userdata('pretest_id') != NULL){
	    	$pretest = $this->model_profil->get_data_user_pretest($this->session->userdata('pretest_id'));
	    	$data = array(
	            'pretest' => $pretest,
	        );

	        $this->load->view('pg_user/profil-pretest', $data);
            
    	}else{
            redirect(base_url(), 'refresh');
    	}
    }


    public function premium()
    {
        if($this->session->userdata('id_siswa')!=NULL){
            $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));

            $data = [
                "id_siswa"     => $this->session->userdata('id_siswa'),
            ];
            if ($siswa->id_premium == 0){
                $data["id_premium"] = 1;
            }else if ($siswa->id_premium >= 0){
                $data["id_premium"] = 0;
            }
            $update = $this->model_profil->toogle_premium($data);
            if($update){
                redirect(base_url().'profil');
            }else{
                var_dump($update);
            }
        }else{
            redirect(base_url(), 'refresh');
        }

    }
}
