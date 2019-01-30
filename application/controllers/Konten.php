<?php

/**
 *
 */
class Konten extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pg');
        $this->load->model('model_konten');
        $this->load->model('model_instruktur');
        $this->load->helper('url');
        $this->load->helper('alert');
    }

    public function index($id_materi_pokok)
    {
        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

        $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));

        $list_submateri = $this->Model_pg->get_sub_materi_by_materi($id_materi_pokok);

        $materi = $this->Model_pg->get_mapel_by_materi($id_materi_pokok);
        // DEBUG HERE
        error_reporting(0);
        $sub_materi_1 = $this->Model_pg->get_sub_materi_by_materi($materi->id_materi_pokok)[0];
        if ($sub_materi_1 != null) {
            $mapok = $this->Model_pg->get_materi_by_mapel($materi->mapel_id);
            $mapok_baru = [];
            foreach ($mapok as $key => $value) {
                $v = $array = json_decode(json_encode($value), true);
                $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
                $mapok_baru[] = $v;
            }
            $konten = "";
            $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);
            $konten = $this->Model_pg->get_konten_by_sub_materi($sub_materi_1->id_sub_materi)[0];

            $data = [
                "kelas_navbar" => $kelas_navbar,

                'siswa'          => $siswa,
                'materi'         => $materi,
                'materi_pokok'   => $mapok_baru,
                'sub_materi'     => $sub_materi_1,
                'konten'         => $konten,
                'list_submateri' => $this->Model_pg->get_sub_materi_by_materi($sub_materi_1->id_sub_materi),
                'next'           => $this->Model_pg->get_next_konten($konten->id_konten),
                'prev'           => $this->Model_pg->get_prev_konten($konten->id_konten),
                'next_mapok'     => $this->Model_pg->get_next_mapok($materi->id_materi_pokok),
                'prev_mapok'     => $this->Model_pg->get_prev_mapok($materi->id_materi_pokok),
            ];
