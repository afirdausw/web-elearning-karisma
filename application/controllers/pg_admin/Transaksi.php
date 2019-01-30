<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_security');
        $this->Model_security->is_logged_in();
    }

    function index()
    {
        $data = [
            'navbar_title' => "Transaksi",
            'table_data'   => $this->Model_Transaksi->getTransaksi(),
        ];

        $this->load->view('pg_admin/transaksi/list', $data);
    }


    function form_validation_rules()
    {
        //set validation rules for each input
        // $this->form_validation->set_rules('kode_paket', 'Kode Paket', 'trim|required');
        $this->form_validation->set_rules('durasi', 'Durasi Paket', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga Paket', 'trim|required');
        $this->form_validation->set_rules('tipe', 'Tipe Paket', 'trim|required');

        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }


}