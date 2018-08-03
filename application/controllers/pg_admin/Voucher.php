<?php


/**
 *
 */
class Voucher extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_pembayaran');
        $this->load->model('model_paket');
        $this->load->model('model_security');
        $this->load->model('model_voucher');
        $this->load->model('model_encrypt');
        $this->model_security->is_logged_in();
        //$this->load->model('model_voucher');
    }

    function randString($length)
    {
        $char = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $char = str_shuffle($char);
        for ($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i++) {
            $rand .= $char{mt_rand(0, $l)};
        }
        return strtoupper($rand);
    }

    function index()
    {
        $data = array(
            'navbar_title' => "Voucher",
            'form_action'  => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            'kelas'        => $this->model_voucher->get_kelas(),
            'table_data'   => $this->model_adm->fetch_all_voucher(),
        );

        $this->load->view('pg_admin/voucher', $data);
    }

    function form_validation_rules()
    {
        //set validation rules for each input
        $this->form_validation->set_rules('paket', 'paket', 'trim|required');
        $this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }

    function manajemen()
    {
//        $json_file = "application/system/voucher.json";
//        $data = $this->model_encrypt->read($json_file);
//        $json = json_encode($data);
//        echo $json.PHP_EOL;
//        $key = "GARUDAMEDIA12345";
//        $encrypted = $this->model_encrypt->encrypt($key,$json);
//        echo $encrypted.PHP_EOL;
//        $decrypted = $this->model_encrypt->decrypt($key,$encrypted);
//        echo $decrypted.PHP_EOL;
//        $this->model_encrypt->write("application/system/voucher.vcr",$encrypted);
        echo date("dmy") . $this->randString(6) . date('s');
    }
}