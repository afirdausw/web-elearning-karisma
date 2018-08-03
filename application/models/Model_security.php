<?php if(!defined('BASEPATH')) exit('No direct script access allowed!');

class Model_security extends CI_Model{
    public function is_logged_in(){
        if($this->session->userdata('is_logged_in')){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('pg_admin/login');
       }
      }
    public function parent_logged_in(){
    	if($this->session->userdata('parent_logged_in')){
    		return true;        
    	}else{
    		// $this->session->set_flashdata('alert','Anda harus login!');
    		alert_error('Error', 'Anda harus login!');
    		redirect('login');       
    	}	
    }	
	public function psep_sekolah_is_logged_in(){
        if($this->session->userdata('psep_sekolah_is_logged_in')){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('psep_sekolah/login');
       }
      }
     public function guru_is_logged_in(){
        if($this->session->userdata('psep_sekolah_is_logged_in')){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('pg_admin/login');
       }
      }
      
      public function siswa_is_logged_in(){
        if($this->session->userdata('siswa_logged_in')){
             return true;
        }else{
             // $this->session->set_flashdata('alert','Anda harus login!');
             alert_error('Error', 'Anda harus login!');
             redirect('/login');
       }
      }
}
?>