<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_menu extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_menu','master_menu');
    }
	
	function index(){
		$data['judul_page'] = 'Halaman Website';
		$data['des_page'] = '';
		$data['page'] = 'view_menu';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addMenu(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Halaman';
		$data['des_page'] = '';
		$data['page'] = 'add_menu';
		$data['modul_active'] = 'master_blog';
		$data['data_menu'] = $this->master_menu->tampilData('tbl_menu','*', array('ID_PARENT' => 0));
		$this->load->view($this->template,$data);
	}
	
	function detailMenu($id){
		$this->load->library('jariprom_tools');
		$id_menu = $this->jariprom_tools->base64_decode_fix($id);
		$detail_menu = $this->master_menu->tampilData('tbl_menu','*', array('ID_MENUWEB' => $id_menu), TRUE);
		$data['judul_page'] = 'Detail menu '.$detail_menu->NAMA_MENU;
		$data['des_page'] = '';
		$data['page'] = 'detail_menu';
		$data['detail'] = $detail_menu;
		$data['modul_active'] = 'master_blog';
		$data['data_menu'] = $this->master_menu->tampilData('tbl_menu','*', array('ID_PARENT' => 0));
		$this->load->view($this->template,$data);
	}
	
	function addMenuSubmit(){
		$this->load->library('jariprom_tools');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('judul_halaman', 'Judul Halaman', 'required');
		$this->form_validation->set_rules('isi_halaman', 'Isi Halaman', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_menu/addMenu');
        }
        $data_insert = array(
			'NAMA_MENU' => $this->input->post('judul_halaman', TRUE),
			'ISI_MENU' => $this->input->post('isi_halaman', TRUE),
			'STS_PUBLISH' => $this->input->post('sts_publish', TRUE),
			'ID_PARENT' => $this->input->post('id_parent', TRUE),
			'STS_TIPE' => 1,
			'TGL_POSTING' => $this->jariprom_tools->tglSekarang(),
			'WKT_POSTING' => $this->jariprom_tools->tglWktSekarang()
		);
		$this->master_menu->tambahData($data_insert,'tbl_menu');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_menu/addMenu');
	}
	
	function hapusMenu($id){
		$this->load->library('jariprom_tools');
		$this->master_menu->hapusData('tbl_menu',array('ID_MENUWEB' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->master_menu->hapusData('tbl_menu',array('ID_PARENT' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_menu');
	}
	
	function editMenuSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('judul_halaman', 'Judul Halaman', 'required');
		$this->form_validation->set_rules('isi_halaman', 'Isi Halaman', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_menu/detailMenu/'.$this->input->post('id_menuweb'));
        }
        if($this->input->post('id_parent')){
			$id_parent = $this->input->post('id_parent');
		}
		else{
			$id_parent = 0;
		}
        $data_update = array(
			'NAMA_MENU' => $this->input->post('judul_halaman', TRUE),
			'ISI_MENU' => $this->input->post('isi_halaman', TRUE),
			'STS_PUBLISH' => $this->input->post('sts_publish', TRUE),
			'ID_PARENT' => $id_parent
		);
		$this->master_menu->editData('tbl_menu', $data_update, array('ID_MENUWEB' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_menuweb'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_menu/detailMenu/'.$this->input->post('id_menuweb'));
	}
	
	function getMenu(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_menu->setTableDatabase('tbl_menu');
			$this->master_menu->setSelectColumn(array('ID_MENUWEB','NAMA_MENU','ID_PARENT'));
			$this->master_menu->setOrderColumn(array('ID_MENUWEB','NAMA_MENU'));
			$this->master_menu->setOrderId(array('ID_MENUWEB','DESC'));
			$this->master_menu->setSearchQuery(array('NAMA_MENU'));
			$fetch_data = $this->master_menu->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_MENUWEB;
	            $sub_array[] = $row->NAMA_MENU;
	            $detail = $this->master_menu->tampilData('tbl_menu','*', array('ID_MENUWEB' => $row->ID_PARENT), TRUE);
	            if($detail){
					$a = $detail->NAMA_MENU;
				}
				else{
					$a = '-';
				}
	            $sub_array[] = $a;
	            if($row->ID_MENUWEB == 8 or $row->ID_MENUWEB == 9){
	            	$sub_array[] = '<a href="'.base_url('master_menu/detailMenu/'.$this->jariprom_tools->base64_encode_fix($row->ID_MENUWEB)).'" class="btn btn-info btn-sm">Edit</a>';  
				}
				else{
	            	$sub_array[] = '<a href="'.base_url('master_menu/detailMenu/'.$this->jariprom_tools->base64_encode_fix($row->ID_MENUWEB)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_menu/hapusMenu/'.$this->jariprom_tools->base64_encode_fix($row->ID_MENUWEB)).'" onclick="return confirm(\'Sebelum menghapus harap diperhatikan, jika Anda menghapus menu utama, maka sub menu juga ikut terhapus. Apakah Anda yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  					
				}
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_menu->get_all_data(),  
	            "recordsFiltered" => $this->master_menu->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
