<?php
/**
 * Created by PhpStorm.
 * User: KARISMA ACADEMY
 * Date: 26/12/2018
 * Time: 09:12
 */

class Checkout extends CI_Controller
{

    public function index()
    {
        if ($this->session->userdata('id_siswa')) {
            $cart = $this->Model_Cart->getCartByIdSiswa($_SESSION['id_siswa']);
            $data = array(
                'navbar_links' => $this->Model_pg->get_navbar_links(),
                'video_demo'   => $this->Model_pg->get_video_demo(null),
                'judul_tab'    => "Checkout",
                'data'         => $cart,
            );


            $this->load->view('pg_user/transaksi/checkout', $data);
        } else {
            redirect(base_url("login"));
        }
    }
}