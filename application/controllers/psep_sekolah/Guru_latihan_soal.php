<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_latihan_soal extends CI_Controller
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
        $this->load->model('model_psep');
        // $this->load->model('model_security');
        // $this->model_security->is_logged_in();
    }

    public function index()
    {

        $idpsep = $this->session->userdata('idpsepsekolah');



        $cariidmapel = $this->model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);

        $data = array(
            'navbar_title' => "Semua Soal",
            'form_action' => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            'table_data' => $this->model_adm->fetch_all_soal_by_mapel($id_mapel)
        );
        // tester
        // alert_success('', "");
        // alert_error('danger', "isi 2");
        // alert_warning('info', "isi 2");
        // alert_info('info', "isi 2");

        //var_dump($data['table_data']);

        $this->load->view('psep_sekolah/guru_latihansoal', $data);
    }

}