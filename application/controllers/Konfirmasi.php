<?php

/**
 *
 */
class Konfirmasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
    }

    function index($id)
    {
        $data = [
            'navbar_links'     => $this->Model_pg->get_navbar_links(),
            'video_demo'       => $this->Model_pg->get_video_demo(null),
            'judul_tab'        => "Check Out",
            "transaksi"        => $this->Model_Transaksi->getTransaksiById($id),
            "detail_transaksi" => $this->Model_Transaksi->getDetailTransaksiById($id),
        ];


        return $this->load->view('pg_user/transaksi/checkout', $data);

    }

    function pembayaran($id_pembayaran)
    {
        $this->rules_pembayaran();

        $file_element_name = "bukti_pembayaran";
        if ($this->form_validation->run() == FALSE) {
            $error = $this->form_validation->error_array();
            alert("danger", ul($error));
            redirect(base_url('konfirmasi-pembayaran/' . $id_pembayaran));
        } else {
            if (isset($_FILES[$file_element_name]['name']) && $_FILES[$file_element_name]['name'] != "") {
                $config['upload_path'] = './assets/uploads/bukti_transfer/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name'] = sprintf("%08d", $id_pembayaran);
                $config['remove_spaces'] = TRUE;  //it will remove all spaces
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload($file_element_name)) {
                    $error = array('error' => $this->upload->display_errors());
                    alert('danger', ul($error));
                    redirect(base_url('konfirmasi-pembayaran/' . $id_pembayaran));

                } else {
                    $data_upload = $this->upload->data();
                    $bukti_transfer = $data_upload['file_name'];

                    $data_simpan = [
                        "atas_nama"        => $_POST["atas_nama"],
                        "total_transfer"   => $_POST["total_transfer"],
                        "bukti_pembayaran" => $bukti_transfer,
                        "status"           => 2,
                    ];

                    $simpan = $this->Model_Transaksi->updateTransaksiById($id_pembayaran, $data_simpan);

                    if ($simpan) {
                        alert('success', "Bukti Pembayaran Berhasil Di Upload");
                        redirect(base_url('konfirmasi-pembayaran/' . $id_pembayaran));
                    } else {
                        alert('danger', "Bukti Pembayaran Gagal Di Upload");
                        redirect(base_url('konfirmasi-pembayaran/' . $id_pembayaran));
                    }
                }
            } else {
                alert('danger', "Bukti Transfer Harus Di Isi");
                $bukti_transfer = null;
                redirect(base_url('konfirmasi-pembayaran/' . $id_pembayaran));
            }
        }
    }

    private function rules_pembayaran()
    {
        //set validation rules for each input
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'trim|required');
        $this->form_validation->set_rules('total_transfer', 'Total Transfer', 'trim|required');
    }
}