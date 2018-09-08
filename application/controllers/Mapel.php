<?php
/**
 * Created by PhpStorm.
 * User: Karisma Academy
 * Date: 14 May 2018
 * Time: 13:10
 */

class Mapel extends CI_Controller
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
        $mapok_ids_in = "";
        foreach ($mapok as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['mapok'] = $this->model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru[] = $v;

            //create string for IN statement on sql
            $mapok_ids_in .= $value->id_materi_pokok;
            $mapok_ids_in .= ",";
        }
        $mapok_baru = json_decode(json_encode($mapok_baru), FALSE);
        
        // PRE
        $mapok_pre = $this->model_pg->get_materi_pre_by_mapel($id_materi);
        $mapok_baru_pre = [];
        foreach ($mapok_pre as $key => $value) {
            $v = $array = json_decode(json_encode($value), true);
            $v['sub_materi'] = $this->model_pg->get_sub_materi_by_materi($value->id_materi_pokok);
            $mapok_baru_pre[] = $v;
        }
        $mapok_baru_pre = json_decode(json_encode($mapok_baru_pre), FALSE);
        // END PRE

        //remove last comma
        $mapok_ids_in = rtrim($mapok_ids_in,",");
        $materi_ids =  $this->model_pg->get_count_submateri($mapok_ids_in);
      
        $id = $this->session->userdata('id_siswa');
        $cek = $this->model_pg->get_log_baca($id);

        $data = array(
            "kelas" => $mapel,
            'materi' => $mapok_baru,
            'materi_pre' => $mapok_baru_pre,
            'mapel_lain' => $this->model_pg->get_mapel_random(),
            'materi_total' => $materi_ids->jumlah_sub,
            'baca_total' => $cek->baca_total,
        );

        if ($this->session->userdata("siswa_logged_in")){
            $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));
            $data['siswa_status'] = $siswa->id_premium;
        }



        $this->load->view('pg_user/materi_pokok', $data);
    }
}
?>

