<?php

class Model_agcu extends CI_Model
{
	function __construct()
	{

		parent::__construct();
	}

	function cek_eq($idsiswa)
	{
		$this->db->select('*');
		$this->db->from('hasil_eq');
		$this->db->where('id_siswa', $idsiswa);
		$result = $this->db->count_all_results();
		return $result;
	}

	function get_eq($idsiswa)
	{
		$this->db->select('*');
		$this->db->from('hasil_eq');
		$this->db->where('id_siswa', $idsiswa);
		$query = $this->db->get();
		return $query->row();
	}

	function cek_ls($idsiswa)
	{
		$this->db->select('*');
		$this->db->from('hasil_ls');
		$this->db->where('id_siswa', $idsiswa);
		$result = $this->db->count_all_results();
		return $result;
	}

	function get_jumlah_soal_diagnostic($idkelas)
	{
		$this->db->select('
	soal_diagnostic.id_diagnostic,
	count( id_banksoal ) AS jumlah_soal');
		$this->db->from('soal_diagnostic');
		$this->db->join('kategori_diagnostic', 'soal_diagnostic.id_diagnostic = kategori_diagnostic.id_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel = mata_pelajaran.id_mapel');
		$this->db->where('mata_pelajaran.kelas_id', $idkelas);
		$this->db->group_by('soal_diagnostic.id_diagnostic');

		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_soal_diagnostic_dikerjakan($idsiswa)
	{
		$this->db->select('
	id_diagnostic, count( id_siswa ) AS jumlah');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->group_by('id_diagnostic');
		$this->db->group_by('id_siswa');

		$query = $this->db->get();
		return $query->result();
	}

	function cek_kelas()
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->group_by('alias_kelas');
		$query = $this->db->get();
		return $query->result();
	}

	function cek_kelas_by_jenjang($jenjang)
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->group_by('alias_kelas');
		$this->db->where('kelas.jenjang', $jenjang);
		$query = $this->db->get();
		return $query->result();
	}


	function get_diagnostic()
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function get_diagnostic_by_jenjang($jenjang)
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('kelas.jenjang', $jenjang);
		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlahsoal()
	{
		$this->db->select('id_diagnostic, COUNT(id_banksoal) as jumlah');
		$this->db->from('soal_diagnostic');
		$this->db->group_by('id_diagnostic');
		$query = $this->db->get();
		return $query->result();
	}

	function get_kelas()
	{
		$this->db->select('*');
		$this->db->from('kelas');
		$this->db->order_by("tingkatan_kelas", "asc");
		$query = $this->db->get();
		return $query->result();
	}
	function get_kelas_by_jenjang($jenjang)
	{
		$this->db->select('*');
		$this->db->from('kelas');
		$this->db->where('kelas.jenjang', $jenjang);
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

	function get_soal_by_mapel($idmapel)
	{
		$this->db->select('*');
		$this->db->from('bank_soal');
		$this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('bank_soal.id_mapel', $idmapel);
		$query = $this->db->get();
		return $query->result();
	}

	function tambah_kategori($idmapel, $nama, $durasi, $ketuntasan)
	{
		$data = array(
			'id_mapel'      => $idmapel,
			'nama_kategori' => $nama,
			'durasi'        => $durasi,
			'ketuntasan'    => $ketuntasan,
		);
		$result = $this->db->insert('kategori_diagnostic', $data);
		return $result;
	}

	function last_addedkategori()
	{
		$this->db->select("max(id_diagnostic) as id_terakhir");
		$this->db->from("kategori_diagnostic");
		$query = $this->db->get();
		return $query->row();
	}

	function add_soal($iddiagnostic, $idbanksoal)
	{
		$data = array(
			'id_diagnostic' => $iddiagnostic,
			'id_banksoal'   => $idbanksoal,
		);
		$result = $this->db->insert('soal_diagnostic', $data);
		return $result;
	}

//TAMBAHAN UNTUK EDIT KATEGORI DIAGNOSTIC...
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



//END TAMBAHAN UNTUK EDIT KATEGORI DIAGNOSTIC...

//fungsi hapus kategori diagnostic
	function hapuskategori($iddiagnostic)
	{
		$this->db->delete('kategori_diagnostic', array('id_diagnostic' => $iddiagnostic));
	}

	function hapus_soal_kategori($iddiagnostic)
	{
		$this->db->delete('soal_diagnostic', array('id_diagnostic' => $iddiagnostic));
	}

//end hapus kategori diagnostic

	function get_diagnosticbyid($iddiagnostic)
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('kategori_diagnostic.id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->row();
	}

	function get_idsoal($iddiagnostic)
	{
		$this->db->select('*');
		$this->db->from('soal_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->result();
	}

	function get_soal()
	{
		$this->db->select('*');
		$this->db->from('bank_soal');
		$this->db->join('mata_pelajaran', 'bank_soal.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	function get_diagnosticbykelas($kelas)
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel=mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id=kelas.id_kelas', 'left');
		$this->db->where('kelas.id_kelas', $kelas);
		$query = $this->db->get();
		return $query->result();
	}

//function untuk diagnostic test
//******************************

	function get_navbar_links()
	{
		$this->db->select('*');
		$this->db->from('mata_pelajaran');
		$this->db->join('kelas', 'kelas.id_kelas = mata_pelajaran.kelas_id', 'left');
		$this->db->order_by('mata_pelajaran.nama_mapel', 'ASC');
		$query = $this->db->get();
		return $query->result();

	}

	function fetch_soal_by_diagnostic($iddiagnostic)
	{
		$this->db->select("
	soal_diagnostic.id_soal,
	soal_diagnostic.id_diagnostic,
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
	bank_soal.bobot_topik,
	bank_soal.kunci,
	kategori_diagnostic.nama_kategori,
	kategori_diagnostic.durasi,
	kategori_diagnostic.ketuntasan
	");
		$this->db->from("soal_diagnostic");
		$this->db->join("bank_soal", "soal_diagnostic.id_banksoal=bank_soal.id_banksoal");
		$this->db->join("kategori_diagnostic", "soal_diagnostic.id_diagnostic=kategori_diagnostic.id_diagnostic");
		$this->db->where("soal_diagnostic.id_diagnostic", $iddiagnostic);

		$query = $this->db->get();
		return $query->result();
	}

	function get_timer($iddiagnostic)
	{
		$this->db->select('durasi');
		$this->db->from('kategori_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);

		$query = $this->db->get();
		return $query->row();
	}

	function get_mapel_by_diagnostic($iddiagnostic)
	{
		$this->db->select('*');
		$this->db->from('kategori_diagnostic');
		$this->db->join('mata_pelajaran', 'kategori_diagnostic.id_mapel = mata_pelajaran.id_mapel', 'left');
		$this->db->join('kelas', 'mata_pelajaran.kelas_id = kelas.id_kelas', 'left');
		$this->db->where('kategori_diagnostic.id_diagnostic', $iddiagnostic);
		$query = $this->db->get();
		return $query->row();
	}

	function fetch_array_id_soal($iddiagnostic)
	{
		$this->db->select('soal_diagnostic.id_banksoal, bank_soal.kunci');
		$this->db->from('soal_diagnostic');
		$this->db->join('bank_soal', 'soal_diagnostic.id_banksoal=bank_soal.id_banksoal');
		$this->db->where('soal_diagnostic.id_diagnostic', $iddiagnostic);

		$query = $this->db->get();
		return $query->result_array();
	}

	function carihasildiagnostic($idkategori, $idsiswa, $id_soal)
	{
		$this->db->select('*');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_diagnostic', $idkategori);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_soal', $id_soal);
		$result = $this->db->count_all_results();
		//tester
		// echo $this->db->_compile_select();
		return $result;
	}

	function edithasildiagnostic($idkategori, $idsiswa, $id_soal, $status)
	{
		$this->db->set('status', $status);

		$this->db->where('id_diagnostic', $idkategori);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('id_soal', $id_soal);
		$query = $this->db->update('hasil_diagnostic');
		return $query;
	}

	function inputhasildiagnostic($idkategori, $idsiswa, $id_soal, $status)
	{
		$data = array(
			'id_diagnostic' => $idkategori,
			'id_siswa'      => $idsiswa,
			'id_soal'       => $id_soal,
			'status'        => $status,
		);

		$result = $this->db->insert('hasil_diagnostic', $data);
	}

	function cari_jumlahsoal_by_diagnostic($iddiagnostic, $idsiswa)
	{
		$this->db->select('*');
		$this->db->from('soal_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$result = $this->db->count_all_results();
		return $result;
	}

	function cari_diagnostic_benar_by_diagnostic($iddiagnostic, $idsiswa)
	{
		$this->db->select('*');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('status', 1);
		$result = $this->db->count_all_results();
		return $result;
	}

	function cari_diagnostic_salah_by_diagnostic($iddiagnostic, $idsiswa)
	{
		$this->db->select('*');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_diagnostic', $iddiagnostic);
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('status', 0);
		$result = $this->db->count_all_results();
		return $result;
	}

	function get_jumlah_benar($idsiswa)
	{
		$this->db->select('
	id_diagnostic,
	id_siswa,
	count(status) as "jumlah_benar"');
		$this->db->from('hasil_diagnostic');
		$this->db->where('id_siswa', $idsiswa);
		$this->db->where('status', 1);
		$this->db->group_by('id_diagnostic');
		$this->db->group_by('id_siswa');

		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_benar_by_kelas_sekolah($idkelas, $idsekolah)
	{
		$this->db->select('
	hasil_diagnostic.id_diagnostic,
	hasil_diagnostic.id_siswa,
	count(hasil_diagnostic.status) as "jumlah_benar"');
		$this->db->from('hasil_diagnostic');
		$thos->db->join("siswa", "hasil_diagnostic.id_siswa=siswa.id_siswa");
		$this->db->where('hasil_diagnostic.status', 1);
		$this->db->group_by('id_diagnostic');

		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_hasil()
	{
		$this->db->select('
	id_diagnostic,
	count(status) as "jumlah_soal"
	');
		$this->db->from('hasil_diagnostic');
		$this->db->group_by('id_diagnostic');

		$query = $this->db->get();
		return $query->result();
	}

	function get_jumlah_benar_hasil()
	{
		$this->db->select('
	id_diagnostic,
	count(status) as "jumlah_benar"
	');
		$this->db->from('hasil_diagnostic');
		$this->db->where('status', 1);
		$this->db->group_by('id_diagnostic');

		$query = $this->db->get();
		return $query->result();
	}

	function get_analisis_topik($id_siswa)
	{
		$this->db->select("hasil_diagnostic.id_diagnostic, hasil_diagnostic.status, bank_soal.topik");
		$this->db->from('hasil_diagnostic');
		$this->db->join('bank_soal', 'hasil_diagnostic.id_soal=bank_soal.id_banksoal');
		$this->db->where('hasil_diagnostic.id_siswa', $id_siswa);

		$query = $this->db->get();
		return $query->result();
	}

	function get_rank_by_kelas($idkelas)
	{
		$this->db->select("siswa.kelas, hasil_diagnostic.id_siswa, count( hasil_diagnostic.status ) AS jumlah_benar");
		$this->db->from("hasil_diagnostic");
		$this->db->join("siswa", "hasil_diagnostic.id_siswa = siswa.id_siswa");
		$this->db->where("hasil_diagnostic.status", 1);
		$this->db->where("siswa.kelas", $idkelas);
		$this->db->group_by("id_siswa");
		$this->db->order_by("jumlah_benar", "DESC");

		$query = $this->db->get();
		return $query->result();
	}

//DIMAS 
	function get_ordered_hasildiagnostic()
	{
		$sql = "SELECT siswa.nama_siswa, hasil_diagnostic.id_siswa, hasil_diagnostic.id_diagnostic,
			(SUM(CASE(hasil_diagnostic.status) WHEN 1 THEN hasil_diagnostic.status ELSE 0 END)) AS 'jumlah_status' 
		FROM hasil_diagnostic 
		LEFT JOIN siswa 
			ON siswa.id_siswa = hasil_diagnostic.id_siswa
		GROUP BY hasil_diagnostic.id_diagnostic, hasil_diagnostic.id_siswa 
		ORDER BY hasil_diagnostic.id_diagnostic, jumlah_status DESC, siswa.nama_siswa";

		$query = $this->db->query($sql);
		return $query->result();
	}

	function get_peringkatsiswabykelas($id_kelas = 0)
	{
		$sql = "SELECT siswa.kelas, siswa.nama_siswa, hasil_diagnostic.id_siswa, 
		(SUM(CASE(hasil_diagnostic.status) WHEN 1 THEN hasil_diagnostic.status ELSE 0 END)) AS 'jumlah_status' 
		FROM hasil_diagnostic 
		LEFT JOIN siswa 
			ON siswa.id_siswa = hasil_diagnostic.id_siswa
		WHERE siswa.kelas = $id_kelas
		GROUP BY hasil_diagnostic.id_siswa 
		ORDER BY jumlah_status DESC, siswa.nama_siswa";

		$query = $this->db->query($sql);
		return $query->result();
	}

}

?>