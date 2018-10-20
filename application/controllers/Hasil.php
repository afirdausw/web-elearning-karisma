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
        $this->load->helper('url_helper');
        $this->load->helper('alert_helper');
    }

    function index() {
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        if($pretest_logged){
            redirect(base_url('hasil/pretest'));
        }else if($siswa_logged){
            $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));
            $siswa_quiz = $this->model_pg->get_nilai_siswa_by_mapel();
            $kelas_navbar = $this->model_pg->fetch_all_kelas();

            $konten = $this->model_pg->get_konten_materi_by_id( 8,3 );

            $soal = $this->model_pg->get_soal_by_sub_materi(4, 2);

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
        }else{
            alert_error("Login terlebih dahulu", "Anda harus login untuk memasuki laman HASIL");
            redirect(base_url('login'));
        }
    }

    public function pretest() {
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        if($siswa_logged){
            redirect(base_url('hasil'));
        }else if($pretest_logged){
            $pretest_id = $this->session->userdata('pretest_id');
            // $pretest = $this->model_pg->get_data_user($pretest_id);
            $pretest = "";
            $pretest_nilai = $this->model_pg->get_nilai_siswa_pretest_by_mapel();
            $kelas_navbar = $this->model_pg->fetch_all_kelas();

            $konten = $this->model_pg->get_konten_materi_by_id( 8,3 );

            $soal = $this->model_pg->get_soal_by_sub_materi( 4,2 );

            $data = array(
                'pretest' => $pretest,
                'pretest_nilai' => $pretest_nilai,
                'kelas_navbar' => $kelas_navbar,
                'konten' =>$konten,
                'soal' => $soal,
            );
    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(500)
    //             ->set_output(json_encode($data));

            $this->load->view("pg_user/hasil_pretest", $data);
        }else{
            alert_error("Login pretest terlebih dahulu", "Anda harus login untuk memasuki laman HASIL PRETEST");
            redirect(base_url('pretest'));
        }
    }
}
