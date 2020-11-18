<?php defined('BASEPATH') OR exit('No direct script access allowed');

class guru_gantipassword extends MY_Guru {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_guru_gantipassword','guru_gantipassword');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Ganti Password';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['detail'] = $this->session->userdata('user_access_id');
		$data['modul_active'] = 'guru_gantipassword';
		$this->load->view($this->template,$data);
	}
	
	function editAkunSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('con_password', 'Konfirmasi Password', 'required|matches[password]');
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('guru_gantipassword');
        }
        $data_update = array(
			'PASSWORD' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT)
		);
		$this->guru_gantipassword->editData('tbl_guru', $data_update, array('NO_GURU' => $this->session->userdata('user_access_id')));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('guru_gantipassword');
	}
}
