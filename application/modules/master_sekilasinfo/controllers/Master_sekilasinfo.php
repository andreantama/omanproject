<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_sekilasinfo extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_sekilasinfo','master_sekilasinfo');
    }
	
	function index(){
		$data['judul_page'] = 'Sekilas Info';
		$data['des_page'] = '';
		$data['page'] = 'view_sekilasinfo';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addSekilasInfo(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Bank';
		$data['des_page'] = '';
		$data['page'] = 'add_sekilasinfo';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function detailSekilasInfo($id){
		$this->load->library('jariprom_tools');
		$id_sekilasinfo = $this->jariprom_tools->base64_decode_fix($id);
		$detail_sekilasinfo = $this->master_sekilasinfo->tampilData('tbl_sekilas_info','*', array('ID_SEKILAS_INFO' => $id_sekilasinfo), TRUE);
		$data['judul_page'] = 'Detail Sekilas Info';
		$data['des_page'] = '';
		$data['page'] = 'detail_sekilasinfo';
		$data['detail'] = $detail_sekilasinfo;
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addSekilasInfoSubmit(){
		$this->load->library('jariprom_tools');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sekilasinfo', 'Sekilas Info', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_sekilasinfo/addSekilasInfo');
        }
        $data_insert = array(
			'SEKILAS_INFO' => $this->input->post('sekilasinfo', TRUE),
			'TGL_POSTING' => $this->jariprom_tools->tglSekarang(),
			'TIME_POSTING' => $this->jariprom_tools->wktSekarang()
		);
		$this->master_sekilasinfo->tambahData($data_insert,'tbl_sekilas_info');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_sekilasinfo/addSekilasInfo');
	}
	
	function hapusBank($id){
		$this->load->library('jariprom_tools');
		$this->master_sekilasinfo->hapusData('tbl_bank',array('ID_BANK' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_sekilasinfo');
	}
	
	function editSekilasInfoSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('sekilasinfo', 'Sekilas Info', 'required|max_length[250]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_sekilasinfo/detailSekilasInfo/'.$this->input->post('id_sekilasinfo'));
        }
        $data_update = array(
			'SEKILAS_INFO' => $this->input->post('sekilasinfo', TRUE)
		);
		$this->master_sekilasinfo->editData('tbl_sekilas_info', $data_update, array('ID_SEKILAS_INFO' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_sekilasinfo'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_sekilasinfo/detailSekilasInfo/'.$this->input->post('id_sekilasinfo'));
	}
	
	function getSekilasInfo(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_sekilasinfo->setTableDatabase('tbl_sekilas_info');
			$this->master_sekilasinfo->setSelectColumn(array('ID_SEKILAS_INFO','SEKILAS_INFO','TGL_POSTING','TIME_POSTING'));
			$this->master_sekilasinfo->setOrderColumn(array('ID_SEKILAS_INFO','SEKILAS_INFO'));
			$this->master_sekilasinfo->setOrderId(array('ID_SEKILAS_INFO','DESC'));
			$this->master_sekilasinfo->setSearchQuery(array('SEKILAS_INFO'));
			$fetch_data = $this->master_sekilasinfo->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_SEKILAS_INFO;
	            $sub_array[] = $row->SEKILAS_INFO;
	            $sub_array[] = $row->TGL_POSTING.' '.$row->TIME_POSTING;
	            $sub_array[] = '<a href="'.base_url('master_sekilasinfo/detailSekilasInfo/'.$this->jariprom_tools->base64_encode_fix($row->ID_SEKILAS_INFO)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_sekilasinfo/hapusSekilasInfo/'.$this->jariprom_tools->base64_encode_fix($row->ID_SEKILAS_INFO)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_sekilasinfo->get_all_data(),  
	            "recordsFiltered" => $this->master_sekilasinfo->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
