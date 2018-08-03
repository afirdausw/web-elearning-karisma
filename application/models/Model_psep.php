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


// model untuk manajemen guru di akun psep sekolah
// ##################################################
// ##################################################
// ##################################################
    function fetch_all_guru($idsekolah)
    {
        $this->db->select("*");
        $this->db->from("login_sekolah");
        $this->db->where("login_sekolah.level", "guru");
        $this->db->where("login_sekolah.id_sekolah", $idsekolah);

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_all_guru_by_id_login($id_login_sekolah)
    {
        $this->db->select("*");
        $this->db->from("login_sekolah");
        $this->db->where("login_sekolah.level", "guru");
        $this->db->where("login_sekolah.id_login_sekolah", $id_login_sekolah);

        $query = $this->db->get();
        return $query->result();

    }

    function guru_by_id_login($id_login_sekolah)
    {
        $this->db->select("*");
        $this->db->from("login_sekolah");
        $this->db->where("login_sekolah.level", "guru");
        $this->db->where("login_sekolah.id_login_sekolah", $id_login_sekolah);

        $query = $this->db->get();
        return $query->row();

    }

    function fetch_kelas_by_id($idkelas)
    {
        $this->db->select("*");
        $this->db->from("kelas");
        $this->db->where("id_kelas", $idkelas);

        $query = $this->db->get();
        return $query->row();
    }

    function tambah_guru($idsekolah, $nama, $email, $username, $password, $identitas, $mapel)
    {
        $data = array(
            'id_sekolah'      => $idsekolah,
            'username'        => $username,
            'password'        => md5($password),
            'nama'            => $nama,
            'kartu_identitas' => $identitas,
            'email'           => $email,
            'status'          => 0,
            'level'           => 'guru',
            'id_mapel'        => $mapel,
        );
        $result = $this->db->insert('login_sekolah', $data);
        $this->edit_kelas_ampu($this->db->insert_id(), $mapel);
    }

    function update_guru($id_guru, $nama, $email, $username, $password, $identitas, $mapel)
    {
        if ($password != "") {
            $data = array(

                'username'        => $username,
                'password'        => md5($password),
                'nama'            => $nama,
                'kartu_identitas' => $identitas,
                'email'           => $email,
                'id_mapel'        => $mapel,
            );
        }else{
            $data = array(

                'username'        => $username,
                'nama'            => $nama,
                'kartu_identitas' => $identitas,
                'email'           => $email,
                'id_mapel'        => $mapel,
            );
        }
        $this->db->where('id_login_sekolah', $id_guru);
        $result = $this->db->update('login_sekolah', $data);
        $this->edit_kelas_ampu($id_guru, $mapel);
        return $result;
    }

    function edit_kategori($iddiagnostic, $idmapel, $nama, $durasi, $ketuntasan)
    {
        $data = array(
            'id_mapel'      => $idmapel,
            'nama_kategori' => $nama,
            'durasi'        => $durasi,
            'ketuntasan'    => $ketuntasan,
        );

        $this->db->where('id_diagnostic', $iddiagnostic);
        $result = $this->db->update('kategori_diagnostic', $data);
        return $result;
    }

    function edit_kelas_ampu($id, $mapel)
    {
        $this->db->where("id_guru = " . $id . " AND id_mapel IN(" . $mapel . ")");
        $this->db->delete('guru_mapel');
        $mpl = explode(',', $mapel);
        foreach ($mpl as $value) {
            $data = [
                'id_guru'  => $id,
                'id_mapel' => $value
            ];
            $this->db->insert('guru_mapel', $data);
        }
    }


// end model untuk manajemen guru di akun psep sekolah
// ##################################################
// ##################################################
// ##################################################
}

?>