<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_alattransportasi extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_alattransportasi','master_alattransportasi');
    }
	
	function index(){
		$data['judul_page'] = 'Master Alat Transportasi';
		$data['des_page'] = '';
		$data['page'] = 'view_alattransportasi';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addAlatTransportasi(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Alat Transportasi';
		$data['des_page'] = '';
		$data['page'] = 'add_alattransportasi';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailAlatTransportasi($id){
		$this->load->library('jariprom_tools');
		$id_alattransportasi = $this->jariprom_tools->base64_decode_fix($id);
		$detail_alattransportasi = $this->master_alattransportasi->tampilData('tbl_alat_transportasi','*', array('ID_ALAT_TRANSPORTASI' => $id_alattransportasi), TRUE);
		$data['judul_page'] = 'Detail alat transportasi '.$detail_alattransportasi->ALAT_TRANSPORTASI;
		$data['des_page'] = '';
		$data['page'] = 'detail_alattransportasi';
		$data['detail'] = $detail_alattransportasi;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addAlatTransportasiSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('alattransportasi', 'Alat Transportasi', 'required|is_unique[tbl_alat_transportasi.ALAT_TRANSPORTASI]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_alattransportasi/addAlatTransportasi');
        }
        $data_insert = array(
			'ALAT_TRANSPORTASI' => $this->input->post('alattransportasi', TRUE)
		);
		$this->master_alattransportasi->tambahData($data_insert,'tbl_alat_transportasi');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_alattransportasi/addAlatTransportasi');
	}
	
	function hapusAlatTransportasi($id){
		$this->load->library('jariprom_tools');
		$this->master_alattransportasi->hapusData('tbl_alat_transportasi',array('ID_ALAT_TRANSPORTASI' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_alattransportasi');
	}
	
	function editAlatTransportasiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('alattransportasi', 'Alat Transportasi', 'required');
		if($this->input->post('alattransportasi_form') != $this->input->post('alattransportasi')){
			$this->form_validation->set_rules('alattransportasi', 'Alat Transportasi', 'required|is_unique[tbl_alat_transportasi.ALAT_TRANSPORTASI]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_alattransportasi/detailAlatTransportasi/'.$this->input->post('id_alattransportasi'));
        }
        $data_update = array(
			'ALAT_TRANSPORTASI' => $this->input->post('alattransportasi', TRUE)
		);
		$this->master_alattransportasi->editData('tbl_alat_transportasi', $data_update, array('ID_ALAT_TRANSPORTASI' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_alattransportasi'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_alattransportasi/detailAlatTransportasi/'.$this->input->post('id_alattransportasi'));
	}
	
	function getAlatTransportasi(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_alattransportasi->setTableDatabase('tbl_alat_transportasi');
			$this->master_alattransportasi->setSelectColumn(array('ID_ALAT_TRANSPORTASI','ALAT_TRANSPORTASI'));
			$this->master_alattransportasi->setOrderColumn(array('ID_ALAT_TRANSPORTASI','ALAT_TRANSPORTASI'));
			$this->master_alattransportasi->setOrderId(array('ID_ALAT_TRANSPORTASI','DESC'));
			$this->master_alattransportasi->setSearchQuery(array('ALAT_TRANSPORTASI'));
			$fetch_data = $this->master_alattransportasi->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_ALAT_TRANSPORTASI;
	            $sub_array[] = $row->ALAT_TRANSPORTASI;
	            if($row->ID_ALAT_TRANSPORTASI == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_alattransportasi/detailAlatTransportasi/'.$this->jariprom_tools->base64_encode_fix($row->ID_ALAT_TRANSPORTASI)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_alattransportasi/hapusAlatTransportasi/'.$this->jariprom_tools->base64_encode_fix($row->ID_ALAT_TRANSPORTASI)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_alattransportasi->get_all_data(),  
	            "recordsFiltered" => $this->master_alattransportasi->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
