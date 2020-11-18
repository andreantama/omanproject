<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gurubp_pesan extends MY_Gurubp {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_gurubp_pesan','gurubp_pesan');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Kirim Pesan';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'gurubp_pesan';
		$this->load->view($this->template,$data);
	}
	
	function searchSiswa(){
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->like('NIPD', $this->input->get("q"));
			$this->db->or_like('NAMA', $this->input->get("q"));
			$query = $this->db->select('NO_SISWA as id, NAMA as text')->get("tbl_siswa");
			$json = $query->result();
		}
		echo json_encode($json);
	}
	
	function kirimPesan(){
		$this->load->library('jariprom_tools');
		foreach($this->input->post('id_siswa') as $key){
			 $data_insert = array(
				'SUBJECT' => $this->input->post('judul', TRUE),
				'ISI_PESAN' => $this->input->post('pengumuman', TRUE),
				'STS_READ' => 0,
				'TGL_KIRIM' => $this->jariprom_tools->tglSekarang(),
				'WKT_KIRIM' => $this->jariprom_tools->wktSekarang(),
				'LEVEL' => 0,
				'NO_SISWA' => $key,
				'NO_GURU' => $this->session->userdata('user_access_id')
			);
			$this->gurubp_pesan->tambahData($data_insert,'tbl_pesan');
		}
		$this->session->set_flashdata('notif', "Berhasil mengirim pesan");
		$this->session->set_flashdata('clr', 'success');
		redirect('gurubp_pesan');
	}
}
