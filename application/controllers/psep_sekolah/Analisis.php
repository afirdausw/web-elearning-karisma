<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller
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
        //$this->load->model('model_adm');
        $this->load->model('model_psep');
        $this->load->model('model_dashboard');
        $this->load->model('model_agcu');
        $this->load->model('model_lstest');
        $this->load->model('model_pg');
        $this->load->model('model_security');
        $this->load->model('model_pembayaran');
        $this->load->model('model_adm');
        $this->load->model('model_fronttryout');
        $this->load->model('model_signup');
        $this->model_security->psep_sekolah_is_logged_in();
    }

    public function index()
    {
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);

        $data = array(
            'navbar_title' => "Analisis Try Out",
            'active'       => "analisis",
            'datakelas'    => $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
        );

        $this->load->view('psep_sekolah/analisis_tryout_pilih_kelas', $data);
    }

    function ajax_siswa_by_jenjang_old($kelas)
    {
        $idsekolah = $this->session->userdata('idsekolah');

        $carisiswa = $this->model_psep->cari_siswa_by_kelas($kelas, $idsekolah);

        $no = 1;
        foreach ($carisiswa as $siswa) {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $siswa->nama_siswa; ?></td>
                <td><?php echo $siswa->alias_kelas; ?></td>
                <td><a href="<?php echo base_url("psep_sekolah/analisis/siswa/" . $siswa->id_siswa); ?>">Report Try
                        Out</a></td>
            </tr>
            <?php
            $no++;
        }
    }




    function ajax_siswa_by_jenjang($kelas , $kategori)
    {
        $sekolah = $this->session->userdata('idsekolah');
        $carijenjang = $this->model_signup->cari_jenjang($kelas, $sekolah);

        // $carikelas = $this->model_signup->cari_kelas_by_jenjang($carijenjang->jenjang);;

        $carisiswa = $this->model_psep->cari_siswa_by_kelas($kelas, $sekolah);
        $dk = $this->model_adm->fetch_kategori_byid($kategori);
        $no = 1;
        foreach ($carisiswa as $siswa) {
            $cariskor = $this->model_dashboard->cari_skor($kategori, $siswa->id_siswa);
            $cariskorsalah = $this->model_dashboard->cari_skor_salah($kategori, $siswa->id_siswa);
            $cariwaktu = $this->model_dashboard->cari_waktu($kategori, $siswa->id_siswa);
            $prosentase = ($dk->jumlah_soal == 0 ? 0 : round(($cariskor / $dk->jumlah_soal) * 100, 2));

            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $siswa->nama_siswa; ?></td>
                <td><?php echo $siswa->alias_kelas; ?></td>
                <td><?php echo $dk->jumlah_soal; ?></td>
                <td><?php echo $cariskor; ?></td>
                <td><?php echo $cariskorsalah; ?></td>
                <td><?php echo $prosentase; ?></td>
                <td><a href="<?php echo base_url("psep_sekolah/analisis/tryoutsiswa/" . $siswa->id_siswa); ?>">Report
                        Tryout</a></td>
            </tr>
            <?php
            $no++;
        }
    }

    function ajax_tryout_by_kelas($kelas)
    {

        $caritryout = $this->model_adm->fetch_all_profil_by_kelas($kelas);

        // $carikelas = $this->model_signup->cari_kelas_by_jenjang($carijenjang->jenjang);;

        $no = 1; ?>
        <option value="">--Pilih Tryout --</option>
        <?php
        foreach ($caritryout as $tryout) {
            ?>
            <option value="<?php echo $tryout->id_tryout ?>"><?php echo $tryout->nama_profil ?></option>
            <?php
            $no++;
        }
    }
    function ajax_kategori_tryout_by_id_tryout($idtryout)
    {

        $daftar_kategori = $this->model_fronttryout->fetch_kategori($idtryout);

        // $carikelas = $this->model_signup->cari_kelas_by_jenjang($carijenjang->jenjang);;

        $no = 1;
        ?>
        <option value="">--Pilih Kategori --</option>
        <?php
        foreach ($daftar_kategori as $tryout) {
            ?>
            <option value="<?php echo $tryout->id_kategori ?>"><?php echo $tryout->nama_kategori ?></option>
            <?php
            $no++;
        }
    }

    function tryoutsiswa($id_siswa, $idtryout)
    {

        $siswa = $this->model_dashboard->get_info_siswa($id_siswa);

        //$this->model_security->psep_sekolah_is_logged_in();
        // 	$data = array(
        // 		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
        // 	);
        //$this->load->view('pg_ortu/pilih_tryout', $data);
        $data = array(
            'infosiswa'         => $this->model_dashboard->get_info_siswa($id_siswa),
            'navbar_links'      => $this->model_pg->get_navbar_links(),
            'data_user'         => $this->model_pg->get_data_user($id_siswa),
            'profil_tryout'     => $this->model_adm->fetch_all_profil_by_id($idtryout),
            'profil_tryout_all' => $this->model_adm->fetch_all_profil_by_kelas($siswa->id_kelas),
            'dataperingkat'     => $this->model_dashboard->peringkat($idtryout),
        );
        $table_data = $data['profil_tryout_all'];

        $daftar_kategori_baru = [];
        $i = 0;
        $totalsoal = 0;
        $totalbenar = 0;
        foreach ($table_data as $kat) {
            $daftar_kategori = $this->model_fronttryout->fetch_kategori($kat->id_tryout);
            $daftar_kategori_baru[$i] = json_decode(json_encode($kat), True);
            $j = 0;
            $index = 0;
            if (count($daftar_kategori) > 0) {
                foreach ($daftar_kategori as $subkey => $value) {
                    if ($value->id_profil == $kat->id_tryout) {
                        $cariskor = $this->model_dashboard->cari_skor($value->id_kategori, $id_siswa);
                        $cariskorsalah = $this->model_dashboard->cari_skor_salah($value->id_kategori, $id_siswa);
                        $cariwaktu = $this->model_dashboard->cari_waktu($value->id_kategori, $id_siswa);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), True);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                        $totalsoal += $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jumlah_soal'];
                        $totalbenar += $cariskor;
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisawaktu'] = json_decode(json_encode($this->model_dashboard->analisis_waktu($value->id_kategori, $id_siswa)), True);
                        $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisistopik'] = json_decode(json_encode($this->model_dashboard->analisistopik($value->id_kategori, $id_siswa)), True);
                        $analisa_topik = json_decode(json_encode($this->model_dashboard->analisatopik($value->id_kategori, $id_siswa)), True);
                        $k = 0;
                        foreach ($analisa_topik as $at) {
                            if ($at['id_analisis_topik'] != null) {
                                $at['jml_benar'] = $this->model_dashboard->analisabytopikbenar($value->id_kategori, $at['topik'], $id_siswa);
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k] = $at;
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['total'] = $this->model_dashboard->jumlahtopik($value->id_kategori, $id_siswa, $at['topik']);
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['presentase'] = ($at['jml_benar'] == 0 ? 0 : ($at['jml_benar'] / $this->model_dashboard->jumlahtopik($value->id_kategori, $id_siswa, $at['topik'])) * 100);
                            } else {
                                $daftar_kategori_baru[$i]['daftar_kategori'][$j][$k]['analisa_topik'] = null;
                            }
                            $k++;
                        }
                        unset($daftar_kategori[$index]);
                        $j++;
                    }
                    if ($j == 0) {
                        $daftar_kategori_baru[$i]['daftar_kategori'] = null;
                    }
                }
                $index++;
            } else {
                $daftar_kategori_baru[$i]['daftar_kategori'] = null;
            }
            $i++;
        }
        $data['daftar_kategori_baru'] = $daftar_kategori_baru;
        $data['daftar_kategori_baru']['totalsoal'] = $totalsoal;
        $data['daftar_kategori_baru']['totalbenar'] = $totalbenar;

