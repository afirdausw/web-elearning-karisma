<?php
if(!defined('BASEPATH')) exit('No direct script access allowed!');
/**
 * Created by PhpStorm.
 * User: Karisma Academy
 * Date: 04 May 2018
 * Time: 13:55
 */

class Model_modul extends CI_Model {

    private $table = "modul";

    function __construct() {
        parent::__construct();
    }

    function get_all_modul() {
        $query = $this->db->get($this->table);
        return $query->result_array();
    }

}