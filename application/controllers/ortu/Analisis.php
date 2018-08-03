<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller {

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
        $this->load->model('model_psep');
        $this->load->model('model_dashboard');
        $this->load->model('model_agcu');
        $this->load->model('model_lstest');
        $this->load->model('model_pg');
        $this->load->model('model_security');
        $this->load->model('model_parent');
        $this->load->model('model_fronttryout');
        $this->model_security->parent_logged_in();

    }

    public function listprofil($idtryout)
    {
        if ($this->uri->segment(3) == "") {
            redirect('user/dashboard');
        } else {
            $totalsoal     = $this->model_dashboard->total_soal_byprofil($idtryout);
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
if ($peringkat->id_siswa == $this->session->userdata('id_siswa')) {
                        echo "<b>" . $datasiswa->nama_siswa . "</b>";
                    } else {
                        echo $datasiswa->nama_siswa;
                    }
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
                    </tr>
                    <?php
}
                $no++;
            }
        }
    }
    function tryout($idtryout)
    {

        if ($this->uri->segment(4) == "") {
            redirect('ortu/analisis');
        } else {



            $idortu = $this->session->userdata('id_ortu');

            $parent = $this->model_parent->get_parent($idortu);
            $idsiswa = $parent->id_siswa;
            $kelas = $parent->kelas;


            //$this->model_security->psep_sekolah_is_logged_in();
            // 	$data = array(
            // 		'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
            // 	);
            //$this->load->view('pg_ortu/pilih_tryout', $data);
            $id = $idsiswa;
            $data = array(
                'infosiswa'         => $this->model_dashboard->get_info_siswa($this->session->userdata('id_siswa')),
                'navbar_links'      => $this->model_pg->get_navbar_links(),
                'data_user'         => $this->model_pg->get_data_user($this->session->userdata('id_siswa')),
                'profil_tryout'     => $this->model_adm->fetch_all_profil_by_id($idtryout),
                'profil_tryout_all' => $this->model_adm->fetch_all_profil_by_kelas($kelas),
                'dataperingkat'     => $this->model_dashboard->peringkat($idtryout),
                'navbar_title'		=> "Log Akses Siswa",
                'page_title' 		=> "Detail Log Siswa",
                'form_action' 		=> current_url() . "?id=$id",
                'data_siswa' 		=> $this->model_adm->fetch_siswa_by_id($id),
                'log_teks' 			=> $this->model_adm->track_akses_by_id($id, 1), // 1=teks
                'log_video' 		=> $this->model_adm->track_akses_by_id($id, 2), // 2=video
                'log_soal' 			=> $this->model_adm->track_akses_soal_by_id($id), // 3=soal
                'group_log_teks' => $this->model_adm->group_akses_by_id($id, 1),
                'group_log_video' => $this->model_adm->group_akses_by_id($id, 2),
                'group_log_soal' => $this->model_adm->group_akses_soal_by_id($id),
                'akses_terakhir' 	=> $this->model_adm->last_akses_by_id($id),
                'infoortu'	=> $this->model_parent->get_parent($_SESSION['id_ortu'])
            );
            $table_data = $data['profil_tryout'];

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
                            $cariskor = $this->model_dashboard->cari_skor($value->id_kategori, $idsiswa);
                            $cariskorsalah = $this->model_dashboard->cari_skor_salah($value->id_kategori, $idsiswa);
                            $cariwaktu = $this->model_dashboard->cari_waktu($value->id_kategori, $idsiswa);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j] = json_decode(json_encode($value), True);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskor'] = $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariskorsalah'] = $cariskorsalah;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['cariwaktu'] = $cariwaktu;
                            $totalsoal+= $daftar_kategori_baru[$i]['daftar_kategori'][$j]['jumlah_soal'];
                            $totalbenar+= $cariskor;
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisawaktu'] = json_decode(json_encode($this->model_dashboard->analisis_waktu($value->id_kategori, $idsiswa)), True);
                            $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisistopik'] = json_decode(json_encode($this->model_dashboard->analisistopik($value->id_kategori, $idsiswa)), True);
                            $analisa_topik = json_decode(json_encode($this->model_dashboard->analisatopik($value->id_kategori, $idsiswa)), True);
                            $k = 0;
                            foreach ($analisa_topik as $at) {
                                if ($at['id_analisis_topik'] != null) {
                                    $at['jml_benar'] = $this->model_dashboard->analisabytopikbenar($value->id_kategori,$at['topik'], $idsiswa);
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k] = $at;
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['total'] = $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik']);
                                    $daftar_kategori_baru[$i]['daftar_kategori'][$j]['analisa_topik'][$k]['presentase'] = ($at['jml_benar'] == 0 ? 0 : ($at['jml_benar'] / $this->model_dashboard->jumlahtopik($value->id_kategori, $idsiswa, $at['topik'])) * 100);
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

//PROSES DESEMBER 05 2017
//
           // return $this->output
           //     ->set_content_type('application/json')
           //     ->set_status_header(500)
           //     ->set_output(json_encode($data));
            $this->load->view('pg_ortu/tryout-statistik', $data);
        }

    }



}