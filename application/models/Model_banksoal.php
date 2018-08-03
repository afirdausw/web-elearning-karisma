<?php

class Model_banksoal extends CI_Model
{
    function __construct()
    {

        parent::__construct();
    }

//general
    function fetch_options_materi_pokok()
    {
        $this->db->select('*');
        $this->db->from('mata_pelajaran');
        $this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
        $this->db->order_by('mata_pelajaran.nama_mapel', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    function tambah_banksoal($mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe)
    {
        $data = array(
            'id_mapel' => $mapel,
            'pertanyaan' => $soal,
            'topik' => $topik,
            'bobot_soal' => $bobot,
            'jawab_1' => $jawab1,
            'jawab_2' => $jawab2,
            'jawab_3' => $jawab3,
            'jawab_4' => $jawab4,
            'jawab_5' => $jawab5,
            'pembahasan_teks' => $bahasteks,
            'pembahasan_video' => $bahasvideo,
            'kunci' => $jawabbenar,
            'id_kategori_bank_soal' => $kategori,
            'status' => $tipe,
        );

        $result = $this->db->insert('bank_soal', $data);
    }

    function fetch_banksoal()
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_banksoal_paging($limit, $start = 0)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_banksoal_paging_by_jenjang($jenjang, $limit, $start = 0)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->limit($limit, $start);
        $this->db->where('jenjang', $jenjang);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_banksoal_total_record()
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');

        $query = $this->db->get();
        return $query->num_rows();
    }

    function fetch_banksoal_total_record_by_jenjang($jenjang)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');

        $this->db->where('jenjang', $jenjang);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function fetch_banksoal_paging_by_kelas($kelas, $limit, $start = 0)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->where('kelas.id_kelas', $kelas);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_banksoal_total_record_by_kelas($kelas)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->where('kelas.id_kelas', $kelas);

        $query = $this->db->get();
        return $query->num_rows();
    }

