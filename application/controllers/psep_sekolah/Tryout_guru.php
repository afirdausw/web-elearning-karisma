<?php

class Tryout_guru extends CI_Controller
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
        $this->load->model('model_security');
        $this->load->model('model_psep');
    }

    function form_validation_rules(){
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

    public function index()
    {
        $idpsep = $this->session->userdata('idpsepsekolah');

        $carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
        $cariidmapel = $this->model_psep->cari_sekolah_by_login($idpsep);
        $id_mapel = $cariidmapel->id_mapel;

        $carikelas = $this->model_psep->cari_kelas_in_id_mapel($id_mapel);



        $data = array(
            'navbar_title' => "Kelas",
            'form_action'  => base_url() . $this->uri->slash_segment(1) . $this->uri->slash_segment(2),
            'table_data'   => $this->model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
            'carikelas' => $this->model_psep->cari_kelas_in_id_mapel($id_mapel),
            //'data_profil'   => $this->model_adm->fetch_all_profil_by_kelas($kelas),
        );

        $this->load->view('psep_sekolah/guru_tryout', $data);

    }

    public function kelas($kelas)
    {
        $data = array(
            'navbar_title' 	=> "Profil Try Out",
            'table_data' 	=> $this->model_adm->fetch_all_profil_by_kelas($kelas),
            'table_kategori'=> $this->model_adm->fetch_kategori()
        );

        $this->load->view('psep_sekolah/guru_tryout_kelas', $data);
    }


    function manajemen($aksi){
        if($aksi){


            $idpsep = $this->session->userdata('idpsepsekolah');

            $carisekolah = $this->model_psep->cari_sekolah_by_login($idpsep);
            $cariidmapel = $this->model_psep->cari_sekolah_by_login($idpsep);
            $id_mapel = $cariidmapel->id_mapel;

            $carikelas = $this->model_psep->cari_kelas_in_id_mapel($id_mapel);


            $this->form_validation_rules();
            switch($aksi){
                case 'tambahprofil':
                    $data = array(
                        'page_title'		=> "Tambah Profil Try Out",
                        'form_action'		=> current_url(),
                        'select_options'	=> $this->model_adm->fetch_all_kelas(),
                        'select_options_materi_pokok'	=> $this->model_adm->fetch_options_materi(),
                        'carikelas' => $this->model_psep->cari_kelas_in_id_mapel($id_mapel),
                    );
                    //jika tombol submit ditekan
                    if($this->input->post('form_submit')){
                        //routing ke proses tambah
                        $this->proses_tambah();
                    }else{
                        //jika tidak submit
                        $this->load->view('psep_sekolah/profil_form_guru', $data);
                    }
                    break;
                case 'tambahkategori':
                    if($this->uri->segment(5) == ""){
                        redirect('psep_sekolah/tryout');
                    }else{
                        $data = array(
                            'idprofil' 		=> $this->uri->segment(5),
                            'form_action'	=> current_url(),
                            'page_title'	=> 'Tambah Kategori Try Out',
                            'data_table'	=> $this->model_adm->fetch_banksoal(),					'datakelas'			=> $this->model_tryout->get_kelas()
                        );
                        if($this->input->post('form_submit')){
                            $this->proses_tambah_kat();
                        }else{
                            //jika tidak submit
                            $this->load->view('psep_sekolah/kategoriprofilform', $data);
                        }
                    }
                    break;
                case 'managesoal':
                    if($this->uri->segment(5) == ""){
                        redirect('psep_sekolah/tryout');
                    }else{
                        $idkategori = $this->uri->segment(5);
                        $data = array(
                            'form_action'	=> current_url(),
                            'page_title'	=> 'Manajemen Soal',
                            'data_table'	=> $this->model_adm->fetch_soalkategori($idkategori)
                        );
                        if($this->input->post('form_submit')){
                            $this->proses_managesoal();
                        }else{
                            //jika tidak submit
                            $this->load->view('psep_sekolah/managesoal', $data);
                        }
                    }
                    break;
                case 'aktivasi':
                    if($this->uri->segment(5) == ""){
                        redirect('psep_sekolah/tryout');
                    }else{
                        $idkategori = $this->uri->segment(5);
                        $this->model_adm->aktivasi_kategori($idkategori);
                        redirect('psep_sekolah/tryout');
                    }
                    break;
                case 'nonaktif':
                    if($this->uri->segment(5) == ""){
                        redirect('psep_sekolah/tryout');
                    }else{
                        $idkategori = $this->uri->segment(5);
                        $this->model_adm->nonaktif($idkategori);
                        redirect('psep_sekolah/tryout');
                    }
                    break;
                case 'editkategori':
                    if($this->uri->segment(5) == ""){
                        redirect('psep_sekolah/tryout');
                    }else{
                        $idkategori = $this->uri->segment(5);
                        $data = array(
                            'form_action'	=> current_url(),
                            'page_title'	=> 'Manajemen Soal',
                            'data_table'	=> $this->model_adm->fetch_kategoriedit($idkategori)
                        );
                        if($this->input->post('form_submit')){
                            $this->proses_editkategori();
                        }else{
                            //jika tidak submit
                            $this->load->view('psep_sekolah/edit_kategori', $data);
                        }
                    }
                    break;
                case 'hapuskategori' :
                    if($this->uri->segment(5) == ""){
                        redirect('psep_sekolah/tryout');
                    }else{
                        $idkategori = $this->uri->segment(5);
                        $result = $this->model_adm->hapus_kategori($idkategori);
                        $result = $this->model_adm->hapus_soal($idkategori);
                        redirect('psep_sekolah/tryout');
                    }

                    break;						case 'pilihmapel' :				$idkelas = $this->uri->segment(5);				$carimapel = $this->model_tryout->get_mapel($idkelas);				echo "<option value='semua'>Semua Mata Pelajaran</option>";				foreach($carimapel as $mapel){				?>					<option value="<?php echo $mapel->id_mapel;?>"><?php echo $mapel->nama_mapel;?></option>				<?php				}			break;						case 'pilihtopik' :				$idmapel = $this->uri->segment(5);								$caritopik = $this->model_tryout->get_topik($idmapel);								echo "<option value='semua'>Semua topik</option>";								foreach($caritopik as $topik){				?>					<option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>				<?php				}			break;						case 'pilihsoalbymapel' :				$idmapel = $this->uri->segment(5);								$carisoal = $this->model_tryout->get_soal_by_mapel($idmapel);								$no=1;				foreach($carisoal as $soal){				?>					<tr colspan="8"><?php echo $topik;?></tr>					<tr>						<td><?php echo $no;?></td>						<td><?php echo $soal->alias_kelas;?></td>						<td><?php echo $soal->pertanyaan;?></td>						<td><?php echo $soal->pembahasan_teks;?>						<p><?php echo $soal->pembahasan_video;?></td>						<td><?php echo $soal->nama_mapel;?></td>						<td><?php echo $soal->bobot_soal;?></td>						<td><?php echo $soal->kunci;?></td>						<td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal;?>" name="pilih[]" /></td>					</tr>									<?php								$no++;				}			break;			case 'pilihsoalbytopik' :				$topik = rawurldecode($this->uri->segment(5));								$carisoal = $this->model_tryout->get_soal_by_topik($topik);								$no=1;				foreach($carisoal as $soal){				?>					<tr colspan="8"><?php echo $topik;?></tr>					<tr>						<td><?php echo $no;?></td>						<td><?php echo $soal->alias_kelas;?></td>						<td><?php echo $soal->pertanyaan;?></td>						<td><?php echo $soal->pembahasan_teks;?>						<p><?php echo $soal->pembahasan_video;?></td>						<td><?php echo $soal->nama_mapel;?></td>						<td><?php echo $soal->bobot_soal;?></td>						<td><?php echo $soal->kunci;?></td>						<td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal;?>" name="pilih[]" /></td>					</tr>									<?php								$no++;				}			break;						case 'pilihkategori' :				$idmapel = $this->uri->segment(5);								$carikategori = $this->model_tryout->get_kategori($idmapel);								echo "<option value='0'> </option>";				echo "<option value='0'>Uncategorized</option>";				echo "<option value='semua'>Semua Kategori</option>";				foreach($carikategori as $kategori){				?>					<option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>				<?php				}			break;						case 'pilihsoalbykategori' :				$idkategori = rawurldecode($this->uri->segment(5));								$carisoal = $this->model_tryout->get_soal_by_kategori($idkategori);								$no=1;				foreach($carisoal as $soal){				?>					<tr>						<td><?php echo $no;?></td>						<td><?php echo $soal->alias_kelas;?></td>						<td><?php echo $soal->pertanyaan;?></td>						<td><?php echo $soal->pembahasan_teks;?>						<p><?php echo $soal->pembahasan_video;?></td>						<td><?php echo $soal->nama_mapel;?></td>						<td><?php echo $soal->bobot_soal;?></td>						<td><?php echo $soal->kunci;?></td>						<td class="text-center"><input type="checkbox" value="<?php echo $soal->id_banksoal;?>" name="pilih[]" /></td>					</tr>									<?php								$no++;				}			break;
                default:
                    $this->load->view('psep_sekolah/profiltryout', $data);
                    break;
            }
        }else{
            redirect('psep_sekolah/tryout');
        }
    }

}

