<?php

/**
 *
 */
class Model_voucher_baru extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function simpan($data)
    {
        $this->db->insert("voucher_baru", $data);
    }

    function ubahstatus($id_siswa, $data)
    {
        $this->db->where('id_siswa', $id_siswa);
        $this->db->update("voucher_baru", $data);
    }

    function ubah($id_voucher, $data)
    {
        $this->db->where('id_siswa', $id_voucher);
        $this->db->update("voucher_baru", $data);
    }

    function hapus($id_voucher)
    {
        $this->db->where('id_siswa', $id_voucher);
        $this->db->delete("voucher_baru");
    }

   

    function allbyjenjang($jenjang)
    {
        $this->db->select('*');
        $this->db->from('voucher_baru');
        $this->db->join('kelas', 'voucher_baru.kelas = kelas.id_kelas');
        $this->db->where('kelas.jenjang', $jenjang);
        $this->db->order_by('voucher_baru.status', 'ASC');
    }

    function all()
    {
        $this->db->select('*');
        $this->db->from('voucher_baru');
        $this->db->order_by('voucher_baru.status', 'ASC');
    }
}