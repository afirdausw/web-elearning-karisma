<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instruktur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //check user session

        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        //$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_security');
        $this->load->model('model_banksoal');
        $this->load->model('model_pg');
        $this->load->model('model_psep');
        $this->model_security->is_logged_in();

        //global variable
        $slug = $this->router->fetch_class();
        $this->gVar = array(
            "slug"      => $slug,
            "title"     => ucwords(strtolower($slug)),
        );


    }

    public function index()
    {
        $gVar = $this->gVar;
        redirect("pg_admin/{$gVar['slug']}/daftar/");
    }

    public function daftar($aksi="",$id_instruktur="")
    {
        $gVar = $this->gVar;
        $data = array(
            "basic_info"      => $gVar,
            "main_title"    => "Semua {$gVar['title']}",
            "navbar_title"    => "Daftar {$gVar['title']}",
            "form_action"     => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
            "data_materi_pokok"    => $this->model_adm->fetch_all_table_data("materi_pokok"),
            "data_instruktur" => $this->model_adm->fetch_all_table_data("{$gVar['slug']}"),
        );
        if(!empty($aksi)){
            switch($aksi):
                case "mapel":
                    if(!empty($id_instruktur)){
                        $where = array(
                            "id_instruktur" => "{$id_instruktur}",
                        );
                        $data["data_instruktur_main"] = $this->model_adm->fetch_all_table_data("instruktur", $where);

                        $where = array(
                            "instruktur_mapel.id_instruktur" => "{$id_instruktur}",
                        );
                        $joinArray = array(
                            array("instruktur", "instruktur_mapel.id_instruktur = instruktur.id_instruktur", ""),
                            array('mata_pelajaran', "instruktur_mapel.id_mapel = mata_pelajaran.id_mapel", ""),
                        );
                        $data["table_fields"] = array(
                            "id_mapel",
                            "nama_mapel",
                            "gambar_mapel",
                        );
                        $data["main_title"] = "Semua Materi Pelajaran";
                        $data["navbar_title"] = "{$data['data_instruktur_main'][0]->nama_instruktur}";
                        $data["data_instruktur"] = $this->model_adm->fetch_all_table_data("instruktur_mapel", $where, "=", "*" , $joinArray);
                    }
                break;
                default:
                    redirect("pg_admin/{$gVar['slug']}");
                break;
            endswitch;
        }

        $this->load->view("pg_admin/{$gVar['slug']}_daftar", $data);
    }

    public function manajemen($aksi, $id_instruktur = "")
    {
        $gVar = $this->gVar;
        //$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
        if ($aksi) {
            //Trigger form submission validation rules
            switch ($aksi) {
                case "tambah":
                    $this->form_validation_rules();
                    $data = array(
                        "basic_info"      => $gVar,
                        "navbar_title"    => "Manajemen {$gVar['title']}",
                        "page_title"      => "Tambah {$gVar['title']}",
                        "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
                        "form_action"     => current_url(),
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if ($this->input->post()) {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah();
                    } else {
                        //No form is submitted. Displaying the form page
                        $this->load->view("pg_admin/{$gVar['slug']}_form", $data);
                    }
                    break;

                case "ubah":
                    $this->form_validation_rules();
                    //Passing id value from GET "?id" to variable "$id"
                    $id = $this->input->get("id") ? $this->input->get("id") : null;

                    //Redirect to instruktur if id is not exist
                    if (!$id) {
                        redirect("pg_admin/{$gVar['slug']}");
                    } else {
                        $data = array(
                            "basic_info"      => $gVar,
                            "navbar_title"    => "Manajemen {$gVar['title']}",
                            "page_title"      => "Ubah {$gVar['title']}",
                            "form_action"    => current_url() . "?id=$id",
                            "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
                            "data_instruktur"     => $this->model_adm->fetch_instruktur_by_id($id),
                        );

                        //Form submit handler. See if the user is attempting to submit a form or not
                        if ($this->input->post()) {
                            //Form is submitted. Now routing to proses_tambah method
                            $this->proses_ubah($id);
                        } else {
                            //No form is submitted. Displaying the form page
                            $this->load->view("pg_admin/{$gVar['slug']}_form", $data);
                        }
                    }
                    break;
                case "mapel":
                    if(!empty($id_instruktur)){
                        $where = array(
                            "id_instruktur" => "{$id_instruktur}",
                        );
                        $data_instruktur = $this->model_adm->fetch_instruktur_by_id($id_instruktur);
                        $table_fields = array("id_mapel", "nama_mapel", "gambar_mapel", "harga");
                        $data = array(
                            "basic_info"      => $gVar,
                            "navbar_title"      => "Materi Pelajaran",
                            "main_title"    => "{$data_instruktur->nama_instruktur}",
                            "page_title"      => "Ubah {$gVar['title']}",
                            "form_action"    => current_url(),
                            "table_fields"    => $table_fields,
                            "data_instruktur"     => $data_instruktur,
                            "data_mapel"     =>  $this->model_adm->fetch_all_table_data("mata_pelajaran"),                            
                            "data_instruktur_mapel"     => $this->model_adm->fetch_all_table_data("instruktur_mapel", $where),
                        );



                        //Form submit handler. See if the user is attempting to submit a form or not
                        if ($this->input->post("submit_batch") == TRUE) {
                            //Form is submitted. Now routing to proses_tambah method
                            $this->proses_mapel($id_instruktur);
                        } else {
                            //No form is submitted. Displaying the form page
                            $this->load->view("pg_admin/{$gVar['slug']}_form_mapel", $data);
                        }
                    }else{
                        redirect("pg_admin/{$gVar['slug']}");
                    }

                break;

                default:
                    redirect("pg_admin/{$gVar['slug']}");
                break;
            }
        } else {
            redirect("pg_admin/{$gVar['slug']}");
        }

    }

    public function proses_tambah()
    {
        $gVar = $this->gVar;
        //set the page title
        $data = array(
            "basic_info"      => $gVar,
            "page_title"     => "Pendaftaran Siswa",
            "form_action"    => current_url(),
            "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
        );

        $file_element_name = "foto";

        if (isset($_FILES[$file_element_name]['name']) && $_FILES[$file_element_name]['name'] != "") {
            $config['upload_path'] = './image/instruktur/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['remove_spaces'] = TRUE;  //it will remove all spaces
            $config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name)) {
                $error = array('error' => $this->upload->display_errors());
                alert_error('danger', ul($error));
            } else {
                $data_upload = $this->upload->data();
                $gambar_instruktur = $data_upload['file_name'];
            }
        } else {
            $gambar_instruktur = null;
        }

        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, true);
        // var_dump($params);
        $params["foto"] = $gambar_instruktur;

        // //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view("pg_admin/{$gVar['slug']}_form", $data);
        } else {
            //passing input value to Model
            $result = $this->model_adm->add_instruktur($params);
            alert_success("Sukses", "Data berhasil ditambahkan");
            redirect("pg_admin/{$gVar['slug']}");
        }
    }

    public function proses_ubah($id)
    {
        $gVar = $this->gVar;
        //set form validation rules
        $id = $this->input->get("id");

        if ($id!=null) {
            $where = array("id_instruktur" => $id);
            $data_instruktur = $this->model_adm->fetch_all_table_data("{$gVar['slug']}", $where)[0];
            
            if($data_instruktur !== null){
                unlink("image/{$gVar['slug']}/" . $data_instruktur->foto);
            }

            $file_element_name = "foto";

            if (isset($_FILES[$file_element_name]['name']) && $_FILES[$file_element_name]['name'] != "") {
                $config['upload_path'] = './image/instruktur/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $config['encrypt_name'] = TRUE;   //it wil encrypte the original file name
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($file_element_name)) {
                    $error = array('error' => $this->upload->display_errors());
                    alert_error('danger', ul($error));
                } else {
                    $data_upload = $this->upload->data();
                    $gambar_instruktur = $data_upload['file_name'];
                }
            } else {
                $gambar_instruktur = null;
            }

            //fetch input (make sure that the variable name is the same as column name in database!)
            $params = $this->input->post(null, true);
            $params["foto"] = $gambar_instruktur;
            $this->model_adm->update_instruktur($params, $id);
            alert_success("Sukses", "Data berhasil diupdate");
        }else{
            alert_error("Error", "Data gagal diupdate");
        }
        redirect("pg_admin/{$gVar['slug']}");
    }

    public function proses_hapus()
    {
        $gVar = $this->gVar;
        //set form validation rules
        $id = $this->input->get("id");

        if ($id!=null) {
            $where = array("id_instruktur" => $id);
            $data_instruktur = $this->model_adm->fetch_all_table_data("{$gVar['slug']}", $where)[0];
            if($data_instruktur !== null){
                unlink("image/{$gVar['slug']}/" . $data_instruktur->foto);
            }
            $this->model_adm->delete_instruktur($id);
            alert_success("Sukses", "Data berhasil dihapus");
        }else{
            alert_error("Error", "Data gagal dihapus");
        }
        redirect("pg_admin/{$gVar['slug']}");
    }

    public function proses_mapel($id_instruktur){
        $where = array(
            "id_instruktur" => "{$id_instruktur}",
        );
        $act = $this->model_adm->delete_instruktur_mapel($where);

        if($act){
            $data_insert = array();
            $params = $this->input->post(null, true);
            if(!empty($params['id_mapel'])){
                foreach($params['id_mapel'] as $key=>$val):
                    $data_insert[] = array(
                        "id_instruktur" => $id_instruktur,
                        "id_mapel" => $key,
                    );
                endforeach;
                $act = $this->model_adm->add_instruktur_mapel($data_insert);
            }
        }
        redirect("pg_admin/instruktur/manajemen/mapel/{$id_instruktur}");
    }

    private function form_validation_rules()
    {
        //set validation rules for each input
        $this->form_validation->set_rules('nama_instruktur', 'Nama Instruktur', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|numeric|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }
}
