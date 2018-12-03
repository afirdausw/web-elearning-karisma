<?php
/**
 * Created by PhpStorm.
 * User: KARISMA ACADEMY
 * Date: 03/12/2018
 * Time: 09:28
 */

class Model_Cart extends CI_Model
{

    public function getCartByIdSiswa($id_siswa)
    {
        $data = $this->db
            ->where('siswa_id', $id_siswa)
            ->join('mapel', 'mapel.id_mapel = siswa.mapel_id')
            ->get('cart');

        return $data->result();
    }

    public function addCartSiswa($id_siswa, $id_mapel)
    {
        $data = [
            "mapel_id"        => $id_mapel,
            "siswa_id"        => $id_siswa,
            "tanggal"         => date('Y-m-d H:i:s'),
            "tipe_pembayaran" => 0,
            "status"          => 0,
        ];

        $result = $this->db->insert('cart', $data);

        return $result;
    }

    public function deleteCartSiswa($id_siswa, $id_mapel)
    {
        $this->db->where('siswa_id', $id_siswa);
        $this->db->where('id_konten', $id_siswa);
        $result = $this->db->delete('bonus_konten');

        return $result;
    }

}