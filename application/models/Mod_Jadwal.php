<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Jadwal extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function get_all_jadwal(){
        $query = $this->db->get("jadwal"); 
        return $query->result();
    }
    
    function insert_jadwal($insert){
        $hasil = $this->db->insert("jadwal",$insert);
        return $hasil;
    }
     
}

