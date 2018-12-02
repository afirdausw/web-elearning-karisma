<?php

/**
 *
 */
class Instruktur extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pg');
        $this->load->model('model_konten');
        $this->load->model('model_profil');
        $this->load->model('model_instruktur');
        $this->load->helper('url');
    }

    public function index($id_instruktur = "")
    {
        $kelas_navbar = $this->model_pg->fetch_all_kelas();
        $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));
        if($id_instruktur!="")
            $where = array("id_instruktur" => $id_instruktur);
        else
            $where = $id_instruktur;
        $instruktur = $this->model_instruktur->fetch_instruktur($where);

        //tambah definisi tabelnya karena join
        $where = array("instruktur_mapel.id_instruktur" => $id_instruktur);
        $materi_list = $this->model_instruktur->get_mapel_by_instruktur($where);
        $data = array(
            "siswa" => $siswa,
            "instruktur" => $instruktur,
            "kelas_navbar" => $kelas_navbar, 
            "materi_list" => $materi_list, 
        );
        if($instruktur==null){
            redirect(base_url(),"refresh");
        }
        $this->load->view('pg_user/profil-instruktur', $data);
    }


    public function premium()
    {
        if($this->session->userdata('id_siswa')!=NULL){
            $siswa = $this->model_pg->get_data_user($this->session->userdata('id_siswa'));

            $data = [
                "id_siswa"     => $this->session->userdata('id_siswa'),
            ];
            if ($siswa->id_premium == 0){
                $data["id_premium"] = 1;
            }else if ($siswa->id_premium >= 0){
                $data["id_premium"] = 0;
            }
            $update = $this->model_profil->toogle_premium($data);
            if($update){
                redirect(base_url().'profil');
            }else{
                var_dump($update);
            }
        }else{
            redirect(base_url(), 'refresh');
        }

    }
}
