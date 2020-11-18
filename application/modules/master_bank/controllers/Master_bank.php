<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_bank extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_bank','master_bank');
    }
	
	function index(){
		$data['judul_page'] = 'Master Bank';
		$data['des_page'] = '';
		$data['page'] = 'view_bank';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template, $data);
	}
	
	function addBank(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Bank';
		$data['des_page'] = '';
		$data['page'] = 'add_bank';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailBank($id){
		$this->load->library('jariprom_tools');
		$id_bank = $this->jariprom_tools->base64_decode_fix($id);
		$detail_bank = $this->master_bank->tampilData('tbl_bank','*', array('ID_BANK' => $id_bank), TRUE);
		$data['judul_page'] = 'Detail bank '.$detail_bank->BANK;
		$data['des_page'] = '';
		$data['page'] = 'detail_bank';
		$data['detail'] = $detail_bank;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addBankSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bank', 'Bank', 'required|is_unique[tbl_bank.BANK]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_bank/addBank');
        }
        $data_insert = array(
			'BANK' => $this->input->post('bank', TRUE)
		);
		$this->master_bank->tambahData($data_insert,'tbl_bank');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_bank/addBank');
	}
	
	function hapusBank($id){
		$this->load->library('jariprom_tools');
		$this->master_bank->hapusData('tbl_bank',array('ID_BANK' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_bank');
	}
	
	function editBankSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('bank', 'Bank', 'required');
		if($this->input->post('bank_form') != $this->input->post('bank')){
			$this->form_validation->set_rules('bank', 'bank', 'required|is_unique[tbl_bank.BANK]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_bank/detailBank/'.$this->input->post('id_bank'));
        }
        $data_update = array(
			'BANK' => $this->input->post('bank', TRUE)
		);
		$this->master_bank->editData('tbl_bank', $data_update, array('ID_BANK' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_bank'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_bank/detailBank/'.$this->input->post('id_bank'));
	}
	
	function getBank(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_bank->setTableDatabase('tbl_bank');
			$this->master_bank->setSelectColumn(array('ID_BANK','BANK'));
			$this->master_bank->setOrderColumn(array('ID_BANK','BANK'));
			$this->master_bank->setOrderId(array('ID_BANK','DESC'));
			$this->master_bank->setSearchQuery(array('BANK'));
			$fetch_data = $this->master_bank->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_BANK;
	            $sub_array[] = $row->BANK;
	            if($row->ID_BANK == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_bank/detailBank/'.$this->jariprom_tools->base64_encode_fix($row->ID_BANK)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_bank/hapusBank/'.$this->jariprom_tools->base64_encode_fix($row->ID_BANK)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_bank->get_all_data(),  
	            "recordsFiltered" => $this->master_bank->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
