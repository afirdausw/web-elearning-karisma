<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_konten extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function select_log_count($data)
    {
        $this->db->select('*');
        $this->db->from('log_ujian');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);
        $result = $this->db->count_all_results();
        return $result;
    }

    public function select_log_data($data)
    {
        $this->db->select('*');
        $this->db->from('log_ujian');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);

        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function select_log_data_result($data)
    {
        $this->db->select('*');
        $this->db->from('log_ujian');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function select_jawaban_data($pilihan, $data)
    {
        $this->db->from('jawaban_siswa');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);

        if ($pilihan == "fetch") {
            $this->db->select('*');
            $this->db->where('soal_id !=', $data["soal_id"]);
            $query = $this->db->get();
            $result = $query->result();
        }
        if ($pilihan == "fetch_id") {
            $this->db->select('*');
            $this->db->where('soal_id', $data["soal_id"]);
            $query = $this->db->get();
            $result = $query->row();
        } else if ($pilihan == "hitung_id") {
            $this->db->select('*');
            $this->db->where('soal_id', $data["soal_id"]);
            $result = $this->db->count_all_results();
        } else if ($pilihan == "hitung_semua") {
            $this->db->select('COUNT(*) AS numrows');
            $query = $this->db->get();
            $result = $query->row();
        }
        return $result;
    }

    public function insert_log($data, $jenis = "")
    {
        if($jenis!=""){
            if($jenis == "ujian"){
                $query = $this->db->insert("log_ujian", $data);
            }
        }else if($jenis==""){
            $query = $this->db->insert("log_baca", $data);
        }
        return $query;

    }

    public function update_log($data, $jenis = "")
    {
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);
        if($jenis!=""){
            if($jenis == "ujian"){
                $query = $this->db->update("log_ujian", $data);
            }
        }else if($jenis==""){
            $query = $this->db->update("log_baca", $data);
        }
        return $query;

    }

    public function insert_jawab($data)
    {
        $query = $this->db->insert("jawaban_siswa", $data);

        return $query;

    }

    public function update_jawab($data)
    {
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);
        $this->db->where('soal_id', $data["soal_id"]);
        $query = $this->db->update("jawaban_siswa", $data);
        return $query;
    }

    /* UJIAN PRETEST */

    public function select_log_count_pretest($data)
    {
        $this->db->select('*');
        $this->db->from('log_ujian_pretest');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);
        $result = $this->db->count_all_results();
        return $result;
    }

    public function select_log_data_pretest($data)
    {
        $this->db->select('*');
        $this->db->from('log_ujian_pretest');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);

        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function select_log_data_result_pretest($data)
    {
        $this->db->select('*');
        $this->db->from('log_ujian_pretest');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);

        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function select_jawaban_data_pretest($pilihan, $data)
    {
        $this->db->from('jawaban_siswa_pretest');
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);

        if ($pilihan == "fetch") {
            $this->db->select('*');
            $this->db->where('soal_id !=', $data["soal_id"]);
            $query = $this->db->get();
            $result = $query->result();
        }
        if ($pilihan == "fetch_id") {
            $this->db->select('*');
            $this->db->where('soal_id', $data["soal_id"]);
            $query = $this->db->get();
            $result = $query->row();
        } else if ($pilihan == "hitung_id") {
            $this->db->select('*');
            $this->db->where('soal_id', $data["soal_id"]);
            $result = $this->db->count_all_results();
        } else if ($pilihan == "hitung_semua") {
            $this->db->select('COUNT(*) AS numrows');
            $query = $this->db->get();
            $result = $query->row();
        }
        return $result;
    }

    public function insert_log_pretest($data)
    {
        $query = $this->db->insert("log_ujian_pretest", $data);
        return $query;

    }

    public function update_log_pretest($data)
    {
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);
        $query = $this->db->update("log_ujian_pretest", $data);

        return $query;

    }

    public function insert_jawab_pretest($data)
    {
        $query = $this->db->insert("jawaban_siswa_pretest", $data);

        return $query;

    }

    public function update_jawab_pretest($data)
    {
        $this->db->where('id_siswa', $data["id_siswa"]);
        $this->db->where('sub_materi_id', $data["sub_materi_id"]);
        $this->db->where('soal_id', $data["soal_id"]);
        $query = $this->db->update("jawaban_siswa_pretest", $data);
        return $query;
    }


    public function select_kunci($data)
    {
        $this->db->select('`kunci_jawaban`, `bobot`');
        $this->db->from('jawaban');
        $this->db->where('soal_id', $data["soal_id"]);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function select_kunci_idsubmateri($data)
    {
        $this->db->select("SUM(bobot) AS bobotnya");
        $this->db->from("jawaban");
        $this->db->join("soal", "jawaban.soal_id = soal.id_soal");
        $this->db->where("soal.sub_materi_id", $data["sub_materi_id"]);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    //TODO Log diinsert saat akses klik sidebar
    public function insert_log_baca($siswa, $sub_materi, $waktu, $jenis_siswa)
    {
        $data = array(
            "id_siswa"      => $siswa,
            "sub_materi_id" => $sub_materi,
            "created_at"    => $waktu,
            "jenis_siswa"    => $jenis_siswa,
        );
        $query = $this->db->insert("log_baca", $data);
        return $query;
    }
    //update jika telah ada
    public function update_log_baca($siswa, $sub_materi, $waktu, $jenis_siswa)
    {
        $data = array(
            "id_siswa"      => $siswa,
            "sub_materi_id" => $sub_materi,
            "created_at"    => $waktu,
            "jenis_siswa"    => $jenis_siswa,
        );
        $this->db->where('id_siswa', $siswa);
        $this->db->where('sub_materi_id', $sub_materi);
        $this->db->where('jenis_siswa', $jenis_siswa);
        $query = $this->db->update("log_baca", $data);

        return $query;
    }

}
