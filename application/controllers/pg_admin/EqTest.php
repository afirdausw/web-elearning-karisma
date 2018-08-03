<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EqTest extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.
        $this->load->helper('alert_helper');
        $this->load->model('Model_eqtest');
        $this->load->model('model_security');
        $this->model_security->is_logged_in();
    }

    function index()
    {
        $data = array(
            'eq_test' => $this->Model_eqtest->get_eqtest(),
            'active' => 'EqTest'
            
        );

        $this->load->view('pg_admin/agcu_eq_test', $data);
    }
}