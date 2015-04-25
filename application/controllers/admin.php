<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_kesebelasan');
        $this->load->model('mod_admin');
        $this->load->model('mod_liga');
        $this->load->model('mod_jadwal');
        $this->load->model('mod_hasil');
        
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 23 Jul 2013 05:00:00 GMT");
        
        $this->m_welcome = "<b>Hello World!</b> Selamat datang di administrator area UKM Sepak Bola UTama. Untuk mengakses area ini diperlukan username dan password. Terima kasih.";
        $this->m_not_match = "<b>Whoopps!</b> Nampaknya kombinasi antara username dan password Anda tidak tepat. Silahkan coba lagi. Terima kasih.";
        $this->m_not_found = "<b>Whoopps!</b> Nampaknya kombinasi antara username dan password Anda tidak terdaftar pada database. Silahkan coba lagi atau hubungi developer. Terima kasih.";
        $this->m_not_login = "<b>Whoopps!</b> Untuk mengakses area ini diperlukan username dan password. Terima kasih.";
        $this->m_logout = "<b>Terima kasih!</b> Anda baru saja keluar dari administrator area UKM Sepak Bola UTama.";
    }
    
    public function index(){
        if($this->session->userdata("s_a_username") && $this->session->userdata("s_a_password")){
            //$this->dashboard();
            redirect(site_url().'/admin/liga');
        }else{
            $content["message"] = $this->alert("SUCCESS", $this->m_welcome);
            $content["isi_body"] = "";
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    public function verifikasi(){
        $u = mysql_real_escape_string($this->input->post('username'));
        $p = mysql_real_escape_string($this->input->post('password'));
        $hasil = $this->mod_admin->verifikasi($u,$p);
        if($hasil["message"]=="STATUS_OK"){ 
            $this->buat_session($hasil["username"],$hasil["password"]);
            redirect(site_url().'/admin/liga', 'refresh');
        }else
        if($hasil["message"]=="STATUS_NOT_MATCH"){ 
            $content["message"] = $this->alert("DANGER", $this->m_not_match);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }else
        if($hasil["message"]=="STATUS_NOT_FOUND"){ 
            $content["message"] = $this->alert("DANGER", $this->m_not_found);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    public function buat_session($u,$p){
        $data_session = array(
            "s_a_username"=>$u,
            "s_a_password"=>$p
        );
        $this->session->set_userdata($data_session);
    }
 
    public function dashboard(){
        if($this->session->userdata("s_a_username") && $this->session->userdata("s_a_password")){
            $this->load->view('admin/r_header');
            $content["isi_body"] = $this->load->view('admin/komponen/dashboard','',true);
            $this->load->view('admin/r_body',$content);
            $this->load->view('admin/r_footer');
        }else{
            //$content["message"] = $this->m_not_login;
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    public function liga(){
        if($this->session->userdata("s_a_username") && $this->session->userdata("s_a_password")){
            $content["data_liga"] = $this->mod_liga->get_all_liga();
            if($this->uri->segment(3)==""){
                $content["isi_body"] = $this->load->view('admin/komponen/data_liga',$content,true);
            }else
            if($this->uri->segment(3)=="tambah"){
                $content["isi_body"] = $this->load->view('admin/komponen/form_tambah_liga',$content,true);
            }else
            if($this->uri->segment(3)=="insert"){
                $insert = array(
                    "id" =>  "",
                    "nama_liga" =>  mysql_real_escape_string($this->input->post('nama_liga')),
                    "tahun" =>  mysql_real_escape_string($this->input->post('tahun')),
                    "keterangan" =>  mysql_real_escape_string($this->input->post('keterangan'))
                );
                $this->mod_liga->insert_liga($insert);
                redirect(site_url().'/admin/liga', 'refresh');
            }
            if($this->uri->segment(3)=="delete"){
                $where = array(
                    "id" =>  $this->uri->segment(4)
                );
                $this->mod_liga->delete_liga($where);
                redirect(site_url().'/admin/liga', 'refresh');
            }
            $this->load->view('admin/r_header',$content);
            $this->load->view('admin/r_body',$content);
            $this->load->view('admin/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    public function kelola_jadwal(){
        if($this->session->userdata("s_a_username") && $this->session->userdata("s_a_password")){
            $content["data_liga"] = $this->mod_liga->get_all_liga();
            $content["data_jadwal"] = $this->mod_jadwal->get_all_jadwal();
            $content["data_kesebelasan"] = $this->mod_kesebelasan->get_all_kesebelasan();
            if($this->uri->segment(3)=="liga"){
                if($this->uri->segment(4)==""){
                    $content["isi_body"] = $this->load->view('admin/komponen/data_jadwal',$content,true);
                }else
                if($this->uri->segment(4)=="tambah"){
                    $content["isi_body"] = $this->load->view('admin/komponen/form_tambah_jadwal',$content,true);
                }else
                if($this->uri->segment(4)=="insert"){
                    $insert = array(
                        "id"=>"",
                        "id_liga"=>  mysql_real_escape_string($this->input->post("id_liga")),
                        "id_kesebelasan_1"=>  mysql_real_escape_string($this->input->post("id_kesebelasan_1")),
                        "id_kesebelasan_2"=>  mysql_real_escape_string($this->input->post("id_kesebelasan_2")),
                        "waktu_tempat"=>  mysql_real_escape_string($this->input->post("waktu_tempat"))
                    );
                    $this->mod_jadwal->insert_jadwal($insert);
                    redirect(site_url().'/admin/kelola_jadwal/liga', 'refresh');  
                }
            }
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body',$content);
            $this->load->view('admin/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    public function kelola_hasil(){
        if($this->session->userdata("s_a_username") && $this->session->userdata("s_a_password")){
            $content["data_liga"] = $this->mod_liga->get_all_liga();
            $content["data_jadwal"] = $this->mod_jadwal->get_all_jadwal();
            $content["data_kesebelasan"] = $this->mod_kesebelasan->get_all_kesebelasan();
            $content["data_hasil"] = $this->mod_hasil->get_all_hasil();
            if($this->uri->segment(3)=="liga"){
                if($this->uri->segment(4)==""){
                    $content["isi_body"] = $this->load->view('admin/komponen/data_hasil',$content,true);
                }else
                if($this->uri->segment(4)=="tambah"){
                    $content["isi_body"] = $this->load->view('admin/komponen/form_tambah_hasil',$content,true);
                }else
                if($this->uri->segment(4)=="insert"){
                    $id_kesebelasan_1 = mysql_real_escape_string($this->input->post("id_kesebelasan_1"));
                    $id_kesebelasan_2 = mysql_real_escape_string($this->input->post("id_kesebelasan_2"));
                    
                    if(mysql_real_escape_string($this->input->post("skor_kesebelasan_1")) > mysql_real_escape_string($this->input->post("skor_kesebelasan_2"))){
                        $menang = $id_kesebelasan_1;
                        $kalah = $id_kesebelasan_2;
                        $seri_kesebelasan_1 = "none";
                        $seri_kesebelasan_2 = "none";
                    }else
                    if(mysql_real_escape_string($this->input->post("skor_kesebelasan_1")) < mysql_real_escape_string($this->input->post("skor_kesebelasan_2"))){
                        $menang = $id_kesebelasan_2;
                        $kalah = $id_kesebelasan_1;
                        $seri_kesebelasan_1 = "none";
                        $seri_kesebelasan_2 = "none";
                    }else
                    if(mysql_real_escape_string($this->input->post("skor_kesebelasan_1")) == mysql_real_escape_string($this->input->post("skor_kesebelasan_2"))){
                        $menang = "none";
                        $kalah = "none";
                        $seri_kesebelasan_1 = $id_kesebelasan_1;
                        $seri_kesebelasan_2 = $id_kesebelasan_2;
                    }
                    
                    $insert = array(
                        "id"=>"",
                        "id_jadwal"=>  mysql_real_escape_string($this->input->post("id_jadwal")),
                        "skor_kesebelasan_1"=>  mysql_real_escape_string($this->input->post("skor_kesebelasan_1")),
                        "skor_kesebelasan_2"=>  mysql_real_escape_string($this->input->post("skor_kesebelasan_2")),
                        "menang"=> $menang,
                        "kalah"=> $kalah,
                        "seri_kesebelasan_1"=> $seri_kesebelasan_1,
                        "seri_kesebelasan_2"=> $seri_kesebelasan_2,
                        "pencetak_kesebelasan_1"=>  mysql_real_escape_string($this->input->post("pencetak_kesebelasan_1")),
                        "pencetak_kesebelasan_2"=>  mysql_real_escape_string($this->input->post("pencetak_kesebelasan_2"))
                        
                    );
                    $this->mod_hasil->insert_hasil($insert);
                    redirect(site_url().'/admin/kelola_hasil/liga', 'refresh');  
                }
            }
            $this->load->view('admin/r_header',$content);
            $this->load->view('admin/r_body',$content);
            $this->load->view('admin/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    
    
    function logout(){
        if($this->session->userdata("s_a_username") && $this->session->userdata("s_a_password")){  
            $this->session->sess_destroy();
            $content["message"] = $this->alert("SUCCESS", $this->m_logout);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('admin/r_header');
            $this->load->view('admin/r_body_login',$content);
            $this->load->view('admin/r_footer');
        }
    }
    
    
    function alert($type,$message){
        $t = strtolower($type);
        $uri = "admin/komponen/alert_".$t;  
        $data["message"] = $message;
        return $this->load->view($uri,$data,true);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */