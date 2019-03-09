<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_instruktur extends CI_Model
{

// model untuk manajemen instruktur
// ##################################################
// ##################################################
// ##################################################
    function fetch_instruktur($where="")
    {
        $this->db->select("*");
        $this->db->from("instruktur");
        if($where != ""){
        	$this->db->where($where);
        }

		$query = $this->db->get();
		return $query->row();
    }

    
    function get_mapel_by_instruktur($where="")
    {
        $this->db->select('*');
        $this->db->from('instruktur_mapel');
        $this->db->join('instruktur','instruktur_mapel.id_instruktur = instruktur.id_instruktur');
        $this->db->join('mata_pelajaran','instruktur_mapel.id_mapel = mata_pelajaran.id_mapel');
        $this->db->where($where);
        $this->db->order_by('instruktur_mapel.id_mapel', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
    function get_instruktur_by_mapel($where="")
    {
        $this->db->select('*');
        $this->db->from('instruktur_mapel');
        $this->db->join('instruktur','instruktur_mapel.id_instruktur = instruktur.id_instruktur');
        $this->db->join('mata_pelajaran','instruktur_mapel.id_mapel = mata_pelajaran.id_mapel');
        $this->db->where($where);
        $this->db->order_by('instruktur_mapel.id_mapel', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    function guru_by_id_login($id_login_sekolah)
    {
        $this->db->select("*");
        $this->db->from("login_sekolah");
        $this->db->where("login_sekolah.level", "guru");
        $this->db->where("login_sekolah.id_login_sekolah", $id_login_sekolah);

        $query = $this->db->get();
        return $query->row();

    }

    function fetch_kelas_by_id($idkelas)
    {
        $this->db->select("*");
        $this->db->from("kelas");
        $this->db->where("id_kelas", $idkelas);

        $query = $this->db->get();
        return $query->row();
    }

    function tambah_guru($idsekolah, $nama, $email, $username, $password, $identitas, $mapel)
    {
        $data = array(
            'id_sekolah'      => $idsekolah,
            'username'        => $username,
            'password'        => md5($password),
            'nama'            => $nama,
            'kartu_identitas' => $identitas,
            'email'           => $email,
            'status'          => 0,
            'level'           => 'guru',
            'id_mapel'        => $mapel,
        );
        $result = $this->db->insert('login_sekolah', $data);
        $this->edit_kelas_ampu($this->db->insert_id(), $mapel);
    }

    function update_guru($id_guru, $nama, $email, $username, $password, $identitas, $mapel)
    {
        if ($password != "") {
            $data = array(

                'username'        => $username,
                'password'        => md5($password),
                'nama'            => $nama,
                'kartu_identitas' => $identitas,
                'email'           => $email,
                'id_mapel'        => $mapel,
            );
        }else{
            $data = array(

                'username'        => $username,
                'nama'            => $nama,
                'kartu_identitas' => $identitas,
                'email'           => $email,
                'id_mapel'        => $mapel,
            );
        }
        $this->db->where('id_login_sekolah', $id_guru);
        $result = $this->db->update('login_sekolah', $data);
        $this->edit_kelas_ampu($id_guru, $mapel);
        return $result;
    }

    function edit_kategori($iddiagnostic, $idmapel, $nama, $durasi, $ketuntasan)
    {
        $data = array(
            'id_mapel'      => $idmapel,
            'nama_kategori' => $nama,
            'durasi'        => $durasi,
            'ketuntasan'    => $ketuntasan,
        );

        $this->db->where('id_diagnostic', $iddiagnostic);
        $result = $this->db->update('kategori_diagnostic', $data);
        return $result;
    }

    function edit_kelas_ampu($id, $mapel)
    {
        $this->db->where("id_guru = " . $id . " AND id_mapel IN(" . $mapel . ")");
        $this->db->delete('guru_mapel');
        $mpl = explode(',', $mapel);
        foreach ($mpl as $value) {
            $data = [
                'id_guru'  => $id,
                'id_mapel' => $value
            ];
            $this->db->insert('guru_mapel', $data);
        }
    }


    //Login Instruktur
    function do_login($username, $password)
    {

        $cred = array('username_instruktur' => $username,
                      'password_instruktur' => md5($password),
        );

        $this->db->select('*');
        $this->db->from('instruktur');

        $this->db->where($cred);

        $query = $this->db->get();
        $exist = $query->num_rows();

        if ($exist > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function data_login($username, $password)
    {
        $cred = array('username_instruktur' => $username,
                      'password_instruktur' => md5($password),
        );
        $this->db->select('*');
        $this->db->from('instruktur');

        $this->db->where($cred);

        $query = $this->db->get();

        return $query->row();
    }




// end model untuk instruktur
// ##################################################
// ##################################################
// ##################################################
}