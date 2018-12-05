<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LsTest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        $this->load->helper('alert_helper');
        $this->load->model('model_pg');
        $this->load->model('model_agcu');
        $this->load->model('model_eqtest');
        $this->load->model('Model_lstest');
        $this->load->model('model_dashboard');
        $this->load->model('model_security');
        $this->Model_security->is_logged_in();
    }

    function index()
    {
        $data = array(
            'ls_test' => $this->Model_lstest->get_lstest(),
            'active' => 'LsTest'

        );

        $this->load->view('pg_admin/agcu_ls_test', $data);
    }
}