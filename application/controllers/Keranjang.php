<?php
/**
 * Created by PhpStorm.
 * User: KARISMA ACADEMY
 * Date: 03/12/2018
 * Time: 09:27
 */

class Keranjang extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('id_siswa')) {
            $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);
            $data = array(
                'navbar_links' => $this->Model_pg->get_navbar_links(),
                'video_demo'   => $this->Model_pg->get_video_demo(null),
                'judul_tab'    => "Keranjang",
                'data'         => $cart,
            );


            $this->load->view('pg_user/transaksi/keranjang', $data);
        } else {
            redirect(base_url("login"));
        }
    }

    public function add($id_mapel)
    {
        if ($this->session->userdata('id_siswa')) {
            $mapel = $this->Model_Cart->getCartByIdSiswaIdMapel($_SESSION['id_siswa'], $id_mapel);

            if (count($mapel) <= 0) {
                $create = $this->Model_Cart->addCartSiswa($_SESSION['id_siswa'], $id_mapel);
                if ($create) {

                    $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);
                    $cart = obj_to_arr($cart);
                    $jumlah_cart = count($cart);
                    $this->session->set_userdata('cart', $cart);
                    $this->session->set_userdata('jumlah_cart', $jumlah_cart);
                }
            }

            redirect($_SESSION['RedirectKe']);
        } else {
            redirect(base_url("login"));
        }

    }

    public function delete($id_mapel)
    {
        if ($this->session->userdata('id_siswa')) {
            $mapel = $this->Model_Cart->getCartByIdSiswaIdMapel($_SESSION['id_siswa'], $id_mapel);

            if (count($mapel) > 0) {
                $create = $this->Model_Cart->deleteCartSiswa($_SESSION['id_siswa'], $id_mapel);
                if ($create) {

                    $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);
                    $cart = obj_to_arr($cart);
                    $jumlah_cart = count($cart);
                    $this->session->set_userdata('cart', $cart);
                    $this->session->set_userdata('jumlah_cart', $jumlah_cart);
                }
            }

            redirect($_SESSION['RedirectKe']);
        } else {
            redirect(base_url("login"));
        }

    }

    public function checkout()
    {
        $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);

        $total = 0;
        $data_detail = [];
        foreach ($cart as $key => $value) {
            $data_detail[] = ["harga" => $value->harga, "mapel_id" => $value->id_mapel];
            $total += $value->harga;
        }

        $data = [
            "siswa_id"     => $_SESSION['id_siswa'],
            "created_at"   => date('Y-m-d H:i:s'),
            "status"       => 0,
            "jumlah_total" => $total,
            "expired"      => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + 2 days')),
        ];

        $simpan_transaksi = $this->Model_Transaksi->addTransaksi($data);
        $id_transaksi = $this->db->insert_id();

        foreach ($data_detail as $key => $data) {
            $data_detail[$key]['transaksi_id'] = $id_transaksi;
            $simpan_transaksi = $this->Model_Transaksi->addDetailTransaksi($data_detail[$key]);
        }


        $this->Model_Cart->deleteCartBySiswa($_SESSION['id_siswa']);

        redirect(base_url('konfirmasi-pembayaran/' . $id_transaksi));
        return true;
    }

}