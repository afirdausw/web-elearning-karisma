<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_banksoal extends CI_Controller{

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
        $this->load->model('model_psep');
    }

    function index($topik=0){

        $idpsep = $this->session->userdata('idpsepsekolah');



        $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $data = array(
            'navbar_title'	=> 'Data Bank Soal',
            'data_soal' 	=> $this->Model_banksoal->fetch_banksoal_by_id_mapel($id_mapel),
            'idtopik'              => $topik,
        );



        $this->load->view('psep_sekolah/guru_banksoal', $data);
    }

    function tambah(){

        $idpsep = $this->session->userdata('idpsepsekolah');



        $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
        $carikelas  = $this->Model_psep->cari_kelas_by_mapel($id_mapel);



        $kelas      =  $carikelas->kelas_id;

        $data = array(
            'navbar_title' 			=> "Tambah Bank Soal",
            'form_action'			=> current_url(),
            'idkelas'               => $kelas,
            'idmapel'               => $id_mapel,
            'select_options_mapel'	=> $this->Model_banksoal->get_kelas(),
            'carikategori'          => $this->Model_banksoal->get_kategori_by_mapel($id_mapel),
            'caritopik'             => $this->Model_banksoal->get_topik_by_mapel($id_mapel)
        );

        //var_dump($idpsep);

        $this->load->view('psep_sekolah/guru_banksoal_form', $data);
    }

    function prosesbanksoal(){
        $params 		= $this->input->post(null, true);
        $mapel			= $params['nama_mapel'];

        if(isset($params['topikbaru'])){
            $topik		= $params['topikbaru'];
        }else{
            $topik			= $params['topik'];
        }
        $soal			= str_replace("\\\\", "\\", $params['soal']);
        $bobot			= $params['bobot'];
        $jawabbenar		= $params['jawabbenar'];
        $jawab1			= str_replace("\\\\", "\\", $params['jawab1']);
        $jawab2			= str_replace("\\\\", "\\", $params['jawab2']);
        $jawab3			= str_replace("\\\\", "\\", $params['jawab3']);
        $jawab4			= str_replace("\\\\", "\\", $params['jawab4']);
        $jawab5			= str_replace("\\\\", "\\", $params['jawab5']);
        $bahasteks		= str_replace("\\\\", "\\", $params['bahasteks']);
        $bahasvideo		= $params['bahasvideo'];
        $kategori		= $params['kategori'];
        $tipe			= $params['tipe'];

        $result = $this->Model_banksoal->tambah_banksoal($mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe);
        redirect('psep_sekolah/guru_banksoal');
    }

    function kategori(){
        $idpsep = $this->session->userdata('idpsepsekolah');



        $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $data = array(
            'navbar_title' 			=> "Tambah Kategori Bank Soal",
            'kategoribanksoal'	=> $this->Model_banksoal->fetch_kategori_bank_soal_by_mapel($id_mapel)
        );
       // var_dump($data['kategoribanksoal']);

        $this->load->view('psep_sekolah/guru_kategori_banksoal', $data);
    }

    function tambahkategori(){

        $idpsep = $this->session->userdata('idpsepsekolah');



        $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
        $carikelas  = $this->Model_psep->cari_kelas_by_mapel($id_mapel);
        $kelas      =  $carikelas->kelas_id;
        $mapel      =  $id_mapel;

        $data = array(
            'navbar_title' 			=> "Tambah Kategori Bank Soal",
            'idkelas'              => $kelas,
            'idmapel'              => $mapel,
            'datakelas'				=> $this->Model_banksoal->get_kelas()
        );

        $this->load->view('psep_sekolah/guru_kategori_banksoal_form', $data);
    }

    function pilihmapel($idkelas){
        $carimapel = $this->Model_banksoal->get_mapel_by_kelas($idkelas);

        echo "<option value=''>-- pilih mata pelajaran --</option>";
        foreach($carimapel as $mapel){
            ?>
            <option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
            <?php
        }
    }

    function pilihkategori($idmapel){
        $carikategori = $this->Model_banksoal->get_kategori_by_mapel($idmapel);

        echo "<option value='0'>Uncategorized</option>";
        foreach($carikategori as $kategori){
            ?>
            <option value="<?php echo $kategori->id_kategori_bank_soal; ?>"><?php echo $kategori->nama_kategori; ?></option>
            <?php
        }
    }

    function pilihtopik($idmapel){
        $caritopik = $this->Model_banksoal->get_topik_by_mapel($idmapel);

        echo "<option value=''>Pilih Topik</option>";
        foreach($caritopik as $topik){
            ?>
            <option value="<?php echo $topik->topik; ?>"><?php echo $topik->topik; ?></option>
            <?php
        }
        echo "<option value='tambah'>Tambah Topik...</option>";
    }

    function tambahtopik($topik){
        if($topik = "tambah"){
            echo "<input type='text' class='form-control' name='topikbaru' placeholder='masukkan topik baru...'/>";
        }
    }

    function proseskategori(){
        $params = $this->input->post(null, true);
        $idmapel = $params['Mapel'];
        $namakategori = $params['nama_kastegori'];

        $result = $this->Model_banksoal->tambah_kategori($idmapel, $namakategori);

        redirect('psep_sekolah/guru_banksoal/kategori');
    }

    function editkategori($idkategori){

        $idpsep = $this->session->userdata('idpsepsekolah');



        $cariidmapel = $this->Model_psep->cari_sekolah_by_login($idpsep);

        $id_mapel = $cariidmapel->id_mapel;

        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
        $carikelas  = $this->Model_psep->cari_kelas_by_mapel($id_mapel);
        $kelas      =  $carikelas->kelas_id;
        $mapel      =  $id_mapel;


        $data = array(
            'navbar_title' 			=> "Edit Kategori Bank Soal",
            'idkelas'              => $kelas,
            'idmapel'              => $mapel,
            'datakategori'			=> $this->Model_banksoal->cari_kategori($idkategori),
            'datakelas'				=> $this->Model_banksoal->get_kelas()
        );

        $this->load->view('psep_sekolah/guru_kategori_banksoal_edit', $data);
    }

    function proseseditkategori(){
        $params 		= $this->input->post(null, true);
        $idmapel 		= $params['Mapel'];
        $namakategori 	= $params['nama_kastegori'];
        $idkategori 	= $params['id_kategori'];

        $result = $this->Model_banksoal->edit_kategori($idkategori, $idmapel, $namakategori);

        redirect('psep_sekolah/guru_banksoal/kategori');
    }

    function hapuskategori($idkategori){
        $hapus = $this->Model_banksoal->hapus_kategori($idkategori);

        redirect('psep_sekolah/guru_banksoal/kategori');
    }

    function edit($idbanksoal){
        $data = array(
            'navbar_title' 			=> "Edit Bank Soal",
            'datasoal'				=> $this->Model_banksoal->cari_bank_soal_by_id($idbanksoal),
            'datakelas'				=> $this->Model_banksoal->get_kelas(),
            'select_options_mapel'	=> $this->Model_banksoal->get_kelas()
        );
        $this->load->view('psep_sekolah/guru_banksoal_edit', $data);
    }

    function proseseditbanksoal(){
        $params = $this->input->post(null, true);

        $idbanksoal = $params['idbanksoal'];
        $mapel			= $params['nama_mapel'];
        if(isset($params['topikbaru'])){
            $topik		= $params['topikbaru'];
        }else{
            $topik			= $params['topik'];
        }
        $soal			= str_replace("\\\\", "\\", $params['soal']);
        $bobot			= $params['bobot'];
        $jawabbenar		= $params['jawabbenar'];
        $jawab1			= str_replace("\\\\", "\\", $params['jawab1']);
        $jawab2			= str_replace("\\\\", "\\", $params['jawab2']);
        $jawab3			= str_replace("\\\\", "\\", $params['jawab3']);
        $jawab4			= str_replace("\\\\", "\\", $params['jawab4']);
        $jawab5			= str_replace("\\\\", "\\", $params['jawab5']);
        $bahasteks		= str_replace("\\\\", "\\", $params['bahasteks']);
        $bahasvideo		= $params['bahasvideo'];
        $kategori		= $params['kategori'];
        $tipe			= $params['tipe'];

        $result = $this->Model_banksoal->edit_banksoal($idbanksoal, $mapel, $topik, $soal, $bobot, $jawabbenar, $jawab1, $jawab2, $jawab3, $jawab4, $jawab5, $bahasteks, $bahasvideo, $kategori, $tipe);
        redirect('psep_sekolah/guru_banksoal');
    }

    function hapus($idbanksoal){
        $hapus = $this->Model_banksoal->hapus($idbanksoal);
        redirect('psep_sekolah/guru_banksoal');
    }

    function ajax_mapel($kelas){
        $carimapel = $this->Model_banksoal->get_mapel_by_kelas($kelas);

        echo "<option value=''>-- pilih mata pelajaran --</option>";
        foreach($carimapel as $mapel){
            ?>
            <option value="<?php echo $mapel->id_mapel; ?>"><?php echo $mapel->nama_mapel; ?></option>
            <?php
        }
    }

    function ajax_soal($kelas, $mapel){
        $carisoal = $this->Model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
        foreach($carisoal as $data){
            ?>
            <tr>
                <td><?php echo $data->topik; ?> ...</td>
                <td>
                    <?php
                    if($data->pembahasan_teks !== "" AND $data->pembahasan_video !== ""){
                        ?>
                        <a href=""><span class="label label-success">Pembahasan Teks</span></a>
                        <a href=""><span class="label label-warning">Pembahasan Video</span></a>
                        <?php
                    }elseif($data->pembahasan_teks == "" AND $data->pembahasan_video !== ""){
                        ?>
                        <a href=""><span class="label label-warning">Pembahasan Video</span></a>
                        <?php
                    }elseif($data->pembahasan_teks !== "" AND $data->pembahasan_video == ""){
                        ?>
                        <a href=""><span class="label label-success">Pembahasan Teks</span></a>
                        <?php
                    }elseif($data->pembahasan_teks == "" AND $data->pembahasan_video == ""){

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
                    <a href="banksoal/edit/<?php echo $data->id_banksoal;?>">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>

                    <?php
                    if($this->session->userdata('level') == "superadmin" or $this->session->userdata('level') == "admin"){
                        ?>
                        <a href="banksoal/hapus/<?php echo $data->id_banksoal;?>" onclick="return confirm('Apakah anda yakin untuk menghapus');">
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


    function ajax_soal_modal($kelas, $mapel){
        $carisoal = $this->Model_banksoal->fetch_banksoal_by_kelas_mapel($kelas, $mapel);
        $no=1;
        foreach($carisoal as $data){
            ?>
            <div class="modal fade" id="myModal<?php echo $data->id_banksoal;?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" id="modalsoal">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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