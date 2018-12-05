<?php

class Tryout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('alert_helper');
        $this->load->model('model_adm');
        $this->load->model('model_pembayaran');
        $this->load->model('model_paket');
        $this->load->model('model_tryout');
        $this->load->model('model_psep');
        $this->load->model('model_banksoal');
    }

    function index()
    {
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $jumdatalimit = 5;

        if (isset($_GET['page'])) {
            if ($_GET['page'] > 1) {
                $page = $jumdatalimit * ($_GET['page'] - 1);
            } else {
                $page = $_GET['page'] - 1;
            }
        } else {
            $page = 1;
        }
        $start = ($page - 1) * $jumdatalimit;
        $jumhal = ceil(count($this->Model_adm->fetch_all_profil_by_jenjang($carisekolah->jenjang)) / $jumdatalimit);

        $data = array(
            'navbar_title'   => "Profil Try Out",
            'table_data'     => $this->Model_adm->fetch_all_profil_by_jenjang_limit($jumdatalimit, $start, $carisekolah->jenjang),
            'table_kategori' => $this->Model_adm->fetch_kategori(),
            'jumhal'         => $jumhal,
        );
        $this->load->view('psep_sekolah/profiltryout', $data);
    }

    function manajemen($aksi)
    {
        if ($aksi) {
            $this->form_validation_rules();
            switch ($aksi) {
                case 'tambahprofil':
                    $idpsep = $this->session->userdata('idpsepsekolah');

                    $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

                    $data = array(
                        'page_title'                  => "Tambah Profil Try Out",
                        'form_action'                 => current_url(),
                        'select_options'              => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
                        'select_options_materi_pokok' => $this->Model_adm->fetch_options_materi(),
                    );
                    //jika tombol submit ditekan
                    if ($this->input->post('form_submit')) {
                        //routing ke proses tambah
                        $this->proses_tambah();
                    } else {
                        //jika tidak submit
                        $this->load->view('psep_sekolah/profilform', $data);
                    }
                    break;
                case 'tambahkategori':
                    if ($this->uri->segment(5) == "") {
                        redirect('psep_sekolah/tryout');
                    } else {
                        $data_profil = $this->Model_adm->fetch_profiledit($this->uri->segment(5));
                        if (count($data_profil) > 0) {
                            $data = array(

                                'idprofil'    => $this->uri->segment(5),
                                'form_action' => current_url(),
                                'page_title'  => 'Tambah Kategori Try Out',
                                'datamapel'   => $this->Model_adm->fetch_mapel_by_id_kelas($data_profil[0]->id_kelas),
                                'data_table'  => $this->Model_adm->fetch_banksoal(),
                                'datakelas'   => $this->Model_tryout->get_kelas(),
                            );
                            if ($this->input->post('form_submit')) {
                                $this->proses_tambah_kat();
                            } else {
                                //jika tidak submit
                                $this->load->view('psep_sekolah/kategoriprofilform', $data);
                            }
                        }
                    }
                    break;
                case 'managesoal':
                    if ($this->uri->segment(5) == "") {
                        redirect('psep_sekolah/tryout');
                    } else {
                        $idkategori = $this->uri->segment(5);
                        $data = array(
                            'form_action' => current_url(),
                            'page_title'  => 'Manajemen Soal',
                            'data_table'  => $this->Model_adm->fetch_soalkategori($idkategori),
                        );
                        if ($this->input->post('form_submit')) {
                            $this->proses_managesoal();
                        } else {
                            //jika tidak submit
                            $this->load->view('psep_sekolah/managesoal', $data);
                        }
                    }
                    break;
                case 'aktivasi':
                    if ($this->uri->segment(5) == "") {
                        redirect('psep_sekolah/tryout');
                    } else {
                        $idkategori = $this->uri->segment(5);
                        $this->Model_adm->aktivasi_kategori($idkategori);
                        redirect('psep_sekolah/tryout');
                    }
                    break;
                case 'nonaktif':
                    if ($this->uri->segment(5) == "") {
                        redirect('psep_sekolah/tryout');
                    } else {
                        $idkategori = $this->uri->segment(5);
                        $this->Model_adm->nonaktif($idkategori);
                        redirect('psep_sekolah/tryout');
                    }
                    break;
                case 'editkategori':
                    if ($this->uri->segment(5) == "") {
                        redirect('psep_sekolah/tryout');
                    } else {
                        $idkategori = $this->uri->segment(5);
                        $data = array(
                            'form_action' => current_url(),
                            'page_title'  => 'Manajemen Soal',
                            'data_table'  => $this->Model_adm->fetch_kategoriedit($idkategori),
                        );
                        if ($this->input->post('form_submit')) {
                            $this->proses_editkategori();
                        } else {
                            //jika tidak submit
                            $this->load->view('psep_sekolah/edit_kategori', $data);
                        }
                    }
                    break;
                case 'hapuskategori' :
                    if ($this->uri->segment(5) == "") {
                        redirect('psep_sekolah/tryout');
                    } else {
                        $idkategori = $this->uri->segment(5);
                        $result = $this->Model_adm->hapus_kategori($idkategori);
                        $result = $this->Model_adm->hapus_soal($idkategori);
                        redirect('psep_sekolah/tryout');
                    }

                    break;
                case 'pilihmapel' :
                    $idkelas = $this->uri->segment(5);
                    $carimapel = $this->Model_tryout->get_mapel($idkelas);
                    echo "<option value='semua'>Semua Mata Pelajaran</option>";
                    foreach ($carimapel as $mapel) { ?>
                        <option value="<?php echo $mapel->id_mapel; ?>">
                            <?php echo $mapel->nama_mapel; ?></option>
                        <?php
                    }
                    break;
                case 'pilihtopik' :
                    $idmapel = $this->uri->segment(5);
                    $caritopik = $this->Model_tryout->get_topik($idmapel);
                    echo "<option value='semua'>Semua topik</option>";
                    foreach ($caritopik as $topik) { ?>
                        <option value="<?php echo $topik->topik; ?>">
                            <?php echo $topik->topik; ?>
                        </option>
                        <?php
                    }
                    break;
                case 'pilihsoalbymapel' :
                    $idmapel = $this->uri->segment(5);
                    $carisoal = $this->Model_tryout->get_soal_by_mapel($idmapel);
                    $no = 1;
                    foreach ($carisoal as $soal) { ?>
                        <tr colspan="8"><?php echo $topik; ?></tr>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $soal->alias_kelas; ?></td>
                            <td><?php echo $soal->pertanyaan; ?></td>
                            <td><?php echo $soal->pembahasan_teks; ?>
                                <p><?php echo $soal->pembahasan_video; ?>
                            </td>
                            <td><?php echo $soal->nama_mapel; ?></td>
                            <td><?php echo $soal->bobot_soal; ?></td>
                            <td><?php echo $soal->kunci; ?></td>
                            <td class="text-center">
                                <input type="checkbox" value="<?php echo $soal->id_banksoal; ?>" name="pilih[]"/>
                            </td>
                        </tr>
                        <?php $no++;
                    }
                    break;
                case 'pilihsoalbytopik' :
                    $topik = rawurldecode($this->uri->segment(5));
                    $carisoal = $this->Model_tryout->get_soal_by_topik($topik);
                    $no = 1;
                    foreach ($carisoal as $soal) { ?>
                        <tr colspan="8"><?php echo $topik; ?></tr>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $soal->alias_kelas; ?></td>
                            <td><?php echo $soal->pertanyaan; ?></td>
                            <td><?php echo $soal->pembahasan_teks; ?>
                                <p><?php echo $soal->pembahasan_video; ?>
                            </td>
                            <td><?php echo $soal->nama_mapel; ?></td>
                            <td><?php echo $soal->bobot_soal; ?></td>
                            <td><?php echo $soal->kunci; ?></td>
                            <td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal; ?>"
                                                           name="pilih[]"/></td>
                        </tr>
                        <?php
                        $no++;
                    }
                    break;
                case 'pilihkategori' :
                    $idmapel = $this->uri->segment(5);
                    $carikategori = $this->Model_tryout->get_kategori($idmapel);
                    echo "<option value='0'> </option>";
                    echo "<option value='0'>Uncategorized</option>";
                    echo "<option value='semua'>Semua Kategori</option>";
                    foreach ($carikategori as $kategori) { ?>
                        <option value="<?php echo $kategori->id_kategori_bank_soal; ?>">
                            <?php echo $kategori->nama_kategori; ?>
                        </option>
                        <?php
                    }
                    break;
                case 'pilihsoalbykategori' :
                    $idkategori = rawurldecode($this->uri->segment(5));
                    $carisoal = $this->Model_tryout->get_soal_by_kategori($idkategori);
                    $no = 1;
                    foreach ($carisoal as $soal) { ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $soal->alias_kelas; ?></td>
                            <td><?php echo $soal->pertanyaan; ?></td>
                            <td><?php echo $soal->pembahasan_teks; ?>
                                <p><?php echo $soal->pembahasan_video; ?>
                            </td>
                            <td><?php echo $soal->nama_mapel; ?></td>
                            <td><?php echo $soal->bobot_soal; ?></td>
                            <td><?php echo $soal->kunci; ?></td>
                            <td class="text-center">
                                <input type="checkbox" value="<?php echo $soal->id_banksoal; ?>" name="pilih[]"/>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    break;
                case 'editprofil':
                    if ($this->uri->segment(5) == "") {
                        redirect('pg_admin/tryout');
                    } else {
                        $idpsep = $this->session->userdata('idpsepsekolah');

                        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

                        $id_tryout = $this->uri->segment(5);
                        $data = array(
                            'form_action'    => current_url(),
                            'page_title'     => 'Manajemen Soal',
                            'select_options' => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
                            'data_table'     => $this->Model_adm->fetch_profiledit($id_tryout),
                        );
                        if ($this->input->post('form_submit')) {
                            $this->proses_edit();
                        } else {
                            //jika tidak submit
                            $this->load->view('psep_sekolah/editprofil', $data);
                        }
                    }
                    break;
                default:
                    $this->load->view('psep_sekolah/profiltryout', $data);
                    break;
            }
        } else {
            redirect('psep_sekolah/tryout');
        }
    }

    public function proses_edit()
    {
        $data = array(
            'page_title'  => "Tambah Paket",
            'form_action' => current_url(),
        );
        //mengambil semua input dari form
        $params = $this->input->post(null, true);
        $nama = $params['nama'];
        $id_tryout = $params['id_tryout'];
        $penyelenggara = $params['penyelenggara'];
        $biaya = $params['biaya'];
        $tanggal = $params['tanggal'];
        $jam = $params['jam'];
        $kelas = $params['kelas'];
        $keterangan = $params['keterangan'];
        $type = $params['tipe'];
        $max = $this->Model_adm->select_max('sub_materi', 'urutan_materi');
        $urutan_materi = ($max->urutan_materi + 1);
        $tanggalpost = $params['tanggal_post'];
        $waktupost = $params['waktu_post'];

        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view('psep_sekolah/profilform', $data);
        } else {
            $profil = $this->Model_adm->fetch_profiledit($id_tryout);
            if (count($profil) > 0) {
                if ($_FILES['banner']['name'] !== "") {
                    $tipe = $this->cek_tipe($_FILES['banner']['type']);
                    $img_path = "assets/uploads/banner/";
                    $namafile = md5($nama) . md5(time()) . $tipe;


                    $config['upload_path'] = $img_path;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $namafile;

                    $this->load->library('upload', $config);
                    $this->upload->do_upload('banner');

                    $result = $this->Model_adm->edit_profil($id_tryout,
                        $kelas, $nama, $keterangan, $urutan_materi,
                        $penyelenggara, $tanggal, $jam, $biaya, $namafile, $tanggalpost, $waktupost, $type);

                    redirect('psep_sekolah/tryout');
                } else {
                    //passing input value to Model
                    $result = $this->Model_adm->edit_profil($id_tryout,
                        $kelas, $nama, $keterangan, $urutan_materi,
                        $penyelenggara, $tanggal, $jam, $biaya, $profil[0]->banner, $tanggalpost, $waktupost, $type);

                    redirect('psep_sekolah/tryout');
                    // echo "Status Insert: " . $result;
                }
            } else {
                redirect('psep_sekolah/tryout');
            }

        }
    }

    public function proses_tambah()
    {
        $data = array(
            'page_title'  => "Tambah Paket",
            'form_action' => current_url(),
        );
        //mengambil semua input dari form
        $params = $this->input->post(null, true);
        $nama = $params['nama'];
        $penyelenggara = $params['penyelenggara'];
        $biaya = $params['biaya'];
        $tanggal = $params['tanggal'];
        $jam = $params['jam'];
        $kelas = $params['kelas'];
        $keterangan = $params['keterangan'];
        $type = $params['tipe'];
        $max = $this->Model_adm->select_max('sub_materi', 'urutan_materi');
        $urutan_materi = ($max->urutan_materi + 1);
        $tanggalpost = $params['tanggal_post'];
        $waktupost = $params['waktu_post'];

        if ($this->form_validation->run() == FALSE) {
            alert_error("Error", "Data gagal ditambahkan");
            $this->load->view('psep_sekolah/profilform', $data);
        } else {

            if ($_FILES['banner']['name'] !== "") {
                $tipe = $this->cek_tipe($_FILES['banner']['type']);
                $img_path = "assets/uploads/banner/";
                $namafile = md5($nama) . md5(time()) . $tipe;


                $config['upload_path'] = $img_path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = $namafile;

                $this->load->library('upload', $config);
                $this->upload->do_upload('banner');

                $result = $this->Model_adm->add_profil(
                    $kelas, $nama, $keterangan, $urutan_materi,
                    $penyelenggara, $tanggal, $jam, $biaya, $namafile, $tanggalpost, $waktupost, $type);

                redirect('psep_sekolah/tryout');
            } else {
                //passing input value to Model
                $result = $this->Model_adm->add_profil(
                    $kelas, $nama, $keterangan, $urutan_materi,
                    $penyelenggara, $tanggal, $jam, $biaya, '-', $tanggalpost, $waktupost, $type);

                redirect('psep_sekolah/tryout');
                // echo "Status Insert: " . $result;
            }


        }
    }

    public function proses_tambah_kat()
    {
        $data = array(
            'page_title'  => "Tambah Kategori",
            'form_action' => current_url(),
        );

        $params = $this->input->post(null, true);
        if (isset($params['pilih'])) {
            $hitung_soal = count($params['pilih']);
            $idbanksoal = $params['pilih'];
        }
        if (isset($params['random'])) {
            $random = "1";
        } else {
            $random = "0";
        }
        $idprofil = $params['idprofil'];
        $tanggal = $params['tanggal'];
        $jam = $params['jam'];
        $nama = $params['nama'];
        $waktu = $params['waktu'];
        $ketuntasan = $params['ketuntasan'];
        $mapel = $params['mata_pelajaran'];

        if (!isset($params['pilih'])) {
            redirect('psep_sekolah/tryout');
        } else {
            //passing input value to Model
            $result = $this->Model_adm->add_kategori(
                $idprofil,
                $nama,
                $random,
                $tanggal,
                $jam,
                $waktu,
                $ketuntasan,
                $hitung_soal,
                $mapel
            );

            for ($i = 0; $i <= $hitung_soal - 1; $i++) {
                $kategoriterakhir = $this->Model_adm->last_addedkategori();

                foreach ($kategoriterakhir as $datakategori) {
                    //echo $datakategori->id_terakhir;
                    $result = $this->Model_adm->add_soal($datakategori->id_terakhir, $idbanksoal[$i]);
                }
            }

            redirect('psep_sekolah/tryout');
        }

    }


    function ambilbanksoalfilter($id_kategori, $kelas = 0, $mapel = 0, $topik = '')
    {
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);


        //load library pagination
        //configurasi pagination
        if ($kelas == 0 && $mapel == 0 && $topik == '') {
            $config['base_url'] = base_url() . 'psep_sekolah/tryout/ambilbanksoalfilter/' . $id_kategori;
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
                'select_options_kelas' => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
            );
        } elseif ($kelas != 0 && $mapel == 0 && $topik == '') {
            $config['base_url'] = base_url() . 'psep_sekolah/tryout/ambilbanksoalfilter/' . $id_kategori . '/' . $kelas . '/';
            $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record_by_kelas($kelas);
            $config['per_page'] = 10;
            $page = (isset($_GET['page']) ? $_GET['page'] : 1);
            // menentukan offset record dari uri segment
            $start = ($page - 1) * $config['per_page'];
            //ubah data menjadi tampilan per limit
            $rows = $this->Model_banksoal->fetch_banksoal_paging_by_kelas($kelas, $config['per_page'], $start);
            $pages = ceil($config['total_rows'] / $config['per_page']);
            $data = array(
                'page'                 => $page,
                'kelas'                => $kelas,
                'data_soal'            => $rows,
                'pagination'           => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start'                => $start,
                'select_options_kelas' => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
                'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas),
            );
        } elseif ($kelas != 0 && $mapel != 0 && $topik == '') {
            $config['base_url'] = base_url() . 'psep_sekolah/tryout/ambilbanksoalfilter/' . $id_kategori . '/' . $kelas . '/' . $mapel . '/';
            $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_total_record_by_id_mapel($mapel);
            $config['per_page'] = 10;
            $page = (isset($_GET['page']) ? $_GET['page'] : 1);
            // menentukan offset record dari uri segment
            $start = ($page - 1) * $config['per_page'];
            //ubah data menjadi tampilan per limit
            $rows = $this->Model_banksoal->fetch_banksoal_paging_by_id_mapel($mapel, $config['per_page'], $start);
            $pages = ceil($config['total_rows'] / $config['per_page']);
            $data = array(
                'page'                 => $page,
                'kelas'                => $kelas,
                'Mapel' => $mapel,
                'data_soal'            => $rows,
                'pagination'           => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start'                => $start,
                'select_options_kelas' => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
                'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas),
            );
        } elseif ($kelas != 0 && $mapel != 0 && $topik != '') {
            $config['base_url'] = base_url() . 'psep_sekolah/tryout/ambilbanksoalfilter/' . $id_kategori . '/' . $kelas . '/' . $mapel . '/' . $topik;
            $config['total_rows'] = $this->Model_banksoal->fetch_banksoal_paging_by_topik($mapel, $topik);
            $config['per_page'] = 10;
            $page = (isset($_GET['page']) ? $_GET['page'] : 1);
            // menentukan offset record dari uri segment
            $start = ($page - 1) * $config['per_page'];
            //ubah data menjadi tampilan per limit
            $rows = $this->Model_banksoal->fetch_banksoal_paging_by_id_topik($mapel, $topik, $config['per_page'], $start);
            $pages = ceil($config['total_rows'] / $config['per_page']);
            $data = array(
                'page'                 => $page,
                'kelas'                => $kelas,
                'Mapel' => $mapel,
                'data_soal'            => $rows,
                'pagination'           => $this->paginate($config['per_page'], $page, $config['total_rows'], $pages, $config['base_url']),
                //'pagination' => $this->pagination->create_links(),
                'start'                => $start,
                'select_options_kelas' => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
                'select_options_mapel' => $this->Model_banksoal->get_mapel_by_kelas($kelas),
                'select_options_topik' => $this->Model_banksoal->get_topik_by_mapel($mapel),
            );
        } else {
            $config['base_url'] = base_url() . 'psep_sekolah/tryout/ambilbanksoalfilter/' . $id_kategori . '/';
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
                'select_options_kelas' => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
            );
        }
        $datas = array_column($this->Model_adm->all_soal_kategori($id_kategori), 'id_banksoal');
        $kat = $this->Model_adm->fetch_kategoriedit($id_kategori);
        if (count($kat) > 0) {
            $data['kategori'] = $kat[0];
            $pro = $this->Model_adm->fetch_profiledit($kat[0]->id_profil);
            if (count($pro) > 0) {
                $data['profil'] = $pro[0];
            }
            $data['navbar_title'] = "Manajemen Soal " . $kat[0]->nama_kategori . ", " . $pro[0]->nama_profil;
        }
        $data['datasoal'] = $datas;
        $data['idkategori'] = $id_kategori;
        $data['kelas'] = $kelas;
        $data['Mapel'] = $mapel;
