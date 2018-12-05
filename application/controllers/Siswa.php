<?php

class Siswa extends CI_Controller{
function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->model('model_adm');
		$this->load->model('model_pembayaran');
		$this->load->model('model_paket');
		$this->load->model('model_tryout');
		$this->load->model('model_banksoal');
		$this->load->model('model_parent');
		$this->load->model('model_dashboard');
		$this->load->model('model_security');
		$this->load->model('model_bonus');
		$this->load->model('model_pg');
		
		
	}

function index(){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->Model_dashboard->get_info_siswa($idsiswa);
	
	
	//cek apakah siswa sudah mempunyai ortu??
	//***************************************
	$cariortu = $this->Model_parent->cari_ortu_by_idsiswa($idsiswa);
	
	if($cariortu > 0){
		//jika siswa sudah memiliki ortu
		$data = array(
			'infosiswa'		=> $infosiswa,
			'infoortu'		=> $this->Model_parent->get_ortu($idsiswa)
		);
		$this->load->view('pg_user/parent', $data);
	}elseif($cariortu == 0){
		//jika siswa tidak memiliki ortu
		$data = array(
			'infosiswa'	=> $infosiswa
		);
		$this->load->view('pg_user/parent_form', $data);
	}
	//end cek
	//***************************************
}

function prosesdaftar(){
	$params = $this->input->post(null, true);
	
	$idsiswa 	= $this->session->userdata('id_siswa');
	$nama 		= $params['nama'];
	$email 		= $params['email'];
	$telepon 	= $params['telepon'];
	$username 	= $params['username'];
	$password 	= $params['password'];
	
	$daftar = $this->Model_parent->daftar($idsiswa, $nama, $email, $telepon, $username, $password);
	
	redirect('parents');
}

function edit($idparent){
	
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->Model_dashboard->get_info_siswa($idsiswa);
	
	$dataortu = $this->Model_parent->get_parent($idparent);
	
	$data = array(
		'dataortu'	=> $dataortu,
		'infosiswa'	=> $infosiswa		
	);
	$this->load->view('pg_user/parent_edit', $data);
	
}

function prosesedit(){
	$params = $this->input->post(null, true);
	$idsiswa = $this->session->userdata('id_siswa');
	
	$idortu		= $params['idparent'];
	$idsiswa 	= $this->session->userdata('id_siswa');
	$nama		= $params['nama'];
	$email		= $params['email'];
	$telepon	= $params['telepon'];
	$username	= $params['username'];
	$password	= $params['password'];
	
	$daftar = $this->Model_parent->edit($idortu, $idsiswa, $nama, $email, $telepon, $username, $password);
	
	redirect('parents');
}

function dashboard(){
	$this->Model_security->parent_logged_in();
	$data = array(
		'quote' 	=> $this->Model_bonus->fetch_random_quote(),
		'infoortu'	=> $this->Model_parent->get_parent($_SESSION['id_ortu'])
	);
	$this->load->view('pg_ortu/dashboard_parent', $data);
}

function profil($idkelas){
	$cariprofil = $this->Model_dashboard->get_profil_by_kelas($idkelas);
	
	echo '<option value="">--- Pilih Profil Try Out ---</option>';
	foreach($cariprofil as $profil){
		echo "
			<option value='".$profil->id_tryout."'>".$profil->nama_profil."</option>
		";
	}
}

function aktivitas_siswa(){
	$this->Model_security->parent_logged_in();
	$id = $_SESSION['id_ortu_siswa'];
	$data = array(
	'navbar_title'		=> "Log Akses Siswa",
	'page_title' 		=> "Detail Log Siswa",
	'form_action' 		=> current_url() . "?id=$id",
	'data_siswa' 		=> $this->Model_adm->fetch_siswa_by_id($id),
	'log_teks' 			=> $this->Model_adm->track_akses_by_id($id, 1), // 1=teks
	'log_video' 		=> $this->Model_adm->track_akses_by_id($id, 2), // 2=video
	'log_soal' 			=> $this->Model_adm->track_akses_soal_by_id($id), // 3=soal
	'group_log_teks' => $this->Model_adm->group_akses_by_id($id, 1),
	'group_log_video' => $this->Model_adm->group_akses_by_id($id, 2),
	'group_log_soal' => $this->Model_adm->group_akses_soal_by_id($id),
	'akses_terakhir' 	=> $this->Model_adm->last_akses_by_id($id),
	'infoortu'	=> $this->Model_parent->get_parent($_SESSION['id_ortu'])
	);

	//Redirect to siswa if id is not exist
	if(!$id)
	{
		redirect('pg_admin/log');
	}
	else 
	{
		$this->load->view('pg_ortu/log_detail', $data);
	}
}

function tryout(){
	$this->Model_security->psep_sekolah_is_logged_in();
	$data = array(
		'infoortu'	=> $this->Model_parent->get_parent($_SESSION['id_ortu'])
	);
	$this->load->view('pg_ortu/pilih_tryout', $data);
}

public function log_by_date()
	{
		$id_siswa = $this->input->post('id');
		$log_date_start = $this->input->post('log_date_start');
		$log_date_end = $this->input->post('log_date_end');
		
		if($id_siswa && $log_date_start && $log_date_end) {
			$date_start = date('Ym', strtotime($log_date_start));
			$date_end = date('Ym', strtotime($log_date_end));
			
			$group_teks = $this->Model_adm->group_akses_by_id($id_siswa, 1, $date_start, $date_end);
			$group_video = $this->Model_adm->group_akses_by_id($id_siswa, 2, $date_start, $date_end);
			$group_soal = $this->Model_adm->group_akses_soal_by_id($id_siswa, $date_start, $date_end);
			
			$ranged_data = array('data_teks'=>'', 'data_video'=>'', 'data_soal'=>'','count_teks'=>0,'count_video'=>0,'count_soal'=>0 
				);
			foreach ($group_teks as $teks) {
				$ranged_data['data_teks'] .= 
				"<tr>".
          "<td>".$teks['alias_kelas']."</td>".
          "<td>".$teks['nama_mapel']."</td>".
          "<td class='text-center'>".$teks['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_teks'] += $teks['jumlah_akses'];
			}
			foreach ($group_video as $video) {
				$ranged_data['data_video'] .= 
				"<tr>".
          "<td>".$video['alias_kelas']."</td>".
          "<td>".$video['nama_mapel']."</td>".
          "<td class='text-center'>".$video['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_video'] += $video['jumlah_akses'];
			}
			foreach ($group_soal as $soal) {
				$ranged_data['data_soal'] .= 
				"<tr>".
          "<td>".$soal['alias_kelas']."</td>".
          "<td>".$soal['nama_mapel']."</td>".
          "<td class='text-center'>".$soal['jumlah_akses']." x</td>".
        "</tr>";
				$ranged_data['count_soal'] += $soal['jumlah_akses'];
			}

			echo json_encode($ranged_data);
		}
	}

function logout(){
	$this->session->sess_destroy();
	redirect(base_url());
}

}