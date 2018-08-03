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
    }

    function index()
    {
        $data = array(
            'title' => 'Judul'
        );
        $this->load->view("pg_user/datadiri");
    }

    function mapel()
    {
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
}