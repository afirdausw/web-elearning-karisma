<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        $this->load->helper('alert_helper');
        $this->load->model('model_pg');
//		$this->load->model('model_login');
//		$this->load->model('model_signup');
//      $this->load->model('model_modul');
    }

    public function indexlama()

    {

        $data = array(

            'navbar_links' => $this->Model_pg->get_navbar_links(),

            'video_demo' => $this->Model_pg->get_video_demo(null),

        );


        $this->load->view('pg_user/home', $data);

    }

    public function index()
    {
        $start = 0;
        $limit = 18;
        $start -= 1;
        if ($start < 0) $start = 0;
        $start *= $limit;
        $mapel = $this->Model_pg->get_all_mapel(1, $limit, $start);

        $kelas = $this->Model_pg->fetch_all_kelas();

        $testimoni = $this->Model_pg->fetch_all_testimoni(0, 3, 2);

        $kelas_navbar = $this->Model_pg->fetch_all_kelas();

        $data = [
            "kelas_navbar" => $kelas_navbar,
            "testimoni"    => $testimoni,
            "mapel"        => $mapel,
            "kelas"        => $kelas,
            "limit"        => $limit,
            "jumlah_mapel" => $this->Model_pg->get_all_mapel(2)->jumlah_mapel,
        ];
        $idsiswa = $this->session->userdata('id_siswa');
        if ($idsiswa != NULL) {
            $siswa = $this->Model_pg->get_data_user($idsiswa);
            $data['siswa'] = $siswa;
        }

        $this->load->view('pg_user/homebaru', $data);

    }

    public function konten($id_materi_pokok)
    {
        $data = array(
            'mapel' => $id_materi_pokok,
        );

        $this->load->view('pg_user/konten', $data);
    }

    /*
    function index(){
        $idsiswa = $this->session->userdata('id_siswa');
        $idortu = $this->session->userdata('id_ortu');

        if($idsiswa != ""){
            redirect('user/dashboard');
        }else if ($idortu != ""){
            redirect('parents/dashboard');
        }else{
            $data = array(

                'navbar_links' => $this->model_pg->get_navbar_links(),

                'video_demo'  => $this->model_pg->get_video_demo(null),
                'select_sekolah'  => $this->model_pg->fetch_all_sekolah(),
                'select_kelas'  	=> $this->model_pg->fetch_all_kelas(),
                'select_provinsi'	=> $this->model_signup->get_provinsi()
                );



            $this->load->view('pg_user/homebaru', $data);
        }
    } */

    function do_login()
    {
        $params = $this->input->post(null, true);
        $do_login = $this->Model_login->cek_login($params['username'], $params['password']);
        $akses_kelas = array();

        if ($do_login != null) {
            //get user access
            $siswa_access = $this->Model_login->cek_user_akses($do_login['id_siswa']);

            foreach ($siswa_access as $item) {
                //firstly, let's check the paket's expiration date
                $sedang_aktif = $this->cek_masa_aktif($item);
                // print_r($item);
                if ($sedang_aktif == TRUE) //paket siswa masih aktif
                {
                    //assemble id_kelas into 'akses' session array
                    // if (strtolower($item->tipe) == 'reguler') {
                    if ($item->tipe == 0) { //0 = reguler
                        $akses_kelas['reguler'][] = $item->id_kelas;
                    }

                    // if (strtolower($item->tipe) == 'premium') {
                    if ($item->tipe == 1) { //1 = premium
                        $akses_kelas['premium'][] = $item->id_kelas;
                    }
                }
            }

            // proses set session
            $this->session->set_userdata($do_login);
            $this->session->set_userdata('akses', $akses_kelas);
            // $this->session->set_userdata();

            redirect("home");
        } else {
            alert_error("Gagal Login", "Username dan/atau Password yang anda masukkan tidak sesuai");
            redirect("home");
        }
    }

    private function cek_masa_aktif($data)
    {
        $sedang_aktif = TRUE;

        if (date('Y-m-d') > $data->expired_on) //paket telah melebihi expiration date
        {
            // return $data->id_kelas.", " . date('Y-m-d').", " . $data->expired_on."<br>";
            $result = $this->Model_login->set_to_inactive($data->id_paket_aktif);
            print_r($result);

            if ($result) {
                $sedang_aktif = FALSE;
            }

        }
        return $sedang_aktif;
    }

    public function ajax_load_listmapel($limit, $start)
    {
        $start -= 1;
        if ($start < 0) $start = 0;
        $start *= $limit;
        $mapel = $this->Model_pg->get_all_mapel(1, $limit, $start);

        //TODO SAMAKAN DENGAN homebaru.php

        foreach ($mapel as $value) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4  pr-3 pl-3  ">
                <div class="thumbnail materi-lainnya">
                    <a href="<?php echo base_url() . 'mapel/' . $value->id_mapel; ?>">
                        <!--                            <span class="badge-diskon">Diskon 25%</span>-->
                        <img style="border: 1px solid  #999;"
                             src="<?= (isset($value->gambar_mapel) ? (!empty($value->gambar_mapel) ? base_url() . 'image/mapel/' . $value->gambar_mapel : base_url() . 'assets/img/icon/no-image.jpg') : base_url() . 'assets/img/icon/no-image.jpg') ?>"
                             alt="<?= $value->nama_mapel ?>">
                        <div class="caption">
                            <?php
                            if (strlen($value->nama_mapel) >= 20) {
                                $mapel = substr($value->nama_mapel, 0, 15) . " . . .";
                            } else {
                                $mapel = $value->nama_mapel;
                            }
                            ?>
                            <a href="<?= base_url() . 'kelas/' . $value->kelas_id; ?>" class="badge-kelas">
                                <?= $value->alias_kelas ?>
                            </a>
                            <div class="w-100">
                                <div class="title w-75 pull-left">
                                    <h4><?= $mapel ?></h4>
                                </div>
                                <div class="title w-25 pull-right text-right">
                                        <span class="badge font-size-h5"
                                              style="background-color:rgb(245, 134, 52); padding: 7px 20px;"> 7 Sesi</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <p class="m-t-2 font-size-md"
                               style="padding-right: 5rem !important;font-style: italic;">
                                Instruktur, Materi & Sertifikat sama persis Kelas Regular tatap muka di Karisma
                                Academy
                            </p>
                            <hr style="border-top: 1px solid  #999"/>
                            <div class="w-100">

                                <h5 class="text-right font-size-h1 mt-5"><i class="glyphicon glyphicon-heart"></i> <span
                                            class="font-size-h4 text-gray mr-3">  * mulai dari </span>
                                    <span style="color: #93bc3a">Rp. <?= money($value->harga) ?></span>
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        }
    }
}
