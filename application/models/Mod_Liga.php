<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Liga extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function get_all_liga(){
        $query = $this->db->get("liga");
        return $query->result();
    }
    
    function insert_liga($insert){
        $hasil = $this->db->insert('liga',$insert);
        return $hasil;
    }
    
    function delete_liga($where){
        $hasil = $this->db->delete('liga', $where);
        return $hasil;
    }
    
     
}

