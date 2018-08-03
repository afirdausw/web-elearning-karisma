<?php

/**
 *
 */
class Hasil extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pg');
    }

    function index() {
        $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));

        $data = array(
            'siswa' => $siswa
        );

        $this->load->view("pg_user/hasil", $data);
    }
}
