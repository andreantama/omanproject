<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_jenjangpendidikan extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_jenjangpendidikan','master_jenjangpendidikan');
    }
	
	function index(){
		$data['judul_page'] = 'Master Jenjang Pendidikan';
		$data['des_page'] = '';
		$data['page'] = 'view_jenjangpendidikan';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addJenjangPendidikan(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah jenjang pendidikan';
		$data['des_page'] = '';
		$data['page'] = 'add_jenjangpendidikan';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailJenjangPendidikan($id){
		$this->load->library('jariprom_tools');
		$id_jenjangpendidikan = $this->jariprom_tools->base64_decode_fix($id);
		$detail_jenjangpendidikan = $this->master_jenjangpendidikan->tampilData('tbl_jenjang_pendidikan','*', array('ID_JENJANG_PENDIDIKAN' => $id_jenjangpendidikan), TRUE);
		$data['judul_page'] = 'Detail jenjang pendidikan '.$detail_jenjangpendidikan->JENJANG_PENDIDIKAN;
		$data['des_page'] = '';
		$data['page'] = 'detail_jenjangpendidikan';
		$data['detail'] = $detail_jenjangpendidikan;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addJenjangPendidikanSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jenjangpendidikan', 'Jenjang Pendidikan', 'required|is_unique[tbl_jenjang_pendidikan.JENJANG_PENDIDIKAN]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_jenjangpendidikan/addJenjangPendidikan');
        }
        $data_insert = array(
			'JENJANG_PENDIDIKAN' => $this->input->post('jenjangpendidikan', TRUE)
		);
		$this->master_jenjangpendidikan->tambahData($data_insert, 'tbl_jenjang_pendidikan');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_jenjangpendidikan/addJenjangPendidikan');
	}
	
	function hapusJenjangPendidikan($id){
		$this->load->library('jariprom_tools');
		$this->master_jenjangpendidikan->hapusData('tbl_jenjang_pendidikan',array('ID_JENJANG_PENDIDIKAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_jenjangpendidikan');
	}
	
	function editJenjangPendidikanSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('jenjangpendidikan', 'Jenjang Pendidikan', 'required');
		if($this->input->post('jenjangpendidikan_form') != $this->input->post('jenjangpendidikan')){
			$this->form_validation->set_rules('jenjangpendidikan', 'Jenjang Pendidikan', 'required|is_unique[tbl_jenjang_pendidikan.JENJANG_PENDIDIKAN]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_jenjangpendidikan/detailJenjangPendidikan/'.$this->input->post('id_jenjangpendidikan'));
        }
        $data_update = array(
			'JENJANG_PENDIDIKAN' => $this->input->post('jenjangpendidikan', TRUE)
		);
		$this->master_jenjangpendidikan->editData('tbl_jenjang_pendidikan', $data_update, array('ID_JENJANG_PENDIDIKAN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_jenjangpendidikan'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_jenjangpendidikan/detailJenjangPendidikan/'.$this->input->post('id_jenjangpendidikan'));
	}
	
	function getJenjangPendidikan(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_jenjangpendidikan->setTableDatabase('tbl_jenjang_pendidikan');
			$this->master_jenjangpendidikan->setSelectColumn(array('ID_JENJANG_PENDIDIKAN','JENJANG_PENDIDIKAN'));
			$this->master_jenjangpendidikan->setOrderColumn(array('ID_JENJANG_PENDIDIKAN','JENJANG_PENDIDIKAN'));
			$this->master_jenjangpendidikan->setOrderId(array('ID_JENJANG_PENDIDIKAN','DESC'));
			$this->master_jenjangpendidikan->setSearchQuery(array('JENJANG_PENDIDIKAN'));
			$fetch_data = $this->master_jenjangpendidikan->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_JENJANG_PENDIDIKAN;
	            $sub_array[] = $row->JENJANG_PENDIDIKAN;
	            if($row->ID_JENJANG_PENDIDIKAN == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_jenjangpendidikan/detailJenjangPendidikan/'.$this->jariprom_tools->base64_encode_fix($row->ID_JENJANG_PENDIDIKAN)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_jenjangpendidikan/hapusJenjangPendidikan/'.$this->jariprom_tools->base64_encode_fix($row->ID_JENJANG_PENDIDIKAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_jenjangpendidikan->get_all_data(),  
	            "recordsFiltered" => $this->master_jenjangpendidikan->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
