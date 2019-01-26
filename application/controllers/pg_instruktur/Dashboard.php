<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
  	    $this->Model_security->is_logged_in();
	}

	public function index()
	{
		$data = array(
			'navbar_title' 					=> "Dashboard",
			// 'list_jenjang_kelas' 		=> $this->Model_adm->fetch_list_group_by('kelas', 'jenjang', 'tingkatan_kelas'),
			// 'list_tingkatan_kelas' 	=> $this->Model_adm->fetch_list_group_by('kelas', 'tingkatan_kelas', 'tingkatan_kelas'),
			// 'list_mapel' 						=> $this->Model_adm->fetch_list_group_by('mata_pelajaran', '', 'kelas_id'),
			// 'list_materi_pokok'			=> $this->Model_adm->fetch_list_group_by('materi_pokok', '', 'urutan'),
			// 'list_sub_materi'				=> $this->model_adm->fetch_list_group_by('sub_materi', '', 'urutan_materi'),
			// 'list_kategori_konten'	=> $this->model_adm->fetch_kategori_konten()
			//'list_sub_materi'				=> $this->model_adm->fetch_kategori_konten(),
      		// 'urutan_konten' 				=> array('teks', 'video', 'soal')

		);

		
	  //   $string = "apakah kamu mau berjalan-jalan denganku nanti malam?";
	  //   if(strlen($string) > 30){
	  //   	echo $string;
	  //   	echo "<br>";
	  //     echo $string_start = substr($string, 0, 15);
	  //   	echo "<br>";
	  //     echo $string_end = substr($string, -20);
	  //   	echo "<br>";
	  //     echo substr($string_start, 0, strrpos($string_start, ' '));
	  //   	echo "<br>";
	  //     echo substr($string_end, strpos($string_end, ' '));
  	  //   }
	  //   die();

		$this->load->view('pg_instruktur/dashboard', $data);
	}

}
