<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agcu_soal extends CI_Controller {
	public function __construct() {
		parent::__construct();
			
		$this->load->helper('security');
		$this->load->library('form_validation');
		$this->load->model('model_agcusoal');
		$this->load->model('model_security');
		$this->Model_security->is_logged_in();
	}
	
	public function index() {
		$this->load->view('pg_admin/agcusoal');
	}

	public function detail($test='') {
		if(empty($test)) {
			$this->load->view('pg_admin/agcusoal');
		} else {
			$data = array(
				'test_name' => ($test == 'diagnostic' ? 'Diagnostic Test' : ($test == 'psychology_potential' ? 'Psychology Potential' : 'Learning Style'))
			);

			if($test == 'diagnostic') {
				$data['table_data'] = $this->Model_agcusoal->get_soal('ls_test2')->result_array();
			} else if($test == 'psychology_potential') {
				$data['table_data'] = $this->Model_agcusoal->get_soal('eq_test')->result_array();
			} else if($test == 'learning_style') {
				$data['table_data'] = $this->Model_agcusoal->get_soal('ls_test1')->result_array();
			}

			$this->load->view('pg_admin/agcusoal_detail', $data);
		}
	}

	public function edit($test='',$id='') {
		if(empty($test) || empty($id)) {
			$this->load->view('pg_admin/agcusoal');
		} else {
			$data = array(
				'page_title' => ($test == 'diagnostic' ? 'Ubah Soal Diagnostic Test' : ($test == 'psychology_potential' ? 'Ubah Soal Psychology Potential' : 'Ubah Soal Learning Style')),
				'test_name' => $test
			);

			if($test == 'diagnostic') {
				$data['row'] = $this->Model_agcusoal->get_soal_by_id('ls_test2', array('id_soal_ls2' => $id))->row();
				$data['idsoal'] = $data['row']->id_soal_ls2;
				$data['jumsoal'] = 2;
			} else if($test == 'psychology_potential') {
				$data['row'] = $this->Model_agcusoal->get_soal_by_id('eq_test', array('id_soal_eq' => $id))->row();
				$data['idsoal'] = $data['row']->id_soal_eq;
				$data['jumsoal'] = 4;
			} else if($test == 'learning_style') {
				$data['row'] = $this->Model_agcusoal->get_soal_by_id('ls_test1', array('id_soal_ls' => $id))->row();
				$data['idsoal'] = $data['row']->id_soal_ls;
				$data['jumsoal'] = 3;
			}

			$this->load->view('pg_admin/agcusoal_edit', $data);
		}
	}

	public function do_edit() {
		$test = $this->security->sanitize_filename($this->input->post('test'));
		$id = $this->security->sanitize_filename($this->input->post('id'));
		$soal = $this->security->sanitize_filename($this->input->post('soal'));
		$jawabA = $this->security->sanitize_filename($this->input->post('jawabA'));
		$skorA = $this->security->sanitize_filename($this->input->post('skorA'));
		$jawabB = $this->security->sanitize_filename($this->input->post('jawabB'));
		$skorB = $this->security->sanitize_filename($this->input->post('skorB'));
		$jawabC = $this->security->sanitize_filename($this->input->post('jawabC'));
		$skorC = $this->security->sanitize_filename($this->input->post('skorC'));
		$jawabD = $this->security->sanitize_filename($this->input->post('jawabD'));
		$skorD = $this->security->sanitize_filename($this->input->post('skorD'));

		if($test == 'diagnostic') {
			$data = array('soal' => $soal, 'jawab_a' => $jawabA, 'jawab_b' => $jawabB, 'skor_a' => $skorA, 'skor_b' => $skorB);

			$update = $this->Model_agcusoal->update_soal_by_id('ls_test2', $data, array('id_soal_ls2' => $id));
		} else if($test == 'psychology_potential') {
			$data = array('soal' => $soal, 'jawab_a' => $jawabA, 'jawab_b' => $jawabB, 'jawab_c' => $jawabC, 'jawab_d' => $jawabD, 'skor_a' => $skorA, 'skor_b' => $skorB, 'skor_c' => $skorC, 'skor_d' => $skorD);

			$update = $this->Model_agcusoal->update_soal_by_id('eq_test', $data, array('id_soal_eq' => $id));
		} else if($test == 'learning_style') {
			$data = array('soal' => $soal, 'jawab_a' => $jawabA, 'jawab_b' => $jawabB, 'jawab_c' => $jawabC, 'skor_a' => $skorA, 'skor_b' => $skorB, 'skor_c' => $skorC);

			$update = $this->Model_agcusoal->update_soal_by_id('ls_test1', $data, array('id_soal_ls1' => $id));
		}
	}
}