//            return $this->output
//                ->set_content_type('application/json')
//                ->set_status_header(500)
//                ->set_output(json_encode($data));

            if ($konten->kategori == '1') {
                $this->load->view('pg_user/konten', $data);
            } elseif ($konten->kategori == '2') {
                $this->load->view('pg_user/konten_video', $data);
            } elseif ($konten->kategori == '3') {
                $this->load->view('pg_user/konten_soal', $data);
            }
        } else { ?>
            <div style="text-align:center; font-size:21px; font-weight:bolder; font-family:'Segoe UI'">Konten belum
                tersedia
            </div>
            <?php
            redirect('', 'refresh');
        }
    }


    public function mapel($id_mapel)
    {
        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

        $pretest_logged = $this->session->userdata('pretest_logged_in');
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if ($siswa_logged) {
            $id = $this->session->userdata('id_siswa');
            $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
            $jenis_siswa = "siswa";
        } else if ($pretest_logged) {
            $id = $this->session->userdata('pretest_id');
            $siswa = "";
            $jenis_siswa = "pretest";
        }

        $materi = $this->Model_pg->get_materi_by_mapel_one($id_mapel);
        // TODO handle error apabila konten tidak ada di DB
        // DEBUG HERE
        error_reporting(0);
        $sub_materi_1 = $this->Model_pg->get_sub_materi_by_materi($materi->id_materi_pokok)[0];


        if ($sub_materi_1 != null) {
            $mapok = $this->Model_pg->get_materi_by_mapel($materi->mapel_id);
            $mapok_baru = [];
            foreach ($mapok as $key => $value) {
                $v = $array = json_decode(json_encode($value), true);
                $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
                $mapok_baru[] = $v;
            }
            $konten = "";
            $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);
            // PRE
            $mapok_pre = $this->Model_pg->get_materi_pre_by_mapel($materi->mapel_id);
            $mapok_baru_pre = [];
            foreach ($mapok_pre as $key => $value) {
                $v = $array = json_decode(json_encode($value), true);
                $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
                $mapok_baru_pre[] = $v;
            }
            $mapok_baru_pre = json_decode(json_encode($mapok_baru_pre), FALSE);
            // END PRE
            $konten = $this->Model_pg->get_konten_by_sub_materi($sub_materi_1->id_sub_materi)[0];

            $data = [
                "kelas_navbar" => $kelas_navbar,

                'siswa'            => $siswa,
                'materi'           => $materi,
                'materi_pokok'     => $mapok_baru,
                'materi_pokok_pre' => $mapok_baru_pre,
                'sub_materi'       => $sub_materi_1,
                'konten'           => $konten,
                'list_submateri'   => $this->Model_pg->get_sub_materi_by_materi($sub_materi_1->id_sub_materi),
                'next'             => $this->Model_pg->get_next_konten($konten->id_konten),
                'prev'             => $this->Model_pg->get_prev_konten($konten->id_konten),
                'next_mapok'       => $this->Model_pg->get_next_mapok($materi->id_materi_pokok),
                'prev_mapok'       => $this->Model_pg->get_prev_mapok($materi->id_materi_pokok),
            ];

            // return $this->output
            // ->set_content_type('application/json')
            // ->set_status_header(500)
            // ->set_output(json_encode($data));
            $this->insert_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            $redirect_link = "konten/detail";

            if ($konten->kategori == '1') {
                //detail
                $redirect_link .= "";
            } elseif ($konten->kategori == '2') {
                //video
                $redirect_link .= "_video";
            } elseif ($konten->kategori == '3') {
                //soal
                $redirect_link .= "_soal";
            }
            $redirect_link .= "/" . $id_mapel;

            redirect(base_url($redirect_link));
        } else { ?>
            <div style="text-align:center; font-size:21px; font-weight:bolder; font-family:'Segoe UI'">Konten belum
                tersedia
            </div>
            <?php
            redirect('', 'refresh');
        }
    }

    public function detail($id_sub_materi)
    {
        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

        $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
        $sub_materi_1 = $this->Model_pg->get_sub_materi_by_id($id_sub_materi)[0];
        $materi = $this->Model_pg->get_mapel_by_materi($sub_materi_1->materi_pokok_id);
        $mapok = $this->Model_pg->get_materi_by_mapel($materi->mapel_id);
        $mapok_baru = [];
        foreach ($mapok as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru[] = $v;
        }
        $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);
        // PRE
        $mapok_pre = $this->Model_pg->get_materi_pre_by_mapel($materi->mapel_id);
        $mapok_baru_pre = [];
        foreach ($mapok_pre as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru_pre[] = $v;
        }
        $mapok_baru_pre = json_decode(json_encode($mapok_baru_pre), FALSE);
        // END PRE
        $konten = $this->Model_pg->get_konten_by_sub_materi($sub_materi_1->id_sub_materi)[0];


        $pretest_logged = $this->session->userdata('pretest_logged_in');
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if ($konten->materi_status == 'buy') {
            if (($siswa_logged && $siswa->id_premium == 0) || $pretest_logged) {
                alert_error("Hanya untuk akun premium", "Silahkan login sebagai akun premium atau lakukan pendaftaran.");
                redirect(base_url("profil"));
            }
        }
        if ($siswa_logged OR $pretest_logged) {
            if ($siswa_logged) {
                $id = $this->session->userdata('id_siswa');
                $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
                $jenis_siswa = "siswa";
            } else if ($pretest_logged) {
                $id = $this->session->userdata('pretest_id');
                $siswa = "";
                $jenis_siswa = "pretest";
            }
            $cek_exist = $this->Model_pg->get_log_baca($id, $sub_materi_1->id_sub_materi);
            if ($cek_exist->baca_total == 0) {
                $this->insert_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            } else if ($cek_exist->baca_total > 0) {
                $this->update_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            }
        }

        $where = [
            "mata_pelajaran.id_mapel" => $mapok[0]->id_mapel,
        ];

        $instruktur = $this->Model_instruktur->get_instruktur_by_mapel($where);

        $data = [
            "kelas_navbar" => $kelas_navbar,

            'siswa'            => $siswa,
            'instruktur'       => $instruktur,
            'materi'           => $materi,
            'materi_pokok'     => $mapok_baru,
            'materi_pokok_pre' => $mapok_baru_pre,
            'sub_materi'       => $sub_materi_1,
            'konten'           => $konten,
            'list_submateri'   => $this->Model_pg->get_sub_materi_by_materi($sub_materi_1->materi_pokok_id),
            'next'             => $this->Model_pg->get_next_konten($konten->id_konten),
            'prev'             => $this->Model_pg->get_prev_konten($konten->id_konten),
            'next_mapok'       => $this->Model_pg->get_next_mapok($materi->id_materi_pokok),
            'prev_mapok'       => $this->Model_pg->get_prev_mapok($materi->id_materi_pokok),
        ];
        //        return $this->output
        //            ->set_content_type('application/json')
        //            ->set_status_header(500)
        //            ->set_output(json_encode($data));


        $this->load->view('pg_user/konten', $data);
    }

    public function detail_video($id_sub_materi)
    {
        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

        $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
        $sub_materi_1 = $this->Model_pg->get_sub_materi_by_id($id_sub_materi, "Video")[0];
        $materi = $this->Model_pg->get_mapel_by_materi($sub_materi_1->materi_pokok_id);
        $mapok = $this->Model_pg->get_materi_by_mapel($materi->mapel_id);
        $mapok_baru = [];
        foreach ($mapok as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru[] = $v;
        }
        $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);
        // PRE
        $mapok_pre = $this->Model_pg->get_materi_pre_by_mapel($materi->mapel_id);
        $mapok_baru_pre = [];
        foreach ($mapok_pre as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru_pre[] = $v;
        }
        $mapok_baru_pre = json_decode(json_encode($mapok_baru_pre), FALSE);
        // END PRE
        $konten = $this->Model_pg->get_konten_by_sub_materi($sub_materi_1->id_sub_materi)[0];

        $pretest_logged = $this->session->userdata('pretest_logged_in');
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if ($konten->materi_status == 'buy') {
            if (($siswa_logged && $siswa->id_premium == 0) || $pretest_logged) {
                alert_error("Hanya untuk akun premium", "Silahkan login sebagai akun premium atau lakukan pendaftaran.");
                redirect(base_url("profil"));
            }
        }
        if ($siswa_logged OR $pretest_logged) {
            if ($siswa_logged) {
                $id = $this->session->userdata('id_siswa');
                $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
                $jenis_siswa = "siswa";
            } else if ($pretest_logged) {
                $id = $this->session->userdata('pretest_id');
                $siswa = "";
                $jenis_siswa = "pretest";
            }
            $cek_exist = $this->Model_pg->get_log_baca($id, $sub_materi_1->id_sub_materi);
            if ($cek_exist->baca_total == 0) {
                $this->insert_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            } else if ($cek_exist->baca_total > 0) {
                $this->update_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            }
        }

        $where = [
            "mata_pelajaran.id_mapel" => $mapok[0]->id_mapel,
        ];

        $instruktur = $this->Model_instruktur->get_instruktur_by_mapel($where);
        $data = [
            "kelas_navbar" => $kelas_navbar,

            'siswa'            => $siswa,
            'instruktur'       => $instruktur,
            'materi'           => $materi,
            'materi_pokok'     => $mapok_baru,
            'materi_pokok_pre' => $mapok_baru_pre,
            'sub_materi'       => $sub_materi_1,
            'konten'           => $konten,
            'list_submateri'   => $this->Model_pg->get_sub_materi_by_materi($sub_materi_1->materi_pokok_id),
            'next'             => $this->Model_pg->get_next_konten($konten->id_konten),
            'prev'             => $this->Model_pg->get_prev_konten($konten->id_konten),
            'next_mapok'       => $this->Model_pg->get_next_mapok($materi->id_materi_pokok),
            'prev_mapok'       => $this->Model_pg->get_prev_mapok($materi->id_materi_pokok),
        ];
        $this->load->view('pg_user/konten_video', $data);
    }

    public function detail_soal($id_sub_materi)
    {
        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

        $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
        $sub_materi_1 = $this->Model_pg->get_sub_materi_by_id($id_sub_materi, "Soal")[0];
        $materi = $this->Model_pg->get_mapel_by_materi($sub_materi_1->materi_pokok_id);
        $mapok = $this->Model_pg->get_materi_by_mapel($materi->mapel_id);
        $mapok_baru = [];
        foreach ($mapok as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru[] = $v;
        }
        $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);
        // PRE
        $mapok_pre = $this->Model_pg->get_materi_pre_by_mapel($materi->mapel_id);
        $mapok_baru_pre = [];
        foreach ($mapok_pre as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru_pre[] = $v;
        }
        $mapok_baru_pre = json_decode(json_encode($mapok_baru_pre), FALSE);
        // END PRE
        $konten = $this->Model_pg->get_konten_by_sub_materi($sub_materi_1->id_sub_materi)[0];

        $pretest_logged = $this->session->userdata('pretest_logged_in');
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if ($konten->materi_status == 'buy') {
            if (($siswa_logged && $siswa->id_premium == 0) || $pretest_logged) {
                alert_error("Hanya untuk akun premium", "Silahkan login sebagai akun premium atau lakukan pendaftaran.");
                redirect(base_url("profil"));
            }
        }
        if (isset($_SESSION['pretest_logged_in']) && $_SESSION['pretest_logged_in']) {
            if ($this->session->userdata('pretest_id')) {
                $check = [
                    "id_siswa"      => $this->session->userdata('pretest_id'),
                    "sub_materi_id" => $id_sub_materi,
                ];
            } else {
                $check = [
                    "id_siswa"      => NULL,
                    "sub_materi_id" => NULL,
                ];
            }
            if ($siswa_logged) {
                $id = $this->session->userdata('id_siswa');
                $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
                $jenis_siswa = "siswa";
            } else if ($pretest_logged) {
                $id = $this->session->userdata('pretest_id');
                $siswa = "";
                $jenis_siswa = "pretest";
            }
            //pretest
            $cek_exist = $this->Model_pg->get_log_baca($id, $sub_materi_1->id_sub_materi);
            if ($cek_exist->baca_total == 0) {
                $this->insert_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            } else if ($cek_exist->baca_total > 0) {
                $this->update_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
            }
            $data_log = $this->Model_konten->select_log_data_result($check);
            $data = [
                "kelas_navbar" => $kelas_navbar,

                'materi_pokok'     => $mapok_baru,
                'materi_pokok_pre' => $mapok_baru_pre,
                'materi'           => $materi,
                'sub_materi'       => $sub_materi_1,
                'list_submateri'   => $this->Model_pg->get_sub_materi_by_materi($sub_materi_1->materi_pokok_id),
                'next'             => $this->Model_pg->get_next_konten($konten->id_konten),
                'prev'             => $this->Model_pg->get_prev_konten($konten->id_konten),
                'next_mapok'       => $this->Model_pg->get_next_mapok($materi->id_materi_pokok),
                'prev_mapok'       => $this->Model_pg->get_prev_mapok($materi->id_materi_pokok),
                'soal'             => $this->Model_pg->fetch_soal_by_submateri($id_sub_materi),
                'jumlah'           => $this->Model_pg->jumlah_soal($id_sub_materi),

                'test_jum' => $this->Model_konten->select_log_count_pretest($check),
                'log'      => $this->Model_konten->select_log_data_pretest($check),
            ];
            if ($this->session->userdata('pretest_id')) {
                //error
                $jawab_data = [
                    "id_siswa"      => $this->session->userdata('pretest_id'),
                    "sub_materi_id" => $id_sub_materi,
                ];
                $data_jawaban = $this->Model_konten->select_jawaban_data_pretest('hitung_semua', $jawab_data);
                if (intval($data_jawaban->numrows) > 0) {
                    $jawab_data["soal_id"] = -1;
                    $data['data_jawaban'] = $this->Model_konten->select_jawaban_data_pretest('fetch', $jawab_data);
                }
                $datanya = $this->Model_konten->select_log_data_pretest($check);
                if ($datanya != NULL) {
                    $data['innerHTMLnya'] = $datanya->nilai;
                } else {
                    $data['innerHTMLnya'] = 0;
                }
            } else {
                $data['innerHTMLnya'] = $this->Model_konten->select_log_data_pretest($check)['nilai'];
            }
        } else {
            if (isset($siswa->id_siswa)) {
                $check = [
                    "id_siswa"      => $siswa->id_siswa,
                    "sub_materi_id" => $id_sub_materi,
                ];
            } else {
                $check = [
                    "id_siswa"      => NULL,
                    "sub_materi_id" => NULL,
                ];
            }
            $data_log = $this->Model_konten->select_log_data_result($check);
            $data = [
                "kelas_navbar" => $kelas_navbar,

                'siswa'            => $siswa,
                'materi_pokok'     => $mapok_baru,
                'materi_pokok_pre' => $mapok_baru_pre,
                'materi'           => $materi,
                'sub_materi'       => $sub_materi_1,
                'list_submateri'   => $this->Model_pg->get_sub_materi_by_materi($sub_materi_1->materi_pokok_id),
                'next'             => $this->Model_pg->get_next_konten($konten->id_konten),
                'prev'             => $this->Model_pg->get_prev_konten($konten->id_konten),
                'next_mapok'       => $this->Model_pg->get_next_mapok($materi->id_materi_pokok),
                'prev_mapok'       => $this->Model_pg->get_prev_mapok($materi->id_materi_pokok),
                'soal'             => $this->Model_pg->fetch_soal_by_submateri($id_sub_materi),
                'jumlah'           => $this->Model_pg->jumlah_soal($id_sub_materi),

                'test_jum' => $this->Model_konten->select_log_count($check),
                'log'      => $this->Model_konten->select_log_data($check),
            ];
            if (isset($siswa->id_siswa)) {
                if ($siswa_logged) {
                    $id = $this->session->userdata('id_siswa');
                    $siswa = $this->Model_pg->get_data_user($this->session->userdata('id_siswa'));
                    $jenis_siswa = "siswa";
                } else if ($pretest_logged) {
                    $id = $this->session->userdata('pretest_id');
                    $siswa = "";
                    $jenis_siswa = "pretest";
                }
                $cek_exist = $this->Model_pg->get_log_baca($id, $sub_materi_1->id_sub_materi);
                if ($cek_exist->baca_total == 0) {
                    $this->insert_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
                } else if ($cek_exist->baca_total > 0) {
                    $this->update_log_baca($id, $sub_materi_1->id_sub_materi, $jenis_siswa);
                }
                //error
                $jawab_data = [
                    "id_siswa"      => $siswa->id_siswa,
                    "sub_materi_id" => $id_sub_materi,
                ];
                $data_jawaban = $this->Model_konten->select_jawaban_data('hitung_semua', $jawab_data);
                if (intval($data_jawaban->numrows) > 0) {
                    $jawab_data["soal_id"] = -1;
                    $data['data_jawaban'] = $this->Model_konten->select_jawaban_data('fetch', $jawab_data);
                }
                $datanya = $this->Model_konten->select_log_data($check);
                if ($datanya != NULL) {
                    $data['innerHTMLnya'] = $datanya->nilai;
                } else {
                    $data['innerHTMLnya'] = 0;
                }
            } else {
                $data['innerHTMLnya'] = $this->Model_konten->select_log_data($check)['nilai'];
            }

            // $data['innerHTMLnya'] = $this->model_konten->select_log_data($check)['nilai'];

        }

        $where = [
            "mata_pelajaran.id_mapel" => $mapok[0]->id_mapel,
        ];
        $instruktur = $this->Model_instruktur->get_instruktur_by_mapel($where);
        $data["instruktur"] = $instruktur;
        $this->load->view('pg_user/konten_soal', $data);
    }

    public function start_soal($id_sub_materi)
    {
        if ($this->session->userdata('pretest_logged_in')) {
            $siswa = $this->session->userdata('pretest_id');
            $sub_materi = intval($id_sub_materi);
            $start = date('Y-m-d H:i:s');

            $ins = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $sub_materi,
            ];

            if ($this->Model_konten->select_log_count_pretest($ins) >= 1) {
                $ins["updated_at"] = $start;
                $update = $this->Model_konten->update_log_pretest($ins);

                if ($update) {
                    $data = [
                        "success" => true,
                    ];
                } else {
                    $data = [
                        "success" => false,
                        "message" => "Terjadi Kesalahan",
                    ];
                }


            } else if ($this->Model_konten->select_log_count_pretest($ins) < 1) {
                $soal = $this->Model_pg->get_sub_materi_by_id($sub_materi)[0];
                //dalam menit
                $waktu_soal = $soal->waktu_soal;

                $ins["start"] = $start;
                $ins["created_at"] = $start;

                $estimasi_finish = time() + ($waktu_soal * 60);
                $ins["finish"] = date('Y-m-d H:i:s', $estimasi_finish);

                $simpan = $this->Model_konten->insert_log_pretest($ins);

                if ($simpan) {
                    $data = [
                        "success" => true,
                    ];
                } else {
                    $data = [
                        "success" => false,
                        "message" => "Terjadi Kesalahan",
                    ];
                }

            }
        } else {

            $siswa = $this->session->userdata('id_siswa');
            $sub_materi = intval($id_sub_materi);
            $start = date('Y-m-d H:i:s');

            $ins = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $sub_materi,
            ];

            if ($this->Model_konten->select_log_count($ins) >= 1) {
                // $ins["updated_at"] = $start;
                // $update = $this->model_konten->update_log($ins);

                // if ($update) {
                //     $data = [
                //         "success" => true,
                //     ];
                // } else {
                //     $data = [
                //         "success" => false,
                //         "message" => "Terjadi Kesalahan",
                //     ];
                // }


            } else if ($this->Model_konten->select_log_count($ins) < 1) {
                $soal = $this->Model_pg->get_sub_materi_by_id($sub_materi)[0];
                //dalam menit
                $waktu_soal = $soal->waktu_soal;

                $ins["start"] = $start;
                $ins["created_at"] = $start;

                $estimasi_finish = time() + ($waktu_soal * 60);
                $ins["finish"] = date('Y-m-d H:i:s', $estimasi_finish);
                echo var_dump($soal);

                $simpan = $this->Model_konten->insert_log($ins, "ujian");

                if ($simpan) {
                    $data = [
                        "success" => true,
                    ];
                } else {
                    $data = [
                        "success" => false,
                        "message" => "Terjadi Kesalahan",
                    ];
                }

            }
        }

    }

    public function submit_jawab($id_materi, $soal_id, $jawab)
    {
        //CHECK DATA DI JAWABAN SISWA dan PRETEST
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if ($pretest_logged) {
            $siswa = $this->session->userdata('pretest_id');


            $sub_materi = intval($id_materi);
            $start = date('Y-m-d H:i:s');

            $check = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $sub_materi,
            ];
            $data_log = $this->Model_konten->select_log_data_pretest($check);

//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(500)
//            ->set_output(json_encode($check));

            $ins = [
                "id_log_ujian"  => $data_log->id_log_ujian,
                "id_siswa"      => $siswa,
                "soal_id"       => $soal_id,
                "sub_materi_id" => $data_log->sub_materi_id,
                "jawaban"       => $jawab,
                "created_at"    => $start,
            ];

            $data_jawaban = $this->Model_konten->select_jawaban_data_pretest('hitung_id', $ins);
            if ($data_jawaban == 0) {
                echo "masuk";
                $insert_act = $this->Model_konten->insert_jawab_pretest($ins);

                if ($insert_act) {
                    echo var_dump($insert_act);
                } else {
                    echo var_dump($insert_act);
                }

                $this->nilai_jawab($siswa, $sub_materi);
            } else {
                $data_jawaban_update = $this->Model_konten->select_jawaban_data_pretest('fetch_id', $ins);
                $createdtime = $data_jawaban_update->created_at;
                $updatetime = date('Y-m-d H:i:s');
                $ins['created_at'] = $createdtime;
                $ins['updated_at'] = $updatetime;

                //aksi
                $update_act = $this->Model_konten->update_jawab_pretest($ins);
                $this->nilai_jawab($siswa, $sub_materi);


            }
        } else if ($siswa_logged) {
            $siswa = $this->session->userdata('id_siswa');
            $sub_materi = intval($id_materi);
            $start = date('Y-m-d H:i:s');

            $check = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $sub_materi,
            ];
            $data_log = $this->Model_konten->select_log_data($check);