//        var_dump($data);
        $this->load->view('psep_sekolah/ambilbanksoaltryout', $data);
//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(200)
//            ->set_output(json_encode($data, TRUE));
    }

    function simpansoal($idkategori, $idsoal, $hal, $kelas = 0, $mapel = 0)
    {
        $result = $this->Model_adm->add_soal_kategori($idkategori, $idsoal);

        if ($result) {
            alert_success("Sukses", "Data berhasil ditambahkan");
        } else {
            alert_error('Gagal', 'Data gagal di tambahkan');
        }
        if ($kelas == 0 && $mapel == 0) {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '?page=' . $hal);
        } elseif ($kelas != 0 && $mapel == 0) {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '/' . $kelas . '?page=' . $hal);
        } elseif ($kelas != 0 && $mapel != 0) {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '/' . $kelas . '/' . $mapel . '?page=' . $hal);
        } else {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '?page=' . $hal);
        }
    }

    function hapussoal($idkategori, $idsoal, $hal, $kelas = 0, $mapel = 0)
    {
        $result = $this->Model_adm->delete_soal_kategori($idkategori, $idsoal);

        if ($result) {
            alert_success("Sukses", "Data berhasil dihapus");
        } else {
            alert_error('Gagal', 'Data gagal dihapus');
        }
        if ($kelas == 0 && $mapel == 0) {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '?page=' . $hal);
        } elseif ($kelas != 0 && $mapel == 0) {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '/' . $kelas . '?page=' . $hal);
        } elseif ($kelas != 0 && $mapel != 0) {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '/' . $kelas . '/' . $mapel . '?page=' . $hal);
        } else {
            redirect('psep_sekolah/tryout/ambilbanksoalfilter/' . $idkategori . '?page=' . $hal);
        }
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


    function proses_managesoal()
    {
        $data = array(
            'page_title'  => "Tambah Kategori",
            'form_action' => current_url(),
        );
        $idkategori = $this->uri->segment(5);
        $params = $this->input->post(null, true);
        if (isset($params['pilih'])) {
            $hitung_soal = count($params['pilih']);
            $idbanksoal = $params['pilih'];
        }
        echo "<p>" . $idkategori;
        for ($i = 0; $i <= $hitung_soal - 1; $i++) {
            $result = $this->Model_adm->delete_soal($idkategori, $idbanksoal[$i]);
            //echo "<p>". $idbanksoal[$i];
        }

        $result = $this->Model_adm->update_jumlahsoal($idkategori, $hitung_soal);
        redirect('psep_sekolah/tryout');
    }

    function proses_editkategori()
    {
        $data = array(
            'page_title'  => "Tambah Kategori",
            'form_action' => current_url(),
        );

        $params = $this->input->post(null, true);

        if (isset($params['random'])) {
            $random = "1";
        } else {
            $random = "0";
        }
        $idkategori = $this->uri->segment(5);
        $tanggal = $params['tanggal'];
        $jam = $params['jam'];
        $nama = $params['nama'];
        $waktu = $params['durasi'];
        $ketuntasan = $params['ketuntasan'];

        $result = $this->Model_adm->edit_kategori(
            $idkategori,
            $nama,
            $random,
            $tanggal,
            $jam,
            $waktu,
            $ketuntasan
        );
        redirect('psep_sekolah/tryout');
    }

    function form_validation_rules()
    {
        //set validation rules untuk masing2 input
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('penyelenggara', 'penyelenggara', 'trim|required');
        $this->form_validation->set_rules('biaya', 'biaya', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');
        $this->form_validation->set_rules('jam', 'jam', 'trim|required');
        $this->form_validation->set_rules('kelas', 'kelas', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }

    function pilihmapel($idkelas)
    {
        $carimapel = $this->Model_tryout->get_mapel($idkelas);
        foreach ($carimapel as $mapel) { ?>
            <option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>    <?php }
    }

    private function cek_tipe($tipe)
    {

        if ($tipe == 'image/jpeg') {
            return ".jpg";
        } else if ($tipe == 'image/png') {
            return ".png";
        } else {
            return false;
        }

    }

    function aktifcbt()
    {
        if ($this->uri->segment(4) == "") {
            redirect('psep_sekolah/tryout');
        }
        $idprofil = $this->uri->segment(4);

        $aktifstatus = $this->Model_tryout->aktifpendaftaran($idprofil);
        redirect('psep_sekolah/tryout');
    }

    function nonaktifcbt()
    {
        if ($this->uri->segment(4) == "") {
            redirect('psep_sekolah/tryout');
        }
        $idprofil = $this->uri->segment(4);

        $aktifstatus = $this->Model_tryout->nonaktifpendaftaran($idprofil);
        redirect('psep_sekolah/tryout');
    }

    function pembayarancbt()
    {
        $data = array(
            'data_bayar' => $this->Model_tryout->get_pembayaran(),
        );

        $this->load->view('psep_sekolah/cbt_pembayaran', $data);
    }

    function konfirmasi_cbt($iddaftar, $idsiswa)
    {
        $this->Model_tryout->konfirmasi_bayar($iddaftar, $idsiswa);
        redirect('psep_sekolah/tryout/pembayarancbt');
    }

    function tolak_cbt($iddaftar, $idsiswa)
    {
        $this->Model_tryout->tolak_bayar($iddaftar, $idsiswa);
        redirect('psep_sekolah/tryout/pembayarancbt');
    }
}


?>