<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kesebelasan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_kesebelasan');
        $this->load->model('mod_kesebelasan');
        $this->load->model('mod_admin');
        $this->load->model('mod_liga');
        $this->load->model('mod_jadwal');
        $this->load->model('mod_hasil');
        $this->load->model('mod_anggota');
        
        
        $this->load->library('upload');
        
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 23 Jul 2013 05:00:00 GMT");
        
        $this->m_welcome = "<b>Hello World!</b> Selamat datang di Panel Kesebelasan area UKM Sepak Bola UTama. Untuk mengakses area ini diperlukan username dan password. Terima kasih.";
        $this->m_not_match = "<b>Whoopps!</b> Nampaknya kombinasi antara username dan password Anda tidak tepat. Silahkan coba lagi. Terima kasih.";
        $this->m_not_found = "<b>Whoopps!</b> Nampaknya kombinasi antara username dan password Anda tidak terdaftar pada database. Silahkan coba lagi atau hubungi developer. Terima kasih.";
        $this->m_not_login = "<b>Whoopps!</b> Untuk mengakses area ini diperlukan username dan password. Terima kasih.";
        $this->m_logout = "<b>Terima kasih!</b> Anda baru saja keluar dari Panel Kesebelasan area UKM Sepak Bola UTama.";
    }
    
    public function index(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){
            //$this->dashboard();
            redirect(site_url().'/kesebelasan/ok');
        }else{
            $content["message"] = $this->alert("SUCCESS", $this->m_welcome);
            $content["isi_body"] = "";
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }
    }
    
    public function verifikasi(){
        $u = mysql_real_escape_string($this->input->post('username'));
        $p = mysql_real_escape_string($this->input->post('password'));
        $hasil = $this->mod_kesebelasan->verifikasi($u,$p);
        if($hasil["message"]=="STATUS_OK"){ 
            $this->buat_session($hasil["id_kesebelasan"],$hasil["username"],$hasil["password"],$hasil["nama_kesebelasan"]);
            redirect(site_url().'/kesebelasan/index/', 'refresh');
        }else
        if($hasil["message"]=="STATUS_NOT_MATCH"){ 
            $content["message"] = $this->alert("DANGER", $this->m_not_match);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }else
        if($hasil["message"]=="STATUS_NOT_FOUND"){ 
            $content["message"] = $this->alert("DANGER", $this->m_not_found);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }
    }
    
    public function buat_session($id,$u,$p,$nama){
        $data_session = array(
            "s_k_id"=>$id,
            "s_k_username"=>$u,
            "s_k_password"=>$p,
            "s_k_nama_kesebelasan"=>$nama,
        );
        $this->session->set_userdata($data_session);
    }
    
    public function ok(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){
            $content["data_liga"] = $this->mod_liga->get_all_liga();
            $content["data_jadwal"] = $this->mod_jadwal->get_all_jadwal();
            $content["data_kesebelasan"] = $this->mod_kesebelasan->get_all_kesebelasan();
            $content["data_hasil"] = $this->mod_hasil->get_all_hasil();
            $content["data_kelasemen"] = $this->mod_hasil->kelasemen();
            
            $content["message"] = $this->alert("SUCCESS", $this->m_welcome);
            $content["id_kesebelasan"] = $this->session->userdata("s_k_id");
            $content["data_anggota"] = $this->mod_anggota->get_all_anggota($content["id_kesebelasan"]);
            $content["isi_body"] = $this->load->view('kesebelasan/komponen/ok',$content,true);
            $content["data_current_kesebelasan"] = $this->mod_kesebelasan->get_current_kesebelasan($this->session->userdata("s_k_id"));
            
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body',$content);
            $this->load->view('kesebelasan/r_footer');
        }else{
               $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
       
        }
    }
    
    public function add_anggota(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){
            $content["message"] = $this->alert("SUCCESS", $this->m_welcome);
            $content["id_kesebelasan"] = $this->session->userdata("s_k_id");
            $content["data_anggota"] = $this->mod_anggota->get_all_anggota($content["id_kesebelasan"]);
            $content["isi_body"] = $this->load->view('kesebelasan/komponen/add_anggota',$content,true);
            $content["data_current_kesebelasan"] = $this->mod_kesebelasan->get_current_kesebelasan($this->session->userdata("s_k_id"));
            
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body',$content);
            $this->load->view('kesebelasan/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }
    }
    
    
    public function ganti_logo(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){
            $content["message"] = $this->alert("SUCCESS", $this->m_welcome);
            $content["id_kesebelasan"] = $this->session->userdata("s_k_id");
            $content["data_anggota"] = $this->mod_anggota->get_all_anggota($content["id_kesebelasan"]);
            $content["isi_body"] = $this->load->view('kesebelasan/komponen/ganti_logo',$content,true);
            $content["data_current_kesebelasan"] = $this->mod_kesebelasan->get_current_kesebelasan($this->session->userdata("s_k_id"));
            
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body',$content);
            $this->load->view('kesebelasan/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }
    }
    
    public function upload_logo(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){
            $content["id_kesebelasan"] = $this->session->userdata("s_k_id");
            $content["data_anggota"] = $this->mod_anggota->get_all_anggota($content["id_kesebelasan"]);
           
            $config['upload_path'] = './upload';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name']= $this->session->userdata("s_k_id").'_'.$this->session->userdata("s_k_nama_kesebelasan");
            $config['max_size']	= '1000';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';
            $config['overwrite']  = 'TRUE';
            $config['remove_spaces']  = 'TRUE';
            //$this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ( ! $this->upload->do_upload('logo')){
                //$content["message"] = "Upload Error";
                //$content["isi_body"] = $this->load->view('kesebelasan/komponen/ganti_logo',$content,true);
                $error = $this->upload->display_errors();
                echo $error;
            }else{
                $res = $this->upload->data();
                $this->mod_kesebelasan->update_logo($this->session->userdata("s_k_id"),$res['file_name']);
                $content["isi_body"] = $this->load->view('kesebelasan/komponen/ok',$content,true);
                redirect(site_url().'/kesebelasan/ok','refresh');
//                $this->load->view('kesebelasan/r_header');
//                $this->load->view('kesebelasan/r_body',$content);
//                $this->load->view('kesebelasan/r_footer');
                
            }
//            $this->load->view('kesebelasan/r_header');
//            $this->load->view('kesebelasan/r_body',$content);
//            $this->load->view('kesebelasan/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }
    }
    
    public function insert(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){
            $content["message"] = $this->alert("SUCCESS", $this->m_welcome);
            $content["id_kesebelasan"] = $this->session->userdata("s_k_id");
            $content["data_anggota"] = $this->mod_anggota->get_all_anggota($content["id_kesebelasan"]);
            
            $insert = array(
                "id" => '',
                "id_kesebelasan" => $content["id_kesebelasan"],
                "nama" => mysql_real_escape_string($this->input->post('nama')), 
                "posisi" => mysql_real_escape_string($this->input->post('posisi')), 
                "no_punggung" => mysql_real_escape_string($this->input->post('no_punggung')), 
                "is_captain" => mysql_real_escape_string($this->input->post('is_captain')) 
            );
            
            if($this->mod_anggota->insert_anggota($insert)){
                redirect(site_url().'/kesebelasan/ok');
            }else{
                $this->load->view('kesebelasan/r_header');
                $this->load->view('kesebelasan/r_body',$content);
                $this->load->view('kesebelasan/r_footer');
            }

        }else{
               $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
       
        }
    }
    
    function logout(){
        if($this->session->userdata("s_k_username") && $this->session->userdata("s_k_password")){  
            $this->session->sess_destroy();
            $content["message"] = $this->alert("SUCCESS", $this->m_logout);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
        }else{
            $content["message"] = $this->alert("DANGER", $this->m_not_login);
            $this->load->view('kesebelasan/r_header');
            $this->load->view('kesebelasan/r_body_login',$content);
            $this->load->view('kesebelasan/r_footer');
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