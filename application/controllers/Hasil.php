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
        $siswa_quiz = $this->model_pg->get_nilai_siswa_by_mapel();
        $kelas_navbar = $this->model_pg->fetch_all_kelas();

        $konten = $this->model_pg->get_konten_materi_by_id( 8,3 );

        $soal = $this->model_pg->get_soal_by_konten(4, 2);

        $data = array(
            'siswa' => $siswa,
            'siswa_quiz' => $siswa_quiz,
            'kelas_navbar' => $kelas_navbar,
            'konten' =>$konten,
            'soal' => $soal,
        );

//         return $this->output
//             ->set_content_type('application/json')
//             ->set_status_header(500)
//             ->set_output(json_encode($data));

        $this->load->view("pg_user/hasil", $data);
    }

    public function pretest() {
        $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));
        $siswa_nilai = $this->model_pg->get_nilai_siswa_pretest_by_mapel();
        $kelas_navbar = $this->model_pg->fetch_all_kelas();

        $konten = $this->model_pg->get_konten_materi_by_id( 8,3 );

        $data = array(
            'siswa' => $siswa,
            'siswa_nilai' => $siswa_nilai,
            'kelas_navbar' => $kelas_navbar,
            'konten' =>$konten
        );
//         return $this->output
//             ->set_content_type('application/json')
//             ->set_status_header(500)
//             ->set_output(json_encode($data));

        $this->load->view("pg_user/hasil_pretest", $data);
    }
}
