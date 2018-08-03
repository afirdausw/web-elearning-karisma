<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller {

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
		$this->model_security->psep_sekolah_is_logged_in();
  }

	public function index()
	{
		$data = array(
			'navbar_title' 	=> "Sekolah",
			'form_action' 	=> base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
			'table_data' 		=> $this->model_adm->fetch_all_sekolah()
			);

		$this->load->view('psep_sekolah/sekolah', $data);
	}

	public function manajemen($aksi)
	{
		//$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
		if($aksi)
		{
			//Trigger form submission validation rules
			$this->form_validation_rules();

			//Fetch select options from table in database

			switch ($aksi) {
				case 'tambah':
					$data = array(
					'navbar_title'		=> "Manajemen Sekolah",
					'page_title' 			=> "Tambah Sekolah",
					'form_action' 		=> current_url(),
					'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
					'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
					'select_kota' 		=> $this->model_adm->fetch_options_kota()
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_tambah();
					}
					else 
					{
						//No form is submitted. Displaying the form page
						$this->load->view('psep_sekolah/sekolah_form', $data);
					}
					break;
				
				case 'ubah':
					//Passing id value from GET '?id' to variable '$id'
					$id = $this->input->get('id') ? $this->input->get('id') : null ;
					
					$data = array(
					'navbar_title'		=> "Manajemen Sekolah",
					'page_title' 			=> "Ubah Sekolah",
					'form_action' 		=> current_url() . "?id=$id",
					'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
					'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
					'select_kota' 		=> $this->model_adm->fetch_options_kota()
					);

					//Redirect to kelas if id is not exist
					if(!$id)
					{
						redirect('psep_sekolah/sekolah');
					}
					else 
					{
						//Calling values from database by id and pass them to View
						//fetching kelas by id
						$data['data'] = $this->model_adm->fetch_sekolah_by_id($id);

						//Form submit handler. See if the user is attempting to submit a form or not
						if($this->input->post('form_submit')) 
						{
							//Form is submitted. Now routing to proses_tambah method
							$this->proses_ubah($id);
						}
						else 
						{
							//No form is submitted. Displaying the form page
							$this->load->view('psep_sekolah/sekolah_form', $data);
						}
					}
					break;

				case 'import':
					$data = array(
					'navbar_title'		=> "Manajemen Sekolah",
					'page_title' 			=> "Import Data Sekolah",
					'form_action' 		=> current_url()
					);

					//Form materi submit handler. See if the user is attempting to submit a form or not
					if($this->input->post('form_submit')) 
					{
						//Form is submitted. Now routing to proses_tambah method
						$this->proses_import();

					}
					else 
					{
						//No form is submitted. Displaying the form page
						$this->load->view('psep_sekolah/sekolah_import', $data);
					}
					break;

				
				default:
					redirect('psep_sekolah/sekolah');
					break;
			}
		}
		else
		{
			redirect('psep_sekolah/sekolah');
		}

	}

	public function proses_tambah()
	{
		//set the page title
		$data = array(
			'page_title' 			=> "Tambah Sekolah", 
			'form_action' 		=> current_url(),
			'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
			'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
			'select_kota' 		=> $this->model_adm->fetch_options_kota()

			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$nama_sekolah 	= $params['nama_sekolah'];
		$jenjang				= $params['jenjang'];
		$email					= $params['email'];
		$telepon				= $params['telepon'];
		$kota						= $params['kota'];
		$alamat_sekolah	= $params['alamat'];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal ditambahkan");
			$this->load->view('psep_sekolah/sekolah_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->add_sekolah($nama_sekolah, $jenjang, $email, $telepon, $kota, $alamat_sekolah);
			alert_success("Sukses", "Data berhasil ditambahkan");
			redirect('psep_sekolah/sekolah');
			// echo "Status Insert: " . $result;
		}	
	}

	public function proses_ubah($id)
	{
		//set the page title
		$data = array(
			'page_title' 			=> "Ubah Sekolah",
			'form_action' 		=> current_url(). "?id=$id",
			'select_jenjang' 	=> $this->model_adm->fetch_options_jenjang(),
			'select_provinsi' => $this->model_adm->fetch_options_provinsi(),
			'select_kota' 		=> $this->model_adm->fetch_options_kota()
			);

		//fetch input (make sure that the variable name is the same as column name in database!) 
		$params = $this->input->post(null, true);
		$nama_sekolah 	= $params['nama_sekolah'];
		$jenjang				= $params['jenjang'];
		$email					= $params['email'];
		$telepon				= $params['telepon'];
		$kota						= $params['kota'];
		$alamat_sekolah	= $params['alamat'];

		//run the validation
		if ($this->form_validation->run() == FALSE) 
		{
			alert_error("Error", "Data gagal diubah");
			$this->load->view('psep_sekolah/sekolah_form', $data);
		}
		else 
		{
			//passing input value to Model
			$result = $this->model_adm->update_sekolah($id, $nama_sekolah, $jenjang, $email, $telepon, $kota, $alamat_sekolah);
			alert_success("Sukses", "Data berhasil diubah");
			redirect('psep_sekolah/sekolah');
			// echo "Status Update: " . $result;
		}	
	}

	public function proses_import()
	{
		$data = array(
			'page_title' 			=> "Import Data Sekolah",
			'form_action' 		=> current_url()
			);

		$this->upload_config();

		if (!$this->upload->do_upload('import_data')) 
		{
			$errors = array('error' => $this->upload->display_errors());
			alert_error("Error", "Proses import data gagal");
			$this->load->view('psep_sekolah/sekolah_import', $data);
		}
		else
		{
			$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

			$media = $this->upload->data();
      $data_sekolah  = array();
      $inputFileName = 'assets/uploads/excel_files/'.$media['file_name'];

     	try {
     		$inputFileType = IOFactory::identify($inputFileName);
        $objReader     = IOFactory::createReader($inputFileType);
        $objPHPExcel   = $objReader->load($inputFileName);
      } 
      catch(Exception $e) {
        die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      for ($row = 2; $row <= $highestRow; $row++)
      { //  Read a row of data into an array                 
        $rowData = $sheet->rangeToArray(
        	'A' . $row . ':' . $highestColumn . $row,
          NULL,
          TRUE,
          FALSE
          );
        //Sesuaikan dengan nama kolom tabel di database                                
         if(!empty($rowData[0][0]) && !empty($rowData[0][1]))
         {
	         $data_sekolah[] = array(
	            "nama_sekolah"		=> $rowData[0][0],
	            "jenjang"					=> strtoupper($rowData[0][1]),
	            "alamat_sekolah"	=> $rowData[0][2],
	            "kota_id"					=> $rowData[0][3],
	            "email"						=> $rowData[0][4],
	            "telepon"					=> $rowData[0][5]
	        );
         }
             
      }

      $import = $this->model_adm->import_sekolah($data_sekolah);
      if($import){
      	alert_success('Sukses', "Data berhasil diimport!");
      }
    	redirect('psep_sekolah/sekolah');
      // echo "<pre>";
      // echo print_r($data_sekolah);
      // echo "</pre>";
      // die();
      //
      // delete_files($media['file_path']);

		}

	}

	public function proses_hapus()
	{

		if($this->input->post('deleteRow_submit'))
		{
			//set form validation rules 
			$this->form_validation->set_rules('hidden_row_id', "Nomor Baris", 'trim|required|numeric');

			if($this->form_validation->run())
			{
				$id 		= $this->input->post('hidden_row_id');
				$result = $this->model_adm->delete_sekolah($id);
				
				alert_success('Sukses', "Data berhasil dihapus");
				redirect('psep_sekolah/sekolah');
			}
		}
		
		alert_danger('Error', "Data gagal dihapus");
		redirect('psep_sekolah/sekolah');
	}

	function ajax_select_kota()
  {
    $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;
    
    if($id)
    {
      $dynamic_options = $this->model_adm->fetch_kota_by_provinsi($id);

      if($dynamic_options){
        echo "<option value=''></option>";
        foreach ($dynamic_options as $item) {
          echo "<option value='" . $item->id_kota . "'> $item->nama_kota </option>";
        }
      }
      else
      {
        echo "<option value=''></option>";
        echo "<option value='' disabled='disabled'>Tidak ada data</option>";
      }
    }
    else{
      return false;
    }
  }

	private function upload_config()
	{
		// $fileName = date("dmy_Hi")."_".$_FILES['import_data']['name'];
		$fileName = 'latest_upload';
	 	$config['upload_path']      = 'assets/uploads/excel_files';
    $config['file_name'] 				= $fileName;
    $config['allowed_types']    = 'xls|xlsx|csv';
    $config['max_size']         = 10000;
    $config['overwrite'] 			  = TRUE;

    $this->load->library('upload');
    $this->upload->initialize($config);
	}

	private function form_validation_rules()
	{
		//set validation rules for each input
		$this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('kota', 'Kota', 'trim|required');
		$this->form_validation->set_rules('jenjang', 'Jenjang', 'trim|required');
		
		//set custom error message
		$this->form_validation->set_message('required', '%s tidak boleh kosong');
	}

}
