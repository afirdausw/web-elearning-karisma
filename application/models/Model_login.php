<?php

/**
 *
 */
class Model_login extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function cek_login($username, $password)
    {
        $result = null;
        //old - Not Used
        // $data = array(
        // 	"username" => $username,
        // 	"password" => md5($password)
        // 	);

        $this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.kelas, siswa.email, siswa.foto, siswa.last_login, login_siswa.username");
        $this->db->from("login_siswa");
        $this->db->join("siswa", "siswa.id_login = login_siswa.id_login");
        $this->db->where("(username = '$username' OR email = '$username' OR siswa.NISN = '$username')");
        // $this->db->where('username', $username);
        // $this->db->or_where('email', $username);
        $this->db->where('password', md5($password));
        // echo $this->db->_compile_select();
        // die();
        // $result = $this->db->get();
        // return $result->row_array();
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

    function cek_login_ortu($username, $password)
    {
        $result = null;
        //old - Not Used
        // $data = array(
        // 	"username" => $username,
        // 	"password" => md5($password)
        // 	);

        $this->db->select("*");
        $this->db->from("parents");
        $this->db->join("siswa", "siswa.id_siswa = parents.id_siswa");
        $this->db->where("(parents.username = '$username' OR parents.email = '$username')");
        // $this->db->where('parents.username', $username);
        // $this->db->or_where('parents.email', $username);
        $this->db->where('parents.password', md5($password));
        // echo $this->db->_compile_select();
        // die();
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

    function cek_akun_fb($fb_id)
    {
        $this->db->select("siswa.id_siswa, siswa.nama_siswa, siswa.email, siswa.foto, siswa.last_login, login_siswa.username, login_siswa.fb_id");
        $this->db->from("login_siswa");
        $this->db->join("siswa", "siswa.id_login = login_siswa.id_login");
        $this->db->where('login_siswa.fb_id', $fb_id);
        // echo $this->db->_compile_select();
        $query = $this->db->get();

        return $query->row_array();
    }

    function cek_user_akses($id_siswa)
    {
        $this->db->select("paket_aktif.id_paket_aktif, paket_aktif.id_siswa, paket_aktif.id_kelas, paket_aktif.id_paket, paket_aktif.expired_on, paket_aktif.isaktif, paket.tipe ");
        $this->db->from("paket_aktif");
        // $this->db->join("pembayaran", "pembayaran.id_pembayaran = paket_aktif.id_pembayaran");
        $this->db->join("paket", "paket.id_paket = paket_aktif.id_paket");
        $this->db->where('paket_aktif.id_siswa', $id_siswa);
        $this->db->where('paket_aktif.isaktif', 1); //selecting only the active paket
        // echo $this->db->_compile_select();
        $query = $this->db->get();

        return $query->result();
    }

    function set_to_inactive($id_paket_aktif)
    {
        $this->db->set('isaktif', 0); //set paket to 'not active'
        $this->db->where('paket_aktif.id_paket_aktif', $id_paket_aktif);
        $result = $this->db->update('paket_aktif');

        return $result;
    }

    function get_id_materipokok($mapel_id)
    {
        $this->db->order_by("urutan", "asc");
        $this->db->where('mapel_id', $mapel_id);
        $result = $this->db->get('materi_pokok');

        return $result->result_array();
    }

    /*
    PRETEST
    =========
    */
    

    function daftar_pretest($nama, $telepon, $email, $alamat, $time){
        $result     = null;
        $data_user  = array(
            "nama_siswa_pretest" => $nama,
            "telepon_siswa_pretest" => $telepon,
            "email_siswa_pretest" => $email,
            "alamat" => $alamat,
            "timestamp_signup" => $time,
        );
        $this->db->insert("siswa_pretest", $data_user);
        $id_sesi = $this->db->insert_id();
        return $id_sesi;
    }
    function update_pretest($nama, $telepon, $email, $alamat, $time){
        $result     = null;
        $data_user  = array(
            "nama_siswa_pretest" => $nama,
            "telepon_siswa_pretest" => $telepon,
            "email_siswa_pretest" => $email,
            "alamat" => $alamat,
            "timestamp_signup" => $time,
        );
        $this->db->where("
            nama_siswa_pretest= '$nama'
            AND telepon_siswa_pretest = '$telepon'
            AND email_siswa_pretest = '$email'
            AND alamat = '$alamat'");
        $this->db->update("siswa_pretest", $data_user);
        $this->db->where("
            nama_siswa_pretest= '$nama'
            AND telepon_siswa_pretest = '$telepon'
            AND email_siswa_pretest = '$email'
            AND alamat = '$alamat'
            AND timestamp_signup = '$time'");
        return $this->db->get('siswa_pretest')->row()->id_siswa_pretest;
    }
    function cek_pretest_sebelumnya($nama, $telepon, $email, $alamat){
        $this->db->select("*");
        $this->db->from("siswa_pretest");
        $this->db->where("
            nama_siswa_pretest= '$nama'
            AND telepon_siswa_pretest = '$telepon'
            AND email_siswa_pretest = '$email'
            AND alamat = '$alamat'");
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

    function cek_pretest_namaemail($nama, $email){
        $this->db->select("nama_siswa, email");
        $this->db->from("siswa");
        $this->db->where("((nama_siswa = '$nama' AND email = '$email') OR email = '$email')");
        $query = $this->db->get();
        $data = $query->row();
        return $data;
    }

}