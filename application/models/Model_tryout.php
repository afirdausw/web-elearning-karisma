<?php

class Model_tryout extends CI_Model
{
    function __construct()
    {

        parent::__construct();
    }

    function get_kelas()
    {
        $this->db->select("*");
        $this->db->from("kelas");
        $query = $this->db->get();
        return $query->result();
    }

    function get_mapel($idkelas)
    {
        $this->db->select("*");
        $this->db->from("mata_pelajaran");
        $this->db->where("kelas_id", $idkelas);
        $query = $this->db->get();
        return $query->result();
    }

    function get_topik($idmapel)
    {
        $this->db->select("*");
        $this->db->from("bank_soal");
        $this->db->where("id_mapel", $idmapel);
        $this->db->group_by('topik');
        $query = $this->db->get();
        return $query->result();
    }

    function get_kategori($idmapel)
    {
        $this->db->select("*");
        $this->db->from("kategori_bank_soal");
        $this->db->where("id_mapel", $idmapel);
        $query = $this->db->get();
        return $query->result();
    }

    function get_soal($idmapel, $topik)
    {
        if ($idmapel == "semua" and $topik == "semua") {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");

            $query = $this->db->get();
            return $query->result();
        } elseif ($idmapel !== "semua" and $topik == "semua") {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.id_mapel", $idmapel);

            $query = $this->db->get();
            return $query->result();
        } elseif ($idmapel == "semua" and $topik !== "semua") {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.topik", $topik);

            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");

            $this->db->where("bank_soal.id_mapel", $idmapel);
            $this->db->where("bank_soal.topik", "'" . $topik . "'");

            $query = $this->db->get();
            return $query->result();
        }
    }

    function get_soal_by_mapel($idmapel)
    {
        $this->db->select("*");
        $this->db->from("bank_soal");
        $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
        $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
        $this->db->where("bank_soal.id_mapel", $idmapel);
        $this->db->where("bank_soal.status", 'main');

        $query = $this->db->get();
        return $query->result();
    }

    function get_soal_by_topik($topik)
    {
        $this->db->select("*");
        $this->db->from("bank_soal");
        $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
        $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
        $this->db->where("bank_soal.topik", $topik);

        $query = $this->db->get();
        return $query->result();
    }

    function get_soal_by_kategori($idkategori)
    {
        if ($idkategori == 'semua') {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.status", 'main');

            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.id_kategori_bank_soal", $idkategori);
            $this->db->where("bank_soal.status", 'main');

            $query = $this->db->get();
            return $query->result();
        }
    }

    function get_soal_by_kategori_page($idkategori,$idmapel,$idkelas,$jumdata,$page)
    {
        if ($idkategori == 'semua') {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.status", 'main');
            $this->db->limit($jumdata,$page);

            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select("*");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.id_kategori_bank_soal", $idkategori);
            $this->db->where("bank_soal.id_mapel", $idmapel);
            $this->db->where("mata_pelajaran.kelas_id", $idkelas);            
            $this->db->where("bank_soal.status", 'main');
            $this->db->limit($jumdata,$page);

            $query = $this->db->get();
            return $query->result();
        }
    }

    function count_kategori($idkategori)
    {
        if ($idkategori == 'semua') {
            $this->db->select("COUNT(*) as jumlahdata");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.status", 'main');

            $query = $this->db->get();
            return $query->result();
        } else {
            $this->db->select("COUNT(*) as jumlahdata");
            $this->db->from("bank_soal");
            $this->db->join("mata_pelajaran", "bank_soal.id_mapel=mata_pelajaran.id_mapel", "left");
            $this->db->join("kelas", "mata_pelajaran.kelas_id=kelas.id_kelas", "left");
            $this->db->where("bank_soal.id_kategori_bank_soal", $idkategori);
            $this->db->where("bank_soal.status", 'main');

            $query = $this->db->get();
            return $query->result();
        }
    }

    function aktifpendaftaran($idprofil)
    {
        $data = array(
            'status' => 1,
        );

        $this->db->where('id_tryout', $idprofil);
        $result = $this->db->update('profil_tryout', $data);
        return $result;
    }

    function nonaktifpendaftaran($idprofil)
    {
        $data = array(
            'status' => 0,
        );

        $this->db->where('id_tryout', $idprofil);
        $result = $this->db->update('profil_tryout', $data);
        return $result;
    }

    function get_pembayaran()
    {
        $this->db->select('
	pembayaran_cbt.id_profil,
	pembayaran_cbt.id_bayar_cbt,
	pembayaran_cbt.status as status_bayar,
	pembayaran_cbt.bukti,
	pembayaran_cbt.tgl_daftar,
	pembayaran_cbt.tgl_bayar,
	siswa.id_siswa,
	siswa.nama_siswa,
	profil_tryout.id_tryout,
	profil_tryout.nama_profil,
	profil_tryout.biaya,
	');
        $this->db->from('pembayaran_cbt');
        $this->db->join('profil_tryout', 'pembayaran_cbt.id_profil=profil_tryout.id_tryout', 'left');
        $this->db->join('siswa', 'pembayaran_cbt.id_siswa=siswa.id_siswa', 'left');

        $query = $this->db->get();
        return $query->result();
    }

    function konfirmasi_bayar($iddaftar, $idsiswa)
    {
        $tglbayar = date('Y-m-d');
        $data = array(
            'status' => 2,

        );
        $this->db->where('id_siswa', $idsiswa);
        $this->db->where('id_bayar_cbt', $iddaftar);
        $this->db->update('pembayaran_cbt', $data);
    }

    function tolak_bayar($iddaftar, $idsiswa)
    {
        $tglbayar = date('Y-m-d');
        $data = array(
            'status' => 3,

        );
        $this->db->where('id_siswa', $idsiswa);
        $this->db->where('id_bayar_cbt', $iddaftar);
        $this->db->update('pembayaran_cbt', $data);
    }

    function get_kelas_by_id_tryout($id_tryout)
    {
        $this->db->select("*");
        $this->db->from("profil_tryout");
        $this->db->where('id_tryout', $id_tryout);
        $query = $this->db->get();
        return $query->result();
    }

}