<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jenisptk extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_jenisptk','master_jenisptk');
    }
	
	function index(){
		$data['judul_page'] = 'Master Jenis PTK';
		$data['des_page'] = '';
		$data['page'] = 'view_jenisptk';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addJenisPtk(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Jenis PTK';
		$data['des_page'] = '';
		$data['page'] = 'add_jenisptk';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailJenisPtk($id){
		$this->load->library('jariprom_tools');
		$id_jenisptk = $this->jariprom_tools->base64_decode_fix($id);
		$detail_jenisptk = $this->master_jenisptk->tampilData('tbl_jenis_ptk','*', array('ID_JNS_PTK' => $id_jenisptk), TRUE);
		$data['judul_page'] = 'Detail jenis PTK '.$detail_jenisptk->JNS_PTK;
		$data['des_page'] = '';
		$data['page'] = 'detail_jenisptk';
		$data['detail'] = $detail_jenisptk;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addJenisPtkSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jenisptk', 'Jenis PTK', 'required|is_unique[tbl_jenis_ptk.JNS_PTK]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_jenisptk/addJenisPtk');
        }
        $data_insert = array(
			'JNS_PTK' => $this->input->post('jenisptk', TRUE)
		);
		$this->master_jenisptk->tambahData($data_insert,'tbl_jenis_ptk');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_jenisptk/addJenisPtk');
	}
	
	function hapusJenisPtk($id){
		$this->load->library('jariprom_tools');
		$this->master_jenisptk->hapusData('tbl_jenis_ptk',array('ID_JNS_PTK' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_jenisptk');
	}
	
	function editJenisPtkSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('jenisptk', 'Jenis PTK', 'required');
		if($this->input->post('jenisptk_form') != $this->input->post('jenisptk')){
			$this->form_validation->set_rules('jenisptk', 'Sumber Gaji', 'required|is_unique[tbl_jenis_ptk.JNS_PTK]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_jenisptk/detailJenisPtk/'.$this->input->post('id_jenisptk'));
        }
        $data_update = array(
			'JNS_PTK' => $this->input->post('jenisptk', TRUE)
		);
		$this->master_jenisptk->editData('tbl_jenis_ptk', $data_update, array('ID_JNS_PTK' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_jenisptk'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_jenisptk/detailJenisPtk/'.$this->input->post('id_jenisptk'));
	}
	
	function getJenisPtk(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_jenisptk->setTableDatabase('tbl_jenis_ptk');
			$this->master_jenisptk->setSelectColumn(array('ID_JNS_PTK','JNS_PTK'));
			$this->master_jenisptk->setOrderColumn(array('ID_JNS_PTK','JNS_PTK'));
			$this->master_jenisptk->setOrderId(array('ID_JNS_PTK','DESC'));
			$this->master_jenisptk->setSearchQuery(array('JNS_PTK'));
			$fetch_data = $this->master_jenisptk->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_JNS_PTK;
	            $sub_array[] = $row->JNS_PTK;
	            if(in_array($row->ID_JNS_PTK,array(2,4,5))){
					$hapus = '';
				}
				else{
					$hapus = ' <a href="'.base_url('master_jenisptk/hapusJenisPtk/'.$this->jariprom_tools->base64_encode_fix($row->ID_JNS_PTK)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            if($row->ID_JNS_PTK == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_jenisptk/detailJenisPtk/'.$this->jariprom_tools->base64_encode_fix($row->ID_JNS_PTK)).'" class="btn btn-info btn-sm">Edit</a>'.$hapus;
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_jenisptk->get_all_data(),  
	            "recordsFiltered" => $this->master_jenisptk->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
