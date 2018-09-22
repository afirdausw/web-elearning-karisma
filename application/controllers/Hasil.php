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
        $siswa_quiz = $this->model_pg->fetch_all_siswa_by_quiz_mapel();

        $data = array(
            'siswa' => $siswa,
            'siswa_quiz' => $siswa_quiz
        );

        $this->load->view("pg_user/hasil", $data);
    }
}
