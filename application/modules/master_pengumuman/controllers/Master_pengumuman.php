<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pengumuman extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_pengumuman','master_pengumuman');
    }
	
	function index(){
		$data['judul_page'] = 'Berita';
		$data['des_page'] = '';
		$data['page'] = 'view_pengumuman';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addPengumuman(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Berita';
		$data['des_page'] = '';
		$data['page'] = 'add_pengumuman';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function detailPengumuman($id){
		$this->load->library('jariprom_tools');
		$id_pengumuman = $this->jariprom_tools->base64_decode_fix($id);
		$detail_pengumuman = $this->master_pengumuman->tampilData('tbl_pengumuman','*', array('ID_PENGUMUMAN' => $id_pengumuman), TRUE);
		$data['judul_page'] = 'Detail berita '.$detail_pengumuman->JUDUL_PENGUMUMAN;
		$data['des_page'] = '';
		$data['page'] = 'detail_pengumuman';
		$data['detail'] = $detail_pengumuman;
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addPengumumanSubmit(){
		$this->load->library('jariprom_tools');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('judul_pengumuman', 'Judul Pengumuman', 'required');
		$this->form_validation->set_rules('pengumuman', 'Pengumuman', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_pengumuman/addPengumuman');
        }
        if($_FILES["file_foto"]["error"] != 0){
			$image = NULL;
		}
		else{
			$config['upload_path'] = './assets/images/berita';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '3048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				$image = $this->upload->data('file_name');
            }
		}
        $data_insert = array(
			'JUDUL_PENGUMUMAN' => $this->input->post('judul_pengumuman', TRUE),
			'PENGUMUMAN' => $this->input->post('pengumuman', TRUE),
			'STS_PUBLISH' => $this->input->post('sts_publish', TRUE),
			'TGL_POSTING' => $this->jariprom_tools->tglSekarang(),
			'TIME_POSTING' => $this->jariprom_tools->wktSekarang(),
			'IMAGE' => $image,
			'KATEGORI' => $this->input->post('kategori', TRUE)
		);
		$this->master_pengumuman->tambahData($data_insert,'tbl_pengumuman');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_pengumuman/addPengumuman');
	}
	
	function hapusPengumuman($id){
		$this->load->library('jariprom_tools');
		$this->master_pengumuman->hapusData('tbl_pengumuman',array('ID_PENGUMUMAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_pengumuman');
	}
	
	function editPengumumanSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('judul_pengumuman', 'Judul Pengumuman', 'required');
		$this->form_validation->set_rules('pengumuman', 'Pengumuman', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_pengumuman/detailPengumuman/'.$this->input->post('id_pengumuman'));
        }
        $foto = $this->master_pengumuman->tampilData('tbl_pengumuman','IMAGE', array('ID_PENGUMUMAN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_pengumuman'))), TRUE);
        if($_FILES["file_foto"]["error"] != 0){
			$image = $foto->IMAGE;
		}
		else{
			$config['upload_path'] = './assets/images/berita';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				if(file_exists('./assets/images/berita/'.$foto->IMAGE)){
					unlink('./assets/images/berita/'.$foto->IMAGE);
				}
				$image = $this->upload->data('file_name');
            }
		}
        $data_update = array(
			'JUDUL_PENGUMUMAN' => $this->input->post('judul_pengumuman', TRUE),
			'PENGUMUMAN' => $this->input->post('pengumuman', TRUE),
			'STS_PUBLISH' => $this->input->post('sts_publish', TRUE),
			'IMAGE' => $image,
			'KATEGORI' => $this->input->post('kategori', TRUE)
		);
		$this->master_pengumuman->editData('tbl_pengumuman', $data_update, array('ID_PENGUMUMAN' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_pengumuman'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_pengumuman/detailPengumuman/'.$this->input->post('id_pengumuman'));
	}
	
	function getPengumuman(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_pengumuman->setTableDatabase('tbl_pengumuman');
			$this->master_pengumuman->setSelectColumn(array('ID_PENGUMUMAN','JUDUL_PENGUMUMAN','TGL_POSTING','TIME_POSTING','STS_PUBLISH'));
			$this->master_pengumuman->setOrderColumn(array('ID_PENGUMUMAN','JUDUL_PENGUMUMAN'));
			$this->master_pengumuman->setOrderId(array('ID_PENGUMUMAN','DESC'));
			$this->master_pengumuman->setSearchQuery(array('JUDUL_PENGUMUMAN'));
			$fetch_data = $this->master_pengumuman->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_PENGUMUMAN;
	            $sub_array[] = $row->JUDUL_PENGUMUMAN;
	            $sub_array[] = $row->TGL_POSTING.' '.$row->TIME_POSTING;
	            $sub_array[] = '<a href="'.base_url('master_pengumuman/detailPengumuman/'.$this->jariprom_tools->base64_encode_fix($row->ID_PENGUMUMAN)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_pengumuman/hapusPengumuman/'.$this->jariprom_tools->base64_encode_fix($row->ID_PENGUMUMAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_pengumuman->get_all_data(),  
	            "recordsFiltered" => $this->master_pengumuman->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
