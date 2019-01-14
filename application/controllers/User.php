<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        //load library in construct. Construct method will be run everytime the controller is called

        //This library will be auto-loaded in every method in this controller.

        //So there will be no need to call the library again in each method.

        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_pg');
        $this->load->model('model_paket');
        $this->load->model('model_voucher');
        $this->load->model('model_pembayaran');
        $this->load->model('model_dashboard');
        $this->load->model('model_signup');
        $this->load->model('model_poin');
        $this->load->model('model_bonus');
        $this->load->model('model_fronttryout');
        $this->load->model('model_adm');

        $this->load->model('model_kontendownload');
    }

    public function index()
    {

        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
        if (empty($this->session->userdata('akses'))) {
            $datapembelian = $this->Model_pembayaran->get_tagihan_by_siswa($id_siswa);
            if (empty($datapembelian)) {
                redirect("user/aktivasi");
            } else {
                redirect("user/buylist");
            }
        }

        $idsiswa = $this->session->userdata('id_siswa');

        $data = array(

            'infosiswa' => $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'data_user' => $this->Model_pg->get_data_user($this->session->userdata('id_siswa')),

        );

        $this->load->view('pg_user/user_profil', $data);

    }

    public function aktivasi_submit()
    {
        $param = $_POST;
        $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-voucher", $param);
        $json = json_decode($data, true);
        if (isset($json['success'])) {
            if (!$json['success']) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode($json));
            } else {
                echo "<script type='text/javascript'>alert('" . $json['pesan'] . "');document.location='" . base_url() . "/user/logout';</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('" . $json['pesan'] . "');document.location='" . base_url() . "';</script>";
        }
    }

    public function ubah_profil()
    {
        $idsiswa = $this->session->userdata('id_siswa');

        if ($idsiswa == "") {
            redirect('login');
        }
        $infosiswa = $this->Model_dashboard->get_info_siswa($idsiswa);

        $carikelas = $this->Model_dashboard->get_kelas($idsiswa);
        $kelas = $carikelas->kelas;

        $carimapel = $this->Model_dashboard->get_mapel_by_kelas($kelas);

        $tanggalsekarang = date('Y-m-d');
        $kelasaktif = $this->Model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);

        $jumlahsoaltryout = $this->Model_dashboard->get_jumlah_soaltryout_bykelas($kelas);

        $bonus_unlocked = $this->Model_bonus->fetch_bonus_unlocked($idsiswa);
        if (!empty($bonus_unlocked)) {
            $bonus_unlocked = explode(',', $bonus_unlocked->unlocked);
        } else {
            $bonus_unlocked = array();
        }

        //UPDATE 20 OKTOBER 2016
        //#####################################
        $cariaktivasi = $this->Model_dashboard->cari_aktivasi($idsiswa);

        if ($cariaktivasi == 0) {
            $statussiswa = 'tidak_aktif';
        } else {
            $statussiswa = 'aktif';
        }
        //END UPDATE 20 OKTOBER 2016
        //#####################################

        $data = array(
            'infosiswa' => $infosiswa,
            'datamapel' => $carimapel,
            'kelasaktif' => $kelasaktif,
            'data_video_motivasi' => $this->Model_bonus->fetch_limit_bonus_video(5), //limit = 5
            'data_bonus' => $this->Model_bonus->fetch_limit_bonus_konten(5), //limit = 5
            'quote' => $this->Model_bonus->fetch_random_quote(), //limit = 5
            'bonus_unlocked' => $bonus_unlocked, //limit = 5
            'status_siswa' => $statussiswa, //update 20 oktober 2016
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'select_provinsi' => $this->Model_signup->get_provinsi(),
        );

        $this->load->view('pg_user/user_ubahprofil', $data);

    }

    public function tryoutsiswaold($idtryout = '')
    {
        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
        if (empty($this->session->userdata('akses'))) {
            $param = ['siswa' => $id_siswa];
            $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
            $datapembelian = $this->Model_pembayaran->get_tagihan_by_siswa($id_siswa);
            $json = json_decode($data, true);
            if ($json['exp']) {
                redirect("user/aktivasi");
            }
        }

        $idsiswa = $this->session->userdata('id_siswa');
        $session = $this->session->userdata;
        //$this->model_security->psep_sekolah_is_logged_in();
        //     $data = array(
        //         'infoortu'    => $this->model_parent->get_parent($_SESSION['id_ortu'])
        //     );
        //$this->load->view('pg_ortu/pilih_tryout', $data);
        $data = array(
            'infosiswa' => $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'data_user' => $this->Model_pg->get_data_user($this->session->userdata('id_siswa')),
            'profil_tryout' => $this->Model_adm->fetch_all_profil_by_kelas($session['kelas']),

        );
        $table_data = $data['profil_tryout'];

        $daftar_kategori_baru = [];
        $i = 0;
        foreach ($table_data as $kat) {
            $daftar_kategori = $this->Model_fronttryout->fetch_kategori($kat->id_tryout);
            $daftar_kategori_baru[$i] = json_decode(json_encode($kat), true);
            $j = 0;
            $index = 0;
            if (count($daftar_kategori) > 0) {
                foreach ($daftar_kategori as $subkey => $value) {
                    if ($value->id_profil == $kat->id_tryout) {
                        $cariskor = $this->Model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                        $cariskorsalah = $this->Model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                        $cariwaktu = $this->Model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), true);
                        $daftar_kategori_baru[$i]['cariskor'] = $cariskor;
                        $daftar_kategori_baru[$i]['cariskorsalah'] = $cariskorsalah;
                        $daftar_kategori_baru[$i]['cariwaktu'] = $cariwaktu;
                        unset($daftar_kategori[$index]);
                        $j++;
                    }
                    if ($j == 0) {
                        $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                    }
                }
                $index++;
            } else {
                $daftar_kategori_baru[$i]['daftar_kategori'] = null;
            }
            $i++;
        }
        $data['daftar_kategori_baru'] = $daftar_kategori_baru;

//        return $this->output
        //            ->set_content_type('application/json')
        //            ->set_status_header(500)
        //            ->set_output(json_encode($data));
        $this->load->view('pg_user/tryout-statistik', $data);
    }

    public function tryoutsiswa()
    {
        if ($this->uri->segment(3) == "") {
            redirect('user/dashboard');
        } else {
            $idtryout = $this->uri->segment(3);
            $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
            if (empty($this->session->userdata('akses'))) {
                $param = ['siswa' => $id_siswa];
                $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
                $datapembelian = $this->Model_pembayaran->get_tagihan_by_siswa($id_siswa);
                $json = json_decode($data, true);

                if ($json['exp']) {
                    redirect("user/aktivasi");
                }
            }

            $idsiswa = $this->session->userdata('id_siswa');
            $session = $this->session->userdata;

            //$this->model_security->psep_sekolah_is_logged_in();
            //     $data = array(
            //         'infoortu'    => $this->model_parent->get_parent($_SESSION['id_ortu'])
            //     );
            //$this->load->view('pg_ortu/pilih_tryout', $data);
            $data = array(
                'infosiswa' => $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
                'navbar_links' => $this->Model_pg->get_navbar_links(),
                'data_user' => $this->Model_pg->get_data_user($this->session->userdata('id_siswa')),
                'profil_tryout' => $this->Model_adm->fetch_all_profil_by_id($idtryout),
                'profil_tryout_all' => $this->Model_adm->fetch_all_profil_by_kelas($session['kelas']),
                'dataperingkat' => $this->Model_dashboard->peringkat($idtryout),
            );
            $table_data = $data['profil_tryout'];

            $daftar_kategori_baru = [];
            $i = 0;
            $totalsoal = 0;
            $totalbenar = 0;
            foreach ($table_data as $kat) {
                $daftar_kategori = $this->Model_fronttryout->fetch_kategori($kat->id_tryout);
                $daftar_kategori_baru[$i] = json_decode(json_encode($kat), true);
                $j = 0;
                $index = 0;
                if (count($daftar_kategori) > 0) {
                    foreach ($daftar_kategori as $subkey => $value) {
                        if ($value->id_profil == $kat->id_tryout && $value->remidi == 0) {
                            $cariskor = $this->Model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                            $cariskorsalah = $this->Model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                            $cariwaktu = $this->Model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), true);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                            $totalsoal += $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jumlah_soal'];
                            $totalbenar += $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisawaktu'] = json_decode(json_encode($this->Model_dashboard->analisis_waktu($value->id_kategori, $idsiswa)), true);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisistopik'] = json_decode(json_encode($this->Model_dashboard->analisistopik($value->id_kategori, $idsiswa)), true);
                            $analisa_topik = json_decode(json_encode($this->Model_dashboard->analisatopik($value->id_kategori, $idsiswa)), true);
                            $k = 0;
                            foreach ($analisa_topik as $at) {
                                if ($at['id_analisis_topik'] != null) {
                                    $at['jml_benar'] = $this->Model_dashboard->analisabytopikbenar($value->id_kategori, $at['topik'], $idsiswa);
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k] = $at;
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['total'] = $this->Model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik']);
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['presentase'] = ($at['jml_benar'] == 0 ? 0 : ($at['jml_benar'] / $this->Model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik'])) * 100);
                                } else {
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j][$k]['analisa_topik'] = null;
                                }
                                $k++;
                            }
                            unset($daftar_kategori[$index]);
                            $j++;
                        }
                        if ($j == 0) {
                            $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                        }
                    }
                    $index++;
                } else {
                    $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                }
                $i++;
            }
            $data['daftar_kategori_baru'] = $daftar_kategori_baru;
            $data['daftar_kategori_baru']['totalsoal'] = $totalsoal;
            $data['daftar_kategori_baru']['totalbenar'] = $totalbenar;
