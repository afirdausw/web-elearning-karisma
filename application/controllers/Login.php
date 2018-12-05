<?php

/**
 *
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("model_login");
        $this->load->library("form_validation");
        $this->load->library("session");
        $this->load->helper("alert_helper");
//        $this->load->model("model_poin_elearning");
//        $this->load->model("model_pg_elearning");
//        $this->load->model("model_pembayaran_elearning");
//        $this->load->model("model_dashboard");
//        $this->load->helper("socmed_helper");
//        if($this->session->userdata('siswa_logged_in') != TRUE) {
//            $this->load->helper('url');
//            $this->session->set_userdata('last_page', current_url());
//            redirect('/login');
//        }
    }

    function index()
    {
//        $data = array(
//            'navbar_links' => $this->model_pg->get_navbar_links(),
//        );

        if ($this->session->userdata('id_siswa')) {
            redirect(base_url());
        } else {
            $this->load->view("pg_user/login");
        }
    }

    function login_submit()
    {
        $this->form_validation_rules();

        if ($this->form_validation->run() == FALSE) {
            alert_error("Gagal Login", "Terjadi kesalahan saat login");
            redirect("login");
        } else {
            $params = $this->input->post(null, true);
            $username = $params['username'];
            $password = $params['password'];

            $result = $this->model_login->cek_login($username, $password);
            if ($result != null) {
                $cart = $this->Model_Cart->getCartByIdSiswa($result->id_siswa);
                $cart = obj_to_arr($cart);
                $jumlah_cart = count($cart);
                $this->session->set_userdata('siswa_logged_in', TRUE);
                $this->session->set_userdata('id_siswa', $result->id_siswa);
                $this->session->set_userdata('cart', $cart);
                $this->session->set_userdata('jumlah_cart', $jumlah_cart);
                $this->session->set_userdata('siswa_nama', $result->nama_siswa);
                $this->session->unset_userdata('pretest_logged_in');
                $this->session->unset_userdata('pretest_email');
                $this->session->unset_userdata('pretest_nama');
                if (isset($_SESSION['RedirectKe'])) {
                    header('location:' . $_SESSION['RedirectKe']);
                } else {
                    redirect(".");
                }
            } else {
                alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
                $link_redir = "login";
                redirect($link_redir);
            }
        }
    }

    function logout()
    {
        $this->session->unset_userdata('siswa_logged_in');
        $this->session->unset_userdata('id_siswa');
        $this->session->sess_destroy();
        session_destroy();
        // $this->session->sess_destroy();
        if (isset($_SESSION['RedirectKe'])) {
            header('location:' . $_SESSION['RedirectKe']);
        } else {
            redirect(".");
        }
    }

    // function do_login()
    // {
    //     $this->form_validation_rules();

    //     if ($this->form_validation->run() == FALSE) {
    //         alert_error("Gagal Login", "Terjadi Kesalahan Saat Login");
    //         redirect("login");
    //     } else {
    //         $params = $this->input->post(null, true);

    //         //cek apakah yang login adalah orang tua?
    //         //***************************************
    //         if ($params['akses'] == 'parent') {
    //             $cek_parent = $this->model_login->cek_login_ortu($params['username'], $params['password']);

    //             $cekortu = $this->model_login->cek_login_ortu($params['username'], $params['password']);
    //             if ($cekortu != null) {
    //                 //echo $cekortu->id_ortu;
    //                 $this->session->set_userdata('parent_logged_in', TRUE);
    //                 $this->session->set_userdata('id_ortu', $cekortu->id_ortu);
    //                 $this->session->set_userdata('id_ortu_siswa', $cekortu->id_siswa);

    //                 redirect('parents/dashboard');
    //             } else {
    //                 alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
    //                 redirect("login");
    //             }
    //             //end
    //             //***************************************
    //         } else {
    //             $do_login = $this->model_login->cek_login($params['username'], $params['password']);
    //             if ($do_login != null) {
    //                 $this->set_siswa_akses($do_login);

    //                 if (empty($this->session->userdata('akses'))) {
    //                     $this->session->set_userdata('siswa_logged_in', TRUE);
    //                     $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;
    //                     $param = ['siswa' => $id_siswa];
    //                     $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);

    //                     $json = json_decode($data, true);
    //                     if ($json['exp']) {
    //                         redirect("user/aktivasi");
    //                     }
    //                 } else {
    //                     redirect("user/dashboard");
    //                 }

    //             } else {
    //                 alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
    //                 redirect("login");
    //             }
    //         }

    //     }
    // }

    // private function curl_download($Url, $param = array())
    // {

    //     // is cURL installed yet?
    //     if (!function_exists('curl_init')) {
    //         die('Sorry cURL is not installed!');
    //     }

    //     // OK cool - then let's create a new cURL resource handle
    //     $ch = curl_init();

    //     // Now set some options (most are optional)

    //     // Set URL to download
    //     curl_setopt($ch, CURLOPT_URL, $Url);
    //     //set Post
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     // Set a referer
    //     curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
    //     // Set a param
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
    //     // User agent
    //     curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");

    //     // Include header in result? (0 = yes, 1 = no)
    //     curl_setopt($ch, CURLOPT_HEADER, 0);

    //     // Should cURL return or print out the data? (true = return, false = print)
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //     // Timeout in seconds
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    //     // Download the given URL, and return output
    //     $output = curl_exec($ch);

    //     // Close the cURL resource, and free system resources
    //     curl_close($ch);

    //     return $output;
    // }

    private function set_siswa_akses($do_login)
    {
        //get user access
        $siswa_access = $this->model_login->cek_user_akses($do_login['id_siswa']);
        $akses_kelas = array();
        $param = ['siswa' => $do_login['id_siswa']];
        $data = $this->curl_download("http://aktivasi.bintangsekolah.co.id/api/cari-siswa", $param);
// var_dump($do_login);
        $json = json_decode($data, true);
        // var_dump($json);/
        $menu = array();
        if (!$json['exp']) {
            $akses_kelas['reguler'] = $json['kelas'];
            // $akses_kelas['premium'][] = $json['kelas'];
            $kelasaktif = $this->model_dashboard->kelas_by_id_in($json['kelas']);
            foreach ($kelasaktif as $kelas2) {

                $menu[$kelas2->jenjang][$kelas2->id_kelas] = json_decode(json_encode($kelas2), true);;
                $mapel = json_decode(json_encode($this->model_dashboard->get_mapel_by_kelas($kelas2->id_kelas)), true);
                $data = array();
                foreach ($mapel as $key => $value) {
                    $mapok = $this->model_login->get_id_materipokok($value['id_mapel']);
                    if (count($mapok) > 0) {
                        $value['id_mapok'] = $mapok[0]['id_materi_pokok'];
                    } else {

                        $value['id_mapok'] = 0;
                    }
                    $data[] = $value;
                }
                $menu[$kelas2->jenjang][$kelas2->id_kelas]['Mapel'] = $data;

            }
        }

        // proses set session
        $this->session->set_userdata($do_login);
        $this->session->set_userdata('akses', $akses_kelas);
        $this->session->set_userdata('menu', $menu);
        // $this->session->set_userdata();
        //SET POIN SISWA
        if (date("Y-m-d", strtotime($do_login['last_login'])) != date("Y-m-d")) {
            $addpoin = $this->model_poin->add_poin_siswa($do_login['id_siswa'], 'login');
        }
    }

    private function form_validation_rules()
    {
        //set validation rules for each input
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }

    private function cek_masa_aktif($data)
    {
        $sedang_aktif = TRUE;

        if (date('Y-m-d') > $data->expired_on) //paket telah melebihi expiration date
        {
            // return $data->id_kelas.", " . date('Y-m-d').", " . $data->expired_on."<br>";
            $result = $this->model_login->set_to_inactive($data->id_paket_aktif);
            print_r($result);

            if ($result) {
                $sedang_aktif = FALSE;
            }

        }
        return $sedang_aktif;
    }

    function cek_akun_fb()
    {
        $fb_id = $this->input->post('id') ? $this->input->post('id') : null;
        $result = FALSE;

        if (!empty($fb_id)) {
            $do_login = $this->model_login->cek_akun_fb($fb_id);

            if (!empty($do_login)) {
                $this->set_siswa_akses($do_login);
                $_SESSION['fb_login'] = TRUE;
                $_SESSION['fb_id'] = $do_login['fb_id'];

                $result = TRUE;
            }
        }

        echo json_encode($result);
    }

    function post_fb()
    {
        $fb_config = array(
            'href'        => base_url(),
            'picture'     => base_url() . 'assets/dashboard/images/sma.jpg',
            'title'       => '[Nama] Menyelesaikan [Judul Latihan]!',
            'description' => 'Aku sudah menyelesaikan latihan di LPI Hidayatullah. Ayo kamu juga!',
            'caption'     => 'belajar.lpi-hidayatullah.or.id',
        );

        $twt_config = array(
            'url'  => base_url(),
            'text' => "Aku sudah menyelesaikan latihan di LPI Hidayatullah. Ayo kamu juga!",
        );

        $data = array(
            'navbar_links' => $this->model_pg->get_navbar_links(),
            'fb_config'    => $fb_config,
            'twt_config'   => $twt_config
            // 'fb_config' => fb_share_config('default')
        );

        $this->load->view("pg_user/post_fb_trial_ver", $data);
    }

    function login_from_signup($username, $password, $nama)
    {
        $do_login = $this->model_login->cek_login($username, $password);
        if ($do_login != null) {
            $this->set_siswa_akses($do_login);

            if (empty($this->session->userdata('akses'))) {
                $id_siswa = isset($_SESSION['id_siswa']) ? $_SESSION['id_siswa'] : 0;

                $datapembelian = $this->model_pembayaran->get_tagihan_by_siswa($id_siswa);
                if (empty($datapembelian)) {
                    $alert_message = "Selamat datang, " . rawurldecode($nama) . ". Akun anda telah terdaftar, Silahkan melakukan aktivasi untuk memulai belajar di LPI Hidayatullah";
                    alert_success('Berhasil!', $alert_message);
                    $this->session->set_flashdata('berhasil', 'daftar');

                    redirect("user/aktivasi");
                } else {
                    redirect("user/buylist");
                }
            } else {
                redirect("user/dashboard");
            }

        } else {
            alert_error("Gagal Login", "Username dan/atau password yang anda masukan tidak sesuai");
            redirect("login");
        }
    }

}
