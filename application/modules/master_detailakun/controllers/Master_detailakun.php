<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_detailakun extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_detailakun','master_detailakun');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$detail_admin = $this->master_detailakun->tampilData('tbl_admin','*', array('ID_ADMIN' => $this->session->userdata('user_access_id')), TRUE);
		$data['judul_page'] = 'Detail Akun';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['detail'] = $detail_admin;
		$data['modul_active'] = 'master_detailakun';
		$this->load->view($this->template,$data);
	}
	
	function editAkunSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if($this->input->post('password') != ''){
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('con_password', 'Konfirmasi Password', 'required|matches[password]');
			$pass = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
		}
		else{
			$detail_pass = $this->master_detailakun->tampilData('tbl_admin','PASSWORD', array('ID_ADMIN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_admin'))), TRUE);
        	$pass = $detail_pass->PASSWORD;
		}
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_detailakun');
        }
        $data_update = array(
			'NAME' => $this->input->post('nama', TRUE),
			'PASSWORD' => $pass
		);
		$this->master_detailakun->editData('tbl_admin', $data_update, array('ID_ADMIN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_admin'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_detailakun');
	}
}
