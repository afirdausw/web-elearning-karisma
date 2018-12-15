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
        $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);
        $data = array(
            'navbar_links' => $this->Model_pg->get_navbar_links(),
            'video_demo'   => $this->Model_pg->get_video_demo(null),
            'judul_tab'    => "Keranjang",
            'data'         => $cart,
        );


        $this->load->view('pg_user/keranjang', $data);
    }

    public function add($id_mapel)
    {

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

    }


}