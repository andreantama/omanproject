<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_sistempendik extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_sistempendik','master_sistempendik');
    }
	
	function index(){
		$data['judul_page'] = 'Master Sistem Pendidikan';
		$data['des_page'] = '';
		$data['page'] = 'view_sistempendik';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addSistemPendik(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Sistem Pendidikan';
		$data['des_page'] = '';
		$data['page'] = 'add_sistempendik';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function detailSistemPendik($id){
		$this->load->library('jariprom_tools');
		$id_sistempendik = $this->jariprom_tools->base64_decode_fix($id);
		$detail_sistempendik = $this->master_sistempendik->tampilData('tbl_sistem_pendidikan','*', array('ID_SISTEM_PENDIDIKAN' => $id_sistempendik), TRUE);
		$data['judul_page'] = 'Detail Sistem Pendidikan '.$detail_sistempendik->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'detail_sistempendik';
		$data['detail'] = $detail_sistempendik;
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addSistemPendikSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('font', 'Font', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_sistempendik/addSistemPendik');
        }
        $data_insert = array(
			'NAMA' => $this->input->post('nama', TRUE),
			'DESKRIPSI' => $this->input->post('deskripsi', TRUE),
			'FONT' => $this->input->post('font', TRUE)
		);
		$this->master_sistempendik->tambahData($data_insert,'tbl_sistem_pendidikan');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_sistempendik/addSistemPendik');
	}
	
	function hapusSistemPendik($id){
		$this->load->library('jariprom_tools');
		$this->master_sistempendik->hapusData('tbl_sistem_pendidikan',array('ID_SISTEM_PENDIDIKAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_sistempendik');
	}
	
	function editSistemPendikSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('font', 'Font', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_sistempendik/detailSistemPendik/'.$this->input->post('id_sistempendik'));
        }
        $data_update = array(
			'NAMA' => $this->input->post('nama', TRUE),
			'DESKRIPSI' => $this->input->post('deskripsi', TRUE),
			'FONT' => $this->input->post('font', TRUE)
		);
		$this->master_sistempendik->editData('tbl_sistem_pendidikan', $data_update, array('ID_SISTEM_PENDIDIKAN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_sistempendik'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_sistempendik/detailSistemPendik/'.$this->input->post('id_sistempendik'));
	}
	
	function getSistemPendik(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_sistempendik->setTableDatabase('tbl_sistem_pendidikan');
			$this->master_sistempendik->setSelectColumn(array('ID_SISTEM_PENDIDIKAN','NAMA','FONT'));
			$this->master_sistempendik->setOrderId(array('ID_SISTEM_PENDIDIKAN','DESC'));
			$this->master_sistempendik->setSearchQuery(array('NAMA'));
			$fetch_data = $this->master_sistempendik->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_SISTEM_PENDIDIKAN;
	            $sub_array[] = $row->NAMA;
	            $sub_array[] = $row->FONT;
	            $sub_array[] = '<a href="'.base_url('master_sistempendik/detailSistemPendik/'.$this->jariprom_tools->base64_encode_fix($row->ID_SISTEM_PENDIDIKAN)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_sistempendik/hapusSistemPendik/'.$this->jariprom_tools->base64_encode_fix($row->ID_SISTEM_PENDIDIKAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_sistempendik->get_all_data(),  
	            "recordsFiltered" => $this->master_sistempendik->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
