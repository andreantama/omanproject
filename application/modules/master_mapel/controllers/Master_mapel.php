<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_mapel extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_mapel','master_mapel');
    }
	
	function index(){
		$data['judul_page'] = 'Master Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'view_mapel';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addMapel(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'add_mapel';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailMapel($id){
		$this->load->library('jariprom_tools');
		$id_mapel = $this->jariprom_tools->base64_decode_fix($id);
		$detail_mapel = $this->master_mapel->tampilData('tbl_mapel','*', array('ID_MAPEL' => $id_mapel), TRUE);
		$data['judul_page'] = 'Detail mata pelajaran '.$detail_mapel->MAPEL;
		$data['des_page'] = '';
		$data['page'] = 'detail_mapel';
		$data['detail'] = $detail_mapel;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addMapelSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required|is_unique[tbl_mapel.MAPEL]');
		$this->form_validation->set_rules('kkm', 'KKM', 'required|numeric');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_mapel/addMapel');
        }
        $data_insert = array(
			'MAPEL' => $this->input->post('nama_mapel', TRUE),
			'KKM' => $this->input->post('kkm', TRUE)
		);
		$this->master_mapel->tambahData($data_insert,'tbl_mapel');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
       redirect('master_mapel/addMapel');
	}
	
	function hapusKelas($id){
		$this->load->library('jariprom_tools');
		$this->master_mapel->hapusData('tbl_mapel',array('ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_mapel');
	}
	
	function editMapelSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required');
		$this->form_validation->set_rules('kkm', 'KKM', 'required|numeric');
		if($this->input->post('nama_mapel_form') != $this->input->post('nama_mapel')){
			$this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'is_unique[tbl_mapel.MAPEL]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_mapel/detailMapel/'.$this->input->post('id_nama_mapel'));
        }
        $data_update = array(
			'MAPEL' => $this->input->post('nama_mapel', TRUE),
			'KKM' => $this->input->post('kkm', TRUE)
		);
		$this->master_mapel->editData('tbl_mapel', $data_update, array('ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_nama_mapel'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_mapel/detailMapel/'.$this->input->post('id_nama_mapel'));
	}
	
	function getMapel(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_mapel->setTableDatabase('tbl_mapel');
			$this->master_mapel->setSelectColumn(array('ID_MAPEL','MAPEL','KKM'));
			$this->master_mapel->setOrderColumn(array('ID_MAPEL','MAPEL'));
			$this->master_mapel->setOrderId(array('ID_MAPEL','DESC'));
			$this->master_mapel->setSearchQuery(array('MAPEL'));
			$fetch_data = $this->master_mapel->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_MAPEL;
	            $sub_array[] = $row->MAPEL;
	            $sub_array[] = $row->KKM;
	            $sub_array[] = '<a href="'.base_url('master_mapel/detailMapel/'.$this->jariprom_tools->base64_encode_fix($row->ID_MAPEL)).'" class="btn btn-info btn-sm">Edit</a>';  
	            $data[] = $sub_array;
	        }
	        $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_mapel->get_all_data(),  
	            "recordsFiltered" => $this->master_mapel->get_filtered_data(),  
	            "data" => $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