//
            //            return $this->output
            //                ->set_content_type('application/json')
            //                ->set_status_header(500)
            //                ->set_output(json_encode($data));
            $this->load->view('pg_user/tryout-statistik', $data);
        }
    }

    public function do_ubah_profil()
    {

        $data = array(

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'data_user' => $this->Model_pg->get_data_user($_SESSION['id_siswa']),

            'select_sekolah' => $this->Model_pg->fetch_all_sekolah(),

            'select_kelas' => $this->Model_pg->fetch_all_kelas(),

        );

        //checking if user has logged in

        if ($_SESSION['id_siswa']) {

            $this->form_validation_rules('profil');

            $foto = $this->upload_file('foto_profil', $_SESSION['id_siswa']);

            if ($this->form_validation->run() == true) {

                $params = $this->input->post(null, true);

                $data_siswa = array(

                    'nama_siswa' => $params['namalengkap'] ? $params['namalengkap'] : '',

                    'email' => $params['email'] ? $params['email'] : '',

                    'telepon' => $params['nohp'] ? $params['nohp'] : '',

                    'telepon_ortu' => $params['nohp_ortu'] ? $params['nohp_ortu'] : '',

                    'sekolah_id' => $params['sekolah'] ? $params['sekolah'] : '',

                    'kelas' => $params['kelas'] ? $params['kelas'] : '',

                    'foto' => $foto ? $foto : '',

                );

                $data_login_siswa = array(

                    'username' => $params['pengguna'] ? $params['pengguna'] : '',

                    'password' => $params['katasandi'] ? md5($params['katasandi']) : '',

                );

                // for testing purpose

                // echo "w/o filter:<br>";

                // print_r($data_siswa);

                // echo "<br>";

                // print_r($data_login_siswa);

                // echo "<br>";

                // echo "<br>";

                // echo "w/ filter:<br>";

                // print_r(array_filter($data_siswa));

                // echo "<br>";

                // print_r(array_filter($data_login_siswa));

                // echo "<br>";

                // echo "<pre>";

                // print_r($_SESSION);

                // echo "</pre>";

                // die();

                $result = $this->Model_pg->update_data_user($_SESSION['id_siswa'], $data_siswa, $data_login_siswa);

                if ($result) {

                    //updating session

                    $session_update = array_filter($data_siswa);

                    $this->session->set_userdata($session_update);

                    $session_update = array_filter($data_login_siswa);

                    $this->session->set_userdata($session_update);

                    $this->session->unset_userdata(array('telepon', 'telepon_ortu', 'password'));

                    alert_success('Berhasil!', 'Profil berhasil diubah');

                } else {
                    alert_error('Gagal!', 'Profil gagal diubah');
                }

            } else {

                alert_error('Gagal!', 'Profil gagal diubah');

            }

        }

        redirect('user/ubah_profil');

    }

    public function beli()
    {

        if ($this->session->userdata('id_siswa') == "") {
            redirect('login');
        }
        $idsiswa = $this->session->userdata('id_siswa');
        $infosiswa = $this->Model_dashboard->get_info_siswa($idsiswa);

        $data = array(

            'infosiswa' => $infosiswa,

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'data_reguler' => $this->Model_paket->get_paket_reguler(),

            'data_premium' => $this->Model_paket->get_paket_premium(),

        );

        $this->load->view('pg_user/user_beli', $data);

    }

    public function do_beli()
    {

        $this->form_validation_rules('beli');

        $now = new DateTime(null);

        $params = $this->input->post(null, true);

        //PERSIAPAN 1

        $new_pembayaran = array(

            "no_tagihan" => '', //no_tagihan set in model_pembayaran

            "siswa_id" => isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0,

            "kelas_id" => 0, //temporary, ganti dengan id_kelas siswa yg sedang login(ambil dari session)

            "metode_pembayaran" => $params["metode_pembayaran"], // 1=transfer, 2=indomaret

            "status" => 0, //status 0 untuk pembayaran yang belum dikonfirmasi oleh siswa

            "timestamp" => $now->format("Y-m-d H:i:00"),

        );

        //PERSIAPAN 2

        //Set interval 1 hari untuk batas waktu pembayaran

        $now->add(new DateInterval('P1D'));

        $new_pembayaran['expired_on'] = $now->format("Y-m-d H:i:00");

        //PERSIAPAN 3

        //fetching post with name contains 'paket_'

        $assoc_keys = preg_grep('/^paket_/', array_keys($params));

        $data_paket = $this->Model_paket->get_all_paket();

        $detail_pembelian = array();

        foreach ($assoc_keys as $index) {

            if ($params["{$index}"] > 0) {

                $sub_index = explode('_', $index);

                $detail_pembelian[] = array(

                    'id_paket' => end($sub_index),

                    'harga_satuan' => $this->get_harga_paket(end($sub_index), $data_paket),

                    'jumlah' => $params["{$index}"],

                );

            }

        }

        // echo "<pre>";

        // print_r($detail_pembelian);

        // echo "</pre>";

        // die();

        // $params[current(preg_grep('/^reguler_/', array_keys($params)))];

        if (!empty($detail_pembelian) or !empty($metode_pembayaran)) {

            $result = $this->Model_pembayaran->simpan($new_pembayaran, $detail_pembelian);

//            $this->send_email_invoice($result);

            redirect("user/bayar/" . $result);

        } else {

            alert_error("Gagal", "Pilih paket yang ingin dibeli");

            redirect("user/beli");

        }

    }

    public function send_email_invoice($id_pembelian)
    {
        $siswa_id = $this->Model_pembayaran->cek_siswa_by_pembelian($id_pembelian);
        $infosiswa = $this->Model_dashboard->get_info_siswa($siswa_id);

        $data = array(
            'buy' => $this->Model_pembayaran->get_pembelian($id_pembelian),
            'detail_pembelian' => $this->Model_pembayaran->get_detail_pembelian($id_pembelian),
        );

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.postmarkapp.com',
            'smtp_port' => 587,
            'smtp_user' => 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
            'smtp_pass' => 'c51e35dc-358a-4c72-9390-d36ecf7f078c', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => true,
        );

        $message = '';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('cs@primemobile.co.id', 'Prime Mobile Customer Service'); // change it to yours
        $this->email->to($infosiswa->email_siswa); // change it to yours
        $this->email->subject('Invoice Prime Mobile');
        $dataemail = $data;

        $body = $this->load->view('pg_user/email_invoice.php', $dataemail, true);
        $this->email->message($body);
        if ($this->email->send()) {
            $res = $this->session->set_flashdata('msgemail', 'Email Invoice Tagihan pembelian voucher berhasil dikirim ..');
        } else {
            $res = $this->session->set_flashdata('msgemail', show_error($this->email->print_debugger()));
        }
        return $res;
    }

    private function get_harga_paket($id_paket, $data_paket)
    {

        foreach ($data_paket as $item) {

            if ($item['id_paket'] == $id_paket) {

                return $item['harga'];

            }

        }

    }

    public function buylist()
    {

        if ($this->session->userdata('id_siswa') == "") {
            redirect('login');
        }

        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

        $data = array(

            'infosiswa' => $this->Model_dashboard->get_info_siswa($id_siswa),

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'data_pembelian' => $this->Model_pembayaran->get_pembelian_by_siswa($id_siswa),

        );

        //checking for expired invoice

        foreach ($data['data_pembelian'] as $invoice) {

            if ($invoice->status == 0) //invoice yang belum dibayar

            {

                $this->cek_expired($invoice->id_pembelian);

            }

        }

        //SAGAB
        $data['riwayat_cbt'] = $this->Model_pembayaran->riwayat_join_cbt($id_siswa);
        //END SAGAB

        $this->load->view('pg_user/user_buylist', $data);

    }

    public function aktivasi()
    {

        if ($this->session->userdata('id_siswa') == "") {
            redirect('login');
        }

        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

        $param = ['siswa' => $id_siswa];
        $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
        $datapembelian = $this->Model_pembayaran->get_tagihan_by_siswa($id_siswa);
        $json = json_decode($data, true);

        $data = array(
            'infosiswa' => $this->Model_dashboard->get_info_siswa($id_siswa),
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'select_options' => $this->Model_pg->fetch_all_kelas(),
        );

        $this->load->view('pg_user/user_aktivasi', $data);

    }

    public function do_aktivasi()
    {

        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

        $data = array(

            'infosiswa' => $this->Model_dashboard->get_info_siswa($id_siswa),

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'select_options' => $this->Model_pg->fetch_all_kelas(),

        );

        $params = $this->input->post(null, true);

        //$kode_voucher = $params['kode_voucher'];

        $nmr_aktivasi = $params['kode_aktivasi'];

        $id_kelas = isset($params['kelas']) ? $params['kelas'] : 0;

        $alias_kelas = $this->Model_voucher->get_kelas_by_id($id_kelas);

        $this->form_validation_rules('aktivasi');

        if ($this->form_validation->run() == true) {

            $voucher = $this->Model_voucher->check_voucher_by_aktivasi($nmr_aktivasi);

            if (empty($voucher)) {

                alert_error('Error!', 'Nomor Aktivasi salah');

                redirect('user/aktivasi');

            } else {

                if ($voucher->status == 0) //if voucher status is available

                {

                    if ($nmr_aktivasi != $voucher->no_aktivasi) {

                        alert_error('Error!', 'Nomor Aktivasi salah !');

                        redirect('user/aktivasi');

                    } else {

                        $now = new DateTime(null);

                        // echo 'ada bo! '.($voucher->tipe == 0 ? 'reguler' : 'premium').' '.$voucher->durasi.' bulan';

                        $data_aktivasi = array(

                            'id_siswa' => isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : null,

                            'id_kelas' => $id_kelas,

                            'id_paket' => $voucher->id_paket,

                            'id_paket' => $voucher->id_paket,

                            'timestamp' => $now->format("Y-m-d H:i:00"),

                            'isaktif' => 1, //diaktifkan

                        );

                        //add activation expired date

                        $cekindihome = $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa'));
                        if ($cekindihome->id_indihome > 0) {
                            $now->add(new DateInterval('P' . (12 * 10) . 'M'));
                        } else {
                            $now->add(new DateInterval('P' . $voucher->durasi . 'M'));
                        }

                        $data_aktivasi['expired_on'] = $now->format("Y-m-d H:i:00");

                        //cek apakah ada aktivasi sebelumnya
                        if (empty($this->session->userdata('akses'))) {
                            $result = $this->Model_voucher->add_paket_aktif($data_aktivasi);
                            $set_aktif = $this->Model_voucher->set_status_aktivasi($nmr_aktivasi);

                            //edit kelas di tabel siswa sesuai dengan aktivasi
                            $this->Model_voucher->edit_kelas_siswa($idsiswa, $id_kelas);

                            //update session 'akses'
                            $this->update_session_akses();
                        } else {
                            //jika ada aktivasi sebelumnya, hapus dahulu, baru input aktivasi baru
                            $hapusaktivasi = $this->Model_voucher->hapus_paket_aktif($_SESSION['id_siswa']);

                            $result = $this->Model_voucher->add_paket_aktif($data_aktivasi);
                            $set_aktif = $this->Model_voucher->set_status_aktivasi($nmr_aktivasi);

                            //edit kelas di tabel siswa sesuai dengan aktivasi
                            $this->Model_voucher->edit_kelas_siswa($_SESSION['id_siswa'], $id_kelas);

                            //update session 'akses'
                            $this->update_session_akses();
                        }
                        //end cek

                        if ($result) {

                            $alert_message = "Kode Voucher telah diaktifkan" .

                                "<hr>" .

                                "Paket <b>" . ($voucher->tipe == 0 ? 'Reguler' : 'Premium') . " " . $voucher->durasi . " bulan</b>" .

                                " untuk <b>" . ($voucher->tipe == 0 ? $alias_kelas : 'semua kelas') .

                                "</b><br> Aktif tanggal <b>" . date("d M Y") . "</b> s/d <b>" . $now->format("d M Y") . "</b>" .

                                "<hr><br><a href='" . base_url() . "' class='btn btn-primary'>Mulai</a>";

                            alert_success('Berhasil!', $alert_message);

                        }

                        $this->session->set_flashdata('berhasil', 'Ok');

                        redirect('user/aktivasi');

                    }

                } else {

                    alert_warning('Error!', 'Voucher telah digunakan');

                    redirect('user/aktivasi');

                }

            }

            die();

        } else {

            $this->load->view('pg_user/user_aktivasi', $data);

        }

    }

    public function bayar($id_pembelian = '')
    {

        if ($this->session->userdata('id_siswa') == "") {
            redirect('login');
        }

        $siswa_id = false;

        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : '';

        if (!empty($id_pembelian)) {

            $siswa_id = $this->Model_pembayaran->cek_siswa_by_pembelian($id_pembelian);

        }

        //check if this pembelian is done by this siswa (check siswa in db and one in the session)

        if ($siswa_id == $id_siswa) {

            $data = array(

                'infosiswa' => $this->Model_dashboard->get_info_siswa($id_siswa),

                'navbar_links' => $this->Model_pg->get_navbar_links(),

                'buy' => $this->Model_pembayaran->get_pembelian($id_pembelian),

                'detail_pembelian' => $this->Model_pembayaran->get_detail_pembelian($id_pembelian),

            );

            //checking for expired invoice

            if ($data['buy']->status == 0) //0 = belum dibayar

            {

                $this->cek_expired($id_pembelian);

            }

            $this->load->view('pg_user/user_bayar', $data);

        } else {

            show_404();

        }

    }

    public function do_bayar($id_pembelian)
    {

        if (!empty($id_pembelian)) {

            $params = $this->input->post(null, true);

            $file_bukti = $this->upload_file('file_bukti');

            if ($file_bukti != null) {

                alert_success('Berhasil!', 'File bukti pembayaran telah diupload');

                $this->Model_pembayaran->update_file_bukti($file_bukti, $id_pembelian);

                redirect('user/buylist');

            } else {

                alert_error('Gagal!', 'Terjadi kesalahan dalam upload file');

                redirect('user/bayar/' . $id_pembelian);

            }

        } else {

            show_404();

        }

    }

    public function cetak_invoice($id_pembelian = '')
    {

        $siswa_id = false;

        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : '';

        if (!empty($id_pembelian)) {

            $siswa_id = $this->Model_pembayaran->cek_siswa_by_pembelian($id_pembelian);

        }

        //check if this pembelian is done by this siswa (check siswa in db and one in the session)

        if ($siswa_id == $id_siswa) {

            $data = array(

                'navbar_links' => $this->Model_pg->get_navbar_links(),

                'buy' => $this->Model_pembayaran->get_pembelian($id_pembelian),

                'detail_pembelian' => $this->Model_pembayaran->get_detail_pembelian($id_pembelian),

            );

            $this->load->view('pg_user/user_invoice', $data);

        } else {

            show_404();

        }

    }

    private function form_validation_rules($form)
    {

        if ($form) {

            switch ($form) {

                case 'beli':

                    //set validation rules for each input

                    // $this->form_validation->set_rules('id_bank', 'Kategori Materi', 'trim|required');

                    // $this->form_validation->set_rules('no_rek', 'Mata Pelajaran', 'trim|required');

                    //set custom error message

                    // $this->form_validation->set_message('required', '%s tidak boleh kosong');

                    break;

                case 'aktivasi':

                    //set validation rules for each input

                    $this->form_validation->set_rules('kode_aktivasi', 'Nomor Aktivasi', 'trim|required');

                    $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

                    //set custom error message

                    $this->form_validation->set_message('required', '%s tidak boleh kosong');

                    break;

                case 'profil':

                    //set validation rules for each input

                    $this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'trim|required');

                    $this->form_validation->set_rules('email', 'Email', 'trim|required');

                    $this->form_validation->set_rules('pengguna', 'Username', 'trim|required');

                    $this->form_validation->set_rules('nohp', 'Telepon', 'trim|numeric');

                    $this->form_validation->set_rules('nohp_ortu', 'Telepon Orang Tua', 'trim|numeric');

                    $this->form_validation->set_rules('sekolah', 'Sekolah', 'trim|required');

                    $this->form_validation->set_rules('kelas', 'Kelas', 'trim|required');

                    //set custom error message

                    $this->form_validation->set_message('required', '%s tidak boleh kosong');

                    break;

                default:

                    # code...

                    break;

            }

        }

    }

    private function upload_file($keperluan = '', $id_siswa = '')
    {

        $result = null;

        $config['overwrite'] = false;

        switch ($keperluan) {

            case 'file_bukti':

                $tipe = $this->cek_tipe($_FILES['file_bukti']['type']);

                $img_path = "assets/uploads/verifikasi/";

                $img_name = "verifikasi_" . substr(sha1(substr(md5($_FILES['file_bukti']['name']), 0, 4) . getrandmax()), 0, 7) . $tipe;

                $input_name = 'file_bukti';

                $view = 'pg_user/user_bayar';

                break;

            case 'foto_profil':

                $config['overwrite'] = true;

                $tipe = $this->cek_tipe($_FILES['foto']['type']);

                $img_path = "assets/uploads/foto_siswa/";

                $img_name = $id_siswa . md5(time()) . $tipe;

                $input_name = 'foto';

                $view = 'pg_user/user_ubahprofil';

                break;

            default:

                $img_path = '';

                $img_name = '';

                $input_name = '';

                $view = '';

                break;

        }

        $config['upload_path'] = $img_path;

        $config['allowed_types'] = "png|jpg";

        $config['file_name'] = $img_name;

        $this->load->library('upload', $config);

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($input_name)) {

            $error = array('error' => $this->upload->display_errors());

            $this->load->view($view, $error);

            // $this->upload->display_errors();

        } else {

            $result = $img_name;

            if ($keperluan == 'foto_profil') {
                $this->load->library('image_lib');
                $config1['image_library'] = 'gd2';
                $config1['source_image'] = 'assets/uploads/foto_siswa/' . $result;
                $config1['new_image'] = 'assets/uploads/foto_siswa/' . $result;
                $config1['maintain_ratio'] = true;
                $config1['width'] = 200;
                $config1['height'] = 300;
                $this->image_lib->initialize($config1);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }

        }

        return $result;

    }

    private function cek_tipe($tipe)
    {

        if ($tipe == 'image/jpeg') {
            return ".jpg";
        } else if ($tipe == 'image/png') {
            return ".png";
        } else {
            return false;
        }

    }

    private function cek_expired($id_pembelian)
    {

        $pembelian = $this->Model_pembayaran->get_pembelian($id_pembelian);

        if (strtotime($pembelian->expired_on) <= strtotime(date('Y-m-d H:i:00')) && ($pembelian->status == 0)) {

            //set status to "dibatalkan"

            $this->Model_pembayaran->update_status("3", $id_pembelian);

        }

    }

    private function update_session_akses()
    {

        $this->load->model('model_login');

        if (isset($_SESSION['id_siswa'])) {

            //get user access

            $siswa_access = $this->Model_login->cek_user_akses($_SESSION['id_siswa']);

            $akses_kelas = array();

            foreach ($siswa_access as $item) {

                // if (strtolower($item->tipe) == 'reguler') {

                if ($item->tipe == 0 || $item->tipe == 2) {
                    //0 = reguler || 2 = indihome

                    $akses_kelas['reguler'][] = $item->id_kelas;

                }

                // if (strtolower($item->tipe) == 'premium') {

                if ($item->tipe == 1) {
                    //1 = premium

                    $akses_kelas['premium'][] = $item->id_kelas;

                }

            }

            // proses set session

            $this->session->set_userdata('akses', $akses_kelas);

        }

    }

    public function logout()
    {

        $this->session->sess_destroy();

        redirect(base_url());

    }

    public function ajax_select_kelas()
    {

        $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

        if ($id) {

            $sekolah = $this->Model_pg->fetch_sekolah_by_id($id);

            $dynamic_options = $this->Model_pg->fetch_kelas_by_jenjang($sekolah->jenjang);

            if ($dynamic_options) {

                echo "<option value='' disabled selected>Pilih Kelas...</option>";

                foreach ($dynamic_options as $item) {

                    echo "<option value='" . $item->id_kelas . "'> $item->alias_kelas </option>";

                }

            } else {

                echo "<option value='' disabled='disabled'>Tidak ada data</option>";

            }

        } else {

            return false;

        }

    }

    public function link_akun_fb()
    {

        $id_siswa = $_SESSION['id_siswa'] ? $_SESSION['id_siswa'] : null;

        $fb_id = $this->input->post('id') ? $this->input->post('id') : null;

        $result = false;

        if (!empty($fb_id)) {

            $link = $this->Model_pg->link_akun_fb($id_siswa, $fb_id);

            if ($link) {

                $result = true;

            }

        }

        echo json_encode($result);

    }

    public function unlink_akun_fb()
    {

        $fb_id = $this->input->post('id') ? $this->input->post('id') : null;

        $result = false;

        if (!empty($fb_id)) {

            $unlink = $this->Model_pg->unlink_akun_fb($fb_id);

            if ($unlink) {

                $result = true;

            }

        }

        echo json_encode($result);

    }

    private function curl_download($Url, $param = array())
    {

        // is cURL installed yet?
        if (!function_exists('curl_init')) {
            die('Sorry cURL is not installed!');
        }

        // OK cool - then let's create a new cURL resource handle
        $ch = curl_init();

        // Now set some options (most are optional)

        // Set URL to download
        curl_setopt($ch, CURLOPT_URL, $Url);
        //set Post
        curl_setopt($ch, CURLOPT_POST, true);
        // Set a referer
        curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
        // Set a param
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        // User agent
        curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");

        // Include header in result? (0 = yes, 1 = no)
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Should cURL return or print out the data? (true = return, false = print)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        // Download the given URL, and return output
        $output = curl_exec($ch);

        // Close the cURL resource, and free system resources
        curl_close($ch);

        return $output;
    }

    public function dashboard($idtryout = '')
    {
        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
        if (empty($this->session->userdata('akses'))) {
            $param = ['siswa' => $id_siswa];
            $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
            $datapembelian = $this->Model_pembayaran->get_tagihan_by_siswa($id_siswa);
            $json = json_decode($data, true);

            if ($json['exp']) {
                redirect("user/aktivasi");
            }

        }
        $param = ['siswa' => $id_siswa];
        $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
        // $datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
        $json = json_decode($data, true);
        $idsiswa = $this->session->userdata('id_siswa');

        if ($idsiswa == "") {
            redirect('login');
        }
        $infosiswa = $this->Model_dashboard->get_info_siswa($idsiswa);

        $carikelas = $this->Model_dashboard->get_kelas($idsiswa);
        $kelas = $carikelas->kelas;

        $carimapel = array();
        $akses = $this->session->userdata('akses');
        $tanggalsekarang = date("Y-m-d");
        if (array_key_exists('premium', $akses)) {
            $kelasaktif = $this->Model_dashboard->get_kelas_premium();
        } else {
            $kelasaktif = $this->Model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
        }

        $jumlahsoaltryout = $this->Model_dashboard->get_jumlah_soaltryout_bykelas($kelas);

        $bonus_unlocked = $this->Model_bonus->fetch_bonus_unlocked($idsiswa);
        if (!empty($bonus_unlocked)) {
            $bonus_unlocked = explode(',', $bonus_unlocked->unlocked);
        } else {
            $bonus_unlocked = array();
        }

        //UPDATE 20 OKTOBER 2016
        //#####################################
        $cariaktivasi = $this->Model_dashboard->cari_aktivasi($idsiswa);

        if ($cariaktivasi == 0) {
            $statussiswa = 'tidak_aktif';
        } else {
            $statussiswa = 'aktif';
        }

        //END UPDATE 20 OKTOBER 2016
        //#####################################

        //UPDATE 08 Agustus 2017
        //#####################################
        $kelasaktif = $this->Model_dashboard->kelas_by_id_in($json['kelas']);
        $menu = array();
        foreach ($kelasaktif as $kelas2) {
            $carimapel[$kelas2->id_kelas] = $this->Model_dashboard->get_mapel_by_kelas($kelas2->id_kelas);
            $menu[$kelas2->jenjang][$kelas2->id_kelas] = $this->Model_dashboard->get_mapel_by_kelas($kelas2->id_kelas);
        }

        //END UPDATE 08 Agustus 2017
        //#####################################

        $session = $this->session->userdata;
        $data = array(
            'tryout' => $idtryout,
            'infosiswa' => $infosiswa,
            'kelasaktif' => $kelasaktif,
            'data_video_motivasi' => $this->Model_bonus->fetch_limit_bonus_video(50), //limit = 5
            'data_bonus' => $this->Model_bonus->fetch_limit_bonus_konten(50), //limit = 5
            'quote' => $this->Model_bonus->fetch_random_quote(), //limit = 5
            'bonus_unlocked' => $bonus_unlocked, //limit = 5
            'status_siswa' => $statussiswa, //update 20 oktober 2016
            'select_provinsi' => $this->Model_signup->get_provinsi(),
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'data_profil' => $this->Model_dashboard->fetch_all_cbtcontest(),

            /* NEW MAPEL */
            'carimapel' => $carimapel,

        );
        $table_data = $this->Model_adm->fetch_all_profil_by_kelas($session['kelas']);

        $daftar_kategori_baru = [];
        $i = 0;
        $r = 0;
        foreach ($table_data as $kat) {
            $r = $kat->id_tryout;
            $daftar_kategori = $this->Model_fronttryout->fetch_kategori($kat->id_tryout);
            $daftar_kategori_baru[$i] = json_decode(json_encode($kat), true);
            $j = 0;
            $index = 0;
            if (count($daftar_kategori) > 0) {
                foreach ($daftar_kategori as $subkey => $value) {
                    if ($value->id_profil == $kat->id_tryout) {
                        $cariskor = $this->Model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                        $cariskorsalah = $this->Model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                        $cariwaktu = $this->Model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), true);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                        unset($daftar_kategori[$index]);
                        $j++;
                    }
                    if ($j == 0) {
                        $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                    }
                }
                $index++;
            } else {
                $daftar_kategori_baru[$i]['daftar_kategori'] = null;
            }
            $i++;
        }
        $data['daftar_kategori_baru'] = $daftar_kategori_baru;
