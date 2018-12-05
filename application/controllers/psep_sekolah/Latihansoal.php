<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihansoal extends CI_Controller
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
        $this->load->model('model_adm');
        $this->load->model('model_security');
        $this->load->model('model_psep');
        $this->load->model('model_banksoal');
        $this->Model_security->psep_sekolah_is_logged_in();
    }

    public function index()
    {
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
        $data = array(
            'navbar_title' => "Semua Soal",
            'form_action'  => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            'table_data'   => $this->Model_adm->fetch_all_soal_by_jenjang($carisekolah->jenjang),
        );
        // tester
        // alert_success('', "");
        // alert_error('danger', "isi 2");
        // alert_warning('info', "isi 2");
        // alert_info('info', "isi 2");

        $this->load->view('psep_sekolah/latihansoal', $data);
    }


    // show all latihan soal from specified sub materi
    public function detail($id_sub_materi)
    {
        $data = array(
            'navbar_title' => "Latihan Soal",
            'form_action'  => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            'table_data'   => $this->Model_adm->fetch_soal_by_submateri($id_sub_materi),
            'submateri'    => $this->Model_adm->fetch_materi_by_id($id_sub_materi),
        );

        // tester
        // alert_success('', "");
        // alert_error('danger', "isi 2");
        // alert_warning('info', "isi 2");
        // alert_info('info', "isi 2");

        $this->load->view('psep_sekolah/latihansoal_detail', $data);
    }

    public function manajemen($aksi)
    {
        //$aksi contains the value needed (tambah/ubah) to direct user to Add/Edit form
        if ($aksi) {
            //Trigger form submission validation rules
            $this->form_validation_rules();

            switch ($aksi) {
                case 'tambah':
                    $data = array(
                        'navbar_title'                => "Manajemen Latihan Soal",
                        'page_title'                  => "Buat Latihan Soal",
                        'form_action'                 => current_url(),
                        'select_options_mapel'        => $this->Model_adm->fetch_options_materi_pokok(),
                        'select_options_materi_pokok' => $this->Model_adm->fetch_options_materi(),
                        'submateri'                   => $this->Model_adm->fetch_all_materi(),
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if ($this->input->post('form_submit')) {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah();
                    } else {
                        //No form is submitted. Displaying the form page
                        $this->load->view('psep_sekolah/latihansoal_form', $data);
                    }
                    break;

                case 'tambah_soal':
                    //Passing id value from GET '?id' to variable '$id'
                    $id = $this->input->get('id') ? $this->input->get('id') : null;

                    $data = array(
                        'navbar_title'  => "Manajemen Latihan Soal",
                        'page_title'    => "Tambah Soal",
                        'form_action'   => current_url() . "?id=$id",
                        'sub_materi_id' => $id,
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if ($this->input->post('form_submit')) {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah_soal($id);
                    } else {
                        //No form is submitted. Displaying the form page
                        $this->load->view('psep_sekolah/latihansoal_detail_form', $data);
                    }
                    break;

                case 'ubah_soal':
                    //Passing id value from GET '?id' to variable '$id'
                    $id = $this->input->get('id') ? $this->input->get('id') : null;

                    $data = array(
                        'navbar_title' => "Manajemen Latihan Soal",
                        'page_title'   => "Ubah Latihan Soal",
                        'form_action'  => current_url() . "?id=$id",
                    );

                    //Redirect to materi if id is not exist
                    if (!$id) {
                        redirect('psep_sekolah/latihansoal/');
                    } else {
                        //Calling values from database by id and pass them to View
                        //fetching jawaban by id
                        $data['data'] = $this->Model_adm->fetch_soal_by_id($id);

                        //Form materi submit handler. See if the user is attempting to submit a form or not
                        if ($this->input->post('form_submit')) {
                            //Form is submitted. Now routing to proses_tambah method
                            $this->proses_ubah_soal($id);
                        } else {
                            //No form is submitted. Displaying the form page
                            $this->load->view('psep_sekolah/latihansoal_detail_form', $data);
                        }
                    }
                    break;

                case 'banksoal':
                    //Passing id value from GET '?id' to variable '$id'
                    $id = $this->input->get('id') ? $this->input->get('id') : null;

                    $data = array(
                        'navbar_title'  => "Manajemen Latihan Soal",
                        'page_title'    => "Tambah Soal",
                        'form_action'   => current_url() . "?id=$id",
                        'sub_materi_id' => $id,
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if ($this->input->post('form_submit')) {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah_soal($id);
                    } else {
                        $config['base_url'] = base_url() . 'pg_admin/banksoal/';
                        $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record();
                        $config['per_page'] = 10;
                        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
                        // menentukan offset record dari uri segment
                        $start = ($page - 1) * $config['per_page'];
                        // ubah data menjadi tampilan per limit
                        $rows = $this->Model_banksoal->fetch_banksoal_paging($config['per_page'], $start);
                        $pages = ceil($config['total_rows'] / $config['per_page']);
                        $data = array(
                            'page'                 => $page,
                            'data_soal'            => $rows,
                            'pagination'           => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                            //'pagination' => $this->pagination->create_links(),
                            'start'                => $start,
                            'select_options_kelas' => $this->Model_banksoal->get_kelas(),
                        );
                        $this->load->view('pg_admin/banksoalbaru', $data);
                    }
                    break;

                case 'tambah_banyak_soal':
                    //Passing id value from GET '?id' to variable '$id'
                    $params = $this->input->get(null, false);

                    $jml_soal = $params['jml_soal'];
                    $id = $this->input->get('id') ? $this->input->get('id') : null;

                    $data = array(
                        'navbar_title'  => "Manajemen Latihan Soal",
                        'page_title'    => "Tambah Soal",
                        'form_action'   => current_url() . "?id=$id",
                        'sub_materi_id' => $id,
                        'jml_soal'      => $jml_soal,
                    );

                    //Form materi submit handler. See if the user is attempting to submit a form or not
                    if ($this->input->post('form_submit')) {
                        //Form is submitted. Now routing to proses_tambah method
                        $this->proses_tambah_banyak_bank_soal($id);
                    } else {
                        //No form is submitted. Displaying the form page
                        $this->load->view('psep_sekolah/latihansoal_banyak_detail_form', $data);
                    }
                    break;
                default:
                    redirect('psep_sekolah/materi');
                    break;
            }
        } else {
            redirect('psep_sekolah/materi');
        }

    }

    public function proses_tambah_soal($id)
    {
        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, false);
        $isi_soal = $params['isi_soal'];
        $kunci_jawaban = $params['kunci_jawaban'];
        $jawab_1 = $params['jawab_1'];
        $jawab_2 = $params['jawab_2'];
        $jawab_3 = $params['jawab_3'];
        $jawab_4 = $params['jawab_4'];
        $jawab_5 = $params['jawab_5'];
        $sub_materi_id = $this->input->get('id');
        $pembahasan = $params['pembahasan'];
        $pembahasan_video = $params['pembahasan_video'];

        //set the page title
        $data = array(
            'page_title'  => "Tambah Soal",
            'form_action' => current_url() . "?id=$id",
        );

        //set validation rules
        $this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
        // $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
        $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view('psep_sekolah/latihansoal_detail_form', $data);
        } else {
            //passing input value to Model
            $result = $this->Model_adm->add_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $sub_materi_id, $pembahasan, $pembahasan_video);
            alert_success("Sukses", "Data berhasil ditambahkan");
            redirect('psep_sekolah/latihansoal/detail/' . $id);
            // echo "Status Insert: " . $result;
        }
    }

    public function proses_ubah_soal($id)
    {
        //set the page title
        $data = array(
            'page_title'  => "Ubah Soal",
            'form_action' => current_url() . "?id=$id",
        );

        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, false);
        $isi_soal = $params['isi_soal'];
        $jawab_1 = $params['jawab_1'];
        $jawab_2 = $params['jawab_2'];
        $jawab_3 = $params['jawab_3'];
        $jawab_4 = $params['jawab_4'];
        $jawab_5 = $params['jawab_5'];
        $kunci_jawaban = $params['kunci_jawaban'];
        $id_soal = $id;
        $sub_materi_id = $params['sub_materi_id'];
        $pembahasan = $params['pembahasan'];
        $pembahasan_video = $params['pembahasan_video'];

        //set validation rules
        $this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
        // $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
        $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal diubah");
            $this->load->view('psep_sekolah/latihansoal_detail_form', $data);
        } else {
            //passing input value to Model
            $result = $this->Model_adm->update_item_soal($isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $pembahasan, $pembahasan_video, $id_soal);

            alert_success("Sukses", "Data berhasil diubah");
            redirect('psep_sekolah/latihansoal/detail/' . $sub_materi_id, $data);
            // echo "Status Update: " . $result;
        }
    }

    public function proses_hapus()
    {
        if ($this->input->post('deleteRow_submit')) {
            //set form validation rules
            $this->form_validation->set_rules('hidden_row_id', "Nomor Baris", 'trim|required|numeric');

            if ($this->form_validation->run()) {
                $id = $this->input->post('hidden_row_id');
                $result = $this->Model_adm->delete_item_soal($id);

                alert_success('Sukses', "Data berhasil dihapus");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

        alert_danger('Error', "Data gagal dihapus");
        redirect('psep_sekolah/materi');
    }


    public function proses_tambah()
    {
        //set the page title
        $data = array(
            'page_title'  => "Tambah Latihan Soal",
            'form_action' => current_url(),
            'submateri'   => $this->Model_adm->fetch_all_materi(),
        );

        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, true);
        $sub_materi = $params['sub_materi'];

        $this->form_validation->set_rules('sub_materi', 'Sub Materi', 'required');

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view('psep_sekolah/latihansoal_form', $data);
        } else {
            //passing input value to Model
            $result = $this->Model_adm->add_latihan_soal($sub_materi);
            alert_success("Sukses", "Data berhasil ditambahkan");
            redirect('psep_sekolah/latihansoal');
            // echo "Status Insert: " . $result;
        }
    }


    public function proses_ubah($id)
    {
        //set the page title
        $data = array(
            'page_title'  => "Tambah Soal",
            'form_action' => current_url() . "?id=$id",
        );

        //fetch input (make sure that the variable name is the same as column name in database!)
        $params = $this->input->post(null, true);
        $kategori = $params['kategori_materi'];
        $mapel_id = $params['nama_mapel'];
        $materi_pokok_id = $params['materi_pokok'];
        $nama_sub_materi = $params['judul_materi'];
        $isi_materi = $params['konten_materi'];
        $gambar_materi = $params['gambar_materi'];
        $tanggal = $params['tanggal_post'];
        $waktu = $params['waktu_post'];

        //run the validation
        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view('psep_sekolah/materi_form', $data);
        } else {
            //passing input value to Model
            $result = $this->Model_adm->add_materi($kategori, $mapel_id, $materi_pokok_id, $nama_sub_materi, $isi_materi, $gambar_materi, $tanggal, $waktu);
            alert_success("Sukses", "Data berhasil ditambahkan");
            redirect('psep_sekolah/materi');
            // echo "Status Insert: " . $result;
        }
    }


    function preview_konten($sub_materi_id)
    {
        if ($sub_materi_id) {
            $data['content_preview'] = $this->Model_adm->fetch_content_by_id($sub_materi_id);
            $gambar_materi = isset($data['content_preview']->gambar_materi) ? $data['content_preview']->gambar_materi : '';
            $data['thumbnail_dir'] = base_url('') . "assets/img/no-image.jpg";

            if ($gambar_materi) {
                $data['thumbnail_dir'] = base_url('') . "assets/js/plugins/kcfinder/upload/images/" . $data['content_preview']->gambar_materi;
            }

            $this->load->view('preview/content_preview', $data);
        } else {
            redirect('psep_sekolah/materi');
        }
    }

    function form_validation_rules()
    {
        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }

    function fetch_materi_by_id($id)
    {
        $data = new stdClass();
        $table_data = $this->Model_adm->fetch_materi_by_id($id);
        $table_fields = $this->Model_adm->get_table_fields('mata_pelajaran', 'materi_pokok', 'sub_materi', 'konten_materi');
        //tester
        // var_dump($table_data);
        // var_dump($table_fields);
        if ($table_data) {
            foreach ($table_fields as $field) {
                $data->{$field} = $table_data->{$field} ? $table_data->{$field} : '';
                // echo "$field -> " . ${$field} . ", ";
            }
        } else {
            $data = null;
        }

        return $data;
    }

    function ajax_select_materi_pokok()
    {
        $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

        if ($id) {
            $dynamic_options = $this->Model_adm->fetch_materi_pokok_by_mapel($id);

            if ($dynamic_options) {
                foreach ($dynamic_options as $item) {
                    echo "<option value=''></option>";
                    echo "<option value='" . $item->id_materi_pokok . "'> $item->nama_materi_pokok </option>";
                }
            } else {
                echo "<option value=''></option>";
                echo "<option value='' disabled='disabled'>Tidak ada data</option>";
            }
        } else {
            return false;
        }
    }

    function ajax_select_sub_materi()
    {
        $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

        if ($id) {
            $dynamic_options = $this->Model_adm->fetch_submateri_by_materi_pokok($id);

            if ($dynamic_options) {
                $no = 1;
                foreach ($dynamic_options as $item) {
                    echo "<option value=''></option>";
                    echo "<option value='" . $item->id_sub_materi . "'> $no" . ". " . " $item->nama_sub_materi </option>";
                    $no++;
                }
            } else {
                echo "<option value=''></option>";
                echo "<option value='' disabled='disabled'>Tidak ada data</option>";
            }
        } else {
            return false;
        }
    }

    public function ambilbanksoal($id_sub_materi)
    {
        //22 November 2017
        //UNTUK FETCH MASIH PENDING
        $config['base_url'] = base_url() . 'psep_sekolah/latihansoal/ambilbanksoal/' . $id_sub_materi;
        $smateri = $this->Model_adm->fetch_materi_by_id_result($id_sub_materi);
        foreach ($smateri as $it) {
            $kelas = $it->kelas_id;
            $mapel = $it->id_mapel;
        }
        // $config['total_rows'] = $this->model_banksoal->fetch_banksoal_total_record();
        $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record_by_id_mapel($mapel);
        $config['per_page'] = 10;
        $page = (isset($_GET['page']) ? $_GET['page'] : 1);
        // menentukan offset record dari uri segment
        $start = ($page - 1) * $config['per_page'];
        // ubah data menjadi tampilan per limit
        $rows = $this->Model_banksoal->fetch_banksoal_paging_by_id_mapel($mapel, $config['per_page'], $start);
        $datas = array_column($this->Model_adm->select_item($id_sub_materi), 'id_banksoal');
        $pages = ceil($config['total_rows'] / $config['per_page']);
        $data = array(
            'navbar_title'         => "Latihan Ambil Bank Soal",
            'submateri'            => $smateri,
            'page'                 => $page,
            'data_soal'            => $rows,
            'datasoal'             => $datas,
            'pagination'           => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
            //'pagination' => $this->pagination->create_links(),
            'start'                => $start,
            'select_options_kelas' => $this->Model_banksoal->get_kelas(),
            'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas),
            'id_sub_materi'        => $id_sub_materi,
        );
        $this->load->view('psep_sekolah/ambilbanksoal', $data);
    }

    function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url)
    {
        $pagination = '';
        if ($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
            $pagination .= '<ul class="pagination">';

            $right_links = $current_page + 3;
            $previous = $current_page - 3; //previous link
            $next = $current_page + 1; //next link
            $first_link = true; //boolean var to decide our first link

            if ($current_page > 1) {
                $previous_link = ($previous == 0) ? 1 : $previous;
                $pagination .= '<li class="first"><a href="' . $page_url . '?page=1" title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="' . $page_url . '?page=' . $previous_link . '" title="Previous">&lt;</a></li>'; //previous link
                for ($i = ($current_page - 2); $i < $current_page; $i++) { //Create left-hand side links
                    if ($i > 0) {
                        $pagination .= '<li><a href="' . $page_url . '?page=' . $i . '">' . $i . '</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if ($first_link) { //if current active page is first link
                $pagination .= '<li class="first active"><a href="#">' . $current_page . '</a></li>';
            } elseif ($current_page == $total_pages) { //if it's the last active link
                $pagination .= '<li class="last active"><a href="#">' . $current_page . '</a></li>';
            } else { //regular current link
                $pagination .= '<li class="active"><a href="#">' . $current_page . '</a></li>';
            }

            for ($i = $current_page + 1; $i < $right_links; $i++) { //create right-hand side links
                if ($i <= $total_pages) {
                    $pagination .= '<li><a href="' . $page_url . '?page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($current_page < $total_pages) {
                $next_link = ($i > $total_pages) ? $total_pages : $i;
                $pagination .= '<li><a href="' . $page_url . '?page=' . $next_link . '" >&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="' . $page_url . '?page=' . $total_pages . '" title="Last">&raquo;</a></li>'; //last link
            }

            $pagination .= '</ul>';
            $pagination .= '<table><tr><td>Total Data  </td><td>:</td><td>' . $total_records . '</td></tr></table>';
            $pagination .= '<table><tr><td>Total Halaman  </td><td>:</td><td>' . $total_pages . '</td></tr></table>';
        }
        return $pagination; //return pagination links
    }

    public function simpanbanksoal($id_sub_materi, $id_banksoal, $hal)
    {
        //fetch input (make sure that the variable name is the same as column name in database!)
        $soal = $this->Model_banksoal->cari_bank_soal_by_id($id_banksoal);
        $isi_soal = $soal->pertanyaan;
        $kunci_jawaban = $soal->kunci;
        $jawab_1 = $soal->jawab_1;
        $jawab_2 = $soal->jawab_2;
        $jawab_3 = $soal->jawab_3;
        $jawab_4 = $soal->jawab_4;
        $jawab_5 = $soal->jawab_5;
        $sub_materi_id = $id_sub_materi;
        $pembahasan = $soal->pembahasan_teks;
        $pembahasan_video = $soal->pembahasan_video;
        $result = $this->Model_adm->add_item_soal_bank_soal($id_banksoal, $isi_soal, $jawab_1, $jawab_2, $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $sub_materi_id, $pembahasan, $pembahasan_video);

        if ($result) {
            alert_success("Sukses", "Data berhasil ditambahkan");
        } else {
            alert_error('Gagal', 'Data gagal di tambahkan');
        }
        redirect('psep_sekolah/latihansoal/ambilbanksoal/' . $id_sub_materi . '?page=' . $hal);
        // echo "Status Insert: " . $result;

    }

    public function hapusbanksoal($id_sub_materi, $id_banksoal, $hal)
    {
        //fetch input (make sure that the variable name is the same as column name in database!)
        $soal = $this->Model_adm->select_item_soal_bank_soal($id_banksoal, $id_sub_materi);
        if (count($soal) > 0) {
            $id = $soal[0]['id_soal'];
            $result = $this->Model_adm->delete_item_soal($id);
            if ($result) {
                alert_success("Sukses", "Data berhasil di hapus");
            } else {
                alert_error('Gagal', 'Data gagal di hapus');
            }
        } else {
            alert_warning('Data', 'Data Tidak Di temukan');
        }
        redirect('psep_sekolah/latihansoal/ambilbanksoal/' . $id_sub_materi . '?page=' . $hal);
        // echo "Status Insert: " . $result;

    }

    public function proses_tambah_banyak_bank_soal($id)
    {
        $params = $this->input->post(null, false);
        $jml_soal = $params['jml_soal'];
        $data2 = array('page_title' => "Tambah Soal", 'form_action' => current_url() . "?id=$id",);
        $err = 0;
        for ($i = 1; $i <= $jml_soal; $i++) {
            $isi_soal = $params['isi_soal'][$i - 1];
            $kunci_jawaban = $params['kunci_jawaban'][$i - 1];
            $jawab_1 = $params['jawab_1'][$i - 1];
            $jawab_2 = $params['jawab_2'][$i - 1];
            $jawab_3 = $params['jawab_3'][$i - 1];
            $jawab_4 = $params['jawab_4'][$i - 1];
            $jawab_5 = $params['jawab_5'][$i - 1];
            $sub_materi_id = $this->input->get('id');
            $pembahasan = $params['pembahasan'][$i - 1];
            $pembahasan_video = $params['pembahasan_video'][$i - 1];
            $data = [
                "isi_soal"      => $params['isi_soal'][$i - 1],
                "kunci_jawaban" => $params['kunci_jawaban'][$i - 1]
            ];
            //set validation rules
            $this->form_validation->set_rules('isi_soal', 'Isi Soal', 'required');
            // $this->form_validation->set_rules('pembahasan', 'Pembahasan', 'required');
            $this->form_validation->set_rules('kunci_jawaban', 'Kunci Jawaban', 'required');
            $this->form_validation->set_data($data);

            if ($this->form_validation->run() == FALSE) {
                $err++;
            } else {
                //passing input value to Model
                $result = $this->Model_adm->add_item_soal($isi_soal, $jawab_1, $jawab_2,
                    $jawab_3, $jawab_4, $jawab_5, $kunci_jawaban, $sub_materi_id, $pembahasan, $pembahasan_video);
                // echo "Status Insert: " . $result;
            }
        }
        if ($err > 0) {
            alert_error("Error", "Beberapa Data Gagal Di Masukan");
            redirect('psep_sekolah/latihansoal/detail/' . $id);
        } else {
            alert_success("Sukses", "Data berhasil ditambahkan");
            redirect('psep_sekolah/latihansoal/detail/' . $id);
        }
    }

}
