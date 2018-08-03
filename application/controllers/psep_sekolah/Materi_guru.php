<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		//check user session

		//load library in construct. Construct method will be run everytime the controller is called
		//This library will be auto-loaded in every method in this controller.
		//So there will be no need to call the library again in each method.
		$this->load->library('form_validation');
		$this->load->helper('alert_helper');
		$this->load->helper('url_validation_helper');
		$this->load->model('model_adm');
		$this->load->model('model_adm1');
		$this->load->model('model_banksoal');
		$this->load->model('model_security');
		$this->load->model('model_psep');
		$this->model_security->psep_sekolah_is_logged_in();
	}


	public function index($kelas = 0, $mapel = 0, $mapok = 0, $page = 1)
	{
		$this->load->library('ajax_pagination');

		$limit = 10000;
		if ($page == 1) {
			$offset = 0;
		} else {
			$offset = ($page - 1) * $limit;
		}
		$idpsep = $this->session->userdata('idpsepsekolah');

		$cariidmapel = $this->model_psep->cari_sekolah_by_login($idpsep);

		if($cariidmapel->id_mapel == 0 ){
			$id_mapel = 20;
		}else{
			$id_mapel   = $cariidmapel->id_mapel;
		}

		$carikelas  = $this->model_psep->cari_kelas_by_mapel($id_mapel);


		$kelas      =  $carikelas->kelas_id;
		$mapel      =  $id_mapel;




		$carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
		$config['base_url'] = base_url() . 'psep_sekolah/materi_guru/tabel_ajax/' . $mapok ;
		$config['total_rows'] = $this->model_adm1->get_all_materi_query($kelas, $mapel, $mapok)->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$config['num_links'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['full_tag_open'] = "<ul class='pagination' style='width:100%;'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->ajax_pagination->initialize($config);

		$data = array(
			'navbar_title'         => "Materi",
			'form_action'          => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			//'data_tabel'           => $this->model_adm1->get_all_materi($kelas, $mapel, $mapok, $offset, $limit),
			'data_tabel'           => $this->model_adm1->get_all_materi($kelas, $mapel, $mapok, $offset, $limit),
			'paginator'            => $this->ajax_pagination->create_links(),
			'hal'                  => $page,
			'per'                  => $limit,
			'idkelas'              => $kelas,
			'idmapel'              => $mapel,
			'idmapok'              => $mapok,
			'select_options_kelas' => $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
			'carikelas' => $this->model_psep->cari_kelas_by_id_mapel($id_mapel),
			'carimapok' => $this->model_adm1->get_mapok_by_mapel($mapel)
		);

		$this->load->view('psep_sekolah/materi_guru', $data);
	}

	public function tabel_ajax($kelas = 0, $mapel = 0, $mapok = 0, $page = 1)
	{
		$this->load->library('ajax_pagination');

		$limit = 10000;
		if ($page == 1) {
			$offset = 0;
		} else {
			$offset = ($page - 1) * $limit;
		}

		$config['base_url'] = base_url() . 'psep_sekolah/materi/tabel_ajax/' . $kelas . '/' . $mapel . '/' . $mapok . '/';
		$config['total_rows'] = $this->model_adm1->get_all_materi_query($kelas, $mapel, $mapok)->num_rows();
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$config['num_links'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = '&gt;';
		$config['prev_link'] = '&lt;';
		$config['full_tag_open'] = "<ul class='pagination' style='width:100%;'>";
		$config['full_tag_close'] = "</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

		$this->ajax_pagination->initialize($config);

		if ($kelas > 0) {
			$carimapel = $this->model_banksoal->get_mapel_by_kelas($kelas);
		} else {
			$carimapel = '';
		}

		if ($kelas > 0 && $mapel > 0) {
			$carimapok = $this->model_adm1->get_mapok_by_mapel($mapel);
		} else {
			$carimapok = '';

		}

		$data = array(
			'data_tabel'           => $this->model_adm1->get_all_materi($kelas, $mapel, $mapok, $offset, $limit),
			'paginator'            => $this->ajax_pagination->create_links(),
			'hal'                  => $page,
			'per'                  => $limit,
			'idkelas'              => $kelas,
			'idmapel'              => $mapel,
			'idmapok'              => $mapok,
			'carimapel'            => $carimapel,
			'carimapok'            => $carimapok,
			'select_options_kelas' => $this->model_banksoal->get_kelas(),
		);

		$this->load->view('psep_sekolah/materi_guru_ajaxpage', $data);
	}


	public function manajemen($aksi,$mapok = 0)
	{
		//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if ($aksi) {
			//Trigger form submission validation rules
			$this->form_validation_rules();

			switch ($aksi) {
				case 'tambah':

					$idpsep = $this->session->userdata('idpsepsekolah');

					$cariidmapel = $this->model_psep->cari_sekolah_by_login($idpsep);

					$id_mapel   = $cariidmapel->id_mapel;

					$carikelas  = $this->model_psep->cari_kelas_by_mapel($id_mapel);

					$kelas      =  $carikelas->kelas_id;
					$mapel      =  $id_mapel;



					$data = array(
						'navbar_title'                => "Manajemen Materi",
						'page_title'                  => "Tambah Materi",
						'form_action'                 => current_url(),
						'carikelas' => $this->model_psep->cari_kelas_by_id_mapel($id_mapel),
						'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
						'select_options_materi_pokok' => $this->model_adm->fetch_options_materi(),
						'carimapok'                   => $this->model_adm1->get_mapok_by_mapel($mapel),
						'idmapok'              => $mapok,
						'idmapel'              => $mapel,
						'idkelas'              => $kelas,
						'jumlah_soal_submateri'       => 0,
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if ($this->input->post('form_submit')) {
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_tambah();
					} else {
						//No form is submitted. Displaying the form page
						$this->load->view('psep_sekolah/materi_guru_form', $data);
						//var_dump($data['carimapok']);
					}
					break;

				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null;

					$idpsep = $this->session->userdata('idpsepsekolah');

					$cariidmapel = $this->model_psep->cari_sekolah_by_login($idpsep);

					$id_mapel   = $cariidmapel->id_mapel;

					$carikelas  = $this->model_psep->cari_kelas_by_mapel($id_mapel);

					$kelas      =  $carikelas->kelas_id;
					$mapel      =  $id_mapel;

					$data = array(
						'navbar_title'                => "Manajemen Materi",
						'page_title'                  => "Ubah Materi",
						'form_action'                 => current_url() . "?id=$id",
						'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
						'select_options_materi_pokok' => $this->model_adm->fetch_options_materi(),
						'jumlah_soal_submateri'       => $this->model_adm->fetch_jumlah_soal($id),
						'data_soal_submateri'         => $this->model_adm->fetch_soal_by_submateri($id),
						'carimapok'                   => $this->model_adm1->get_mapok_by_mapel($mapel),
						'idmapok'              => $mapok,
						'idmapel'              => $mapel,
						'idkelas'              => $kelas,
					);

					//Redirect to materi if id is not exist
					if (!$id) {
						redirect('psep_sekolah/materi_guru');
					} else {
						//Calling values from database by id and pass them to View
						//fetching konten_materi by id
						$data['data'] = $this->fetch_materi_by_id($id);
						$data['data_soal'] = $this->model_adm->fetch_soal_by_id($id);
						// var_dump($data['data_soal']);

						//Form materi submit handler. See if the user is attempting to submit a form or not
						if ($this->input->post('form_submit')) {
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						} else {
							//No form is submitted. Displaying the form page
							$this->load->view('psep_sekolah/materi_guru_form', $data);
						}
					}
					break;

				default:
					redirect('psep_sekolah/materi_guru');
					break;
			}
		} else {
			redirect('psep_sekolah/materi_guru');
		}

	}


	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title'                  => "Tambah Materi",
			'form_action'                 => current_url(),
			'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
			'select_options_materi_pokok' => $this->model_adm->fetch_options_materi(),
		);

		//fetch input (make sure that the variable name is the same as column name in database!)
		$params = $this->input->post(null, false);
		$kategori = $params['kategori_materi'];
		$mapel_id = $params['nama_mapel'];
		$materi_pokok_id = $params['materi_pokok'];
		$nama_sub_materi = $params['judul_materi'];
		$deskripsi_sub_materi = isset($params['deskripsi_materi']) ? $params['deskripsi_materi'] : '';
		// $deskripsi_sub_materi  = '';
		$isi_materi = $params['konten_materi'];
		$video_materi = valid_url($params['konten_video']) ? $params['konten_video'] : '';
		$gambar_materi = $params['gambar_materi'];
		$tanggal = $params['tanggal_post'];
		$waktu = $params['waktu_post'];
		$max = $this->model_adm->select_max('sub_materi', 'urutan_materi');
		$urutan_materi = ($max->urutan_materi + 1);

		//fetch input for soal
		if ($kategori == 3) {
			$isi_soal = $params['isi_soal'];
			$kunci_jawaban = $params['kunci_jawaban'] ? $params['kunci_jawaban'] : 1;
			$jawab_1 = $params['jawab_1'];
			$jawab_2 = $params['jawab_2'];
			$jawab_3 = $params['jawab_3'];
			$jawab_4 = $params['jawab_4'];
			$jawab_5 = $params['jawab_5'];
			$pembahasan = $params['pembahasan'];
			$pembahasan_video = valid_url($params['pembahasan_video']) ? $params['pembahasan_video'] : '';
		}

		//run the validation
		if ($this->form_validation->run() == FALSE) {
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('psep_sekolah/materi_form', $data);
		} else {
			//passing input value to Model
			$insert_id = $this->model_adm->add_materi($kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $deskripsi_sub_materi, $isi_materi, $video_materi, $gambar_materi, $tanggal, $waktu, $urutan_materi);

			//continue passing soal input value to Model
			if ($insert_id && $kategori == 3) {
				$result = $this->model_adm->add_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $insert_id, $pembahasan, $pembahasan_video);
			}

			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('psep_sekolah/materi_guru');
			// echo "Status Insert: " . $result;
		}
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title'                  => "Ubah Materi",
			'form_action'                 => current_url() . "?id=$id",
			'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
			'select_options_materi_pokok' => $this->model_adm->fetch_options_materi(),
		);

		//fetch input (make sure that the variable name is the same as column name in database!)
		$params = $this->input->post(null, false);
		$kategori = $params['kategori_materi'];
		$mapel_id = $params['nama_mapel'];
		$materi_pokok_id = $params['materi_pokok'];
		$nama_sub_materi = $params['judul_materi'];
		$deskripsi_sub_materi = isset($params['deskripsi_materi']) ? $params['deskripsi_materi'] : '';
		// $deskripsi_sub_materi    = '';
		$isi_materi = $params['konten_materi'];
		$video_materi = valid_url($params['konten_video']) ? $params['konten_video'] : '';
		$gambar_materi = $params['gambar_materi'];
		$tanggal = $params['tanggal_post'];
		$waktu = $params['waktu_post'];

		//fetch input for soal
		if ($kategori == 3) {
			$id_soal_array = explode(',', $this->input->post('id_soal_array'));
			$ke = 1;
			foreach ($id_soal_array as $id_soal) {
				if ($id_soal == 0) {
					$ke = '';
				}
				$isi_soal = $params['isi_soal' . $ke];
				$jawab_1 = $params['jawab_1' . $ke];
				$jawab_2 = $params['jawab_2' . $ke];
				$jawab_3 = $params['jawab_3' . $ke];
				$jawab_4 = $params['jawab_4' . $ke];
				$jawab_5 = $params['jawab_5' . $ke];
				$kunci_jawaban = $params['kunci_jawaban' . $ke] ? $params['kunci_jawaban' . $ke] : 1;
				$pembahasan = $params['pembahasan' . $ke];
				$pembahasan_video = valid_url($params['pembahasan_video' . $ke]) ? $params['pembahasan_video' . $ke] : '';

				if ($id_soal != 0) {
					$this->model_adm->update_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $pembahasan, $pembahasan_video, $id_soal);
					$ke++;
				} else if ($id_soal == 0) {
					$sub_materi_id = $this->input->get('id') ? $this->input->get('id') : null;
					$this->model_adm->add_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $sub_materi_id, $pembahasan, $pembahasan_video);
				}
			}
		}

		//run the validation
		if ($this->form_validation->run() == FALSE) {
			alert_error("Error", "Data gagal diubah");
			$this->load->view('psep_sekolah/materi_form', $data);
		} else {
			//passing input value to Model
			$result = $this->model_adm->update_materi($id, $kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $deskripsi_sub_materi, $isi_materi, $video_materi, $gambar_materi, $tanggal, $waktu);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('psep_sekolah/materi_guru');
			// echo "Status Update: " . $result;
		}
	}

	public function proses_hapus()
	{

		if ($this->input->post('deleteRow_submit')) {
			//set form validation rules
			$this->form_validation->set_rules('hidden_row_id', "Nomor Baris", 'trim|required|numeric');

			if ($this->form_validation->run()) {
				$id = $this->input->post('hidden_row_id');
				$result = $this->model_adm->delete_materi($id);

				alert_success('Sukses', "Data berhasil dihapus");
				redirect('psep_sekolah/materi');
			}
		}

		alert_danger('Error', "Data gagal dihapus");
		redirect('psep_sekolah/materi');
	}

	function preview_konten($sub_materi_id)
	{
		if ($sub_materi_id) {
			$data['content_preview'] = $this->model_adm->fetch_content_by_id($sub_materi_id);
			$gambar_materi = isset($data['content_preview']->gambar_materi) ? $data['content_preview']->gambar_materi : '';
			$data['thumbnail_dir'] = base_url('') . "assets/img/no-image.jpg";

			if ($gambar_materi) {
				$data['thumbnail_dir'] = base_url('') . "assets/js/plugins/kcfinder/upload/images/" . $data['content_preview']->gambar_materi;
			}

			$this->load->view('preview/content_preview', $data);
		} else {
			redirect('psep_sekolah/materi');
		}
	}

	function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('kategori_materi', 'Kategori Materi', 'trim|required');
		$this->form_validation->set_rules('nama_mapel', 'Mata Pelajaran', 'trim|required');
		$this->form_validation->set_rules('materi_pokok', 'Materi Pokok', 'trim|required');
		$this->form_validation->set_rules('judul_materi', 'Judul Materi', 'trim|required');
		// $this->form_validation->set_rules('deskripsi_materi', 'Deskripsi Materi', 'trim');
		// $this->form_validation->set_rules('konten_materi', 'Konten Materi', 'required');
		$this->form_validation->set_rules('tanggal_post', 'Tanggal Post', 'trim|required');
		$this->form_validation->set_rules('waktu_post', 'Waktu Post', 'trim|required');

		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

	function fetch_materi_by_id($id)
	{
		$data = new stdClass();
		$table_data = $this->model_adm->fetch_materi_by_id($id);
		$table_fields = $this->model_adm->get_table_fields('mata_pelajaran', 'materi_pokok', 'sub_materi', 'konten_materi');
		//tester
		// var_dump($table_data);
		// var_dump($table_fields);
		if ($table_data) {
			foreach ($table_fields as $field) {
				$data->{$field} = $table_data->{$field} ? $table_data->{$field} : '';
				// echo "$field -> " . ${$field} . ", ";
			}
		} else {
			$data = null;
		}

		return $data;
	}

	function ajax_select_materi_pokok()
	{
		$id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

		if ($id) {
			$dynamic_options = $this->model_adm->fetch_materi_pokok_by_mapel($id);

			if ($dynamic_options) {
				foreach ($dynamic_options as $item) {
					echo "<option value=''></option>";
					echo "<option value='" . $item->id_materi_pokok . "'> $item->nama_materi_pokok </option>";
				}
			} else {
				echo "<option value=''></option>";
				echo "<option value='' disabled='disabled'>Tidak ada data</option>";
			}
		} else {
			return false;
		}
	}

	function ajax_status_materi()
	{
		$target = $this->input->post('target_name');
		$state = $this->input->post('state'); // (0)free : (1)berbayar

		$id_sub = $target;

		$result = $this->model_adm->set_status_materi($id_sub, $state);

		echo "target: $id_sub, state: $state, resultDB: $result";
	}

	function ajax_datatables()
	{
		// $fields = array('alias_kelas', 'nama_mapel', 'nama_materi_pokok', 'nama_sub_materi', 'kategori');
		$fields = array('id_sub_materi', 'nama_sub_materi', 'status_materi', 'alias_kelas', 'nama_mapel', 'nama_materi_pokok', 'kategori');
		$request_data = $_REQUEST;
		$totalfiltered = $request_data['length'];
		$columns = array('', 'alias_kelas', 'nama_mapel', 'nama_materi_pokok', 'nama_sub_materi', 'kategori', '', '');
		$filterColumn = $columns[$request_data['order'][0]['column']];
		$table_data = $this->model_adm->fetch_ajax_materi($fields, $totalfiltered, $filterColumn, $request_data);
		$totaldata = count($this->model_adm->fetch_all_materi());
		$totalFiltered = $totaldata;
		if (!empty($request_data['search']['value'])) {
			$totalFiltered = count($totaldata);
		}
		// $totalfiltered = $totaldata;
		// echo "<pre>";
		// print_r($_REQUEST);
		// print_r($table_data);
		// echo "</pre>";
		// die();


		$row = array();
		$no = $request_data['start'] + 1;
		foreach ($table_data as $item) {
			$row[] = array(
				"no"                => $no,
				"alias_kelas"       => $item->alias_kelas,
				"nama_mapel"        => $item->nama_mapel,
				"nama_materi_pokok" => $item->nama_materi_pokok,
				"nama_sub_materi"   => $item->nama_sub_materi,
				"kategori"          => $item->kategori,
				"daftar_soal"       => base_url(),
				"aksi"              => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
				"id_sub_materi"     => $item->id_sub_materi,
				"status_materi"     => $item->status_materi,
			);
			// $row[] = $no;
			$no++;
		}

		//      echo "<pre>";
		//     print_r($row);
		//     echo "</pre>";
		//     die();

		$json_data = array(
			"draw"            => intval($_REQUEST['draw']),
			"recordsTotal"    => intval($totaldata),
			"recordsFiltered" => intval($totalFiltered),
			"data"            => $row,
		);
		echo json_encode($json_data);
	}

	function ajax_mapel($kelas)
	{
		$carimapel = $this->model_banksoal->get_mapel_by_kelas($kelas);

		echo "<option value=''>-- pilih mata pelajaran --</option>";
		foreach ($carimapel as $mapel) {
			?>
			<option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
			<?php
		}
	}


}
