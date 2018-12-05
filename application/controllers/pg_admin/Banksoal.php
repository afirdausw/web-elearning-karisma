<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banksoal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_pembayaran');
        $this->load->model('model_paket');
        $this->load->model('model_tryout');
        $this->load->model('model_banksoal');
        $this->load->model('model_security');
        $this->Model_security->is_logged_in();
    }

    function index_lama()
    {
        $data = array(
            'navbar_title' => 'Data Bank Soal',
            'data_soal' => $this->Model_banksoal->fetch_banksoal(),
            'select_options_kelas' => $this->Model_banksoal->get_kelas()
        );
        $this->load->view('pg_admin/banksoal', $data);
    }

    function indexlama()
    {
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
            'page' => $page,
            'data_soal' => $rows,
            'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
            //'pagination' => $this->pagination->create_links(),
            'start' => $start,
            'select_options_kelas' => $this->Model_banksoal->get_kelas()
        );
        $this->load->view('pg_admin/banksoalbaru', $data);

    }

    function index()
    {
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
            'page' => $page,
            'data_soal' => $rows,
            'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
            //'pagination' => $this->pagination->create_links(),
            'start' => $start,
            'select_options_kelas' => $this->Model_banksoal->get_kelas()
        );
        $this->load->view('pg_admin/banksoalbaru', $data);
    }

    public function excelupload()
    {
        $data = array(
            'navbar_title' => 'Upload Excel Bank Soal',
            'select_options_mapel' => $this->Model_banksoal->get_kelas()
        );
        $this->load->view('pg_admin/banksoalupload', $data);
    }

    public function upload()
    {
        $this->upload_config();

        if (!$this->upload->do_upload('import_data')) {
            $errors = array('error' => $this->upload->display_errors());
            alert_error("Error", "Proses import data gagal");
            //$this->load->view('pg_admin/siswa', $data);
            redirect('pg_admin/banksoal');
            //echo "prosses upload gagal";
        } else {
            $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

            $media = $this->upload->data();
            $data_sekolah = array();
            $inputFileName = 'assets/uploads/excel_files/' . $media['file_name'];

            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) { //  Read a row of data into an array
                $rowData = $sheet->rangeToArray(
                    'A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE
                );
                //Sesuaikan dengan nama kolom tabel di database
                if (!empty($rowData[0][0]) && !empty($rowData[0][1])) {
                    $data_sekolah[] = array(
                        "id_mapel" => $_POST['nama_mapel'],
                        "id_kategori_bank_soal" => $_POST['kategori'],
                        "pertanyaan" => $rowData[0][0],
                        "topik" => $rowData[0][1],
                        "jawab_1" => $rowData[0][2],
                        "jawab_2" => $rowData[0][3],
                        "jawab_3" => $rowData[0][4],
                        "jawab_4" => $rowData[0][5],
                        "jawab_5" => $rowData[0][6],
                        "pembahasan_teks" => $rowData[0][7],
                        "pembahasan_video" => '',
                        "bobot_soal" => $rowData[0][8],
                        "bobot_topik" => '',
                        "kunci" => $rowData[0][9],
                        "status" => $_POST['tipe']

                    );
                }

            }

            $import = $this->Model_adm->import_bank_soal($data_sekolah);
            if ($import) {
                alert_success('Sukses', "Data berhasil diimport!");
            }
            redirect('pg_admin/banksoal/excelupload');


        }

    }

    private function upload_config()
    {
        // $fileName = date("dmy_Hi")."_".$_FILES['import_data']['name'];
        $fileName = 'latest_upload';
        $config['upload_path'] = 'assets/uploads/excel_files';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = 10000;
        $config['overwrite'] = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);
    }

    function filter($kelas = 0, $mapel = 0, $topik = '')
    {
        //load library pagination
        //configurasi pagination
        if ($kelas == 0 && $mapel == 0 && $topik == '') {
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
                'page' => $page,
                'data_soal' => $rows,
                'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start' => $start,
                'select_options_kelas' => $this->Model_banksoal->get_kelas()
            );
        } elseif ($kelas != 0 && $mapel == 0 && $topik == '') {
            $config['base_url'] = base_url() . 'pg_admin/banksoal/filter/' . $kelas . '/';
            $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record_by_kelas($kelas);
            $config['per_page'] = 10;
            $page = (isset($_GET['page']) ? $_GET['page'] : 1);
            // menentukan offset record dari uri segment
            $start = ($page - 1) * $config['per_page'];
            //ubah data menjadi tampilan per limit
            $rows = $this->Model_banksoal->fetch_banksoal_paging_by_kelas($kelas, $config['per_page'], $start);
            $pages = ceil($config['total_rows'] / $config['per_page']);
            $data = array(
                'page' => $page,
                'kelas' => $kelas,
                'data_soal' => $rows,
                'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start' => $start,
                'select_options_kelas' => $this->Model_banksoal->get_kelas(),
                'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas)
            );
        } elseif ($kelas != 0 && $mapel != 0 && $topik == '') {
            $config['base_url'] = base_url() . 'pg_admin/banksoal/filter/' . $kelas . '/' . $mapel . '/';
            $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record_by_id_mapel($mapel);
            $config['per_page'] = 10;
            $page = (isset($_GET['page']) ? $_GET['page'] : 1);
            // menentukan offset record dari uri segment
            $start = ($page - 1) * $config['per_page'];
            //ubah data menjadi tampilan per limit
            $rows = $this->Model_banksoal->fetch_banksoal_paging_by_id_mapel($mapel, $config['per_page'], $start);
            $pages = ceil($config['total_rows'] / $config['per_page']);
            $data = array(
                'page' => $page,
                'kelas' => $kelas,
                'mapel' => $mapel,
                'data_soal' => $rows,
                'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start' => $start,
                'select_options_kelas' => $this->Model_banksoal->get_kelas(),
                'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas),
                'select_options_topik' => $this->Model_banksoal->get_topik_by_mapel($mapel)
            );

        } elseif ($kelas != 0 && $mapel != 0 && $topik != '') {
            $config['base_url'] = base_url() . 'pg_admin/banksoal/filter/' . $kelas . '/' . $mapel . '/' . $topik;
            $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record_by_topik($mapel,$topik);
            $config['per_page'] = 10;
            $page = (isset($_GET['page']) ? $_GET['page'] : 1);
            // menentukan offset record dari uri segment
            $start = ($page - 1) * $config['per_page'];
            //ubah data menjadi tampilan per limit
            $rows = $this->Model_banksoal->fetch_banksoal_paging_by_topik($mapel,$topik, $config['per_page'], $start);
            $pages = ceil($config['total_rows'] / $config['per_page']);
            $data = array(
                'page' => $page,
                'kelas' => $kelas,
                'mapel' => $mapel,
                'data_soal' => $rows,
                'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start' => $start,
                'select_options_kelas' => $this->Model_banksoal->get_kelas(),
                'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas),
                'select_options_topik' => $this->Model_banksoal->get_topik_by_mapel($mapel)
            );
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
                'page' => $page,
                'data_soal' => $rows,
                'pagination' => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start' => $start,
                'select_options_kelas' => $this->Model_banksoal->get_kelas()
            );
        }


