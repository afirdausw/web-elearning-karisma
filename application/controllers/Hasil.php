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

    function index($id_submateri = "") {
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        if($pretest_logged){
            redirect(base_url('hasil/pretest'));
        }else if($siswa_logged){
            $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
            $log_ujian = $this->Model_pg->get_nilai_siswa_by_mapel($this->session->userdata('id_siswa'));
            $kelas_navbar = $this->Model_pg->fetch_all_kelas();

            $data = array(
                'siswa' => $siswa,
                'log_ujian' => $log_ujian,
                'kelas_navbar' => $kelas_navbar,
            );
            if($id_submateri==""){
                $id_submateri = $log_ujian[0]->sub_materi_id;
            }
            $konten = $this->Model_pg->get_konten_materi_by_id($id_submateri,3);
            $soal = $this->Model_pg->get_soal_by_sub_materi($id_submateri, $siswa->id_siswa);
            $siswa_quiz = $this->Model_pg->get_nilai_siswa_by_mapel("", "", $id_submateri) ;

            $data['siswa_quiz'] = $siswa_quiz;
            $data['konten'] = $konten;
            $data['soal'] = $soal;

    //         return $this->output
    //             ->set_content_type('application/json')
    //             ->set_status_header(500)
    //             ->set_output(json_encode($data));


            $this->load->view('pg_user/hasil', $data);
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
            $pretest_nilai = $this->Model_pg->get_nilai_siswa_pretest_by_mapel();
            $kelas_navbar = $this->Model_pg->fetch_all_kelas();

            $konten = $this->Model_pg->get_konten_materi_by_id( 8,3 );

            $soal = $this->Model_pg->get_soal_by_sub_materi( 4,2 );

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

            $this->load->view('pg_user/hasil_pretest', $data);
        }else{
            alert_error("Login pretest terlebih dahulu", "Anda harus login untuk memasuki laman HASIL PRETEST");
            redirect(base_url('pretest'));
        }
    }
}
