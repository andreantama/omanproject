<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_admin extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_admin','master_admin');
    }
	
	function index(){
		$data['judul_page'] = 'Master Admin';
		$data['des_page'] = '';
		$data['page'] = 'view_admin';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addAdmin(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Admin';
		$data['des_page'] = '';
		$data['page'] = 'add_admin';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function detailAdmin($id){
		$this->load->library('jariprom_tools');
		$id_admin = $this->jariprom_tools->base64_decode_fix($id);
		$detail_admin = $this->master_admin->tampilData('tbl_admin','*', array('ID_ADMIN' => $id_admin), TRUE);
		$data['judul_page'] = 'Detail admin '.$detail_admin->NAME;
		$data['des_page'] = '';
		$data['page'] = 'detail_admin';
		$data['detail'] = $detail_admin;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function addAdminSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[tbl_admin.USERNAME]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('con_password', 'Konfirmasi Password', 'required|matches[password]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_admin/addAdmin');
        }
        $data_insert = array(
			'NAME' 		=> $this->input->post('nama', TRUE),
			'USERNAME' 	=> $this->input->post('username', TRUE),
			'LEVEL' 	=> $this->input->post('level', TRUE),
			'PASSWORD' 	=> password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT)
		);
		$this->master_admin->tambahData($data_insert,'tbl_admin');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_admin/addAdmin');
	}
	
	function hapusAdmin($id){
		$this->load->library('jariprom_tools');
		$this->master_admin->hapusData('tbl_admin',array('ID_ADMIN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_admin');
	}
	
	function editAdminSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if($this->input->post('password') != ''){
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('con_password', 'Konfirmasi Password', 'required|matches[password]');
			$pass = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
		}
		else{
			$detail_pass = $this->master_admin->tampilData('tbl_admin','PASSWORD', array('ID_ADMIN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_admin'))), TRUE);
        	$pass = $detail_pass->PASSWORD;
		}
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_admin/detailAdmin/'.$this->input->post('id_admin'));
        }
        $data_update = array(
			'NAME' => $this->input->post('nama', TRUE),
			'PASSWORD' => $pass,
			'LEVEL' => $this->input->post('level', TRUE)
		);
		$this->master_admin->editData('tbl_admin', $data_update, array('ID_ADMIN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_admin'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_admin/detailAdmin/'.$this->input->post('id_admin'));
	}
	
	function getAdmin(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_admin->setTableDatabase('tbl_admin');
			$this->master_admin->setSelectColumn(array('ID_ADMIN','NAME','LEVEL','LAST_LOGIN','USERNAME'));
			$this->master_admin->setOrderColumn(array('ID_ADMIN','NAME'));
			$this->master_admin->setOrderId(array('ID_ADMIN','DESC'));
			$this->master_admin->setSearchQuery(array('NAME'));
			$fetch_data = $this->master_admin->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  

				$level = '';
				if($row->LEVEL == 1){
					$level = 'Super Admin';
				} else if($row->LEVEL == 2){
					$level = 'Admin Master Data';
				} else if($row->LEVEL == 3){
					$level = 'Admin PPDB';
				} else if($row->LEVEL == 4){
					$level = 'Admin Web';
				}

	            $sub_array = array(); 
	            $sub_array[] = $row->USERNAME;
	            $sub_array[] = $row->NAME;
	            $sub_array[] = $level;
	            $sub_array[] = $row->LAST_LOGIN;

	            if($row->LEVEL == 1){ // SUPER ADMIN
					$sub_array[] = 'Tidak ada aksi';
				}
				else{
	            	$sub_array[] = '<a href="'.base_url('master_admin/detailAdmin/'.$this->jariprom_tools->base64_encode_fix($row->ID_ADMIN)).'" class="btn btn-info btn-sm">Edit</a> 
	            					<a href="'.base_url('master_admin/hapusAdmin/'.$this->jariprom_tools->base64_encode_fix($row->ID_ADMIN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';;
				}
	            $data[] = $sub_array;
	        }
	        $output = array(  
	            "draw" 				=> intval($_GET["draw"]), 
	            "recordsTotal"		=> $this->master_admin->get_all_data(),  
	            "recordsFiltered" 	=> $this->master_admin->get_filtered_data(),  
	            "data" 				=> $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
