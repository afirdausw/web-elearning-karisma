<?php
/**
 * Created by PhpStorm.
 * User: KARISMA ACADEMY
 * Date: 03/12/2018
 * Time: 09:28
 */

class Model_Transaksi extends CI_Model
{


    public function addTransaksi($data)
    {
        $result = $this->db->insert('transaksi', $data);

        return $result;
    }

    public function addDetailTransaksi($data)
    {
        $result = $this->db->insert('detail_transaksi', $data);

        return $result;
    }

    public function getTransaksiByIdSiswa($id)
    {
        $this->db->where('siswa_id', $id);
        $result = $this->db
            ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id')
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel = detail_transaksi.mapel_id')
            ->join('instruktur_mapel', 'mata_pelajaran.id_mapel = instruktur_mapel.id_mapel')
            ->join('instruktur', 'instruktur_mapel.id_instruktur = instruktur.id_instruktur')
            ->group_by('transaksi.id_transaksi')
            ->order_by('transaksi.created_at')
            ->get('transaksi');

        return $result->result();
    }

    public function getTransaksi()
    {
        $result = $this->db
            ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id')
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel = detail_transaksi.mapel_id')
            ->join('instruktur_mapel', 'mata_pelajaran.id_mapel = instruktur_mapel.id_mapel')
            ->join('instruktur', 'instruktur_mapel.id_instruktur = instruktur.id_instruktur')
            ->join('siswa', 'transaksi.siswa_id = siswa.id_siswa')
            ->group_by('transaksi.id_transaksi')
            ->order_by('transaksi.created_at')
            ->get('transaksi');

        return $result->result();
    }


    public function getTransaksiByIdSiswaAndStatus($id, $status)
    {
        $this->db->where('siswa_id', $id);
        $result = $this->db
            ->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id')
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel = detail_transaksi.mapel_id')
            ->join('instruktur_mapel', 'mata_pelajaran.id_mapel = instruktur_mapel.id_mapel')
            ->join('instruktur', 'instruktur_mapel.id_instruktur = instruktur.id_instruktur')
            ->where('status', $status)
            ->group_by('transaksi.id_transaksi')
            ->get('transaksi');

        return $result->result();
    }

    public function getTransaksiById($id)
    {
        $this->db->where('id_transaksi', $id);
        $result = $this->db->get('transaksi');

        return $result->row();
    }

    public function updateTransaksiById($id, $data)
    {
        $this->db->where('id_transaksi', $id);
        $result = $this->db->update('transaksi', $data);

        return $result;
    }

    public function getDetailTransaksiById($id)
    {
        $this->db->where('transaksi_id', $id);
        $result = $this->db
            ->join('mata_pelajaran', 'mata_pelajaran.id_mapel = detail_transaksi.mapel_id')
            ->join('instruktur_mapel', 'mata_pelajaran.id_mapel = instruktur_mapel.id_mapel')
            ->join('instruktur', 'instruktur_mapel.id_instruktur = instruktur.id_instruktur')
            ->get('detail_transaksi');

        return $result->result();
    }
    
    public function updateStatusExpired()
    {
        $tanggal = date('Y-m-d H:i:s');
        $this->db->where("expired <= ", $tanggal);
        $result = $this->db->update('transaksi', ["status" => 3]);
        return $result;
    }

}