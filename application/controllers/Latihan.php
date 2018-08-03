<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        $this->load->library('session');
        $this->load->helper('alert_helper');
        $this->load->model('model_pg');
        $this->load->model('model_poin');
        $this->output->delete_cache();
    }

    public function index($id_sub_materi)
    {
        if (!$id_sub_materi) {
            //Redirect history back -1
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = array(
            'navbar_links' => $this->model_pg->get_navbar_links(),
            'header'       => $this->model_pg->get_mapel_by_konten($id_sub_materi),
            'data'         => $this->model_pg->get_sub_materi_by_id($id_sub_materi),
            'infolatihan'  => $this->model_pg->get_info_latihan($id_sub_materi),
            'jumlahsoal'   => $this->model_pg->get_jumlah_soal_latihan($id_sub_materi),
        );
        $id_kelas = $this->model_pg->get_mapel_by_materi($data['data']->materi_pokok_id);
        //	$allow_akses = $this->validasi_akses_siswa($id_kelas);
//        $allow_akses = $this->validasi_akses_siswa($data['header']->id_kelas);

//        $data['allow_akses'] = $allow_akses;

        //tester
        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";

        $this->load->view('pg_user/latihan_soal_mulai', $data);
    }

    public function soal($id_sub_materi)
    {
        $_SESSION['data_latihan'] = null;
        $_SESSION['kunci_soal'] = null;
        $data = array(
            'navbar_links' => $this->model_pg->get_navbar_links(),
            'data_soal'    => $this->model_pg->fetch_soal_by_submateri($id_sub_materi),
            'header'       => $this->model_pg->get_mapel_by_konten($id_sub_materi),
//            'header'       => $this->model_pg->get_sub_materi_by_id($id_sub_materi),
            'data'         => $this->model_pg->get_sub_materi_by_id($id_sub_materi),
            'poin'         => $this->model_poin->fetch_poin_bonus('jawaban_benar'),
        );

//        $id_kelas = $this->model_pg->get_mapel_by_materi($data['header']->materi_pokok_id);
//        $allow_akses = $this->validasi_akses_siswa($id_kelas);
//        $data['allow_akses'] = $allow_akses;

        $id_kelas = $this->model_pg->get_mapel_by_materi($data['data']->materi_pokok_id);
//        $allow_akses = $this->validasi_akses_siswa($id_kelas);
//        $allow_akses = $this->validasi_akses_siswa($data['header']->id_kelas);

//        $data['allow_akses'] = $allow_akses;

        if (!isset($_SESSION['data_latihan'])) {

            //preparing list jawaban
            $list_jawaban = array();
            for ($i = 1; $i <= count($data['data_soal']); $i++) {
                $list_jawaban[] = 0;
            }

            $session = array(
                'data_latihan' => array(
                    'list_jawaban'       => $list_jawaban,
                    'sedang_mengerjakan' => true,
                    'skor'               => 0,
                    'id_materi'          => $id_sub_materi,
                    'id_pokok'           => $this->model_pg->get_sub_materi_by_id($id_sub_materi)->materi_pokok_id,
                ),
                'kunci_soal'   => $this->model_pg->fetch_array_id_soal($id_sub_materi),
//				'kunci' 	=> $this->model_pg->fetch_array_kunci()
            );
            $this->session->unset_userdata('kunci_soal');
            $this->session->unset_userdata('data_latihan');
            unset($_SESSION['data_latihan']);
            unset($_SESSION['kunci_soal']);
//            $this->session->set_userdata($session);
            $_SESSION['kunci_soal'] = $this->model_pg->fetch_array_id_soal($id_sub_materi);

            
            $_SESSION['data_latihan'] = array(
                'list_jawaban'       => $list_jawaban,
                'sedang_mengerjakan' => true,
                'skor'               => 0,
                'id_materi'          => $id_sub_materi,
                'id_pokok'           => $this->model_pg->get_sub_materi_by_id($id_sub_materi)->materi_pokok_id,
            );
//            session_write_close();
        }

        if ((!$id_sub_materi) OR (!$_SESSION['data_latihan']['sedang_mengerjakan'])) {
            //Redirect history back -1
            redirect($_SERVER['HTTP_REFERER']);
        }

        // print_r(json_encode($_SESSION));
        // tester
        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        // die();


        $this->load->view('pg_user/latihan_soal', $data);
    }

    public function penilaian()
    {
        $submit = $_POST['submit_form_soal'];
        if (!$submit) {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $skor = $this->input->post('skor');
        $id_sub_materi = $_SESSION['data_latihan']['id_materi'] ? $_SESSION['data_latihan']['id_materi'] : 0;
        // $jumlah_soal = $this->model_pg->jumlah_soal($id_sub_materi);
        $data_soal = $this->model_pg->fetch_soal_by_submateri($id_sub_materi);
        $jumlah_soal = count($data_soal);

        // $data_latihan = array('skor' => $skor);
        // $session 			= array($data_latihan);
        // $this->session->set_userdata(array('data_latihan' => array('skor' => 700)));


        //NEW WAY TO CALCULATE FINAL SKOR
        if (isset($_SESSION['data_latihan']['list_jawaban'])) {
            $jwb = 0;
            foreach ($_SESSION['data_latihan']['list_jawaban'] as $list) {
                if ($list) {
                    $jwb += 1;
                }
            }
            $skor = $jwb;
        }

        if (($jumlah_soal > 0) && ($skor > 0)) {
            $final_skor = round(((100 / $jumlah_soal) * $skor), 1);
        } else {
            $final_skor = 0;
        }


        $_SESSION['data_latihan']['skor'] = $skor;

        //tester
        // echo "Jumlah soal: ". " -> ". $jumlah_soal;
        // print_r($_SESSION['data_latihan']);
        // $this->session->set_userdata('data_latihan')['sedang_mengerjakan'] = false;
        // print_r($this->session->userdata('data_latihan')['sedang_mengerjakan']);

        $data = array(
            'navbar_links' => $this->model_pg->get_navbar_links(),
            'skor'         => $final_skor,
        );

        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        $this->load->view('pg_user/latihan_soal_selesai', $data);
    }

    public function validasi_akses_siswa($id_kelas)
    {
        $allow_akses = FALSE;

        if (isset($_SESSION['akses'])) {
            $akses = $this->session->userdata('akses');

            if (array_key_exists('premium', $akses)) {
                // echo "Premium ADA!";
                $allow_akses = TRUE;
            } else if (array_key_exists('reguler', $akses)) {
                $data_mapel = $id_kelas;

                if (in_array($data_mapel, $akses['reguler'])) {
                    // echo "$data_mapel ADA!";
                    $allow_akses = TRUE;
                } else {
                    // echo "$data_mapel GAK ADA!";
                    $allow_akses = FALSE;
                }
            } else {
                // echo "Reguler GAK ADA!";
                $allow_akses = FALSE;
            }
        }

        return $allow_akses;
    }

    public function ajax_check_jawaban()
    {
        $result = "No data";
        $id_soal = $this->input->post('id');
        $jawaban = $this->input->post('jawaban');

        if (!empty($id_soal) && !empty($jawaban)) {
            $kunci_soal = $this->session->userdata('kunci_soal');
            foreach ($kunci_soal as $key => $item) {
//

                if ($item['id_soal'] == $id_soal) {

                    if ($item['kunci_jawaban'] == $jawaban) {

                        $_SESSION['data_latihan']['list_jawaban'][$key] = 1;
                        // $this->session->set_userdata('data_latihan')['skor'];
                        session_write_close();
                        $result = "benar";
                        //SET POIN SISWA
                        if (isset($_SESSION['id_siswa'])) {
                            $addpoin = $this->model_poin->add_poin_siswa($_SESSION['id_siswa'], 'jawaban_benar');
                        }
                    } else {

                        $_SESSION['data_latihan']['list_jawaban'][$key] = 0;
                        $result = "salah";
                    }
                }
            }
            // print_r($kunci_soal);

            //Implode Multidimensional Array
            // $kunci = implode(', ', array_map(function ($entry) {
            //   return $entry['kunci_jawaban'];
            // }, $_SESSION['kunci_soal']));

            //FETCH DATA FROM DB
            // $row = $this->model_pg->fetch_jawaban_by_soal($id_soal);
            // if ($jawaban == $row->kunci_jawaban)
            // {
            // 	$result = "benar";
            // }
        }

        echo $result;
    }

    public function ajax_fetch_pembahasan()
    {
        $id_soal = $this->input->post('id');
        $tipe_pembahasan = $this->input->post('tipe');

        if (!empty($id_soal) && !empty($tipe_pembahasan)) {
            $row = $this->model_pg->fetch_jawaban_by_soal($id_soal);

            if (!empty($row)) {
                //if tipe pembahasan == teks
                if ($tipe_pembahasan == 'teks') {
                    echo html_entity_decode($row->pembahasan);
                } //if tipe pembahasan == video
                elseif ($tipe_pembahasan == 'video') {
                    echo $row->pembahasan_video;
                }
            }
        } else {
            echo "No data";
        }
    }



}