    function fetch_banksoal_paging_by_id_mapel($id_mapel, $limit, $start = 0)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->where('bank_soal.id_mapel', $id_mapel);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
        // SELECT `bank_soal`.`id_banksoal`, `bank_soal`.`pertanyaan`, `bank_soal`.`topik`, `bank_soal`.`jawab_1`, `bank_soal`.`jawab_2`, `bank_soal`.`jawab_3`, `bank_soal`.`jawab_4`, `bank_soal`.`jawab_5`, `bank_soal`.`pembahasan_teks`, `bank_soal`.`pembahasan_video`, `bank_soal`.`bobot_soal`, `bank_soal`.`kunci`, `mata_pelajaran`.`nama_mapel`, `kelas`.`alias_kelas` FROM `bank_soal` JOIN `mata_pelajaran` ON `bank_soal`.`id_mapel`=`mata_pelajaran`.`id_mapel` JOIN `kelas` ON `mata_pelajaran`.`kelas_id`=`kelas`.`id_kelas` WHERE `bank_soal`.`id_mapel` = '22'
    }

    function fetch_banksoal_total_record_by_id_mapel($id_mapel)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->where('bank_soal.id_mapel', $id_mapel);

        $query = $this->db->get();
        return $query->num_rows();
    }

    function fetch_banksoal_paging_by_topik($mapel, $topik, $limit, $start = 0)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->like('bank_soal.topik', $topik);
        $this->db->where('bank_soal.id_mapel', $mapel);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_banksoal_total_record_by_topik($mapel, $topik)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->like('bank_soal.topik', $topik);
        $this->db->where('bank_soal.id_mapel', $mapel);

        $query = $this->db->get();
        return $query->num_rows();
    }


    function fetch_banksoal_by_id_mapel($id_mapel)
    {
        $this->db->select('
            bank_soal.id_banksoal,
            bank_soal.pertanyaan,
            bank_soal.topik,
            bank_soal.jawab_1,
            bank_soal.jawab_2,
            bank_soal.jawab_3,
            bank_soal.jawab_4,
            bank_soal.jawab_5,
            bank_soal.pembahasan_teks,
            bank_soal.pembahasan_video,
            bank_soal.bobot_soal,
            bank_soal.kunci,
            mata_pelajaran.nama_mapel,
            kelas.alias_kelas
            ');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->where('bank_soal.id_mapel', $id_mapel);

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_banksoal_by_id_mapel_($id_mapel)
    {
        $this->db->select('
            bank_soal.id_banksoal,
            bank_soal.pertanyaan,
            bank_soal.topik,
            bank_soal.jawab_1,
            bank_soal.jawab_2,
            bank_soal.jawab_3,
            bank_soal.jawab_4,
            bank_soal.jawab_5,
            bank_soal.pembahasan_teks,
            bank_soal.pembahasan_video,
            bank_soal.bobot_soal,
            bank_soal.kunci,
            mata_pelajaran.nama_mapel,
            kelas.alias_kelas
            ');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas');
        $this->db->where('bank_soal.id_mapel', $id_mapel);

        $query = $this->db->get();
        return $query->result();
    }

    function hapus($idbanksoal)
    {
        $this->db->where('id_banksoal', $idbanksoal);
        $this->db->delete('bank_soal');
    }

    function fetch_kategori_bank_soal()
    {
        $this->db->select('*');
        $this->db->from('kategori_bank_soal');
        $this->db->join('mata_pelajaran', 'kategori_bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
        $query = $this->db->get();
        return $query->result();

    }

    function fetch_kategori_bank_soal_by_jenjang($jenjang)
    {
        $this->db->select('*');
        $this->db->from('kategori_bank_soal');
        $this->db->join('mata_pelajaran', 'kategori_bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
        $this->db->where('kelas.jenjang', $jenjang);
        $query = $this->db->get();
        return $query->result();

    }

    function fetch_kategori_bank_soal_by_mapel($id_mapel)
    {
        $this->db->select('*');
        $this->db->from('kategori_bank_soal');
        $this->db->join('mata_pelajaran', 'kategori_bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
        $this->db->where('kategori_bank_soal.id_mapel', $id_mapel);
        $query = $this->db->get();
        return $query->result();

    }

    function get_kelas()
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $query = $this->db->get();
        return $query->result();
    }

    function get_kelas_by_jenjang($jenjang)
    {
        $this->db->select('*');
        $this->db->from('kelas');
        $this->db->where('jenjang', $jenjang);
        $query = $this->db->get();
        return $query->result();
    }

    function get_mapel_by_kelas($idkelas)
    {
        $this->db->select('*');
        $this->db->from('mata_pelajaran');
        $this->db->where('kelas_id', $idkelas);
        $query = $this->db->get();
        return $query->result();
    }

    function get_materipokok_by_mapel($idmapel)
    {
        $this->db->select('*');
        $this->db->from('materi_pokok');
        $this->db->where('mapel_id', $idmapel);
        $this->db->order_by('urutan', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function get_kategori_by_mapel($idmapel)
    {
        $this->db->select('*');
        $this->db->from('kategori_bank_soal');
        $this->db->where('id_mapel', $idmapel);
        $query = $this->db->get();
        return $query->result();
    }

    function get_topik_by_mapel($idmapel)
    {
        $this->db->select('topik');
        $this->db->from('bank_soal');
        $this->db->where('id_mapel', $idmapel);
        $this->db->group_by('topik');
        $query = $this->db->get();
        return $query->result();
    }


    function tambah_kategori($idmapel, $namakategori)
    {
        $data = array(
            'id_mapel' => $idmapel,
            'nama_kategori' => $namakategori,
        );
        $result = $this->db->insert('kategori_bank_soal', $data);

    }

    function edit_kategori($idkategori, $idmapel, $namakategori)
    {
        $this->db->set('id_mapel', $idmapel);
        $this->db->set('nama_kategori', $namakategori);
        $this->db->where('id_kategori_bank_soal', $idkategori);
        $this->db->update('kategori_bank_soal');
    }

    function cari_kategori($idkategori)
    {
        $this->db->select('
	*
	');
        $this->db->from('kategori_bank_soal');
        $this->db->join('mata_pelajaran', 'kategori_bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
        $this->db->where('id_kategori_bank_soal', $idkategori);

        $query = $this->db->get();
        return $query->row();
    }

    function hapus_kategori($idkategori)
    {
        $this->db->where('id_kategori_bank_soal', $idkategori);
        $result = $this->db->delete('kategori_bank_soal');
    }

    function cari_bank_soal_by_id($idbanksoal)
    {
        $this->db->select('
	*
	');
        $this->db->from('bank_soal');
        $this->db->join('kategori_bank_soal', 'bank_soal.id_kategori_bank_soal=kategori_bank_soal.id_kategori_bank_soal', 'left');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
        $this->db->where('bank_soal.id_banksoal', $idbanksoal);

        $query = $this->db->get();
        return $query->row();
    }

    function edit_banksoal($idbanksoal, $mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe)
    {
        $this->db->set('id_mapel', $mapel);
        $this->db->set('id_kategori_bank_soal', $kategori);
        $this->db->set('pertanyaan', $soal);
        $this->db->set('topik', $topik);
        $this->db->set('jawab_1', $jawab1);
        $this->db->set('jawab_2', $jawab2);
        $this->db->set('jawab_3', $jawab3);
        $this->db->set('jawab_4', $jawab4);
        $this->db->set('jawab_5', $jawab5);
        $this->db->set('pembahasan_teks', $bahasteks);
        $this->db->set('pembahasan_video', $bahasvideo);
        $this->db->set('bobot_soal', $bobot);
        $this->db->set('kunci', $jawabbenar);
        $this->db->set('status', $tipe);

        $this->db->where('id_banksoal', $idbanksoal);
        $this->db->update('bank_soal');
    }

    function fetch_banksoal_by_kelas_mapel($kelas, $mapel)
    {
        $this->db->select('
	bank_soal.id_banksoal,
	bank_soal.pertanyaan,
	bank_soal.topik,
	bank_soal.jawab_1,
	bank_soal.jawab_2,
	bank_soal.jawab_3,
	bank_soal.jawab_4,
	bank_soal.jawab_5,
	bank_soal.pembahasan_teks,
	bank_soal.pembahasan_video,
	bank_soal.bobot_soal,
	bank_soal.kunci,
	mata_pelajaran.nama_mapel,
	kelas.alias_kelas,
	mata_pelajaran.id_mapel,
	kelas.id_kelas
	');
        $this->db->from('bank_soal');
        $this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
        $this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');

        $this->db->where('kelas.id_kelas', $kelas);
        $this->db->where('mata_pelajaran.id_mapel', $mapel);

        $query = $this->db->get();
        return $query->result();
    }


}

?>