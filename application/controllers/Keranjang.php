<?php
/**
 * Created by PhpStorm.
 * User: KARISMA ACADEMY
 * Date: 03/12/2018
 * Time: 09:27
 */

class Keranjang extends CI_Controller
{

    public function simpan()
    {

        $this->simpan_rules();
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
            $status = 422;
            $result = [
                "success" => true,
                "message" => $error,
            ];
        } else {
            $id_mapel = $_POST['id_mapel'];
            $create = $this->Model_Cart->addCartSiswa($_SESSION['id_siswa'], $id_mapel);
            if ($create) {
                $status = 200;
                $result = [
                    "success" => true,
                    "message" => "Berhasil Menyimpan Data",
                ];
            } else {
                $status = 500;
                $result = [
                    "success" => false,
                    "message" => "Gagal Menyimpan Data",
                ];
            }
        }

        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode($result));

    }

    private function simpan_rules()
    {
        $this->form_validation->set_rules('id_mapel', 'Mapel Belum Di Pilih', 'required|trim');
    }

}