//         return $this->output
        //             ->set_content_type('application/json')
        //             ->set_status_header(500)
        //             ->set_output(json_encode($_SESSION['menu']));
        $this->load->view('pg_user/dashboard_user', $data);
    }

    public function pilihmapel($idkelas)
    {
        $carimapel = $this->Model_dashboard->get_mapel_by_kelas($idkelas);
        foreach ($carimapel as $mapel) {
            echo "
				<li class='pilih' id='" . $mapel->id_mapel . "'><a href='#dropmapel' id='asdasdasd'>" . $mapel->nama_mapel . "<span class='circle' style='background-color:#e6353c;'></span></a></li>
			";
        }
        ?>
        <script>
            $(function () {
                $(".pilih").click(function () {
                    $("#materi").html("<img src='<?php echo base_url('assets/img/gears.gif'); ?>' style='margin: 20px auto 0px; width: 200px;' />");
                    $("#materi").load("materi/" + $(this).attr('id'));
                });
            });
        </script>
        <?php
    }

    public function lihatmapel($idkelas)
    {
        /* MARKED USER MAPEL */
        $carimapel = $this->Model_dashboard->get_mapel_by_kelas($idkelas);

        echo "
		<button class='btn btn-link kembalikelas pull-right hidden'></button>
		<div class='col-lg-12'>
		<p>&nbsp;
		<p>&nbsp;
		</div>";

        foreach ($carimapel as $mapel) {
            echo "
				<div class='mapel-container'>
					<div class='content'>
						<div class='title'>
							<h5>$mapel->alias_kelas</h5>
							<h4 style='text-transform:uppercase;'>$mapel->nama_mapel</h4>
						</div>
						<input type='hidden' id='m$mapel->id_mapel' value='$idkelas'/>
						<button class='btn btn-dashboard-materi btn-pilihmapel' id='$mapel->id_mapel'>Lihat Materi</button>
					</div>
				</div>
			";
        }
        ?>
        <script>
            $(function () {
                $(".btn-pilihmapel").click(function () {
                    var kelas = $("#m" + $(this).attr('id')).val();
                    $("#materi" + kelas).html("<img src='<?php echo base_url('assets/img/gears.gif'); ?>' style='margin: 20px auto 0px; width: 200px;' />");
                    $("[btn-ke=" + kelas + "]").removeClass("hidden");
                    $("[btn-ke=" + kelas + "]").addClass("kembalimapel");
                    $("[btn-ke=" + kelas + "]").addClass("show");
                    $("#materi" + kelas).load("materi/" + $(this).attr('id'));

                });
                // $(".kembalikelas").click(function () {
                //  $("#materi").html("<img src='<?php echo base_url('assets/img/gears.gif'); ?>' style='margin: 20px auto 0px; width: 200px;' />");
                //  $("#materi").load("kembalikelas");
                // });
            });
        </script>
        <!-- height judul materi -->
        <script type="text/javascript" charset="utf-8">
            $(function () {
                $('.mapel-container .content .title h4').matchHeight();
            });
        </script>
        <?php
    }

    public function kembalikelas()
    {
        $idsiswa = $this->session->userdata('id_siswa');

        $tanggalsekarang = date('Y-m-d');

        $akses = $this->session->userdata('akses');

        if (array_key_exists('premium', $akses)) {
            $kelasaktif = $this->Model_dashboard->get_kelas_premium();
        } else {
            $kelasaktif = $this->Model_dashboard->get_kelas_aktif($idsiswa, $tanggalsekarang);
        }

        foreach ($kelasaktif as $kelas) {
            ?>
            <div class="mapel-container">
                <div class="content">
                    <div class="title">
                        <h4><?php echo $kelas->alias_kelas; ?></h4>
                    </div>
                    <button class="btn btn-dashboard-materi btn-kelas" type="submit"
                            id="<?php echo $kelas->id_kelas; ?>">Lihat Mata Pelajaran
                    </button>
                </div>
            </div>
            <?php
        }
        ?>
        <script>
            $(".btn-kelas").click(function () {
                $("#materi").html("<img src='<?php echo base_url('assets/img/gears.gif'); ?>' style='margin: 20px auto 0px; width: 200px;' />");
                $("#materi").load("lihatmapel/" + $(this).attr('id'));
            });
        </script>
        <?php
    }

    public function kembalimapel($idkelas)
    {

    }

    public function carimateri($keyword)
    {
        $keyword = rawurldecode($keyword);
        $carimateri = $this->Model_dashboard->get_materi_by_keyword($keyword);
        //echo $keyword;
        foreach ($carimateri as $materi) {
            ?>
            <div class="mapel-container">
                <div class="content">
                    <div class="title">
                        <?php echo $materi->alias_kelas; ?>
                        <h4><?php echo $materi->nama_materi_pokok; ?></h4>
                    </div>
                    <a href="../materi/tabel_konten_detail/<?php echo $materi->id_materi_pokok; ?>"
                       class="btn btn-dashboard-materi btn-block" type="submit">Mulai Belajar</a>
                </div>
            </div>
            <?php
        }

    }

    public function profil($idkelas)
    {
        $cariprofil = $this->Model_dashboard->get_profil_by_kelas($idkelas);

        foreach ($cariprofil as $profil) {
            echo "
				<li class='pilihprofil' id='" . $profil->id_tryout . "'><a href='#dropmapel' id='asdasdasd'>" . $profil->nama_profil . "<span class='circle' style='background-color:#e6353c;'></span></a></li>
			";
        }
        ?>
        <script>
            $(function () {
                $(".pilihprofil").click(function () {
                    $("#tryout").html("<img src='<?php echo base_url('assets/img/gears.gif'); ?>' style='margin: 20px auto 0px; width: 200px;' />");
                    $("#tryout").load("tryout/" + $(this).attr('id'));
                    $("#profilterpilih").val($(this).attr('id'));
                    $('#submitstatistik').css('display', 'inline-block');
                });
            });
        </script>
        <?php
    }

    public function materi($idmapel)
    {
        $carimateri = $this->Model_dashboard->get_topik_by_mapel($idmapel);
        $infomapel = $this->Model_dashboard->get_info_mapel($idmapel);
        echo "
		<button class='btn btn-link hidden'><< Tutup</button>
		<div class='col-lg-12'>
		<p>&nbsp;
		<p>&nbsp;
		</div>";
        foreach ($carimateri as $materi) {
            ?>
            <div class="mapel-container">
                <div class="content">
                    <div class="title">
                        <h5><?php echo $materi->alias_kelas; ?></h5>
                        <h4><?php echo $materi->nama_materi_pokok; ?></h4>
                    </div>
                    <a href="../materi/tabel_konten_detail/<?php echo $materi->id_materi_pokok; ?>"
                       class="btn btn-dashboard-materi" type="submit">Mulai</a>
                </div>
            </div>
            <?php
        }
        ?>
        <script>
            $(function () {
                $("#materi-home .materi-home-btn").attr("id", "<?php echo $infomapel->kelas_id; ?>");
            });
        </script>
        <script>
            $(function () {
                $(".kembalimapel").click(function () {
                    var kelas = $(this).attr('btn-ke');

                    $("#materi" + kelas).html("<img src='<?php echo base_url('assets/img/gears.gif'); ?>' style='margin: 20px auto 0px; width: 200px;' />");

                    $("#materi" + kelas).load("lihatmapel/" + $(this).attr('id'));

                    $("[btn-ke=" + kelas + "]").removeClass("kembalimapel");
                    $("[btn-ke=" + kelas + "]").removeClass("show");
                    $("[btn-ke=" + kelas + "]").addClass("hidden");
                });
            });
        </script>

        <!-- height judul materi -->
        <script type="text/javascript" charset="utf-8">
            $(function () {
                $('.mapel-container .content .title h4').matchHeight();
            });
        </script>
        <?php
    }

    public function tryout($idprofil = '')
    {
        $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
        if (empty($this->session->userdata('akses'))) {
            $param = ['siswa' => $id_siswa];
            $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
            $datapembelian = $this->Model_pembayaran->get_tagihan_by_siswa($id_siswa);
            $json = json_decode($data, true);

            if ($json['exp']) {
                redirect("user/aktivasi");
            }
        }

        $idsiswa = $this->session->userdata('id_siswa');

        $session = $this->session->userdata;
        $data = array(
            'tryout' => $idprofil,
            'infosiswa' => $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'data_user' => $this->Model_pg->get_data_user($this->session->userdata('id_siswa')),
            'caritryout' => $this->Model_dashboard->get_tryout_by_profil($idprofil, $session['kelas']),
            'idsiswa' => $this->session->userdata('id_siswa'),

        );
        $table_data = $this->Model_adm->fetch_all_profil_by_kelas($session['kelas']);

        $daftar_kategori_baru = [];
        $i = 0;
        $r = 0;
        foreach ($table_data as $kat) {
            $r = $kat->id_tryout;
            $daftar_kategori = $this->Model_fronttryout->fetch_kategori($kat->id_tryout);
            $daftar_kategori_baru[$i] = json_decode(json_encode($kat), true);
            $j = 0;
            $index = 0;
            if (count($daftar_kategori) > 0) {
                foreach ($daftar_kategori as $subkey => $value) {
                    if ($value->id_profil == $kat->id_tryout) {
                        if ($value->remidi == 0) {
                            $cariskor = $this->Model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                            $cariskorsalah = $this->Model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                            $cariwaktu = $this->Model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), true);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['presentase'] = ($value->jumlah_soal == 0 ? 0 : round(($cariskor / $value->jumlah_soal) * 100, 2));;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa'] = json_decode(json_encode($this->Model_dashboard->analisistopik($value->id_kategori, $idsiswa)), true);
                            unset($daftar_kategori[$index]);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jml_analisa'] = count($daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa']);
                            $nilai = 0;
                            foreach ($daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa'] as $item) {
                                $nilai += $item['status_topik'] * $item['bobot_soal'];
                            }
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['nilai'] = $nilai;
                            if ($nilai >= $value->ketuntasan) {
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['tuntas'] = true;
                            } else {
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['tuntas'] = false;
                            }
                            $remidi = $this->Model_fronttryout->fetch_remidi_by_id_remidi($value->id_kategori);
                            if(count($remidi) > 0){
                            foreach ($remidi as $key => $rem) {
                                $arr_rem = array();
                                $cariskor = $this->Model_dashboard->cari_skor($rem->id_kategori, $idsiswa);
                                $cariskorsalah = $this->Model_dashboard->cari_skor_salah($rem->id_kategori, $idsiswa);
                                $cariwaktu = $this->Model_dashboard->cari_waktu($rem->id_kategori, $idsiswa);
                                $arr_rem = json_decode(json_encode($rem), true);
                                $arr_rem['cariskor'] = $cariskor;
                                $arr_rem['cariskorsalah'] = $cariskorsalah;
                                $arr_rem['cariwaktu'] = $cariwaktu;
                                $arr_rem['presentase'] = ($rem->jumlah_soal == 0 ? 0 : round(($cariskor / $rem->jumlah_soal) * 100, 2));;
                                $arr_rem['analisa'] = json_decode(json_encode($this->Model_dashboard->analisistopik($rem->id_kategori, $idsiswa)), true);
                                $arr_rem['jml_analisa'] = count($daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa']);
                                $nilai = 0;
                                foreach ($arr_rem['analisa'] as $item) {
                                    $nilai += $item['status_topik'] * $item['bobot_soal'];
                                }
                                $arr_rem['nilai'] = $nilai;
                                if ($nilai >= $value->ketuntasan) {
                                    $arr_rem['tuntas'] = true;
                                } else {
                                    $arr_rem['tuntas'] = false;
                                }
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['profil_remidi'][] = $arr_rem;
                            }
                            }else{
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['profil_remidi'] = null;
                            }
                            $j++;

                        }
                    }
                    if ($j == 0) {
                        $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                    }
                }
                $index++;
            } else {
                $daftar_kategori_baru[$i]['daftar_kategori'] = null;
            }
            $i++;
        }
        $data['daftar_kategori_baru'] = $daftar_kategori_baru;
