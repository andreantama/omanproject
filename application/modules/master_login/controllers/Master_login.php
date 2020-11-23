<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_login extends CI_Controller {
	
	var $template = 'home_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_login','master_login');
		
    }
	
	function index(){
		$this->session->set_userdata("a" , "b");
		//echo $this->session->userdata("a");
		$this->load->view('index');
		
	}
	public function cobaya()
	{

		
	}
	
	function loginSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$level = $this->input->post('level', TRUE);
		
		if($this->form_validation->run() == FALSE){
			if($level != 1){
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('clr', 'danger');
				redirect('master_login');
				
			}
			else{
				$this->session->set_flashdata('notif', validation_errors());
				$this->session->set_flashdata('clr', 'info');
				redirect('homepage_loginsiswa');
			}
			
		}
		if($level == 1){
			$cek = $this->master_login->tampilData('tbl_siswa','NO_SISWA, NIPD, PASSWORD',array('NIPD' => $this->input->post('username', TRUE)),TRUE);
			if($cek){
				if(password_verify($this->input->post('password', TRUE), $cek->PASSWORD)){
					$data = array(
						'user_access_id' => $cek->NO_SISWA,
						'user_level' => 1,
						'user_string' => 'siswa'
					);
					$this->session->set_userdata($data);
	            	redirect('siswa_dashboard');
				}
				else{
					$this->session->set_flashdata('notif', 'Password yang Anda masukkan salah.');
					$this->session->set_flashdata('clr', 'danger');
	            	redirect('homepage_loginsiswa');
				}
			}
			else{
				$this->session->set_flashdata('notif', 'NIS yang Anda masukkan tidak terdaftar.');
				$this->session->set_flashdata('clr', 'danger');
	            redirect('homepage_loginsiswa');
			}
		}
		elseif($level == 2){
			$cek = $this->master_login->tampilData('tbl_guru','NO_GURU, NUPTK, PASSWORD',array('NUPTK' => $this->input->post('username', TRUE), 'ID_JNS_PTK' => 5),TRUE);
			if($cek){
				if(password_verify($this->input->post('password', TRUE), $cek->PASSWORD)){
					$data = array(
						'user_access_id' => $cek->NO_GURU,
						'user_level' => 2,
						'user_string' => 'guru_bp'
					);
					$this->session->set_userdata($data);
	            	redirect('gurubp_dashboard');
				}
				else{
					$this->session->set_flashdata('notif', 'Password yang Anda masukkan salah.');
					$this->session->set_flashdata('clr', 'danger');
	            	redirect('master_login');
				}
			}
			else{
				$this->session->set_flashdata('notif', 'Anda tidak memiliki akses menjadi guru BP, hubungi Administrator');
				$this->session->set_flashdata('clr', 'danger');
	            redirect('master_login');
			}
		}
		elseif($level == 3){
			$cek = $this->master_login->tampilData('tbl_guru','NO_GURU, NUPTK, PASSWORD',array('NUPTK' => $this->input->post('username', TRUE)),TRUE);
			if($cek){
				if(password_verify($this->input->post('password', TRUE), $cek->PASSWORD)){
					$data = array(
						'user_access_id' => $cek->NO_GURU,
						'user_level' => 3,
						'user_string' => 'guru'
					);
					$this->session->set_userdata($data);
	            	redirect('guru_dashboard');
				}
				else{
					$this->session->set_flashdata('notif', 'Password yang Anda masukkan salah.');
					$this->session->set_flashdata('clr', 'danger');
	            	redirect('master_login');
				}
			}
			else{
				$this->session->set_flashdata('notif', 'NUPTK yang Anda masukkan tidak terdaftar.');
				$this->session->set_flashdata('clr', 'danger');
	            redirect('master_login');
			}
		}
		elseif($level == 4){
			$cek = $this->master_login->tampilData('tbl_guru','NO_GURU, NUPTK, PASSWORD',array('NUPTK' => $this->input->post('username', TRUE)),TRUE);
			if($cek){
				$cek_wali = $this->master_login->tampilData('tbl_kelas','NO_GURU',array('NO_GURU' => $cek->NO_GURU),TRUE);
				if($cek_wali){
					if(password_verify($this->input->post('password', TRUE), $cek->PASSWORD)){
						$data = array(
							'user_access_id' => $cek->NO_GURU,
							'user_level' => 4,
							'user_string' => 'walikelas'
						);
						$this->session->set_userdata($data);
		            	redirect('walikelas_dashboard');
					}
					else{
						$this->session->set_flashdata('notif', 'Password yang Anda masukkan salah.');
						$this->session->set_flashdata('clr', 'danger');
		            	redirect('master_login');
					}
				}
				else{
					$this->session->set_flashdata('notif', 'Anda bukan Wali Kelas.');
					$this->session->set_flashdata('clr', 'danger');
	            	redirect('master_login');
				}
				
			}
			else{
				$this->session->set_flashdata('notif', 'NUPTK yang Anda masukkan tidak terdaftar.');
				$this->session->set_flashdata('clr', 'danger');
	            redirect('master_login');
			}
		}
		elseif($level == 5){
			
			$cek = $this->master_login->tampilData('tbl_admin','ID_ADMIN, USERNAME, LEVEL, PASSWORD',array('USERNAME' => $this->input->post('username', TRUE)),TRUE);
			if($cek){
				if(password_verify($this->input->post('password', TRUE), $cek->PASSWORD)){
					$data = array(
						'user_access_id' => $cek->ID_ADMIN,
						'user_level' => 5,
						'user_string' => 'admin',
						'level_admin' => $cek->LEVEL // 2 = Admin Master Data, 3 = Admin PPDB, 4 = Admin Web
					);
					
					$this->session->set_userdata($data);
					redirect('master_dashboard');
					//die();
				}
				else{
					$this->session->set_flashdata('notif', 'Password yang Anda masukkan salah.');
					$this->session->set_flashdata('clr', 'danger');
	            	redirect('master_login');
				}
			}
			else{
				$this->session->set_flashdata('notif', 'Username yang Anda masukkan tidak terdaftar.');
				$this->session->set_flashdata('clr', 'danger');
	            redirect('master_login');
			}
		}
	}
	
	function logout(){
		$this->load->library('jariprom_tools');
		$id = $this->session->userdata('user_level');
		$data = array(
			'user_access_id',
			'user_level',
			'user_string',
			'level_admin'
		);
		$update = array(
			'LAST_IP' => $this->input->ip_address(),
			'LAST_LOGIN' => $this->jariprom_tools->tglWktSekarang()
		);
		$this->master_login->editData('tbl_admin',$update,array('ID_ADMIN' => $this->session->userdata('user_access_id')));
		$this->session->unset_userdata($data);
		$this->session->set_flashdata('notif', 'Berhasil Logout');
		$this->session->set_flashdata('clr', 'info');
		if($id == 1){
			redirect('homepage_loginsiswa');	
		}
		else{
			redirect('master_login');	
		}
	}
}