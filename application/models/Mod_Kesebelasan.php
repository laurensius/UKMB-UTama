<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_Kesebelasan extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    
    
    function submit_registrasi($submit){
        $hasil = $this->db->insert('kesebelasan',$submit);
        return $hasil;
    }
    
    function verifikasi($u,$p){
        $query = $this->db->query("select * from kesebelasan where username='$u'");
        $data = array();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                if(md5($row->password) == md5($p)){
                    $data["message"] = "STATUS_OK";
                    $data["id_kesebelasan"] = $row->id;
                    $data["username"] = $row->username;
                    $data["password"] = md5($row->password);
                    $data["nama_kesebelasan"] = $row->nama_kesebelasan;
                }else{
                    $data["message"] = "STATUS_NOT_MATCH";
                    $data["username"] = "";
                    $data["password"] = "";
                }
            }
        }else
        if($query->num_rows()==0){
            $data["message"] = "STATUS_NOT_FOUND";
            $data["username"] = "";
            $data["password"] = "";
        }
        return $data;
    }
    
    
    function get_all_kesebelasan(){
        $query = $this->db->get("kesebelasan");
        return $query->result();
    }
    
    function get_current_kesebelasan($id){
        $this->db->select('*');
        $this->db->from('kesebelasan');
        $this->db->where('id', $id); 
        $query = $this->db->get();
        return $query->result();
    }
    
    function update_logo($id,$logo){
        $data = array('logo'=>$logo);
        $this->db->where('id', $id);    
        $this->db->update('kesebelasan', $data);    
    }
}