//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(500)
//            ->set_output(json_encode($data['daftar_kategori_baru']));
        $this->load->view('pg_user/tryoutanu', $data);
    }

    public
    function tryoutjson($idprofil = '')
    {
        $idsiswa = $this->session->userdata('id_siswa');
        $session = $this->session->userdata;
        $data = array(
            'tryout' => $idprofil,
            'infosiswa' => $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'data_user' => $this->Model_pg->get_data_user($this->session->userdata('id_siswa')),
            'caritryout' => $this->Model_dashboard->get_tryout_by_profil($idprofil, $session['kelas']),
            'idsiswa' => $this->session->userdata('id_siswa'),

        );
        $table_data = $this->Model_adm->fetch_all_profil_by_kelas($session['kelas']);

        $daftar_kategori_baru = [];
        $i = 0;
        $r = 0;
        foreach ($table_data as $kat) {
            $r = $kat->id_tryout;
            $daftar_kategori = $this->Model_fronttryout->fetch_kategori($kat->id_tryout);
            $daftar_kategori_baru[$i] = json_decode(json_encode($kat), true);
            $j = 0;
            $index = 0;
            if (count($daftar_kategori) > 0) {
                foreach ($daftar_kategori as $subkey => $value) {
                    if ($value->id_profil == $kat->id_tryout) {
                        $cariskor = $this->Model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                        $cariskorsalah = $this->Model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                        $cariwaktu = $this->Model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), true);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                        unset($daftar_kategori[$index]);
                        $j++;
                    }
                    if ($j == 0) {
                        $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                    }
                }
                $index++;
            } else {
                $daftar_kategori_baru[$i]['daftar_kategori'] = null;
            }
            $i++;
        }
        $data['daftar_kategori_baru'] = $daftar_kategori_baru;
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode($data));
        $this->load->view('pg_user/kategori_tryout', $data);
    }

    public
    function statistik()
    {
        $idkelas = $this->input->get('kelas');
        $aliaskelas = $this->Model_dashboard->kelas_by_id($idkelas);

        $idsiswa = $this->session->userdata('id_siswa');
        $carikelas = $this->Model_dashboard->get_kelas($idsiswa);
        $kelas = $carikelas->kelas;

        $data = array(
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'analisis_mapel' => $this->Model_dashboard->get_analisis_mapel_bykelas($idsiswa, $idkelas),
            'analisis_waktu' => $this->Model_dashboard->get_analisis_waktu_bykelas($idsiswa, $idkelas),
            'kategori' => $this->Model_dashboard->get_kategori_tryout($idkelas),
            'kelas' => $kelas,
            'analisis_topik' => $this->Model_dashboard->get_analisis_topik($idsiswa),
            'kelasaktif' => $this->Model_dashboard->get_kelas_aktif($idsiswa, date('Y-m-d')),
            'aliaskelas' => $aliaskelas,
            'totalpeserta' => $this->Model_dashboard->peserta_tryout($idkelas),
            'totalsoal' => $this->Model_dashboard->total_soal_bykelas($idkelas),
            'jumlahbenar' => $this->Model_dashboard->jumlah_benar($idsiswa),
            'dataperingkat' => $this->Model_dashboard->peringkat($idkelas),
        );

        $this->load->view('pg_user/dashboard', $data);
    }

    public
    function statistiknilai()
    {
        $idprofil = $this->input->get('profil');

        if ($idprofil == "") {
            redirect('user/dashboard');
        }

        $aliaskelas = $this->Model_dashboard->kelas_by_profil($idprofil);

        $idsiswa = $this->session->userdata('id_siswa');
        $carikelas = $this->Model_dashboard->get_kelas($idsiswa);
        $kelas = $carikelas->kelas;

        $cariidkelas = $this->Model_dashboard->get_idkelas_byprofil($idprofil);

        if ($cariidkelas->id_kelas == "") {
            redirect('user/dashboard');
        }

        $idkelas = $cariidkelas->id_kelas;

        $data = array(
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'infosiswa' => $this->Model_dashboard->get_info_siswa($idsiswa),
            'analisis_mapel_lama' => $this->Model_dashboard->get_analisis_mapel_byprofil($idsiswa, $idprofil),
            'analisis_waktu' => $this->Model_dashboard->get_analisis_waktu_byprofil($idsiswa, $idprofil),
            'kategori' => $this->Model_dashboard->get_kategori_tryout_byprofil($idprofil),
            'kelas' => $kelas,
            'analisis_topik' => $this->Model_dashboard->get_analisis_topik_2($idsiswa),
            'kelasaktif' => $this->Model_dashboard->get_kelas_aktif($idsiswa, date('Y-m-d')),
            'aliaskelas' => $aliaskelas,
            'totalpeserta' => $this->Model_dashboard->peserta_tryout($idkelas),
            'totalsoal' => $this->Model_dashboard->total_soal_byprofil($idprofil),
            'jumlahbenar' => $this->Model_dashboard->jumlah_benar($idsiswa, $idprofil),
            'dataperingkatlama' => $this->Model_dashboard->peringkat($idprofil),
            'dataperingkat' => $this->Model_dashboard->peringkat($idprofil),
            'analisis_mapel' => $this->Model_dashboard->analisis_mapel_by_profil_siswa($idsiswa, $idprofil),
        );

        $this->load->view('pg_user/hasil_tryout', $data);
    }

    public
    function ajax_update_bonus_unlock()
    {
        $result = 0;
        $msg = "Bonus gagal dibuka";
        $id_siswa = $this->session->userdata('id_siswa');
        $id_bonus = $this->input->post('id_bonus');
        $bonus_unlocked = $this->Model_bonus->fetch_bonus_unlocked($id_siswa);
        if (!empty($bonus_unlocked)) {
            $unlocked = explode(',', $bonus_unlocked->unlocked);
        } else {
            $unlocked = array();
        }

        if (!empty($id_bonus)) {
            $poin_siswa = $this->Model_poin->fetch_poin_siswa($id_siswa);
            $poin_minus = $this->Model_poin->fetch_poin_minus($id_bonus);
            // echo "Poin Siswa: ".$poin_siswa." - ".Poin Minus: ".$poin_minus;
            if (!in_array($id_bonus, $unlocked)) {
                if ($poin_siswa >= $poin_minus) {
                    //1. Cutting Siswa Poin
                    $result = $this->Model_poin->cut_poin_siswa($id_siswa, $id_bonus);
                    //2. Unlocking Bonus
                    array_push($unlocked, $id_bonus);
                    $unlocked = implode(',', $unlocked);
                    $data_model = array('unlocked' => $unlocked);
                    $result = $this->Model_bonus->update_bonus_unlock($id_siswa, $data_model);
                } else {
                    $poin = $poin_minus - $poin_siswa;
                    $msg = "Kamu masih kurang $poin poin untuk membuka bonus ini";
                }
            } else {
                $msg = "Bonus telah terbuka";
            }
        }
        $response['result'] = $result;
        $response['msg'] = $msg;
        $response['poin'] = $this->Model_poin->fetch_poin_siswa($id_siswa);
        echo json_encode($response);
    }

    public
    function proses_edit_profil()
    {
        $idsiswa = $this->session->userdata('id_siswa');
        $params = $this->input->post(null, true);

        $nama = $params['nama'];
        $phone = $params['phone'];
        $email = $params['email'];
        $jeniskelamin = $params['gender'];
        $alamat = $params['alamat'];

        if ($_FILES['foto']['name'] !== "") {
            $tipe = $this->cek_tipe($_FILES['foto']['type']);
            $img_path = "assets/uploads/foto_siswa/";
            $namafile = $idsiswa . md5(time()) . $tipe;

            $config['upload_path'] = $img_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $namafile;

            $this->load->library('upload', $config);
            $this->upload->do_upload('foto');

            $this->load->library('image_lib');
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = 'assets/uploads/foto_siswa/' . $namafile;
            $config1['new_image'] = 'assets/uploads/foto_siswa/' . $namafile;
            $config1['maintain_ratio'] = true;
            $config1['width'] = 200;
            $config1['height'] = 300;
            $this->image_lib->initialize($config1);
            $this->image_lib->resize();
            $this->image_lib->clear();

            $edit = $this->Model_dashboard->edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, $namafile);

            redirect('user/dashboard');
        } else {
            $edit = $this->Model_dashboard->edit_profil($idsiswa, $nama, $phone, $email, $jeniskelamin, $alamat, "");

            redirect('user/dashboard');
        }
    }

    public
    function kelasbyjenjang($jenjang)
    {
        $carikelas = $this->Model_dashboard->cari_kelas_by_jenjang($jenjang);

        foreach ($carikelas as $kelas) {
            echo "
			<option value='" . $kelas->id_kelas . "'>" . $kelas->alias_kelas . "</option>
			";
        }
    }

    public
    function kelasbysekolah($sekolah)
    {
        $carisekolah = $this->Model_dashboard->cari_sekolah($sekolah);

        $carikelas = $this->Model_dashboard->cari_kelas_by_jenjang($carisekolah->jenjang);

        foreach ($carikelas as $kelas) {
            echo "
			<option value='" . $kelas->id_kelas . "'>" . $kelas->alias_kelas . "</option>
			";
        }
    }

    public
    function proses_edit_sekolah()
    {
        $idsiswa = $this->session->userdata('id_siswa');
        $params = $this->input->post(null, true);

        $jenis = $params['jenis'];

        if ($jenis == "lama") {
            $sekolah = $params['sekolah'];
            $kelas = $params['kelas'];

            $editsekolah = $this->Model_dashboard->edit_sekolah_siswa($sekolah, $kelas, $idsiswa);
        } elseif ($jenis == "baru") {
            $kota = $params['kota'];
            $sekolah = $params['sekolahbaru'];
            $jenjang = $params['jenjang'];
            $kelas = $params['kelas'];

            $editsekolah = $this->Model_dashboard->edit_sekolah_siswa_baru($kota, $jenjang, $sekolah, $kelas, $idsiswa);
        }

        redirect('user/dashboard');
    }

    public
    function liveskor()
    {
        $idsiswa = $this->session->userdata('id_siswa');

        $data = array(
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'infosiswa' => $this->Model_dashboard->get_info_siswa($idsiswa),
            'dataprofil' => $this->Model_dashboard->cari_profil_tryout(),
        );

        $this->load->view('pg_user/live_skor', $data);
    }

    public
    function listprofil($idtryout)
    {
        if ($this->uri->segment(3) == "") {
            redirect('user/dashboard');
        } else {
            $totalsoal = $this->Model_dashboard->total_soal_byprofil($idtryout);
            $dataperingkat = $this->Model_dashboard->peringkat($idtryout);

            $no = 1;
            foreach ($dataperingkat as $peringkat) {

                $datasiswa = $this->Model_dashboard->data_peringkat($peringkat->id_siswa, $idtryout);

                if (isset($peringkat->waktu_kerja)) {
                    $waktu = round($peringkat->waktu_kerja / 60, 2);
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td class="text-center">
                            <?php
                            if ($datasiswa->foto !== "") {
                                ?>
                                <img src="<?php echo base_url('assets/uploads/foto_siswa/' . $datasiswa->foto); ?>"
                                     style="width: 75px;"></img>
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url('assets/uploads/foto_siswa/default.png'); ?>"
                                     style="width: 75px;"></img>
                                <?php
                            }
                            ?>

                        </td>
                        <td>

                            <?php
                            if ($peringkat->id_siswa == $this->session->userdata('id_siswa')) {
                                echo "<b>" . $datasiswa->nama_siswa . "</b>";
                            } else {
                                echo $datasiswa->nama_siswa;
                            }
                            ?>
                        </td>

                        <td class="text-center"><?php echo $datasiswa->nama_sekolah; ?>
                            <br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
                        <td class="text-center"><?php echo $waktu; ?> Menit</td>
                        <td class="text-center"><?php echo number_format($peringkat->jumlah_bobot_benar, 2, '.', ''); ?>

                        </td>
                        <td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar / $peringkat->jumlah_bobot) * 100, 2, '.', ''); ?>
                            %
                        </td>
                    </tr>
                    <?php
                }
                $no++;
            }
        }
    }

    public
    function listrekap($idprofil)
    {
        $totalsoal = $this->Model_dashboard->total_soal_byprofil($idprofil);
        $dataperingkat = $this->Model_dashboard->peringkat($idprofil);

        $no = 1;
        foreach ($dataperingkat as $peringkat) {

            $datasiswa = $this->Model_dashboard->data_peringkat($peringkat->id_siswa, $idprofil);

            if (isset($peringkat->waktu_kerja)) {
                $waktu = round($peringkat->waktu_kerja / 60, 2);
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td>

                        <?php
                        if ($peringkat->id_siswa == $this->session->userdata('id_siswa')) {
                            echo "<b>" . $datasiswa->nama_siswa . "</b>";
                        } else {
                            echo $datasiswa->nama_siswa;
                        }
                        ?>
                    </td>

                    <td class="text-center"><?php echo $datasiswa->nama_sekolah; ?>
                        <br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>

                    <?php
                    $datanilai = $this->Model_dashboard->rekap_nilai($idprofil, $peringkat->id_siswa);

                    foreach ($datanilai as $nilai) {
                        ?>
                        <td><?php echo number_format($nilai->jumlah_bobot_benar, 2, '.', ''); ?></td>
                        <?php
                    }
                    ?>

                    <td class="text-center">
                        <?php
                        if ($peringkat->jumlah_bobot_benar > 100) {
                            echo "100.00";
                        } else {
                            echo number_format($peringkat->jumlah_bobot_benar, 2, '.', '');
                        }
                        ?>
                    </td>
                    <td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar / $peringkat->jumlah_bobot) * 100, 2, '.', ''); ?>
                        %
                    </td>
                    <td class="text-center"><?php echo $waktu; ?> Menit</td>
                </tr>
                <?php
            }
            $no++;
        }
    }

    public
    function ganti_password()
    {
        $idsiswa = $this->session->userdata('id_siswa');
        $params = $this->input->post(null, true);

        $oldpassword = $params['oldpassword'];
        $newpassword = $params['newpassword'];
        $renewpassword = $params['renewpassword'];

        if ($newpassword == $renewpassword) {
            $caripasslama = $this->Model_pg->cari_password_lama($idsiswa, $oldpassword);
            if (!empty($caripasslama)) {
                //echo "old password cocok";
                $this->Model_pg->ganti_password($caripasslama->id_login, $newpassword);
                alert_success('Berhasil!', 'Password telah diganti');
                redirect('user/ubah_profil');
            } else {
                //echo "old password tidak cocok";
                alert_error('Gagal!', 'Password lama salah');
                redirect('user/ubah_profil');
            }
        } else {
            alert_error('Gagal!', 'Perulangan password baru tidak sama');
            redirect('user/ubah_profil');
            //echo "perulangan tidak sama";
        }

    }

    /* UPDATE DOWNLOAD KONTENT 2017-08-12*/
    public
    function download_konten()
    {
        if ($this->session->userdata('id_siswa') == "") {
            redirect('login');
        }

        $session = $this->session->userdata;
        $jenjang_str = array();
        $i = 0;
        foreach ($_SESSION['menu'] as $jenjang => $data_kelas) {
            $jenjang_str[$i] = $jenjang;
            $i++;
        }
        $data = array(

            'infosiswa' => $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'data_user' => $this->Model_pg->get_data_user($this->session->userdata('id_siswa')),

            'konten_download_kat' => $this->Model_kontendownload->get_kategori_konten_download_by_jenjang($jenjang_str),

        );

        $this->load->view('pg_user/materi_download', $data);

    }

    public
    function download_konten_mapeldetail($id_kat)
    {
        $konten_list = $this->Model_kontendownload->get_konten_by_id_kat($id_kat);

        ?>

        <div class="mapel-download-content slide<?php echo $id_kat; ?>">

            <?php
            $itung = 0;
            foreach ($konten_list as $konten_key => $konten_val) {
                ?>
                <div class="col-md-6 col-sm-12">
                    <div class="mapel-download-small">
                        <table>
                            <tr>
                                <td colspan=3>
                                    <p>
                                        <?php echo $konten_val->point ?> P
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td rowspan=2>
                                    <div class="mapel-download-img"
                                         style="background-image:url('<?php echo base_url() . 'assets/uploads/konten_download/' . $konten_val->gambar; ?>');">
                                    </div>
                                </td>
                                <td>
                                    <strong><h4>
                                            <?php echo $konten_val->judul; ?>
                                        </h4></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php
                                    if ($konten_val->keterangan != '') {
                                        echo $konten_val->keterangan;
                                    } else {
                                        echo "&nbsp;";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <?php
                                    //Dapatkan konten point
                                    $poin_konten = $konten_val->point;
                                    
                                    //Dapatkan konten point            
                                    $siswa = $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa'));
                                    $poin_siswa = $siswa->poin;
                                    //Kurangi user point dalam var
                                    $poin_final =  $poin_siswa-$poin_konten;


                                    //cek download apakah sudah pernah
                                    $kd_detail = $this->Model_kontendownload->get_kd_by_idsiswakonten($this->session->userdata('id_siswa'), $konten_val->id);

                                    if($poin_final>=0 AND count($kd_detail) <= 0){
                                    ?>
                                    <a class="btn btn-primary"
                                       onclick="window.open('<?php echo site_url('user/kd_tambah/' . $konten_val->id); ?>','_self');"
                                       href="<?php echo $konten_val->link; ?>"
                                       target="_blank"
                                    >Download
                                        <!-- fungsi onclick ada di materi_download.php -->
                                    </a>
                                    <?php
                                    }else if(count($kd_detail) > 0){ ?>
                                        <a class="btn btn-primary" href="<?php echo $konten_val->link; ?>"
                                            target="_blank"
                                            style="display:initial;vertical-align:baseline;padding:5px 35px;">
                                            <!-- Style untuk memperbaiki tampilan -->
                                            Buka file
                                        </a>
                                    <?php 
                                    }else{ ?>
                                    <a class="mapel-download-button" disabled style="cursor:not-allowed;">
                                        Poin tidak mencukupi
                                    </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php

                $itung++;
            }

            if ($itung == 0) {
                ?>

                <div class="col-lg-12 text-center">
                    <div class="alert alert-warning">
                        Maaf, untuk sementara konten kategori ini <strong>tidak ada.</strong>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php

    }

    public
    function kd_tambah($id_konten)
    {
        $kd_detail = $this->Model_kontendownload->get_kd_by_idsiswakonten($this->session->userdata('id_siswa'), $id_konten);


        if (count($kd_detail) <= 0) {

            //Dapatkan konten point
            $konten_list = $this->Model_kontendownload->get_konten_by_id($id_konten);
            $poin_konten = $konten_list->point;
            
            //Dapatkan konten point            
            $siswa = $this->Model_dashboard->get_info_siswa($this->session->userdata('id_siswa'));
            $poin_siswa = $siswa->poin;
            //Kurangi user point dalam var
            $poin_final =  $poin_siswa-$poin_konten;

            //jika poin final tidak menghasilkan angka negatif
            if($poin_final>=0){
                //Deklarasi konten point
                $data_update = array(
                    'poin' => $poin_final
                );
                //proses
                $this->Model_kontendownload->kurangi_poin($this->session->userdata('id_siswa'),$data_update);


                $data_insert = array(
                    'id_siswa' => $this->session->userdata('id_siswa'),
                    'id_konten_download' => $id_konten
                );
                $this->Model_kontendownload->insert_kd_siswa($data_insert);

                echo "<script type='text/javascript'>
                    document.location='" . base_url() . "user/download_konten';
                    </script>";
            }else{

            }
        }
    }

}
