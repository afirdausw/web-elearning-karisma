<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

function index(){
	$data = array(
		'navbar_title' 	=> "Manajemen User LPIH",
		'data_table' 	=> $this->Model_adm->fetch_all_user()
		);

	$this->load->view('pg_admin/user/user', $data);
}

function tambah(){
	$data = array(
		'navbar_title' 	=> "Manajemen User LPIH"
		);

	$this->load->view('pg_admin/user/user_form', $data);
}


function proses_tambah(){
	$params = $this->input->post(null, true);
	
	$username 	= $params['username'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];
	$level 		= $params['level'];
	
	if($password !== $repassword){
		alert_error("Gagal Register", "Password tidak sama");
		redirect("pg_admin/user/tambah");
	}
	
	$cariuserpass = $this->Model_adm->cari_user($username, $password);
	
	if($cariuserpass === FALSE){
		$prosestambah = $this->Model_adm->tambah_user($username, md5($password), $level);
		alert_success("Berhasil", "User LPIH Berhasil Ditambahkan");
		redirect('pg_admin/user');
	}
	else{				
		alert_error("Error", "Username Sudah ada yang memakai, pakai username yang lain!");
		redirect('pg_admin/user/tambah');
	}
}

function edit($iduser){
	$data = array(
		'navbar_title' 	=> "Manajemen Akun PSEP",
		'user'			=> $this->Model_adm->get_user_by_id($iduser)
	);
	
	$this->load->view('pg_admin/user/user_edit', $data);
}

function proses_edit(){
	$params = $this->input->post(null, true);
	
	$iduser 	= $params['iduser'];
	$username 	= $params['username'];
	$level 		= $params['level'];
	
	$prosestambah = $this->Model_adm->edit_user($iduser, $username, $level);
	alert_success("Berhasil", "User LPIH Berhasil Dirubah");
	redirect('pg_admin/user');
}

function edit_password($iduser){
	$data = array(
		'navbar_title' 	=> "Manajemen Akun PSEP",
		'user'			=> $this->Model_adm->get_user_by_id($iduser)
	);
	
	$this->load->view('pg_admin/user/user_edit_password', $data);
}

function proses_edit_password(){
	$params = $this->input->post(null, true);
	
	$iduser 	= $params['iduser'];
	$password 	= $params['password'];
	$repassword = $params['repassword'];
	
	if($password !== $repassword){
		alert_error("Gagal Register", "Password tidak sama");
		redirect("pg_admin/user/edit_password/".$iduser);
	}
	$prosestambah = $this->Model_adm->edit_password_user($iduser, $password);
	alert_success("Berhasil", "Password User LPIH Berhasil Dirubah");
	redirect('pg_admin/user');
}

function hapus($iduser){
	$proseshapus = $this->Model_adm->hapus_user($iduser);
	redirect('pg_admin/user');
}

//buat function untuk kirim email, jaga2 kalau pengen ngirim ke email sekolah setelah pembuatan akun
function send_Smtp2go($idbayar, $email)
{
	$config = Array(
		'protocol' 		=> 'smtp',
		'smtp_host' 	=> 'smtp.postmarkapp.com',
		'smtp_port' 	=> 587,
		'smtp_user' 	=> 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
		'smtp_pass' 	=> 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
		'mailtype' 		=> 'html',
		'charset' 		=> 'iso-8859-1',
		'wordwrap' 		=> TRUE
	);

	$message = '';
	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");  
	$this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
	$this->email->to($email);// change it to yours
	$this->email->subject('Voucher LPIH');
	$dataemail = array (
		'table_data' => $this->Model_pembayaran->cari_voucher($idbayar)
	);

	$body = $this->load->view('pg_admin/email.php',$dataemail,TRUE);
	$this->email->message($body);
	if($this->email->send())
	{
	  redirect('pg_admin/akun_psep/sekolah');
	}
	else
	{
		show_error($this->email->print_debugger());
	}
}

}