//            return $this->output
//                ->set_content_type('application/json')
//                ->set_status_header(500)
//                ->set_output(json_encode($data));
        $this->load->view('psep_sekolah/report_analisis_siswa', $data);

    }

    function listprofil($idtryout)
    {
        if ($this->uri->segment(3) == "") {
            redirect('user/dashboard');
        } else {
            $totalsoal = $this->model_dashboard->total_soal_byprofil($idtryout);
            $dataperingkat = $this->model_dashboard->peringkat($idtryout);
            $no = 1;
            foreach ($dataperingkat as $peringkat) {
                $datasiswa = $this->model_dashboard->data_peringkat($peringkat->id_siswa, $idtryout);
                if (isset($peringkat->waktu_kerja)) {
                    $waktu = round($peringkat->waktu_kerja / 60, 2);
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td class="text-center">
                            <?php
                            if ($datasiswa->foto !== "") {
                                ?>
                                <img src="<?php echo base_url('assets/uploads/foto_siswa/' . $datasiswa->foto); ?>"
                                     style="width: 75px;"></img>
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url('assets/uploads/foto_siswa/default.png'); ?>"
                                     style="width: 75px;"></img>
                                <?php
                            }
                            ?>

                        </td>
                        <td>

                            <?php

                            echo $datasiswa->nama_siswa;

                            ?>
                        </td>

                        <td class="text-center"><?php echo $datasiswa->nama_sekolah; ?>
                            <br> <?php echo $datasiswa->nama_kota; ?> - <?php echo $datasiswa->nama_provinsi; ?></td>
                        <td class="text-center"><?php echo $waktu; ?> Menit</td>
                        <td class="text-center"><?php echo number_format($peringkat->jumlah_bobot_benar, 2, '.', ''); ?>

                        </td>
                        <td class="text-center"><?php echo number_format(($peringkat->jumlah_bobot_benar / $peringkat->jumlah_bobot) * 100, 2, '.', ''); ?>
                            %
                        </td>
                        <td>
                            <a href="<?php echo base_url("psep_sekolah/analisis/tryoutsiswa/" . $peringkat->id_siswa . "/" . $idtryout); ?>">Report
                                Tryout</a></td>
                    </tr>
                    <?php
                }
                $no++;
            }
        }
    }



}