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

        $this->load->library("form_validation");
    }

    function index()
    {
        $data = array(
            'title' => 'Judul'
        );
        $this->load->view("pg_user/datadiri");
    }

    function mapel($id_materi='')
    {
        if($id_materi){
            $mapok = $this->model_pg->get_materi_by_mapel($id_materi);
            $mapel = $this->model_pg->get_mapel_by_id($id_materi);
            //        var_dump($mapok->kelas_id);
            //        $kelas = $this->model_pg->get_mapel_by_kelas($mapok->kelas_id);
            $mapok_baru = [];
            foreach ($mapok as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['mapok'] = $this->model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru[] = $v;
            }
            $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);

            $data = array(
                "kelas" => $mapel,
                'materi' => $mapok_baru,
                'mapel_lain' => $this->model_pg->get_mapel_random(),
            );

            // return $this->output
            //      ->set_content_type('application/json')
            //      ->set_status_header(500)
            //      ->set_output(json_encode($data));

            $this->load->view('pg_user/materi_pokok', $data);
        }else{            
            $start = 0;
            $limit = 6;
            $start-=1;
            if($start<0) $start = 0;
            $start*=$limit;
            $mapel = $this->model_pg->get_all_mapel(1, $limit, $start);

            $kelas = $this->model_pg->fetch_all_kelas();

            $data = [
                "mapel" => $mapel,
                "kelas" => $kelas, 
                "limit" => $limit,
                "jumlah_mapel" => $this->model_pg->get_all_mapel(2)->jumlah_mapel,
            ];
            $idsiswa = $this->session->userdata('id_siswa');
            if($idsiswa != NULL){
                $siswa = $this->model_pg->get_data_user($idsiswa);
                $data['siswa'] = $siswa;
            }
           // return $this->output
           //     ->set_content_type('application/json')
           //     ->set_status_header(500)
           //     ->set_output(json_encode($data));
            $this->load->view("pg_user/pretest-mapel", $data);
        }
    }

    public function ajax_load_listmapel($limit, $start){
        $start-=1;
        if($start<0) $start = 0;
        $start*=$limit;
        $mapel = $this->model_pg->get_all_mapel(1, $limit, $start);

        //TODO SAMAKAN DENGAN homebaru.php

        foreach ($mapel as $value) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="thumbnail materi-lainnya">
                    <a href="<?php echo base_url().'pretest/mapel/'.$value->id_mapel; ?>">
                        <span class="badge-diskon">Diskon 25%</span>
                        <img src="<?=(isset($value->gambar_mapel) ? (!empty($value->gambar_mapel) && substr($value->gambar_mapel,0,5) == 'data:' ? $value->gambar_mapel : base_url().'assets/img/no-image.jpg') : base_url().'assets/img/no-image.jpg') ?>" alt="<?= $value->nama_mapel ?>">
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

//        if ($this->form_validation->run() == FALSE) {
//            alert_error("Error", "Terjadi Kesalahan Saat Daftar!");
//        } else {
            $result = $this->model_pg->daftar_pretest($nama, $telepon, $email, $alamat);
            //$insert_pretest = $this->model_pg->daftar($result, $session);

            redirect("pretest/mapel");
//        }
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