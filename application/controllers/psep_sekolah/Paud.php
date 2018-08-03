<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paud extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //check user session

        //load library in construct. Construct method will be run everytime the controller is called
        //This library will be auto-loaded in every method in this controller.
        //So there will be no need to call the library again in each method.

        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->helper('url_validation_helper');
        $this->load->model('model_adm');
        $this->load->model('model_adm1');
        $this->load->model('model_banksoal');
        $this->load->model('model_security');
        $this->load->model('model_psep');
        $this->load->model('model_paud');
        $this->model_security->psep_sekolah_is_logged_in();
    }

    public function index()
    {
        $this->load->view('psep_sekolah/paud');
    }

    function form_validation_rules()
    {


        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }


    public function manajemen($aksi)
    {
        //$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
        if($aksi)
        {
            //Trigger form submission validation rules
            $this->form_validation_rules();

            switch ($aksi) {
                case 'seri':
                    $data = array(
                        'navbar_title'                => "Manajemen Seri Video",
                        'page_title'                  => "Data Seri Video",
                        'form_action'                 => current_url(),
                        'select_options_seri'        => $this->model_paud->get_seri_video(),
                        'jumlah_soal_submateri'       => 0
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if($this->input->post('form_submit'))
                    {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah();
                    }
                    else
                    {
                        //No form is submitted. Displaying the form page
                        $this->load->view('psep_sekolah/seri_judul', $data);
                    }
                    break;


                case 'tambah':
                    $data = array(
                        'navbar_title'                => "Manajemen Materi",
                        'page_title'                  => "Tambah Materi",
                        'form_action'                 => current_url(),
                        'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
                        'select_options_materi_pokok' => $this->model_adm->fetch_options_materi(),
                        'jumlah_soal_submateri'       => 0
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if($this->input->post('form_submit'))
                    {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah();
                    }
                    else
                    {
                        //No form is submitted. Displaying the form page
                        $this->load->view('pg_admin/materi_form', $data);
                    }
                    break;

                case 'ubah':
                    //Passing id value from GET '?id' to variable '$id'
                    $id = $this->input->get('id') ? $this->input->get('id') : null ;

                    $data = array(
                        'navbar_title'                => "Manajemen Materi",
                        'page_title'                  => "Ubah Materi",
                        'form_action'                 => current_url() . "?id=$id",
                        'select_options_mapel'        => $this->model_adm->fetch_options_materi_pokok(),
                        'select_options_materi_pokok' => $this->model_adm->fetch_options_materi(),
                        'jumlah_soal_submateri'       => $this->model_adm->fetch_jumlah_soal($id),
                        'data_soal_submateri'         => $this->model_adm->fetch_soal_by_submateri($id)
                    );

                    //Redirect to materi if id is not exist
                    if(!$id)
                    {
                        redirect('pg_admin/materi');
                    }
                    else
                    {
                        //Calling values from database by id and pass them to View
                        //fetching konten_materi by id
                        $data['data']       = $this->fetch_materi_by_id($id);
                        $data['data_soal']  = $this->model_adm->fetch_soal_by_id($id);
                        // var_dump($data['data_soal']);

                        //Form materi submit handler. See if the user is attempting to submit a form or not
                        if($this->input->post('form_submit'))
                        {
                            //Form is submitted. Now routing to proses_tambah method
                            $this->proses_ubah($id);
                        }
                        else
                        {
                            //No form is submitted. Displaying the form page
                            $this->load->view('pg_admin/materi_form', $data);
                        }
                    }
                    break;

                default:
                    redirect('pg_admin/materi');
                    break;
            }
        }
        else
        {
            redirect('pg_admin/materi');
        }

    }




}
