<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_kepegawaian extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_kepegawaian','master_kepegawaian');
    }
	
	function index(){
		$data['judul_page'] = 'Master Kepegawaian';
		$data['des_page'] = '';
		$data['page'] = 'view_kepegawaian';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addKepegawaian(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Kepegawaian';
		$data['des_page'] = '';
		$data['page'] = 'add_kepegawaian';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailKepegawaian($id){
		$this->load->library('jariprom_tools');
		$id_kepegawaian = $this->jariprom_tools->base64_decode_fix($id);
		$detail_kepegawaian = $this->master_kepegawaian->tampilData('tbl_kepegawaian','*', array('ID_KEPEGAWAIAN' => $id_kepegawaian), TRUE);
		$data['judul_page'] = 'Detail kepegawaian '.$detail_kepegawaian->KEPEGAWAIAN;
		$data['des_page'] = '';
		$data['page'] = 'detail_kepegawaian';
		$data['detail'] = $detail_kepegawaian;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addKepegawaianSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kepegawaian', 'Kepegawaian', 'required|is_unique[tbl_kepegawaian.KEPEGAWAIAN]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_kepegawaian/addKepegawaian');
        }
        $data_insert = array(
			'KEPEGAWAIAN' => $this->input->post('kepegawaian', TRUE)
		);
		$this->master_kepegawaian->tambahData($data_insert,'tbl_kepegawaian');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_kepegawaian/addKepegawaian');
	}
	
	function hapusKepegawaian($id){
		$this->load->library('jariprom_tools');
		$this->master_kepegawaian->hapusData('tbl_kepegawaian',array('ID_KEPEGAWAIAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_kepegawaian');
	}
	
	function editKepegawaianSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('kepegawaian', 'Kepegawaian', 'required');
		if($this->input->post('kepegawaian_form') != $this->input->post('kepegawaian')){
			$this->form_validation->set_rules('kepegawaian', 'Kepegawaian', 'is_unique[tbl_kepegawaian.KEPEGAWAIAN]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_kepegawaian/detailKepegawaian/'.$this->input->post('id_kepegawaian'));
        }
        $data_update = array(
			'KEPEGAWAIAN' => $this->input->post('kepegawaian', TRUE)
		);
		$this->master_kepegawaian->editData('tbl_kepegawaian', $data_update, array('ID_KEPEGAWAIAN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_kepegawaian'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
       redirect('master_kepegawaian/detailKepegawaian/'.$this->input->post('id_kepegawaian'));
	}
	
	function getKepegawaian(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_kepegawaian->setTableDatabase('tbl_kepegawaian');
			$this->master_kepegawaian->setSelectColumn(array('ID_KEPEGAWAIAN','KEPEGAWAIAN'));
			$this->master_kepegawaian->setOrderColumn(array('ID_KEPEGAWAIAN','KEPEGAWAIAN'));
			$this->master_kepegawaian->setOrderId(array('ID_KEPEGAWAIAN','DESC'));
			$this->master_kepegawaian->setSearchQuery(array('KEPEGAWAIAN'));
			$fetch_data = $this->master_kepegawaian->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_KEPEGAWAIAN;
	            $sub_array[] = $row->KEPEGAWAIAN;
	            if($row->ID_KEPEGAWAIAN == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_kepegawaian/detailKepegawaian/'.$this->jariprom_tools->base64_encode_fix($row->ID_KEPEGAWAIAN)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_kepegawaian/hapusKepegawaian/'.$this->jariprom_tools->base64_encode_fix($row->ID_KEPEGAWAIAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_kepegawaian->get_all_data(),  
	            "recordsFiltered" => $this->master_kepegawaian->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
