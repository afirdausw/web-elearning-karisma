<?php

/**
 *
 */
class Signup extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("model_signup");
        $this->load->model("model_pg");
        $this->load->model("model_parent");
        $this->load->helper('alert_helper');

        $this->load->library("form_validation");
    }

    function index()
    {
        $siswa_logged = $this->session->userdata('siswa_logged_in');
        if ($siswa_logged) {
            redirect(base_url("profil"));
        } else {
            $kelas_navbar = $this->Model_pg->fetch_all_kelas();
            $data = array(
                'navbar_links'    => $this->Model_pg->get_navbar_links(),
                'select_provinsi' => $this->Model_pg->fetch_all_provinsi(),
                'select_kota'     => $this->Model_pg->fetch_all_kota(),
                'select_sekolah'  => $this->Model_pg->fetch_all_sekolah(),
                'select_kelas'    => $this->Model_pg->fetch_all_kelas(),
                'select_jenjang'  => $this->Model_pg->fetch_options_jenjang(),

                "kelas_navbar" => $kelas_navbar,
            );
            $this->load->view('pg_user/signup', $data);
        }
    }

    function kota($idprovinsi)
    {
        $carikota = $this->Model_signup->get_kota_by_provinsi($idprovinsi);

        foreach ($carikota as $kota) {
            echo "
			<option value='$kota->id_kota'>$kota->nama_kota</option>
		";
        }
    }

    function sekolah($idkota)
    {
        $carisekolah = $this->Model_signup->get_sekolah_by_kota($idkota);

        echo "
		<option value=''>Pilih Sekolah...</option>
	";
        foreach ($carisekolah as $sekolah) {
            echo "
			<option value='$sekolah->id_sekolah'>$sekolah->nama_sekolah</option>
		";
        }
    }

    function kelas($idsekolah)
    {
        if ($idsekolah !== 'sekolahbaru') {
            $carijenjang = $this->Model_signup->cari_jenjang($idsekolah);

            $carikelas = $this->Model_signup->cari_kelas_by_jenjang($carijenjang->jenjang);

            foreach ($carikelas as $kelas) {
                echo "
				<option value='$kelas->id_kelas'>$kelas->alias_kelas</option>
			";
            }
        }
    }

    function save()
    {
        $data = array(
            'navbar_links' => $this->Model_pg->get_navbar_links(),
        );

        $this->form_validation_rules();

        $params = $this->input->post(null, true);
        $nama = isset($params["nama"]) ? $params["nama"] : '';
        $username = isset($params["username"]) ? $params["username"] : '';
        $email = isset($params["email"]) ? $params["email"] : '';
        $jeniskelamin = isset($params["gender"]) ? $params["gender"] : '';
        $telepon = isset($params["nohp"]) ? $params["nohp"] : '';
        $telepon_ortu = isset($params["nohp_ortu"]) ? $params["nohp_ortu"] : '';
        $sekolah = isset($params["sekolah"]) ? $params["sekolah"] : '';
        $kelas = isset($params["kelas"]) ? $params["kelas"] : '';
        $kota = isset($params["kota"]) ? $params["kota"] : '';
        $jenjang = isset($params["jenjang"]) ? $params["jenjang"] : '';
        $sekolahbaru = isset($params["sekolahbaru"]) ? $params["sekolahbaru"] : '';
        $nis = isset($params["nis"]) ? $params["nis"] : '';
        $nisn = isset($params["nisn"]) ? $params["nisn"] : '';
        $password = md5($params["password"]);
        $timestamp = date('Y-m-d H:i:s');

        if ($this->form_validation->run() == FALSE || $this->cek_password($params['password'], $params['password']) == FALSE) {
            alert_error("Error", "Terjadi Kesalahan Saat Signup");
            $this->load->view('pg_user/signup', $data);
            // redirect("signup");
        } else {
            $result = $this->Model_signup->add_user($username, $password, $nama, $email, $telepon, $telepon_ortu, $sekolah, $kelas, $timestamp, $jeniskelamin, $kota, $jenjang, $sekolahbaru, $nis, $nisn);

            $insert_ortu = $this->Model_parent->daftar($result, $nama, $email, $telepon_ortu, $username, $password);

            $last_id = $result;
            $data = [
                'id_kelas' => $kelas,
                'id_siswa' => $last_id,
                'isaktif'  => 0,

            ];
            $this->Model_signup->add_paket($data);


            alert_success("berhasil", "Selamat datang, ".$nama.". Akun anda telah terdaftar, Silahkan melakukan aktivasi untuk memulai belajar di Karisma Academy");
            redirect("login");


//            redirect("login/login_from_signup/" . $username . "/" . $params["katasandi"] . "/" . $nama);
        }

    }

    function cek_password($password, $re_password)
    {
        // return $result, default false.
        $result = false;
        if ((strlen($password) > 3 && $password) === ($re_password && strlen($re_password) > 3)) {
            $result = true;
            // jika memenuhi kriteria(lebih dari 3 karakter dan password=ulang password)
        }
        return $result;
    }

    private function form_validation_rules()
    {
        //set validation rules for each input
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required');
        $this->form_validation->set_rules('nohp', 'Telepon', 'trim|numeric');
        $this->form_validation->set_rules('nohp_ortu', 'Telepon Orang Tua', 'trim|numeric');

        //set custom error message
        $this->form_validation->set_message('required', '%s tidak boleh kosong');
    }

    function ajax_select_kelas()
    {
        $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

        if ($id) {
            $sekolah = $this->Model_pg->fetch_sekolah_by_id($id);
            $dynamic_options = $this->Model_pg->fetch_kelas_by_jenjang($sekolah->jenjang);

            if ($dynamic_options) {
                echo "<option value='' disabled selected>Pilih Kelas...</option>";
                foreach ($dynamic_options as $item) {
                    echo "<option value='" . $item->id_kelas . "'> $item->alias_kelas </option>";
                }
            } else {
                echo "<option value='' disabled='disabled'>Tidak ada data</option>";
            }
        } else {
            return false;
        }
    }

    function ajax_select_kota()
    {
        $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

        if ($id) {
            $dynamic_options = $this->Model_pg->fetch_kota_by_provinsi($id);

            if ($dynamic_options) {
                echo "<option value='' disabled selected>Pilih Kota/Kabupaten...</option>";
                foreach ($dynamic_options as $item) {
                    echo "<option value='" . $item->id_kota . "'> $item->nama_kota </option>";
                }
            } else {
                echo "<option value='' disabled='disabled' selected>Data kota tidak ditemukan...</option>";
            }
        } else {
            return false;
        }
    }

    function ajax_select_sekolah()
    {
        $id = $this->input->post('id', true) ? $this->input->post('id', true) : null;

        if ($id) {
            $dynamic_options = $this->Model_pg->fetch_sekolah_by_kota($id);

            if ($dynamic_options) {
                echo "<option value='' disabled selected>Pilih Sekolah...</option>";
                foreach ($dynamic_options as $item) {
                    echo "<option value='" . $item->id_sekolah . "'> $item->nama_sekolah </option>";
                }
            } else {
                echo "<option value='' disabled='disabled' selected>Data sekolah tidak ditemukan...</option>";
            }
        } else {
            return false;
        }
    }

    function ajax_cek_email()
    {
        $isAvailable = false;

        if ($this->input->post('email') != null) {
            $result = $this->Model_signup->cek_exist_email($this->input->post('email'));
            $isAvailable = !empty($result) ? false : true;
        }

        echo json_encode(array(
            'valid' => $isAvailable,
        ));
    }

    function ajax_cek_username()
    {
        $isAvailable = false;

        if ($this->input->post('pengguna') != null) {
            $result = $this->Model_signup->cek_exist_user($this->input->post('pengguna'));
            $isAvailable = !empty($result) ? false : true;
        }

        echo json_encode(array(
            'valid' => $isAvailable,
        ));
    }

    function ajax_tambah_sekolah()
    {
        $result_id = 0;
        $id_kota = $this->input->post('id_kota');
        $jenjang = $this->input->post('jenjang');
        $sekolah = $this->input->post('sekolah');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
        $alamat = $this->input->post('alamat');

        if (!empty($id_kota) AND !empty($jenjang) AND !empty($sekolah)) {
            //checking if nama sekolah is already exist
            $sekolah_found = $this->Model_pg->check_sekolah_by_nama($sekolah, $id_kota);
            if ($sekolah_found == 0) {
                $result_id = $this->Model_pg->add_sekolah($id_kota, $jenjang, $sekolah, $email, $telepon, $alamat);
            } else {
                $result_id = 0;
            }
        }
        echo json_encode($result_id);
    }

    function cek_akun_fb()
    {
        $fb_id = $this->input->post('id') ? $this->input->post('id') : null;
        $result = FALSE;

        if (!empty($fb_id)) {
            $do_login = $this->Model_signup->cek_akun_fb($fb_id);

            if (empty($do_login)) {
                $result = TRUE;
            }
        }

        echo json_encode($result);
    }

    function ajax_sekolah_baru($idkota, $idsekolah)
    {
        $carisekolah = $this->Model_pg->fetch_sekolah_by_kota($idkota);
        if ($carisekolah) {
            echo "<option value='' disabled selected>Pilih Sekolah...</option>";
            foreach ($carisekolah as $item) {
                echo "<option value='" . $item->id_sekolah . "' ";
                if ($item->id_sekolah == $idsekolah) {
                    echo "selected";
                }
                echo "> $item->nama_sekolah </option>";
            }
        } else {
            echo "<option value='' disabled='disabled' selected>Data sekolah tidak ditemukan...</option>";
        }
    }

    function ajax_select_kelas_baru($id)
    {

        if ($id) {
            $sekolah = $this->Model_pg->fetch_sekolah_by_id($id);
            $dynamic_options = $this->Model_pg->fetch_kelas_by_jenjang($sekolah->jenjang);

            if ($dynamic_options) {
                echo "<option value='' disabled selected>Pilih Kelas...</option>";
                foreach ($dynamic_options as $item) {
                    echo "<option value='" . $item->id_kelas . "'> $item->alias_kelas </option>";
                }
            } else {
                echo "<option value='' disabled='disabled'>Tidak ada data</option>";
            }
        } else {
            return false;
        }
    }

}