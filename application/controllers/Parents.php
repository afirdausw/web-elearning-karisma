<?php

class Parents extends CI_Controller{
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
		
		//sansan code
		$this->load->model('model_pg');

		$this->load->model('model_paket');

		$this->load->model('model_voucher');

		$this->load->model('model_pembayaran');

		$this->load->model('model_dashboard');
		$this->load->model('model_signup');
		$this->load->model('model_poin');
		$this->load->model('model_bonus');
		$this->load->model('model_fronttryout');
		$this->load->model('model_adm');
		
	}

function index(){
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	
	//cek apakah siswa sudah mempunyai ortu??
	//***************************************
	$cariortu = $this->model_parent->cari_ortu_by_idsiswa($idsiswa);
	
	if($cariortu > 0){
		//jika siswa sudah memiliki ortu
		$data = array(
			'infosiswa'		=> $infosiswa,
			'infoortu'		=> $this->model_parent->get_ortu($idsiswa)
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
	
	$daftar = $this->model_parent->daftar($idsiswa, $nama, $email, $telepon, $username, $password);
	
	redirect('parents');
}

function edit($idparent){
	
	$idsiswa = $this->session->userdata('id_siswa');
	
	if($idsiswa == ""){
		redirect('login');
	}
	$infosiswa = $this->model_dashboard->get_info_siswa($idsiswa);
	
	$dataortu = $this->model_parent->get_parent($idparent);
	
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
	
	$daftar = $this->model_parent->edit($idortu, $idsiswa, $nama, $email, $telepon, $username, $password);
	
	redirect('parents');
}

function dashboard(){
	$this->model_security->parent_logged_in();
	$data = array(
		'quote' 	=> $this->model_bonus->fetch_random_quote(),
		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
	);
	$this->load->view('pg_ortu/dashboard_parent', $data);
}

function profil($idkelas){
	$cariprofil = $this->model_dashboard->get_profil_by_kelas($idkelas);
	
	echo '<option value="">--- Pilih Profil Try Out ---</option>';
	foreach($cariprofil as $profil){
		echo "
			<option value='".$profil->id_tryout."'>".$profil->nama_profil."</option>
		";
	}
}

function aktivitas_siswa(){
	$this->model_security->parent_logged_in();
	$id = $_SESSION['id_ortu_siswa'];
	$data = array(
	'navbar_title'		=> "Log Akses Siswa",
	'page_title' 		=> "Detail Log Siswa",
	'form_action' 		=> current_url() . "?id=$id",
	'data_siswa' 		=> $this->model_adm->fetch_siswa_by_id($id),
	'log_teks' 			=> $this->model_adm->track_akses_by_id($id, 1), // 1=teks 
	'log_video' 		=> $this->model_adm->track_akses_by_id($id, 2), // 2=video 
	'log_soal' 			=> $this->model_adm->track_akses_soal_by_id($id), // 3=soal 
	'group_log_teks' => $this->model_adm->group_akses_by_id($id, 1),
	'group_log_video' => $this->model_adm->group_akses_by_id($id, 2),
	'group_log_soal' => $this->model_adm->group_akses_soal_by_id($id),
	'akses_terakhir' 	=> $this->model_adm->last_akses_by_id($id),
	'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
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

function tryoutsiswa(){
	$this->model_security->parent_logged_in();
	$data = array(
		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
	);
	$this->load->view('pg_ortu/pilih_tryout', $data);
}

function tryout()
	{
// 	    if ($this->uri->segment(3) == "") {
// 			redirect('parents/dashboard');
// 		} else {
// 			$idtryout = $this->uri->segment(3);
// 			$id_siswa = isset($_SESSION['id_ortu']) ? $_SESSION['id_ortu'] : 0;
// 			if (empty($this->session->userdata('akses'))) {
// 				$datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_ortu);
// 				if (empty($datapembelian)) {
// 					redirect("user/aktivasi");
// 				} else {
// 					redirect("user/buylist");
// 				}
// 			}
	    
// 			$idsiswa = $this->session->userdata('id_ortu');
// 			$session = $this->session->userdata;
// 			$this->model_security->parent_logged_in();
// 			 	$data = array(
// 			 		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
// 			 	);
			//$this->load->view('pg_ortu/pilih_tryout', $data);
			$data = array(
				'infosiswa'         => $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
				'navbar_links'      => $this->model_pg->get_navbar_links(),
				'data_user'         => $this->model_pg->get_data_user($this->session->userdata('id_siswa')),
				'profil_tryout'     => $this->model_adm->fetch_all_profil_by_id($idtryout),
				'profil_tryout_all' => $this->model_adm->fetch_all_profil_by_kelas($session['kelas']),
				'dataperingkat'     => $this->model_dashboard->peringkat($idtryout),
			);
			$table_data = $data['profil_tryout'];

			$daftar_kategori_baru = [];
			$i = 0;
			$totalsoal = 0;
			$totalbenar = 0;
			foreach ($table_data as $kat) {
				$daftar_kategori = $this->model_fronttryout->fetch_kategori($kat->id_tryout);
				$daftar_kategori_baru[$i] = json_decode(json_encode($kat), True);
				$j = 0;
				$index = 0;
				if (count($daftar_kategori) > 0) {
					foreach ($daftar_kategori as $subkey => $value) {
						if ($value->id_profil == $kat->id_tryout) {
							$cariskor = $this->model_dashboard->cari_skor($value->id_kategori, $idsiswa);
							$cariskorsalah = $this->model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
							$cariwaktu = $this->model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
							$daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), True);
							$daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
							$daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
							$daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
							$totalsoal+= $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jumlah_soal'];
							$totalbenar+= $cariskor;
							$daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisawaktu'] = json_decode(json_encode($this->model_dashboard->analisis_waktu($value->id_kategori, $idsiswa)), True);
							$daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisistopik'] = json_decode(json_encode($this->model_dashboard->analisistopik($value->id_kategori, $idsiswa)), True);
							$analisa_topik = json_decode(json_encode($this->model_dashboard->analisatopik($value->id_kategori, $idsiswa)), True);
							$k = 0;
							foreach ($analisa_topik as $at) {
								if ($at['id_analisis_topik'] != null) {
									$at['jml_benar'] = $this->model_dashboard->analisabytopikbenar($value->id_kategori,$at['topik'], $idsiswa);
									$daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k] = $at;
									$daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['total'] = $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik']);
									$daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['presentase'] = ($at['jml_benar'] == 0 ? 0 : ($at['jml_benar'] / $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik'])) * 100);
								} else {
									$daftar_kategori_baru[$i]['daftar_kategori'][$j][$k]['analisa_topik'] = null;
								}
								$k++;
							}
							unset($daftar_kategori[$index]);
							$j++;
						}
						if ($j == 0) {
							$daftar_kategori_baru[$i]['daftar_kategori'] = null;
						}
					}
					$index++;
				} else {
					$daftar_kategori_baru[$i]['daftar_kategori'] = null;
				}
				$i++;
			}
			$data['daftar_kategori_baru'] = $daftar_kategori_baru;
			$data['daftar_kategori_baru']['totalsoal'] = $totalsoal;
			$data['daftar_kategori_baru']['totalbenar'] = $totalbenar;
//
//            return $this->output
//                ->set_content_type('application/json')
//                ->set_status_header(500)
//                ->set_output(json_encode($data));
			$this->load->view('pg_user/tryout-statistik', $data);
		
	//}
	}

public function log_by_date()
	{
		$id_siswa = $this->input->post('id');
		$log_date_start = $this->input->post('log_date_start');
		$log_date_end = $this->input->post('log_date_end');
		
		if($id_siswa && $log_date_start && $log_date_end) {
			$date_start = date('Ym', strtotime($log_date_start));
			$date_end = date('Ym', strtotime($log_date_end));
			
			$group_teks = $this->model_adm->group_akses_by_id($id_siswa, 1, $date_start, $date_end);
			$group_video = $this->model_adm->group_akses_by_id($id_siswa, 2, $date_start, $date_end);
			$group_soal = $this->model_adm->group_akses_soal_by_id($id_siswa, $date_start, $date_end);
			
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