<?php

if (!defined('BASEPATH')) exit('No direct script access allowed!');

/**
 *
 */
class Model_kontendownload extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function get_all_konten_by_kategori_konten_download($id_kategori_konten_download)
	{
		$this->db->where('id_kategori', $id_kategori_konten_download);
        $this->db->select("`konten_download`.`id`, `konten_download`.`judul`, `konten_download`.`keterangan`, `konten_download`.`gambar`, `konten_download`.`link`, `konten_download`.`point`, `kategori_konten_download`.`kategori_konten_download`");
        $this->db->from("konten_download");
        $this->db->join("kategori_konten_download", "konten_download.id_kategori=kategori_konten_download.id", "left");
        $this->db->order_by("`konten_download`.`id`", "asc");
		$query = $this->db->get();
		return $query->result();
	}

	function get_jenjang()
	{
		return $this->db->get('kelas');
	}

	function get_all_konten()
	{
		$this->db->select("`konten_download`.`id`, `konten_download`.`judul`, `konten_download`.`keterangan`, `konten_download`.`gambar`, `konten_download`.`link`, `konten_download`.`point`, `kategori_konten_download`.`kategori_konten_download`");
		$this->db->from("konten_download");
		$this->db->join("kategori_konten_download", "konten_download.id_kategori=kategori_konten_download.id", "left");
		$this->db->order_by("`konten_download`.`id`", "asc");
		$query = $this->db->get();

		return $query->result();
	}

	function simpan($data)
	{
		$query = $this->db->insert('konten_download', $data);

		return $query;
	}

	function get_all_konten_by_mapel($id_mapel)
	{
		$this->db->where('id_mapel', $id_mapel);
		$query = $this->db->get('konten_download');
		return $query->result();
	}




// FETCH DATA

	function get_konten_by_id($id)
	{
		$this->db->select("*");
		$this->db->from("konten_download");
		$this->db->where('id', $id);

		$query = $this->db->get();
		return $query->row();
	}




	function update($id, $judul, $link, $poin, $keterangan, $gambar, $kategori){

		//Update row by id in table sub_materi 
		$data = array(
			'judul' 			=> $judul,
			'keterangan' => $keterangan,
			'gambar' => $gambar,
			'link' => $link,
			'point' => $poin,
			'id_kategori' => $kategori
		);
		$this->db->where('id', $id);
		$result = $this->db->update('konten_download', $data);

		return $result;

	}


	function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('konten_download');
		
		return $result;
	}


	

//#########################################
//#########################################
//#########################################
// KATEGORI KONTEN DOWNLOAD
//#########################################
//#########################################
//#########################################


	function get_kategori_konten_download()
	{
      
		$query = $this->db->get('kategori_konten_download');
		
		return $query->result();
	}
	function get_kategori_konten_download_by_jenjang($jenjang)
	{
        $this->db->where_in('kelas',$jenjang);
		$query = $this->db->get('kategori_konten_download');
		
		return $query->result();
	}

	function simpan_kategori_konten_download($data)
	{
		$query = $this->db->insert('kategori_konten_download', $data);

		return $query;
	}


	function get_kategori_konten_by_id($id)
	{
		$this->db->select("*");
		$this->db->from("kategori_konten_download");
		$this->db->where('id', $id);

		$query = $this->db->get();
		return $query->row();
	}

	function update_kategori($id, $judul_kategori, $gambar){

		//Update row by id in table sub_materi 
		$data = array(
			'kategori_konten_download' 			=> $judul_kategori,
			'gambar'							=> $gambar
		);
		$this->db->where('id', $id);
		$result = $this->db->update('kategori_konten_download', $data);

		return $result;

	}


	function delete_kategori($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('kategori_konten_download');
		
		return $result;
	}


//#########################################
//#########################################
//#########################################



	function get_konten_by_id_kat($id)
	{
		$this->db->where('id_kategori', $id);
		$query = $this->db->get('konten_download');
		return $query->result();
	}




//#########################################
//#########################################
//#########################################


	function insert_kd_siswa($data)
	{
		$query = $this->db->insert('konten_download_siswa', $data);


		return $query;
	}

	function get_kd_by_idsiswakonten($siswa, $konten){
		$where_arr= array('id_siswa =' => $siswa, 'id_konten_download =' => $konten);
		$this->db->where($where_arr);
		$query = $this->db->get('konten_download_siswa');
		return $query->result();		
	}

	//proses

	function kurangi_poin($id_siswa,$data){
		$this->db->where('id_siswa', $id_siswa);
		$result = $this->db->update('siswa', $data);

		// return $result;

	}


}