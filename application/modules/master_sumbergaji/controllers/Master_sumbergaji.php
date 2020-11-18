<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_sumbergaji extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_sumbergaji','master_sumbergaji');
    }
	
	function index(){
		$data['judul_page'] = 'Master Sumber Gaji';
		$data['des_page'] = '';
		$data['page'] = 'view_sumbergaji';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addSumberGaji(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Sumber Gaji';
		$data['des_page'] = '';
		$data['page'] = 'add_sumbergaji';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailSumberGaji($id){
		$this->load->library('jariprom_tools');
		$id_sumbergaji = $this->jariprom_tools->base64_decode_fix($id);
		$detail_sumbergaji = $this->master_sumbergaji->tampilData('tbl_sumber_gaji','*', array('ID_SUMBER_GAJI' => $id_sumbergaji), TRUE);
		$data['judul_page'] = 'Detail sumber gaji '.$detail_sumbergaji->SUMBER_GAJI;
		$data['des_page'] = '';
		$data['page'] = 'detail_sumbergaji';
		$data['detail'] = $detail_sumbergaji;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addSumberGajiSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sumbergaji', 'Sumber Gaji', 'required|is_unique[tbl_sumber_gaji.SUMBER_GAJI]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_sumbergaji/addSumberGaji');
        }
        $data_insert = array(
			'SUMBER_GAJI' => $this->input->post('sumbergaji', TRUE)
		);
		$this->master_sumbergaji->tambahData($data_insert,'tbl_sumber_gaji');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_sumbergaji/addSumberGaji');
	}
	
	function hapusSumberGaji($id){
		$this->load->library('jariprom_tools');
		$this->master_sumbergaji->hapusData('tbl_sumber_gaji',array('ID_SUMBER_GAJI' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_sumbergaji');
	}
	
	function editSumberGajiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('sumbergaji', 'Sumber Gaji', 'required');
		if($this->input->post('sumbergaji_form') != $this->input->post('sumbergaji')){
			$this->form_validation->set_rules('sumbergaji', 'Sumber Gaji', 'required|is_unique[tbl_sumber_gaji.SUMBER_GAJI]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_sumbergaji/detailSumberGaji/'.$this->input->post('id_sumbergaji'));
        }
        $data_update = array(
			'SUMBER_GAJI' => $this->input->post('sumbergaji', TRUE)
		);
		$this->master_sumbergaji->editData('tbl_sumber_gaji', $data_update, array('ID_SUMBER_GAJI' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_sumbergaji'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_sumbergaji/detailSumberGaji/'.$this->input->post('id_sumbergaji'));
	}
	
	function getSumberGaji(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_sumbergaji->setTableDatabase('tbl_sumber_gaji');
			$this->master_sumbergaji->setSelectColumn(array('ID_SUMBER_GAJI','SUMBER_GAJI'));
			$this->master_sumbergaji->setOrderColumn(array('ID_SUMBER_GAJI','SUMBER_GAJI'));
			$this->master_sumbergaji->setOrderId(array('ID_SUMBER_GAJI','DESC'));
			$this->master_sumbergaji->setSearchQuery(array('SUMBER_GAJI'));
			$fetch_data = $this->master_sumbergaji->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_SUMBER_GAJI;
	            $sub_array[] = $row->SUMBER_GAJI;
	            if($row->ID_SUMBER_GAJI == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_sumbergaji/detailSumberGaji/'.$this->jariprom_tools->base64_encode_fix($row->ID_SUMBER_GAJI)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_sumbergaji/hapusSumberGaji/'.$this->jariprom_tools->base64_encode_fix($row->ID_SUMBER_GAJI)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_sumbergaji->get_all_data(),  
	            "recordsFiltered" => $this->master_sumbergaji->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
