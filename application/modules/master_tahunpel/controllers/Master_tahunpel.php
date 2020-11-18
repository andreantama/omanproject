<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_tahunpel extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_tahunpel','master_tahunpel');
    }
	
	function index(){
		$data['judul_page'] = 'Master Tahun Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'view_tahunpel';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addTahunPel(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Tahun Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'add_tahunpel';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailTahunPel($id){
		$this->load->library('jariprom_tools');
		$id_sumbergaji = $this->jariprom_tools->base64_decode_fix($id);
		$detail_sumbergaji = $this->master_tahunpel->tampilData('tbl_sumber_gaji','*', array('ID_SUMBER_GAJI' => $id_sumbergaji), TRUE);
		$data['judul_page'] = 'Detail sumber gaji '.$detail_sumbergaji->SUMBER_GAJI;
		$data['des_page'] = '';
		$data['page'] = 'detail_sumbergaji';
		$data['detail'] = $detail_sumbergaji;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addTahunPelSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('tahunpel', 'Tahun Pelajaran', 'required');
		$this->form_validation->set_rules('semester', 'Semester', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_tahunpel/addTahunPel');
        }
        $data_insert = array(
			'TAHUN_PEL' => $this->input->post('tahunpel', TRUE),
			'SEMESTER' => $this->input->post('semester', TRUE)
		);
		$this->master_tahunpel->tambahData($data_insert,'tbl_tahun_pel');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_tahunpel/addTahunPel');
	}
	
	function hapusSumberGaji($id){
		$this->load->library('jariprom_tools');
		$this->master_tahunpel->hapusData('tbl_sumber_gaji',array('ID_SUMBER_GAJI' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_tahunpel');
	}
	
	function editTahunPelSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('sumbergaji', 'Sumber Gaji', 'required');
		if($this->input->post('sumbergaji_form') != $this->input->post('sumbergaji')){
			$this->form_validation->set_rules('sumbergaji', 'Sumber Gaji', 'required|is_unique[tbl_sumber_gaji.SUMBER_GAJI]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_tahunpel/detailSumberGaji/'.$this->input->post('id_sumbergaji'));
        }
        $data_update = array(
			'SUMBER_GAJI' => $this->input->post('sumbergaji', TRUE)
		);
		$this->master_tahunpel->editData('tbl_sumber_gaji', $data_update, array('ID_SUMBER_GAJI' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_sumbergaji'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_tahunpel/detailSumberGaji/'.$this->input->post('id_sumbergaji'));
	}
	
	function getTahunPel(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_tahunpel->setTableDatabase('tbl_tahun_pel');
			$this->master_tahunpel->setSelectColumn(array('ID_TAHUN_PEL','TAHUN_PEL','SEMESTER'));
			$this->master_tahunpel->setOrderColumn(array('ID_TAHUN_PEL','TAHUN_PEL','SEMESTER'));
			$this->master_tahunpel->setOrderId(array('ID_TAHUN_PEL','DESC'));
			$this->master_tahunpel->setSearchQuery(array('TAHUN_PEL','SEMESTER'));
			$fetch_data = $this->master_tahunpel->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_TAHUN_PEL;
	            $sub_array[] = $row->TAHUN_PEL;
	            $sub_array[] = ($row->SEMESTER == 1 ? "Ganjil" : "Genap");
	            $sub_array[] = '<a href="'.base_url('master_tahunpel/detailTahunPel/'.$this->jariprom_tools->base64_encode_fix($row->ID_TAHUN_PEL)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_tahunpel/hapusTahunPel/'.$this->jariprom_tools->base64_encode_fix($row->ID_TAHUN_PEL)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_tahunpel->get_all_data(),  
	            "recordsFiltered" => $this->master_tahunpel->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
