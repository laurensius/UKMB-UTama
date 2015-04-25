<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_kesebelasan');
        $this->load->model('mod_admin');
        $this->load->model('mod_liga');
        $this->load->model('mod_jadwal');
        $this->load->model('mod_hasil');
        $this->load->model('mod_anggota');
    }
    
    public function index(){
        //$data["isi_body"] = "test";
        $content["data_liga"] = $this->mod_liga->get_all_liga();
        $content["data_jadwal"] = $this->mod_jadwal->get_all_jadwal();
        $content["data_kesebelasan"] = $this->mod_kesebelasan->get_all_kesebelasan();
        $content["data_hasil"] = $this->mod_hasil->get_all_hasil();
        $content["data_kelasemen"] = $this->mod_hasil->kelasemen();
        $content["message"] = "";
        $content["registrasi"] = $this->load->view('site/komponen/form_registrasi',$content,true);
        $this->load->view('site/site',$content);
    }
    
    public function detail(){
        $content["data_liga"] = $this->mod_liga->get_all_liga();
        $content["data_jadwal"] = $this->mod_jadwal->get_all_jadwal();
        $content["data_kesebelasan"] = $this->mod_kesebelasan->get_all_kesebelasan();
        $content["data_hasil"] = $this->mod_hasil->get_all_hasil();
        $content["data_kelasemen"] = $this->mod_hasil->kelasemen();
        $content["id_kesebelasan"] = $this->uri->segment(3);
        $content["data_anggota"] = $this->mod_anggota->get_all_anggota($this->uri->segment(3));
        $content["isi_body"] = $this->load->view('site/komponen/detail',$content,true);
        $content["data_current_kesebelasan"] = $this->mod_kesebelasan->get_current_kesebelasan($this->uri->segment(3));

        $this->load->view('site/detail',$content);
    }
    
    
    public function submit_registrasi(){
        $submit = array(
            "id" => "",
            "username" => $this->input->post('username'),
            "password" => $this->input->post('password'),
            "email" => $this->input->post('email'),
            "nama_kesebelasan" => $this->input->post('nama_kesebelasan'),
            "nama_manager" => $this->input->post('nama_manager'),
            "id_liga" => $this->input->post('idliga'),
            "logo" => 'logoukm.png');
        $result = $this->mod_kesebelasan->submit_registrasi($submit);
        if($result){
            $content["message"] = "OK";
        }else{
            $content["message"] = "FAILED";
        }
        redirect(site_url());
    }
    
//    public function kelasemen(){
//        $data["data_kelasemen"] = $this->mod_hasil->kelasemen();
//        $this->load->view('site/r_header');
//        $this->load->view('site/komponen/kelasemen',$data);
//        $this->load->view('site/r_footer');
//    }
}

