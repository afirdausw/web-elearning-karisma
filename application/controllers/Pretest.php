<?php

/**
 *
 */
class Pretest extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('model_pg');
        $this->load->model('model_login');

        $this->load->helper('alert_helper');
        $this->load->library("form_validation");
    }

    function index()
    {
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if($pretest_logged){ //jika siswa telah mendaftar pretest
            redirect(base_url("pretest/mapel"));
        }else if ($siswa_logged){
            redirect(base_url()."#materi_list");
        }else{
            $kelas_navbar = $this->Model_pg->fetch_all_kelas();
            $data = array(
                'title' => 'Judul',
                'form_aksi' => base_url(uri_string())."/daftar",

                "kelas_navbar" => $kelas_navbar, 
            );
            $this->load->view("pg_user/pretest/pretest-login", $data);
        }
    }

    function mapel($id_materi='')
    {
        $pretest_logged = $this->session->userdata('pretest_logged_in');
        if($pretest_logged){ //jika siswa telah login dan mendaftar pretest
            $kelas_navbar = $this->Model_pg->fetch_all_kelas();
            if($id_materi){
                $mapok = $this->Model_pg->get_materi_by_mapel($id_materi);
                $mapel = $this->Model_pg->get_mapel_by_id($id_materi);

                $mapok_baru = [];
                $mapok_ids_in = "";
                foreach ($mapok as $key => $value) {
                    $v = $array = json_decode(json_encode($value), true);
                    $v['mapok'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
                    $mapok_baru[] = $v;

                    //create string for IN statement on sql
                    $mapok_ids_in .= $value->id_materi_pokok;
                    $mapok_ids_in .= ",";
                }
                $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);

                // PRE
                $mapok_pre = $this->Model_pg->get_materi_pre_by_mapel($id_materi);
                $mapok_baru_pre = [];
                foreach ($mapok_pre as $key => $value) {
                    $v = $array = json_decode(json_encode($value), true);
                    $v['sub_materi'] = $this->Model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
                    $mapok_baru_pre[] = $v;
                }
                $mapok_baru_pre = json_decode(json_encode($mapok_baru_pre), FALSE);
                // END PRE

                //remove last comma
                $mapok_ids_in = rtrim($mapok_ids_in,",");
                $materi_ids =  $this->Model_pg->get_count_submateri($mapok_ids_in);

                $id = $this->session->userdata('pretest_id');
                $cek = $this->Model_pg->get_log_baca($id);

                $data = [
                    "kelas" => $mapel,
                    'status' => $cek,
                    'materi' => $mapok_baru,
                    'materi_pre' => $mapok_baru_pre,
                    'mapel_lain' => $this->Model_pg->get_mapel_random(),
                    'materi_total' => $materi_ids->jumlah_sub,
                    'baca_total' => $cek->baca_total,

                    "kelas_navbar" => $kelas_navbar, 
                ];

                //otomatis bukan premium
                $data["siswa_status"] = 0;

                //Jika kode pretest tidak ada
                if($mapel == NULL){
                    redirect(base_url("pretest/mapel"));
                    alert_error("Terjadi Kesalahan", "Kode Pretest tidak ditemukan");
                }
                $this->load->view('pg_user/materi_pokok', $data);
            }else{
                $start = 0;
                $limit = 6;
                $start-=1;
                if($start<0) $start = 0;
                $start*=$limit;
                $mapel = $this->Model_pg->get_all_mapel(1, $limit, $start);

                $kelas = $this->Model_pg->fetch_all_kelas();

                $data = [
                    "mapel" => $mapel,
                    "kelas" => $kelas, 
                    "limit" => $limit,
                    "jumlah_mapel" => $this->Model_pg->get_all_mapel(2)->jumlah_mapel,

                    "kelas_navbar" => $kelas_navbar, 
                ];

                $siswa_logged = $this->session->userdata('siswa_logged_in');
                if ($siswa_logged){
                    redirect(base_url()."#materi_list");
                    // $siswa = $this->model_pg->get_data_user($idsiswa);
                    // $data['siswa'] = $siswa;
                }else{

                }
               // return $this->output
               //     ->set_content_type('application/json')
               //     ->set_status_header(500)
               //     ->set_output(json_encode($data));
                $this->load->view("pg_user/pretest/pretest-mapel", $data);
            }

        }else{
            alert_error("Daftar Pretest Terlebih Dahulu", "Diperlukan nama lengkap, e-mail, nomor telepon, dan alamat");
            redirect(base_url("pretest"));
        }
    }

    public function ajax_load_listmapel($limit, $start){
        $start-=1;
        if($start<0) $start = 0;
        $start*=$limit;
        $mapel = $this->Model_pg->get_all_mapel(1, $limit, $start);

        //TODO SAMAKAN DENGAN homebaru.php

        foreach ($mapel as $value) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail materi-lainnya">
                    <a href="<?php echo base_url().'pretest/mapel/'.$value->id_mapel; ?>">
                        <span class="badge-diskon">Diskon 25%</span>
                        <img src="<?=(isset($value->gambar_mapel) ? (!empty($value->gambar_mapel) && substr($value->gambar_mapel,0,5) == 'data:' ? $value->gambar_mapel : base_url().'assets/img/icon/no-image.jpg') : base_url().'assets/img/icon/no-image.jpg') ?>" alt="<?= $value->nama_mapel ?>">
                        <div class="caption">
                            <?php
                                if(strlen($value->nama_mapel) >= 60 ){
                                    $mapel = substr($value->nama_mapel, 0, strpos($value->nama_mapel, ' ', 50))." . . .";
                                }else{
                                    $mapel = $value->nama_mapel;
                                }
                            ?>
                            <a href="<?= base_url().'kelas/'.$value->kelas_id; ?>" class="badge-kelas">
                                <?= $value->alias_kelas ?>
                            </a>
                            <h3><?= $mapel ?></h3>
                            <p>Pelajari lebih lanjut ...</p>
                        </div>
                    </a>
                </div>
            </div>
            <?php
        }   
    }

    function daftar() {
//        $this->form_validation_rules();

        $params     = $this->input->post(null, true);
        $nama       = isset($params["nama"])        ? $params["nama"]    : '';
        $telepon    = isset($params["telepon"])     ? $params["telepon"] : '';
        $email      = isset($params["email"])       ? $params["email"]   : '';
        $alamat     = isset($params["alamat"])      ? $params["alamat"]  : '';
        $tanggal = date(DATE_ATOM);

//        if ($this->form_validation->run() == FALSE) {
//            alert_error("Error", "Terjadi Kesalahan Saat Daftar!");
//        } else {
            $cek1 = $this->Model_login->cek_pretest_namaemail($nama, $email);
            //jika siswa telah mendaftar akun tetap
            if ($cek1 == null) {
                //jika pretest telah mendaftar pretest sebelumnya
                $cek2 = $this->Model_login->cek_pretest_sebelumnya($nama, $telepon, $email, $alamat, $tanggal);
                if($cek2 == null){
                    $aksi = $this->Model_login->daftar_pretest($nama, $telepon, $email, $alamat, $tanggal);
                    $id = $this->db->insert_id();
                }else{
                    $aksi = $this->Model_login->update_pretest($nama, $telepon, $email, $alamat, $tanggal);
                    $id = $aksi;
                }

                if($aksi){
                    //reset sesion
                    $this->session->set_userdata('pretest_logged_in', TRUE);
                    $this->session->set_userdata('pretest_id', $id);
                    $this->session->set_userdata('pretest_email', $email);
                    $this->session->set_userdata('pretest_nama', $nama);
                    redirect(base_url("pretest/mapel"));
                }
            }else{
                alert_error("Telah terdaftar", "Nama dan/atau e-mail anda telah terdaftar dalam sistem, silahkan login");
                redirect(base_url()."login");
            }

//        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }

    private function form_validation_rules() {
        //set validation rules for each input
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required');

        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }
}
