<?php
/**
 * Created by PhpStorm.
 * User: Karisma Academy
 * Date: 14 May 2018
 * Time: 13:10
 */

class Materi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pg');
    }

    public function index($id_materi)
    {
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
            'materi_lain' => $this->model_pg->get_materi_random(),
        );
        if($this->session->userdata('siswa_logged_in')){
            $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));
            $data["siswa_status"] = $siswa->id_premium;
        }
        // return $this->output
        //      ->set_content_type('application/json')
        //      ->set_status_header(500)
        //      ->set_output(json_encode($data));

        

        $this->load->view('pg_user/materi_pokok', $data);
    }
}