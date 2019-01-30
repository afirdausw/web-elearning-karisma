<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimoni_Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //check user session

        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        //$this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_security');
        $this->load->model('model_testimoni');
        $this->Model_security->is_logged_in();

        //global variable
        $slug = $this->router->fetch_class();
        $this->gVar = array(
            "slug"      => $slug,
            "title"     => ucwords(strtolower($slug)),
        );
    }

    public function index()
    {   
        $gVar = $this->gVar;
        $data['siswa'] = $this->Model_Testimoni->fetch_all_siswa();
        $this->load->view('pg_admin/testimoni_siswa', $data);
    }

    public function add_testimonial()
    {
        if ($this->form_validation->run() == TRUE) {
            $data  = array(
                'id_siswa' => $this->input->post('id_siswa'),
                'waktu' =>  date("Y-m-d h:i:sa"),
                'testimoni' => $this->input->post('tanggapan_siswa')
            );

            $insert = $this->Model_Testimoni->insert_testimonial($data);
        } else {
            redirect('pg_admin/testimoni_siswa','refresh');
        }
    }

    public function form_validation_rules(){
        $this->form_validation->set_rules('id_siswa', '', 'trim|required');
        $this->form_validation->set_rules('testimoni', '', 'trim|required');
    }   
}
