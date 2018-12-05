<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller
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
        $this->load->model('model_psep');
        $this->load->model('model_dashboard');
        $this->load->model('model_agcu');
        $this->load->model('model_lstest');
        $this->load->model('model_pg');
        $this->load->model('model_security');
        $this->Model_security->psep_sekolah_is_logged_in();
    }

    function index()
    {
        $idsekolah = $this->session->userdata('idsekolah');
        $data = array(
            'navbar_title' => "Manajemen Guru",
            'active'       => "guru",
            'sekolah'      => $this->Model_psep->fetch_sekolah_by_id($idsekolah),
            'dataguru'     => $this->Model_psep->fetch_all_guru($idsekolah),
        );
        //var_dump($data['dataguru']);

        $this->load->view("psep_sekolah/guru", $data);
    }

    function tambah()
    {

        $idpsep = $this->session->userdata('idpsepsekolah');
        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
        $mapel = $this->Model_psep->cari_mapel_by_jenjang($carisekolah->jenjang);
        $list_mapel = array();
        foreach ($mapel as $key => $value) {
            $list_mapel[$value->nama_mapel][] = [
                "id_mapel" => $value->id_mapel,
                "kelas"    => $value->alias_kelas,
            ];
        }
//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(500)
//            ->set_output(json_encode($list_mapel));
        $data = array(
            'action'       => base_url("psep_sekolah/guru/proses_tambah"),
            'navbar_title' => "Register  Guru",
            'active'       => "guru",
            'act'          => 'insert',
            'sekolah'      => $carisekolah,
            'Mapel' => $list_mapel,
            'table_data'   => $this->Model_adm->fetch_mapel_by_id_kelas($idpsep),
        );

        $this->load->view("psep_sekolah/guru_form", $data);
    }


    function edit($id_login_sekolah)
    {

        $idpsep = $this->session->userdata('idpsepsekolah');
        $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
        $mapel = $this->Model_psep->cari_mapel_by_jenjang($carisekolah->jenjang);
        $list_mapel = array();
        foreach ($mapel as $key => $value) {
            $list_mapel[$value->nama_mapel][] = [
                "id_mapel" => $value->id_mapel,
                "kelas"    => $value->alias_kelas,
            ];
        }
        $data = array(
            'action'       => base_url("psep_sekolah/guru/proses_update"),
            'navbar_title' => "Edit  Guru",
            'active'       => "guru",
            'sekolah'      => $carisekolah,
            'datakelas'    => $this->Model_psep->cari_kelas_by_jenjang($carisekolah->jenjang),
            'Mapel' => $list_mapel,
            'cariguru'     => $this->Model_psep->fetch_all_guru_by_id_login($id_login_sekolah),
        );

//        var_dump($data);
//        return $this->output
//            ->set_content_type('application/json')
//            ->set_status_header(200)
//            ->set_output(json_encode($data, TRUE));

        $this->load->view("psep_sekolah/guru_form", $data);
    }

    function ajax_mapel($kelas)
    {
        $carimapel = $this->Model_adm->fetch_mapel_by_id_kelas($kelas);
        $no = 1; ?>
        <option value="">--Pilih Mata Pelajaran --</option>
        <?php
        foreach ($carimapel as $mapel) {
            ?>
            <option value="<?php echo $mapel->id_mapel ?>"><?php echo $mapel->nama_mapel ?></option>
            <?php
            $no++;
        }

    }

    function proses_tambah()
    {
        $params = $this->input->post(null, true);
        $idsekolah = $this->session->userdata('idsekolah');


        $nama = $params['nama'];
        $email = $params['email'];
        $mapel = $params['Mapel'];
        $username = $params['username'];
        $password = $params['password'];
        $repassword = $params['repassword'];
        $mapel = implode(',', $mapel);


        if ($password !== $repassword) {
            alert_error("Gagal Register", "Password tidak sama");
            redirect("psep_sekolah/guru/tambah");
        } else {

            $cariuserpass = $this->Model_adm->cari_user_psep_sekolah($username, $password);

            if ($cariuserpass === FALSE) {
                $tipe = $this->cek_tipe($_FILES['identitas']['type']);

                if ($tipe !== false) {
                    $img_path = "assets/uploads/identitas/";
                    $namafile = md5($nama) . md5(time()) . $tipe;


                    $config['upload_path'] = $img_path;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $namafile;

                    $this->load->library('upload', $config);
                    $this->upload->do_upload('identitas');

                    $result = $this->Model_psep->tambah_guru(
                        $idsekolah, $nama, $email, $username, $password, $namafile, $mapel);
                    print_r($result);
                    redirect('psep_sekolah/guru');
                } else {
                    alert_error("Gagal Register", "Format file identitas tidak dikenal (gunakan file berformat .jpg/.jpeg/.png)");
                    redirect("psep_sekolah/guru/tambah");
                }
            } else {
                alert_error("Gagal Register", "Username Sudah ada yang memakai, pakai username yang lain!");

                redirect("psep_sekolah/guru/tambah");
            }
        }
    }


    function proses_update()
    {
        $params = $this->input->post(null, true);


        $id_guru = $params['id_guru'];
        $nama = $params['nama'];
        $email = $params['email'];
        $mapel = $params['Mapel'];
        $username = $params['username'];
        $password = $params['password'];
        $repassword = $params['repassword'];
        $mapel = implode(',', $mapel);

        if ($password !== $repassword) {
            alert_error("Gagal Register", "Password tidak sama");
            redirect("psep_sekolah/guru/edit");
        } else {
            $idpsep = $this->session->userdata('idpsepsekolah');
            $carisekolah = $this->Model_psep->cari_sekolah_by_login($idpsep);
            if (count($carisekolah) > 0) {

                $tipe = $this->cek_tipe($_FILES['identitas']['type']);
                if ($tipe !== false) {

                    $img_path = "assets/uploads/identitas/";
                    $namafile = md5($nama) . md5(time()) . $tipe;


                    $config['upload_path'] = $img_path;
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $namafile;

                    $this->load->library('upload', $config);
                    $this->upload->do_upload('identitas');


                    echo "<script>document.location='" . base_url("psep_sekolah/guru") . "';</script>";

                } else {
                    alert_info('Upload Gambar Identitas', 'Gambar Identitas tidak di ubah');
                    $result = $this->Model_psep->update_guru(
                        $id_guru, $nama, $email, $username, $password, $carisekolah->kartu_identitas, $mapel);
                    print_r($result);
                    echo "<script>document.location='" . base_url("psep_sekolah/guru/edit/" . $id_guru) . "';</script>";

                }
            } else {
                echo "<script>document.location='" . base_url("psep_sekolah/guru") . "';</script>";
            }


        }
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

    public function detail($id_login_sekolah)
    {
        $cariguru = $this->Model_psep->guru_by_id_login($id_login_sekolah);
        $carisekolah = $this->Model_psep->fetch_sekolah_by_id($cariguru->id_sekolah);
        $mapel = $this->Model_psep->guru_by_id_login($id_login_sekolah)->id_mapel;
        $carimapel = $this->Model_psep->cari_kelas_in_id_mapel($mapel);
        $data = array(
            'navbar_title' => "Detail  Guru",
            'active'       => "guru",
            'cariguru'     => $cariguru,
            'sekolah'      => $carisekolah,
            'carimapel'    => $carimapel,

        );
//        var_dump($carimapel);
        $this->load->view("psep_sekolah/data_detail_guru", $data);

    }


}

?>