<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_aturtahunpel extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_aturtahunpel','master_aturtahunpel');
    }
	
	function index(){
		$data['judul_page'] = 'Atur Semester';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_setting';
		$data['detail'] = $this->master_aturtahunpel->tampilData('tbl_set_tahunpel', '*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$data['data_semester'] = $this->master_aturtahunpel->tampilData('tbl_tahun_pel');
		$this->load->view($this->template,$data);
	}
	
	function updateSetTahunPelSubmit(){
		$data_update = array(
			'ID_TAHUN_PEL' => $this->input->post('id_tahun_pel', TRUE)
		);
		$this->master_aturtahunpel->editData('tbl_set_tahunpel', $data_update, array('ID_SET_TAHUNPEL' => 1));
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturtahunpel');
	}
}
