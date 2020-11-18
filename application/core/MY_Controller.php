<?php
	class MY_Controller extends CI_Controller{
		
	}
	
	class MY_Admin extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("user_access_id") == FALSE){
				$this->session->set_flashdata('notif', 'Sesi Anda telah habis, silahkan login kembali');
				$this->session->set_flashdata('clr', 'info');
				redirect("master_login");
			}
			else{
				if($this->session->userdata("user_level") != 5 and $this->session->userdata("user_string") != 'admin'){
					$this->session->set_flashdata('notif', 'Anda tidak diperbolehkan mengakses halaman ini. Silahkan login sebagai Admin.');
					$this->session->set_flashdata('clr', 'danger');
					redirect("master_login");
				}
			}
		}
	}
	
	class MY_Guru extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("user_access_id") == FALSE){
				$this->session->set_flashdata('notif', 'Sesi Anda telah habis, silahkan login kembali');
				$this->session->set_flashdata('clr', 'info');
				redirect("master_login");
			}
			else{
				if($this->session->userdata("user_level") != 3 and $this->session->userdata("user_string") != 'guru'){
					$this->session->set_flashdata('notif', 'Anda tidak diperbolehkan mengakses halaman ini. Silahkan login sebagai Guru.');
					$this->session->set_flashdata('clr', 'danger');
					redirect("master_login");
				}
			}
		}
	}
	
	class MY_Gurubp extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("user_access_id") == FALSE){
				$this->session->set_flashdata('notif', 'Sesi Anda telah habis, silahkan login kembali');
				$this->session->set_flashdata('clr', 'info');
				redirect("master_login");
			}
			else{
				if($this->session->userdata("user_level") != 2 and $this->session->userdata("user_string") != 'guru_bp'){
					$this->session->set_flashdata('notif', 'Anda tidak diperbolehkan mengakses halaman ini. Silahkan login sebagai Guru BP.');
					$this->session->set_flashdata('clr', 'danger');
					redirect("master_login");
				}
			}
		}
	}
	
	class MY_Walikelas extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("user_access_id") == FALSE){
				$this->session->set_flashdata('notif', 'Sesi Anda telah habis, silahkan login kembali');
				$this->session->set_flashdata('clr', 'info');
				redirect("master_login");
			}
			else{
				if($this->session->userdata("user_level") != 4 and $this->session->userdata("user_string") != 'walikelas'){
					$this->session->set_flashdata('notif', 'Anda tidak diperbolehkan mengakses halaman ini. Silahkan login sebagai Wali Kelas.');
					$this->session->set_flashdata('clr', 'danger');
					redirect("master_login");
				}
			}
		}
	}
	
	class MY_Siswa extends MY_Controller{
		
		public function __construct(){
			parent:: __construct();
			if($this->session->userdata("user_access_id") == FALSE){
				$this->session->set_flashdata('notif', 'Sesi Anda telah habis, silahkan login kembali');
				$this->session->set_flashdata('clr', 'info');
				redirect("master_login");
			}
			else{
				if($this->session->userdata("user_level") != 1 and $this->session->userdata("user_string") != 'siswa'){
					$this->session->set_flashdata('notif', 'Anda tidak diperbolehkan mengakses halaman ini. Silahkan login sebagai Siswa.');
					$this->session->set_flashdata('clr', 'danger');
					redirect("master_login");
				}
			}
			
		}
	}
	
?>