//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(500)
//            ->set_output(json_encode($data));

        //var_dump($data['data_soal']);

        $this->load->view('pg_admin/banksoalbaru', $data);
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
                $previous_link = ($previous < 1) ? 1 : $previous;
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

    function tambah()
    {
        $data = array(
            'navbar_title' => "Tambah Bank Soal",
            'form_action' => current_url(),
            'select_options_mapel' => $this->Model_banksoal->get_kelas()
        );
        $this->load->view('pg_admin/banksoal_form', $data);
    }

    function prosesbanksoal()
    {
        $params = $this->input->post(null, true);
        $mapel = $params['nama_mapel'];

        if (isset($params['topikbaru'])) {
            $topik = $params['topikbaru'];
        } else {
            $topik = $params['topik'];
        }
        $soal = str_replace("\\\\", "\\", $params['soal']);
        $bobot = $params['bobot'];
        $jawabbenar = $params['jawabbenar'];
        $jawab1 = str_replace("\\\\", "\\", $params['jawab1']);
        $jawab2 = str_replace("\\\\", "\\", $params['jawab2']);
        $jawab3 = str_replace("\\\\", "\\", $params['jawab3']);
        $jawab4 = str_replace("\\\\", "\\", $params['jawab4']);
        $jawab5 = str_replace("\\\\", "\\", $params['jawab5']);
        $bahasteks = str_replace("\\\\", "\\", $params['bahasteks']);
        $bahasvideo = $params['bahasvideo'];
        $kategori = $params['kategori'];
        $tipe = $params['tipe'];

        $result = $this->Model_banksoal->tambah_banksoal($mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe);
        redirect('pg_admin/banksoal');
    }

    function kategori()
    {
        $data = array(
            'navbar_title' => "Tambah Kategori Bank Soal",
            'kategoribanksoal' => $this->Model_banksoal->fetch_kategori_bank_soal()
        );
        $this->load->view('pg_admin/kategori_banksoal', $data);
    }

    function tambahkategori()
    {
        $data = array(
            'navbar_title' => "Tambah Kategori Bank Soal",
            'datakelas' => $this->Model_banksoal->get_kelas()
        );

        $this->load->view('pg_admin/kategori_banksoal_form', $data);
    }

    function pilihmapel($idkelas)
    {
        $carimapel = $this->Model_banksoal->get_mapel_by_kelas($idkelas);

        echo "<option value=''>-- pilih mata pelajaran --</option>";
        foreach ($carimapel as $mapel) {
            ?>
            <option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
            <?php
        }
    }

    function pilihkategori($idmapel)
    {
        $carikategori = $this->Model_banksoal->get_kategori_by_mapel($idmapel);

        echo "<option value='0'>Uncategorized</option>";
        foreach ($carikategori as $kategori) {
            ?>
            <option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>
            <?php
        }
    }

    function pilihtopik($idmapel)
    {
        $caritopik = $this->Model_banksoal->get_topik_by_mapel($idmapel);

        echo "<option value=''>Pilih Topik</option>";
        foreach ($caritopik as $topik) {
            ?>
            <option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>
            <?php
        }
        echo "<option value='tambah'>Tambah Topik...</option>";
    }

    function tambahtopik($topik)
    {
        if ($topik = "tambah") {
            echo "<input type='text' class='form-control' name='topikbaru' placeholder='masukkan topik baru...'/>";
        }
    }

    function proseskategori()
    {
        $params = $this->input->post(null, true);
        $idmapel = $params['mapel'];
        $namakategori = $params['nama_kastegori'];

        $result = $this->Model_banksoal->tambah_kategori($idmapel, $namakategori);

        redirect('pg_admin/banksoal/kategori');
    }

    function editkategori($idkategori)
    {
        $data = array(
            'navbar_title' => "Edit Kategori Bank Soal",
            'datakategori' => $this->Model_banksoal->cari_kategori($idkategori),
            'datakelas' => $this->Model_banksoal->get_kelas()
        );

        $this->load->view('pg_admin/kategori_banksoal_edit', $data);
    }

    function proseseditkategori()
    {
        $params = $this->input->post(null, true);
        $idmapel = $params['mapel'];
        $namakategori = $params['nama_kastegori'];
        $idkategori = $params['id_kategori'];

        $result = $this->Model_banksoal->edit_kategori($idkategori, $idmapel, $namakategori);

        redirect('pg_admin/banksoal/kategori');
    }

    function hapuskategori($idkategori)
    {
        $hapus = $this->Model_banksoal->hapus_kategori($idkategori);

        redirect('pg_admin/banksoal/kategori');
    }

    function edit($idbanksoal)
    {
        $data = array(
            'navbar_title' => "Edit Bank Soal",
            'datasoal' => $this->Model_banksoal->cari_bank_soal_by_id($idbanksoal),
            'datakelas' => $this->Model_banksoal->get_kelas(),
            'select_options_mapel' => $this->Model_banksoal->get_kelas()
        );
        $this->load->view('pg_admin/banksoal_edit', $data);
    }

    function editjson($idbanksoal)
    {
        $data = array(
            'navbar_title' => "Edit Bank Soal",
            'datasoal' => $this->Model_banksoal->cari_bank_soal_by_id($idbanksoal),
            'datakelas' => $this->Model_banksoal->get_kelas(),
            'select_options_mapel' => $this->Model_banksoal->get_kelas()
        );
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(500)
            ->set_output(json_encode($data));
//	$this->load->view('pg_admin/banksoal_edit', $data);
    }

    function proseseditbanksoal()
    {
        $params = $this->input->post(null, true);

        $idbanksoal = $params['idbanksoal'];
        $mapel = $params['nama_mapel'];
        if (isset($params['topikbaru'])) {
            $topik = $params['topikbaru'];
        } else {
            $topik = $params['topik'];
        }
        $soal = str_replace("\\\\", "\\", $params['soal']);
        $bobot = $params['bobot'];
        $jawabbenar = $params['jawabbenar'];
        $jawab1 = str_replace("\\\\", "\\", $params['jawab1']);
        $jawab2 = str_replace("\\\\", "\\", $params['jawab2']);
        $jawab3 = str_replace("\\\\", "\\", $params['jawab3']);
        $jawab4 = str_replace("\\\\", "\\", $params['jawab4']);
        $jawab5 = str_replace("\\\\", "\\", $params['jawab5']);
        $bahasteks = str_replace("\\\\", "\\", $params['bahasteks']);
        $bahasvideo = $params['bahasvideo'];
        $kategori = $params['kategori'];
        $tipe = $params['tipe'];

        $result = $this->Model_banksoal->edit_banksoal($idbanksoal, $mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe);
        redirect('pg_admin/banksoal');
    }

    function hapus($idbanksoal)
    {
        $hapus = $this->Model_banksoal->hapus($idbanksoal);
        redirect('pg_admin/banksoal');
    }

    function ajax_mapel($kelas)
    {
        $carimapel = $this->Model_banksoal->get_mapel_by_kelas($kelas);

        echo "<option value=''>-- Pilih Mata Pelajaran --</option>";
        foreach ($carimapel as $mapel) {
            ?>
            <option value="<?php echo $mapel->id_mapel; ?>"
                    data-mapel="<?php echo $mapel->nama_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
            <?php
        }
    }

    function ajax_topik($mapel)
    {
        $caritopik = $this->Model_banksoal->get_topik_by_mapel($mapel);

        echo "<option value=''>-- Pilih Topik --</option>";
        foreach ($caritopik as $topik) {
            ?>
            <option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>
            <?php
        }
    }

    function ajax_soal($kelas, $mapel)
    {
        $carisoal = $this->Model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
        foreach ($carisoal as $data) {
            ?>
            <tr>
                <td><?php echo $data->topik; ?> ...</td>
                <td>
                    <?php
                    if ($data->pembahasan_teks !== "" AND $data->pembahasan_video !== "") {
                        ?>
                        <a href=""><span class="label label-success">Pembahasan Teks</span></a>
                        <a href=""><span class="label label-warning">Pembahasan Video</span></a>
                        <?php
                    } elseif ($data->pembahasan_teks == "" AND $data->pembahasan_video !== "") {
                        ?>
                        <a href=""><span class="label label-warning">Pembahasan Video</span></a>
                        <?php
                    } elseif ($data->pembahasan_teks !== "" AND $data->pembahasan_video == "") {
                        ?>
                        <a href=""><span class="label label-success">Pembahasan Teks</span></a>
                        <?php
                    } elseif ($data->pembahasan_teks == "" AND $data->pembahasan_video == "") {

                    }
                    ?>

                </td>
                <td>
                    <?php
                    echo $data->nama_mapel . " - " . $data->alias_kelas;
                    ?>
                </td>
                <td>
                    <?php
                    echo $data->bobot_soal;
                    ?>
                </td>
                <td>
                    <?php
                    echo $data->kunci;
                    ?>
                </td>
                <td class="text-center">
                    <a href="#" data-toggle="modal" data-target="#myModal<?php echo $data->id_banksoal; ?>">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>
                    <a href="banksoal/edit/<?php echo $data->id_banksoal; ?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <?php
                    if ($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin") {
                        ?>
                        <a href="banksoal/hapus/<?php echo $data->id_banksoal; ?>"
                           onclick="return confirm('Apakah anda yakin untuk menghapus');">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
    }


    function ajax_soal_modal($kelas, $mapel)
    {
        $carisoal = $this->Model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
        $no = 1;
        foreach ($carisoal as $data) {
            ?>
            <div class="modal fade" id="myModal<?php echo $data->id_banksoal; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="modalsoal">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $data->pertanyaan; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <?php
        }
    }

}


?>