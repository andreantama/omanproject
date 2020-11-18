<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pekerjaan extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_pekerjaan','master_pekerjaan');
    }
	
	function index(){
		$data['judul_page'] = 'Master Pekerjaan';
		$data['des_page'] = '';
		$data['page'] = 'view_pekerjaan';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addPekerjaan(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Pekerjaan';
		$data['des_page'] = '';
		$data['page'] = 'add_pekerjaan';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailPekerjaan($id){
		$this->load->library('jariprom_tools');
		$id_pekerjaan = $this->jariprom_tools->base64_decode_fix($id);
		$detail_pekerjaan = $this->master_pekerjaan->tampilData('tbl_pekerjaan','*', array('ID_PEKERJAAN' => $id_pekerjaan), TRUE);
		$data['judul_page'] = 'Detail pekerjaan '.$detail_pekerjaan->PEKERJAAN;
		$data['des_page'] = '';
		$data['page'] = 'detail_pekerjaan';
		$data['detail'] = $detail_pekerjaan;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addPekerjaanSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|is_unique[tbl_pekerjaan.PEKERJAAN]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_pekerjaan/addPekerjaan');
        }
        $data_insert = array(
			'PEKERJAAN' => $this->input->post('pekerjaan', TRUE)
		);
		$this->master_pekerjaan->tambahData($data_insert,'tbl_pekerjaan');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_pekerjaan/addPekerjaan');
	}
	
	function hapusPekerjaan($id){
		$this->load->library('jariprom_tools');
		$this->master_pekerjaan->hapusData('tbl_pekerjaan',array('ID_PEKERJAAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_pekerjaan');
	}
	
	function editPekerjaanSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
		if($this->input->post('pekerjaan_form') != $this->input->post('pekerjaan')){
			$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'is_unique[tbl_pekerjaan.PEKERJAAN]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_pekerjaan/detailPekerjaan/'.$this->input->post('id_pekerjaan'));
        }
        $data_update = array(
			'PEKERJAAN' => $this->input->post('pekerjaan', TRUE)
		);
		$this->master_pekerjaan->editData('tbl_pekerjaan', $data_update, array('ID_PEKERJAAN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_pekerjaan'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
       redirect('master_pekerjaan/detailPekerjaan/'.$this->input->post('id_pekerjaan'));
	}
	
	function getPekerjaan(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_pekerjaan->setTableDatabase('tbl_pekerjaan');
			$this->master_pekerjaan->setSelectColumn(array('ID_PEKERJAAN','PEKERJAAN'));
			$this->master_pekerjaan->setOrderColumn(array('ID_PEKERJAAN','PEKERJAAN'));
			$this->master_pekerjaan->setOrderId(array('ID_PEKERJAAN','DESC'));
			$this->master_pekerjaan->setSearchQuery(array('PEKERJAAN'));
			$fetch_data = $this->master_pekerjaan->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_PEKERJAAN;
	            $sub_array[] = $row->PEKERJAAN;
	            if($row->ID_PEKERJAAN == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_pekerjaan/detailPekerjaan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PEKERJAAN)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_pekerjaan/hapusPekerjaan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PEKERJAAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_pekerjaan->get_all_data(),  
	            "recordsFiltered" => $this->master_pekerjaan->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
