<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_slider extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_slider','master_slider');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Master Slider';
		$data['des_page'] = '';
		$data['page'] = 'view_slider';
		$data['modul_active'] = 'master_blog';
		$data['data_slider'] = $this->master_slider->tampilData('tbl_slider');
		$this->load->view($this->template,$data);
	}
	
	function addSlider(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Slider';
		$data['des_page'] = '';
		$data['page'] = 'add_slider';
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function detailSlider($id){
		$this->load->library('jariprom_tools');
		$id_slider = $this->jariprom_tools->base64_decode_fix($id);
		$detail_slider = $this->master_slider->tampilData('tbl_slider','*', array('ID_SLIDER' => $id_slider), TRUE);
		$data['judul_page'] = 'Detail Slider';
		$data['des_page'] = '';
		$data['page'] = 'detail_slider';
		$data['detail'] = $detail_slider;
		$data['modul_active'] = 'master_blog';
		$this->load->view($this->template,$data);
	}
	
	function addSliderSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('judul_slider', 'Judul Slider', 'required');
		$this->form_validation->set_rules('deskripsi_slider', 'Deskripsi Slider', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_slider/addSlider');
        }
        $config['upload_path'] = './assets/images/slider/';
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
        	redirect('master_slider/addSlider');
		}
        $data_insert = array(
			'JUDUL_SLIDER' => $this->input->post('judul_slider', TRUE),
			'DESKRIPSI_SLIDER' => $this->input->post('deskripsi_slider', TRUE),
			'GAMBAR' => $image
		);
		$this->master_slider->tambahData($data_insert,'tbl_slider');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
        redirect('master_slider/addSlider');
	}
	
	function hapusSlider($id){
		$this->load->library('jariprom_tools');
		$foto = $this->master_slider->tampilData('tbl_slider','GAMBAR', array('ID_SLIDER' => $this->jariprom_tools->base64_decode_fix($id)), TRUE);
		if(file_exists('./assets/images/slider/'.$foto->GAMBAR)){
			unlink('./assets/images/slider/'.$foto->GAMBAR);
		}
		$this->master_slider->hapusData('tbl_slider',array('ID_SLIDER' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_slider');
	}
	
	function editSliderSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('judul_slider', 'Judul Slider', 'required');
		$this->form_validation->set_rules('deskripsi_slider', 'Deskripsi Slider', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_slider/detailSlider/'.$this->input->post('id_slider'));
        }
        $slider = $this->master_slider->tampilData('tbl_slider','GAMBAR', array('ID_SLIDER' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_slider'))), TRUE);
        if($_FILES["file_foto"]["error"] != 0){
			$image = $slider->GAMBAR;
		}
		else{
			$config['upload_path'] = './assets/images/slider';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				if(file_exists('./assets/images/slider/'.$slider->GAMBAR)){
					unlink('./assets/images/slider/'.$slider->GAMBAR);
				}
				$image = $this->upload->data('file_name');
            }
		}
        $data_update = array(
			'JUDUL_SLIDER' => $this->input->post('judul_slider', TRUE),
			'DESKRIPSI_SLIDER' => $this->input->post('deskripsi_slider', TRUE),
			'GAMBAR' => $image
		);
		$this->master_slider->editData('tbl_slider', $data_update, array('ID_SLIDER' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_slider'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_slider/detailSlider/'.$this->input->post('id_slider'));
	}
	
	function getSumberGaji(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_slider->setTableDatabase('tbl_sumber_gaji');
			$this->master_slider->setSelectColumn(array('ID_SUMBER_GAJI','SUMBER_GAJI'));
			$this->master_slider->setOrderColumn(array('ID_SUMBER_GAJI','SUMBER_GAJI'));
			$this->master_slider->setOrderId(array('ID_SUMBER_GAJI','DESC'));
			$this->master_slider->setSearchQuery(array('SUMBER_GAJI'));
			$fetch_data = $this->master_slider->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->ID_SUMBER_GAJI;
	            $sub_array[] = $row->SUMBER_GAJI;
	            if($row->ID_SUMBER_GAJI == 1){
					$link = '-';
				}
				else{
					$link = '<a href="'.base_url('master_slider/detailSumberGaji/'.$this->jariprom_tools->base64_encode_fix($row->ID_SUMBER_GAJI)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_slider/hapusSumberGaji/'.$this->jariprom_tools->base64_encode_fix($row->ID_SUMBER_GAJI)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
				}
	            $sub_array[] = $link;  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_slider->get_all_data(),  
	            "recordsFiltered" => $this->master_slider->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
