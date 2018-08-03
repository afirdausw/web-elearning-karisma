<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori_konten_download extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			
			//check user session

			//load library in construct. Construct method will be run everytime the controller is called 
			//This library will be auto-loaded in every method in this controller. 
			//So there will be no need to call the library again in each method. 
			$this->load->library('form_validation');
			$this->load->helper('alert_helper');
			$this->load->model('model_adm');
			$this->load->model('model_security');
			$this->model_security->is_logged_in();
	}


	public function index($id_konten = 0)
	{
		$data = array(
			'navbar_title' => "Kategori Konten Download",
			'form_action'  => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data'   => $this->model_adm->get_all_konten_by_kategori_konten_download($id_konten),
		);

		$this->load->view('pg_admin/kategori_konten_download', $data);
	}

	public function kategori_konten_download_all(){
		$data = array(
			'navbar_title' 	=> "Manajemen Akun PSEP - Kategori Konten Download",
			'table_data' 	=> $this->model_adm->fetch_all_akun_sekolah(),
			'data_kategori_konten_download' => $this->model_adm->fetch_all_kategori_konten_download()
		);

		$this->load->view('pg_admin/kategori_konten_download', $data);
	}

}
