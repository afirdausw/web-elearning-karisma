<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnostictest extends CI_Controller {
public function __construct(){
	parent::__construct();
	//load library in construct. Construct method will be run everytime the controller is called 
	//This library will be auto-loaded in every method in this controller. 
	//So there will be no need to call the library again in each method. 
	$this->load->helper('alert_helper');
	$this->load->model('model_pg');
	$this->load->model('model_agcu');
	$this->load->model('model_eqtest');
	$this->load->model('model_lstest');
	$this->load->model('model_dashboard');
    $this->load->model('model_security');
    $this->Model_security->is_logged_in();
}
function index(){
	$data = array(
		'kelas'			=> $this->Model_agcu->cek_kelas(),
		'diagnostic'	=> $this->Model_agcu->get_diagnostic(),
		'jumlah_soal'	=> $this->Model_agcu->get_jumlahsoal()
	);
	
	$this->load->view('pg_admin/kategori_diagnostic', $data);
}


function tambah(){
	$data = array(
		'kelas'	=> $this->Model_agcu->get_kelas()
	);
	$this->load->view('pg_admin/diagnostic_form', $data);
}

function pilihmapel(){
	$idkelas = $this->uri->segment(4);
	
	$mapel = $this->Model_agcu->get_mapel_by_kelas($idkelas);
	    
	    echo "
	        <option>--- Pilih Mata Pelajaran ---</option>
	        ";
	
	foreach($mapel as $datamapel){
		echo "
		<option value='".$datamapel->id_mapel."'>".$datamapel->nama_mapel."</option>
		";
	}
}

function pilihsoal(){
	$idmapel = $this->uri->segment(4);
	
	$soal = $this->Model_agcu->get_soal_by_mapel($idmapel);
	
	$no = 1;
	foreach($soal as $datasoal){
		echo "
		<tr>
			<td>".$datasoal->alias_kelas." - ".$datasoal->nama_mapel."</td>
			<td>".$datasoal->pertanyaan."</td>
			<td>".$datasoal->topik."</td>
			<td>
				<input type='checkbox' value='".$datasoal->id_banksoal."' name='pilih[]' />
			</td>
		</tr>
		";
		$no++;
	}
}

function prosestambah(){
	$params = $this->input->post(null, true);
	
	if(isset($params['pilih'])){
		$hitung_soal	= count($params['pilih']);
		$idbanksoal 	= $params['pilih'];
	}
	
	$idmapel 	= $params['mapel'];
	$nama 		= $params['nama'];
	$durasi 	= $params['durasi'];
	$ketuntasan = $params['ketuntasan'];
	
	$insertkategori = $this->Model_agcu->tambah_kategori($idmapel, $nama, $durasi, $ketuntasan);
	
	$idkategori = $this->Model_agcu->last_addedkategori();
	
	
	
	for($i=0; $i <= $hitung_soal - 1; $i++){
		$result = $this->Model_agcu->add_soal($idkategori->id_terakhir, $idbanksoal[$i]);
	}
	redirect('pg_admin/diagnostictest');
}

function edit(){
	$iddiagnostic 	= $this->uri->segment(4);
	$getdiagnostic 	= $this->Model_agcu->get_diagnosticbyid($iddiagnostic );
	$getidsoal 		= $this->Model_agcu->get_idsoal($iddiagnostic );
	$getsoal 		= $this->Model_agcu->get_soal();
	
	$data = array(
	'iddiagnostic'	=> $iddiagnostic,
	'getdiagnostic'	=> $getdiagnostic,
	'getidsoal'		=> $getidsoal,
	'getsoal'		=> $getsoal,
	'kelas'	=> $this->Model_agcu->get_kelas()
	);	
	
	$this->load->view('pg_admin/diagnostic_edit', $data);
}
function prosesedit(){
	$params = $this->input->post(null, true);
	
	if(isset($params['pilih'])){
		$hitung_soal	= count($params['pilih']);
		$idbanksoal 	= $params['pilih'];
	}
	
	$idmapel 	= $params['mapel'];
	$iddiagnostic 	= $params['id'];
	$nama 		= $params['nama'];
	$durasi 	= $params['durasi'];
	$ketuntasan = $params['ketuntasan'];
	
	$editkategori = $this->Model_agcu->edit_kategori($iddiagnostic, $idmapel, $nama, $durasi, $ketuntasan);
	
	$hapussoal = $this->Model_agcu->hapus_soal_kategori($iddiagnostic);
	
	for($i=0; $i <= $hitung_soal - 1; $i++){
		$result = $this->Model_agcu->add_soal($iddiagnostic, $idmapel, $idbanksoal[$i]);
	}
	redirect('pg_admin/diagnostictest');
}
function hapus($iddiagnostic){
	$hapuskategori = $this->Model_agcu->hapuskategori($iddiagnostic);
	$hapussoal = $this->Model_agcu->hapus_soal_kategori($iddiagnostic);
	redirect('pg_admin/diagnostictest');
}

function manage_soal()
    {
        echo "disiani";
    }

}

?>