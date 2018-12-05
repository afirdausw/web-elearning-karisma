<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_ampu extends CI_Controller
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

        $this->load->model('model_adm');

        $this->load->model('model_security');

        $this->load->model('model_psep');

        $this->Model_security->psep_sekolah_is_logged_in();

    }

    public function index()
    {

        $idpsep = $this->session->userdata('idpsepsekolah');

        $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $data = array(

            'navbar_title' => "Kelas",

            'form_action'  => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),

            'table_data'   => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),

            'carikelas'    => $this->Model_psep->cari_kelas_in_id_mapel($id_mapel),

        );
        // return $this->output
        // ->set_content_type('application/json')
        // ->set_status_header(200)
        // ->set_output(json_encode($data, TRUE));
        $this->load->view('psep_sekolah/kelas_ampu', $data);

    }

    public function manajemen($aksi)
    {

        //$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form

        if ($aksi) {

            //Trigger form submission validation rules

            $this->form_validation_rules();

            switch ($aksi) {

                case 'tambah':

                    $data = array(

                        'navbar_title' => "Manajemen Kelas",

                        'page_title'   => "Tambah Kelas",

                        'form_action'  => current_url(),

                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not

                    if ($this->input->post('form_submit')) {

                        //Form is submitted. Now routing to proses_tambah method

                        $this->proses_tambah();

                    } else {

                        //No form is submitted. Displaying the form page

                        $this->load->view('psep_sekolah/kelas_form', $data);

                    }

                    break;

                case 'tambah_by_mapel':

                    $idpsep = $this->session->userdata('idpsepsekolah');

                    $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

                    $id_mapel = $cariidmapel->id_mapel;

                    $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

                    $data = array(

                        'navbar_title'   => "Manajemen Materi Pokok",

                        'page_title'     => "Tambah Materi Pokok",

                        'form_action'    => current_url(),

                        'carikelas'      => $this->Model_psep->cari_kelas_by_id_mapel($id_mapel),

                        'select_options' => $this->Model_adm->fetch_options_materi_pokok(),

                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not

                    if ($this->input->post('form_submit')) {

                        //Form is submitted. Now routing to proses_tambah method

                        $this->proses_tambah();

                    } else {

                        //No form is submitted. Displaying the form page

                        $this->load->view('psep_sekolah/materi_pokok_form_guru', $data);

                    }

                    break;

                case 'ubah':

                    //Passing id value from GET '?id' to variable '$id'

                    $id = $this->input->get('id') ? $this->input->get('id') : null;

                    $data = array(

                        'navbar_title' => "Manajemen Kelas",

                        'page_title'   => "Ubah Kelas",

                        'form_action'  => current_url() . "?id=$id",

                    );

                    //Redirect to kelas if id is not exist

                    if (!$id) {

                        redirect('psep_sekolah/kelas');

                    } else {

                        //Calling values from database by id and pass them to View

                        //fetching kelas by id

                        $data['data'] = $this->fetch_kelas_by_id($id);

                        //Form submit handler. See if the user is attempting to submit a form or not

                        if ($this->input->post('form_submit')) {

                            //Form is submitted. Now routing to proses_tambah method

                            $this->proses_ubah($id);

                        } else {

                            //No form is submitted. Displaying the form page

                            $this->load->view('pg_admin/kelas_form', $data);

                        }

                    }

                    break;

                default:

                    redirect('psep_sekolah/kelas');

                    break;

            }

        } else {

            redirect('psep_sekolah/kelas');

        }

    }

    public function proses_tambah()
    {

        //set the page title

        $data = array(

            'page_title'  => "Tambah Kelas",

            'form_action' => current_url(),

        );

        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

        //fetch input (make sure that the variable name is the same as column name in database!)

        $params = $this->input->post(null, true);

        $jenjang = $carisekolah->jenjang;

        $tingkatan_kelas = $params['tingkatan_kelas'];

        $alias_kelas = $params['alias_kelas'];

        //run the validation

        if ($this->form_validation->run() == false) {

            alert_error("Error", "Data gagal ditambahkan");

            $this->load->view('psep_sekolah/kelas_form', $data);

        } else {

            //passing input value to Model

            $result = $this->Model_adm->add_kelas($jenjang, $tingkatan_kelas, $alias_kelas);

            alert_success("Sukses", "Data berhasil ditambahkan");

            redirect('psep_sekolah/kelas');

            // echo "Status Insert: " . $result;

        }

    }

    public function proses_ubah($id)
    {

        //set the page title

        $data = array(

            'page_title'  => "Ubah Materi",

            'form_action' => current_url() . "?id=$id",

        );

        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

        //fetch input (make sure that the variable name is the same as column name in database!)

        $params = $this->input->post(null, true);

        $jenjang = $carisekolah->jenjang;

        $tingkatan_kelas = $params['tingkatan_kelas'];

        $alias_kelas = $params['alias_kelas'];

        //run the validation

        if ($this->form_validation->run() == false) {

            alert_error("Error", "Data gagal diubah");

            $this->load->view('psep_sekolah/kelas_form', $data);

        } else {

            //passing input value to Model

            $result = $this->Model_adm->update_kelas($id, $jenjang, $tingkatan_kelas, $alias_kelas);

            alert_success("Sukses", "Data berhasil diubah");

            redirect('psep_sekolah/kelas');

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

                $result = $this->Model_adm->delete_kelas($id);

                alert_success('Sukses', "Data berhasil dihapus");

                redirect('psep_sekolah/kelas');

            }

        }

        alert_danger('Error', "Data gagal dihapus");

        redirect('psep_sekolah/kelas');

    }

    public function form_validation_rules()
    {

        //set validation rules for each input

//        $this->form_validation->set_rules('jenjang', 'Jenjang Pendidikan', 'trim|required');

        $this->form_validation->set_rules('tingkatan_kelas', 'Tingkatan Kelas', 'trim|required');

        $this->form_validation->set_rules('alias_kelas', 'Alias Kelas', 'trim|required');

        //set custom error message

        $this->form_validation->set_message('required', '%s tidak boleh kosong');

    }

    public function fetch_kelas_by_id($id)
    {

        $data = new stdClass();

        $table_data = $this->Model_adm->fetch_kelas_by_id($id);

        $table_fields = $this->Model_adm->get_table_fields('kelas');

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

}
