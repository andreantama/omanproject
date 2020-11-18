<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pindahkelas extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_pindahkelas','master_pindahkelas');
    }
	
	function index(){
		$data['judul_page'] = 'Pindah Kelas';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_setting';
		$data['data_kelas'] = $this->master_pindahkelas->tampilData('tbl_kelas', '*');
		$this->load->view($this->template,$data);
	}
	
	function pindahKelasSubmit(){
		foreach($this->input->post('id_siswa') as $key){
			 $data_update = array(
				'ID_KELAS' => $this->input->post('id_kelas', TRUE)
			);
			$this->master_pindahkelas->editData('tbl_siswa', $data_update, array('NO_SISWA' => $key));		
		}
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_pindahkelas');
	}
	
	function searchSiswa(){
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->where('NIPD', $this->input->get("q"));
			$this->db->where('ID_KELAS !=', 1);
			$query = $this->db->select('NO_SISWA as id, NAMA as text')->get("tbl_siswa");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
