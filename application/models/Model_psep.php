<?php if (!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_psep extends CI_Model
{

    private $insert_id;

    function __construct()
    {
        parent::__construct();
    }

    function do_login($username, $password)
    {
        $cred = array('username' => $username,
                      'password' => md5($password),
                      'status'   => 1,
        );

        $this->db->select('*');
        $this->db->from('login_sekolah');

        $this->db->where($cred);

        $query = $this->db->get();
        $exist = $query->num_rows();

        if ($exist > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function data_login($username, $password)
    {
        $cred = array('username' => $username,
                      'password' => md5($password),
        );

        $this->db->select('*');
        $this->db->from('login_sekolah');
        $this->db->join("sekolah", "login_sekolah.id_sekolah=sekolah.id_sekolah");

        $this->db->where($cred);

        $query = $this->db->get();
        return $query->row();
    }


    function cari_sekolah_by_login($idpsep)
    {
        $this->db->select("*");
        $this->db->from("login_sekolah");
        $this->db->join("sekolah", "login_sekolah.id_sekolah=sekolah.id_sekolah");
        $this->db->where('id_login_sekolah', $idpsep);

        $query = $this->db->get();
        return $query->row();
    }


    function cari_kelas_by_id_mapel($id_mapel)
    {
        $this->db->select("*");
        $this->db->from("mata_pelajaran");
        $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas");
        $this->db->where('id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->result();
    }


    function cari_kelas_in_id_mapel($id_mapel)
    {
        $this->db->select("*");
        $this->db->from("mata_pelajaran");
        $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas");
        $this->db->where_in('id_mapel', explode(',', $id_mapel));
        $query = $this->db->get();
        return $query->result();
    }

    function cari_kelas_by_mapel($id_mapel)
    {
        $this->db->select("*");
        $this->db->from("mata_pelajaran");
        $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas");
        $this->db->where('id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->row();
    }


    function fetch_sekolah_by_id($idsekolah)
    {
        $this->db->select("*");
        $this->db->from("sekolah");
        $this->db->where('id_sekolah', $idsekolah);

        $query = $this->db->get();
        return $query->row();
    }

    function cari_kelas_by_jenjang($jenjang)
    {
        $this->db->select("*");
        $this->db->from("kelas");
        $this->db->where("jenjang", $jenjang);
//        $this->db->join("mata_pelajaran", "mata_pelajaran.kelas_id=kelas.id_kelas");
        $query = $this->db->get();
        return $query->result();
    }

    function cari_mapel_by_jenjang($jenjang)
    {
        $this->db->select("*");
        $this->db->from("kelas");
        $this->db->where("jenjang", $jenjang);
        $this->db->join("mata_pelajaran", "mata_pelajaran.kelas_id=kelas.id_kelas");

        $query = $this->db->get();
        return $query->result();
    }

    function cari_mapel_by_jenjang_group_by_mapel($jenjang)
    {
        $this->db->select("*");
        $this->db->from("kelas");
        $this->db->where("jenjang", $jenjang);
        $this->db->join("mata_pelajaran", "mata_pelajaran.kelas_id=kelas.id_kelas");
        $this->db->group_by('mata_pelajaran.nama_mapel');
        $query = $this->db->get();
        return $query->result();
    }

    function cari_siswa_by_kelas($kelas, $idsekolah)
    {
        $this->db->select("*");
        $this->db->from("siswa");
        $this->db->join("kelas", "siswa.kelas=kelas.id_kelas");
        $this->db->where("kelas.id_kelas", $kelas);
        $this->db->where("sekolah_id", $idsekolah);

        $query = $this->db->get();
        return $query->result();
    }


    function cari_siswa_by_kelas_who_do_agcutest($kelas, $idsekolah)
    {
        $this->db->select("*");
        $this->db->from("siswa");
        $this->db->join("kelas", "siswa.kelas=kelas.id_kelas");
        $this->db->join("hasil_eq", "siswa.id_siswa = hasil_eq.id_siswa");
        $this->db->join("hasil_ls", "siswa.id_siswa = hasil_ls.id_siswa");
        $this->db->where("kelas.id_kelas", $kelas);
        $this->db->where("sekolah_id", $idsekolah);

        $query = $this->db->get();
        return $query->result();
    }

}

?>