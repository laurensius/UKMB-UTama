<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Anggota extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function get_all_anggota($id_kesebelasan){
        $query = $this->db->query("select * from anggota where id_kesebelasan='$id_kesebelasan'"); 
        return $query->result();
    }
    
    function insert_anggota($insert){
        $hasil = $this->db->insert("anggota",$insert);
        return $hasil;
    }
}

