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

    public function daftar()
    {
        $gVar = $this->gVar;
        $data = array(
            "basic_info"      => $gVar,
            "navbar_title"    => "Daftar {$gVar['title']}",
            "form_action"     => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
            "data_instruktur"      => $this->model_adm->fetch_all_table_data("{$gVar['slug']}"),
        );

        $this->load->view("pg_admin/{$gVar['slug']}_daftar", $data);
    }

    public function manajemen($aksi)
    {
        $gVar = $this->gVar;
        //$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
        if ($aksi) {
            //Trigger form submission validation rules
            $this->form_validation_rules();

            switch ($aksi) {
                case "tambah":
                    $data = array(
                        "basic_info"      => $gVar,
                        "navbar_title"    => "Manajemen {$gVar['title']}",
                        "page_title"      => "Tambah {$gVar['title']}",
                        "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
                        "form_action"     => current_url(),
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if ($this->input->post("form_submit")) {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah();
                    } else {
                        //No form is submitted. Displaying the form page
                        $this->load->view("pg_admin/{$gVar['slug']}_form", $data);
                    }
                    break;

                case "ubah":
                    //Passing id value from GET "?id" to variable "$id"
                    $id = $this->input->get("id") ? $this->input->get("id") : null;

                    $data = array(
                        "basic_info"      => $gVar,
                        "navbar_title"    => "Manajemen {$gVar['title']}",
                        "page_title"      => "Ubah {$gVar['title']}",
                        "form_action"    => current_url() . "?id=$id",
                        "table_fields"    => $this->model_adm->get_table_fields("{$gVar['slug']}"),
                        "data_instruktur"     => $this->model_adm->fetch_instruktur_by_id($id),
                    );

                    //Redirect to instruktur if id is not exist
                    if (!$id) {
                        redirect("pg_admin/{$gVar['slug']}");
                    } else {
                        //Calling values from database by id and pass them to View
                        //fetching instruktur by id
                        $data["data"] =  $this->model_adm->fetch_instruktur_by_id($id);

                        //Form submit handler. See if the user is attempting to submit a form or not
                        if ($this->input->post("form_submit")) {
                            //Form is submitted. Now routing to proses_tambah method
                            $this->proses_ubah($id);
                        } else {
                            //No form is submitted. Displaying the form page
                            $this->load->view("pg_admin/{$gVar['slug']}_form", $data);
//                            var_dump($data);
//                            echo json_encode($data);
                        }
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
        //set the page title
        $data = array(
            "page_title"     => "Pendaftaran Siswa",
            "form_action"    => current_url(),
            "select_sekolah" => $this->model_adm->fetch_all_sekolah(),
            "select_options" => $this->model_adm->fetch_all_kelas()
        );

        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, true);
        $nama = $params['nama'] ? $params['nama'] : '';
        $nis = $params['nis'] ? $params['nis'] : '';
        $nisn = $params['nisn'] ? $params['nisn'] : '';
        $username = $params['username'] ? $params['username'] : '';
        $email = $params['email'] ? $params['email'] : '';
        $telepon = $params['telepon'] ? $params['telepon'] : '';
        $telepon_ortu = $params['telepon_ortu'] ? $params['telepon_ortu'] : '';
        $alamat = $params['alamat'] ? $params['alamat'] : '';
        $sekolah_id = $params['sekolah'] ? $params['sekolah'] : '';
        $kelas = $params['kelas'] ? $params['kelas'] : '';
        $password_raw = $params['password'] ? $params['password'] : $nisn;
        $password = $password_raw;
        //$tambah_sekolah   = $params['tambah_sekolah'] ? $params['tambah_sekolah'] : null;

        if (!empty($tambah_sekolah)) {
            $jenjang = $this->model_adm->fetch_kelas_by_id($kelas)->jenjang;
            $insert_id = $this->model_adm->add_quick_sekolah($tambah_sekolah, $jenjang);
            $sekolah_id = $insert_id;
        }

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view("pg_admin/siswa_form", $data);
        } else {
            //passing input value to Model
            $result = $this->model_adm->add_siswa($nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas, $nisn, $nis, $username, $password);
            alert_success("Sukses", "Data berhasil ditambahkan");
            redirect("pg_admin/siswa");
            // echo "Status Insert: " . $result;
        }
    }

    public function proses_ubah($id)
    {
        //set the page title
        $data = array(
            "page_title"     => "Ubah Data Siswa",
            "select_sekolah" => $this->model_adm->fetch_all_sekolah(),
            "select_options" => $this->model_adm->fetch_all_kelas(),
            "form_action"    => current_url() . "?id=$id"
        );

        $siswa = $this->model_adm->fetch_siswa_by_id($id);
        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, true);
        $nama = $params['nama'] ? $params['nama'] : $siswa->nama;
        $nis = $params['nis'] ? $params['nis'] : $siswa->nis;
        $nisn = $params['nisn'] ? $params['nisn'] : $siswa->nisn;
        $email = $params['email'] ? $params['email'] : $siswa->email;
        $telepon = $params['telepon'] ? $params['telepon'] : $siswa->telepon;
        $telepon_ortu = $params['telepon_ortu'] ? $params['telepon_ortu'] : $siswa->telepon_ortu;
        $alamat = $params['alamat'] ? $params['alamat'] : $siswa->alamat;
        $sekolah_id = $params['sekolah'] ? $params['sekolah'] : $siswa->sekolah_id;
        $kelas = $params['kelas'] ? $params['kelas'] : $siswa->kelas;
        $username = $params['username'] ? $params['username'] : $siswa->username;
        $password_raw = $params['password'] ? md5($params['password']) : $siswa->password;
        $password = $password_raw;
        //$tambah_sekolah	= $params['tambah_sekolah'] ? $params['tambah_sekolah'] : null;
        if (!empty($tambah_sekolah)) {
            $jenjang = $this->model_adm->fetch_kelas_by_id($kelas)->jenjang;
            $insert_id = $this->model_adm->add_quick_sekolah($tambah_sekolah, $jenjang);
            $sekolah_id = $insert_id;
        }

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal diubah");
            $this->load->view("pg_admin/siswa_form", $data);
        } else {
            //passing input value to Model
            $result = $this->model_adm->update_siswa($id, $nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas, $nisn, $nis,$username,$username,$password);
            alert_success("Sukses", "Data berhasil diubah");
            redirect("pg_admin/siswa");
            // echo "Status Update: " . $result;
        }
    }

    public function proses_ubah_aktif($id)
    {
        //set the page title
        $data = array(
            "page_title"     => "Ubah Data Siswa",
            "select_sekolah" => $this->model_adm->fetch_all_sekolah(),
            "select_options" => $this->model_adm->fetch_all_kelas(),
            "form_action"    => current_url() . "?id=$id"
        );

        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, true);
        $nama = $params['nama'] ? $params['nama'] : '';
        $email = $params['email'] ? $params['email'] : '';
        $telepon = $params['telepon'] ? $params['telepon'] : '';
        $telepon_ortu = $params['telepon_ortu'] ? $params['telepon_ortu'] : '';
        $alamat = $params['alamat'] ? $params['alamat'] : '';
        $sekolah_id = $params['sekolah'] ? $params['sekolah'] : '';
        $kelas = $params['kelas'] ? $params['kelas'] : '';
        //$tambah_sekolah	= $params['tambah_sekolah'] ? $params['tambah_sekolah'] : null;

        if (!empty($tambah_sekolah)) {
            $jenjang = $this->model_adm->fetch_kelas_by_id($kelas)->jenjang;
            $insert_id = $this->model_adm->add_quick_sekolah($tambah_sekolah, $jenjang);
            $sekolah_id = $insert_id;
        }

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal diubah");
            $this->load->view("pg_admin/siswa_form", $data);
        } else {
            //passing input value to Model
            $result = $this->model_adm->update_siswa($id, $nama, $email, $telepon, $telepon_ortu, $alamat, $sekolah_id, $kelas);
            alert_success("Sukses", "Data berhasil diubah");
            redirect("pg_admin/siswa/aktif");
            // echo "Status Update: " . $result;
        }
    }

    public function proses_hapus()
    {


        //set form validation rules
        $this->form_validation->set_rules("hidden_row_id", "Nomor Baris", "trim|required|numeric");

        if ($this->form_validation->run()) {
            $id = $this->input->post("hidden_row_id");
            $result = $this->model_adm->delete_siswa($id);

            alert_success("Sukses", "Data berhasil dihapus");
            redirect("pg_admin/siswa");
        }


        alert_error("Error", "Data gagal dihapus");
//        redirect("pg_admin/siswa");
    }

    private function form_validation_rules()
    {
        //set validation rules for each input
        $this->form_validation->set_rules('nama', 'Nama Instruktur', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'trim|numeric|required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }
}
