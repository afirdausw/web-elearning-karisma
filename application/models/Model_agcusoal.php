<?php
class Model_agcusoal extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_soal($table) {
        return $this->db->get($table);
    }

    function get_soal_by_id($table, $parameter) {
        $this->db->where($parameter);
        return $this->db->get($table);
    }

    function update_soal_by_id($table, $data, $parameter) {
        $this->db->where($parameter);
        return $this->db->update($table, $data);
    }
}
?>