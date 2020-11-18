<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_gallery extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_gallery','master_gallery');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Master Gallery';
		$data['des_page'] = '';
		$data['page'] = 'view_slider';
		$data['modul_active'] = 'master_blog';
		$data['data_gallery'] = $this->master_gallery->tampilData('tbl_gallery');
		$this->load->view($this->template,$data);
	}
	
	function addGallery(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Gallery';
		$data['des_page'] = '';
		$data['page'] = 'add_gallery';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function detailGallery($id){
		$this->load->library('jariprom_tools');
		$id_gallery = $this->jariprom_tools->base64_decode_fix($id);
		$detail_gallery = $this->master_gallery->tampilData('tbl_gallery','*', array('ID_GALLERY' => $id_gallery), TRUE);
		$data['judul_page'] = 'Detail Gallery';
		$data['des_page'] = '';
		$data['page'] = 'detail_gallery';
		$data['detail'] = $detail_gallery;
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addGallerySubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('judul_gallery', 'Judul Slider', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_gallery/addGallery');
        }
        $config['upload_path'] = './assets/images/gallery/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = '30048';
		$config['file_ext_tolower'] = TRUE;
		$config['encrypt_name'] = TRUE;
		$config['detect_mime'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('file_foto')){
			$image = $this->upload->data('file_name');
        }
        else{
			$this->session->set_flashdata('notif', $this->upload->display_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_gallery/addGallery');
		}
        $data_insert = array(
			'NAMA_GALLERY' => $this->input->post('judul_gallery', TRUE),
			'GAMBAR' => $image
		);
		$this->master_gallery->tambahData($data_insert,'tbl_gallery');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_gallery/addGallery');
	}
	
	function hapusSlider($id){
		$this->load->library('jariprom_tools');
		$foto = $this->master_gallery->tampilData('tbl_gallery','GAMBAR', array('ID_GALLERY' => $this->jariprom_tools->base64_decode_fix($id)), TRUE);
		if(file_exists('./assets/images/gallery/'.$foto->GAMBAR)){
			unlink('./assets/images/gallery/'.$foto->GAMBAR);
		}
		$this->master_gallery->hapusData('tbl_gallery',array('ID_GALLERY' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_gallery');
	}
	
	function editGallerySubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('judul_gallery', 'Judul Slider', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_gallery/detailGallery/'.$this->input->post('id_gallery'));
        }
        $gallery = $this->master_gallery->tampilData('tbl_gallery','GAMBAR', array('ID_GALLERY' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_gallery'))), TRUE);
        if($_FILES["file_foto"]["error"] != 0){
			$image = $gallery->GAMBAR;
		}
		else{
			$config['upload_path'] = './assets/images/gallery';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				if(file_exists('./assets/images/gallery/'.$gallery->GAMBAR)){
					unlink('./assets/images/gallery/'.$gallery->GAMBAR);
				}
				$image = $this->upload->data('file_name');
            }
		}
        $data_update = array(
			'NAMA_GALLERY' => $this->input->post('judul_gallery', TRUE),
			'GAMBAR' => $image
		);
		$this->master_gallery->editData('tbl_gallery', $data_update, array('ID_GALLERY' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_gallery'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_gallery/detailGallery/'.$this->input->post('id_gallery'));
	}
	
	function getSumberGaji(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_gallery->setTableDatabase('tbl_sumber_gaji');
			$this->master_gallery->setSelectColumn(array('ID_SUMBER_GAJI','SUMBER_GAJI'));
			$this->master_gallery->setOrderColumn(array('ID_SUMBER_GAJI','SUMBER_GAJI'));
			$this->master_gallery->setOrderId(array('ID_SUMBER_GAJI','DESC'));
			$this->master_gallery->setSearchQuery(array('SUMBER_GAJI'));
			$fetch_data = $this->master_gallery->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_SUMBER_GAJI;
	            $sub_array[] = $row->SUMBER_GAJI;
	            if($row->ID_SUMBER_GAJI == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_gallery/detailSumberGaji/'.$this->jariprom_tools->base64_encode_fix($row->ID_SUMBER_GAJI)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_gallery/hapusSumberGaji/'.$this->jariprom_tools->base64_encode_fix($row->ID_SUMBER_GAJI)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_gallery->get_all_data(),  
	            "recordsFiltered" => $this->master_gallery->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