//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(500)
//            ->set_output(json_encode($check));

            $ins = [
                "id_log_ujian"  => $data_log->id_log_ujian,
                "id_siswa"      => $siswa,
                "soal_id"       => $soal_id,
                "sub_materi_id" => $data_log->sub_materi_id,
                "jawaban"       => $jawab,
                "created_at"    => $start,
            ];

            $data_jawaban = $this->Model_konten->select_jawaban_data('hitung_id', $ins);
            if ($data_jawaban == 0) {
                echo "masuk";
                $insert_act = $this->Model_konten->insert_jawab($ins);

                if ($insert_act) {
                    echo var_dump($insert_act);
                } else {
                    echo var_dump($insert_act);
                }

                $this->nilai_jawab($siswa, $sub_materi);
            } else {
                $data_jawaban_update = $this->Model_konten->select_jawaban_data('fetch_id', $ins);
                $createdtime = $data_jawaban_update->created_at;
                $updatetime = date('Y-m-d H:i:s');
                $ins['created_at'] = $createdtime;
                $ins['updated_at'] = $updatetime;

                //aksi
                $update_act = $this->Model_konten->update_jawab($ins);
                $this->nilai_jawab($siswa, $sub_materi);


            }
        }

    }

    public function nilai_jawab($siswa, $id_sub_materi)
    {
        $sekarang = date('Y-m-d H:i:s');
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        if ($pretest_logged) {
            $updt_ins = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $id_sub_materi,
                "soal_id"       => -1,
            ];

            //BUAT NILAI
            $update_nilai = 0; //akkhir
            $nilai_siswa = 0; //jawaban siswa
            $nilai_total = 0; //total semua berdasar bobot
            $data_jawaban_update = $this->Model_konten->select_jawaban_data_pretest('fetch', $updt_ins);

            $dt_kunci = [
                "sub_materi_id" => $id_sub_materi,
            ];
            $nilai_total = $this->Model_konten->select_kunci_idsubmateri($dt_kunci)->bobotnya;

            $poin_per_bobot = 100 / $nilai_total;
            if (preg_match('/\.\d{3,}/', $poin_per_bobot)) {
                // Jika koma lebih dari 3
                // $poin_per_bobot = 100/($nilai_total-1);
            }

            foreach ($data_jawaban_update as $dt) {
                $id_soal_jawab = $dt->soal_id;
                $dt_kunci = [
                    "soal_id" => $id_soal_jawab,
                ];
                $dt_kunci_fetch = $this->Model_konten->select_kunci($dt_kunci);

                $bobot_soal = $this->Model_konten->select_kunci($dt_kunci)->bobot;
                $kunci_jawaban = $this->Model_konten->select_kunci($dt_kunci)->kunci_jawaban;
                if ($dt->jawaban == $kunci_jawaban) {
                    $nilai_siswa += $bobot_soal * $poin_per_bobot;
                }
            }
            echo "Nilai total = $nilai_total <br> Poin Per Bobot = $poin_per_bobot <br> $nilai_siswa";
            if ($nilai_siswa > 100) {
                $nilai_siswa = 100;
            }

            $update_nilai = $nilai_siswa;

            $data_updt = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $id_sub_materi,
                "nilai"         => $update_nilai,
                "updated_at"    => $sekarang,
            ];

            //aksi2
            $update_log = $this->Model_konten->update_log_pretest($data_updt);

            //DEBUG
            // if($update_log){
            //     echo "berhasil nilai update";
            //     echo var_dump($update_log);

            // }else{
            //     echo "error log update";
            //     echo var_dump($update_log);
            // }
        } else {
            $updt_ins = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $id_sub_materi,
                "soal_id"       => -1,
            ];

            //BUAT NILAI
            $update_nilai = 0; //akkhir
            $nilai_siswa = 0; //jawaban siswa
            $nilai_total = 0; //total semua berdasar bobot
            $data_jawaban_update = $this->Model_konten->select_jawaban_data('fetch', $updt_ins);

            $dt_kunci = [
                "sub_materi_id" => $id_sub_materi,
            ];
            $nilai_total = $this->Model_konten->select_kunci_idsubmateri($dt_kunci)->bobotnya;

            $poin_per_bobot = 100 / $nilai_total;
            if (preg_match('/\.\d{3,}/', $poin_per_bobot)) {
                // Jika koma lebih dari 3
                // $poin_per_bobot = 100/($nilai_total-1);
            }

            foreach ($data_jawaban_update as $dt) {
                $id_soal_jawab = $dt->soal_id;
                $dt_kunci = [
                    "soal_id" => $id_soal_jawab,
                ];
                $dt_kunci_fetch = $this->Model_konten->select_kunci($dt_kunci);

                $bobot_soal = $this->Model_konten->select_kunci($dt_kunci)->bobot;
                $kunci_jawaban = $this->Model_konten->select_kunci($dt_kunci)->kunci_jawaban;
                if ($dt->jawaban == $kunci_jawaban) {
                    $nilai_siswa += $bobot_soal * $poin_per_bobot;
                }
            }
            echo "Nilai total = $nilai_total <br> Poin Per Bobot = $poin_per_bobot <br> $nilai_siswa";
            if ($nilai_siswa > 100) {
                $nilai_siswa = 100;
            }

            $update_nilai = $nilai_siswa;

            $data_updt = [
                "id_siswa"      => $siswa,
                "sub_materi_id" => $id_sub_materi,
                "nilai"         => $update_nilai,
                "updated_at"    => $sekarang,
            ];

            //aksi2
            $update_log = $this->Model_konten->update_log($data_updt, "ujian");

            //DEBUG
            // if($update_log){
            //     echo "berhasil nilai update";
            //     echo var_dump($update_log);

            // }else{
            //     echo "error log update";
            //     echo var_dump($update_log);
            // }
        }
    }

    public function end_soal($id_materi)
    {
        //CHECK DATA DI JAWABAN SISWA
        $siswa = $this->session->userdata('id_siswa');
        $sub_materi = intval($id_materi);
        $end = date('Y-m-d H:i:s');

        $dt_updt = [
            "id_siswa"      => $siswa,
            "sub_materi_id" => $sub_materi,
            "finish_ujian"  => $end,
        ];

        $update = $this->Model_konten->update_log($dt_updt, "ujian");

    }

    public function insert_log_baca($id, $sub_materi, $jenis_siswa)
    {
        // simpan ke log baca
        //TODO Log diinsert saat akses klik sidebar
        $tanggal = date(DATE_ATOM);
        $this->Model_konten->insert_log_baca($id, $sub_materi, $tanggal, $jenis_siswa);
    }

    public function update_log_baca($id, $sub_materi, $jenis_siswa)
    {
        // simpan ke log baca
        //TODO Log diinsert saat akses klik sidebar
        $tanggal = date(DATE_ATOM);
        $this->Model_konten->update_log_baca($id, $sub_materi, $tanggal, $jenis_siswa);
    }

    public function DOMinnerHTML(DOMNode $element)
    {
        $innerHTML = "";
        $children = $element->childNodes;

        foreach ($children as $child) {
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML;
    }

    public function remove_unsusedp($isi)
    {
        $isi = trim($isi);
        $isi = str_replace('&nbsp;', '', $isi);
        $isi = preg_replace('#<o:p>(\s|&nbsp;)*</o:p>#', '', $isi);
        $isi = preg_replace("/<p[^>]*>[\s|&nbsp;]*<\/p>/", '', $isi);
        $isi = trim($isi);

        return $isi;
    }

    public function remove_unsusedhtml($isi)
    {
        $isi = trim($isi);
        $isi = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace(['<html>', '</html>', '<body>', '</body>', '<head>', '</head>', '<title>', '</title>'], ['', '', '', '', '', '', '', ''], $isi));;
        $isi = preg_replace('/<!--(.*)-->/Uis', '', $isi);
        $isi = trim($isi);

        return $isi;
    }
}
