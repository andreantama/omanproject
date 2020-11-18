<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_infosekolah extends MY_Admin {

	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_infosekolah','master_infosekolah');
    }

	function index(){
		$this->load->library('jariprom_tools');
		$detail_website = $this->master_infosekolah->tampilData('tbl_info_sekolah','*', array('ID_INFO' => 1), TRUE);
		$data['judul_page'] = 'Informasi Website';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['detail'] = $detail_website;
		$data['modul_active'] = 'master_infoweb';
		$this->load->view($this->template,$data);
	}

	function editInfoSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama_sekolah', 'Nama Sekolah', 'required');
		$this->form_validation->set_rules('no_telepon', 'No Telepon', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_infosekolah');
        }
        $detail_website = $this->master_infosekolah->tampilData('tbl_info_sekolah','*', array('ID_INFO' => 1), TRUE);
        if($_FILES["file_foto"]["error"] != 0){
			$image = $detail_website->LOGO;
		}
		else{
			$config['upload_path'] = './assets-admin/img/logo';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				if(file_exists('./assets-admin/img/logo/'.$detail_website->LOGO)){
					unlink('./assets-admin/img/logo/'.$detail_website->LOGO);
				}
				$image = $this->upload->data('file_name');
            }
		}
		if($_FILES["homepage"]["error"] != 0){
			$image_homepage = $detail_website->LOGO_HOMEPAGE;
		}
		else{
			$config['upload_path'] = './assets-admin/img/logo';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('homepage')){
				if(file_exists('./assets-admin/img/logo/'.$detail_website->LOGO_HOMEPAGE)){
					unlink('./assets-admin/img/logo/'.$detail_website->LOGO_HOMEPAGE);
				}
				$image_homepage = $this->upload->data('file_name');
            }
		}

		if($_FILES["tkit"]["error"] != 0){
			$image_tkit = $detail_website->FOTO_TKIT;
		}
		else{
			$config['upload_path'] = './assets/images/banner';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('tkit')){
				if(file_exists('./assets/images/banner/'.$detail_website->FOTO_TKIT)){
					unlink('./assets/images/banner/'.$detail_website->FOTO_TKIT);
				}
				$image_tkit = $this->upload->data('file_name');
            }
		}
		if($_FILES["smpit"]["error"] != 0){
			$image_smpit = $detail_website->FOTO_SMPIT;
		}
		else{
			$config['upload_path'] = './assets/images/banner';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('smpit')){
				if(file_exists('./assets/images/banner/'.$detail_website->FOTO_SMPIT)){
					unlink('./assets/images/banner/'.$detail_website->FOTO_SMPIT);
				}
				$image_smpit = $this->upload->data('file_name');
            }
		}
		if($_FILES["dokumen"]["error"] != 0){
			$dokumen = $detail_website->DOKUMEN_PDF;
		}
		else{
			$config['upload_path'] = './assets/dokumen';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '30048';
			$config['file_ext_tolower'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('dokumen')){
				if(file_exists('./assets/dokumen/'.$detail_website->DOKUMEN_PDF)){
					unlink('./assets/dokumen/'.$detail_website->DOKUMEN_PDF);
				}
				$dokumen = $this->upload->data('file_name');
            }
		}
        $data_update = array(
			'NAMA_SEKOLAH' => $this->input->post('nama_sekolah', TRUE),
			'ALAMAT_SEKOLAH' => $this->input->post('alamat', TRUE),
			'TELP_SEKOLAH' => $this->input->post('no_telepon', TRUE),
			'EMAIL_SEKOLAH' => $this->input->post('email', TRUE),
			'LOGO_HOMEPAGE' => $image_homepage,
			'LOGO' => $image,
			'FOTO_TKIT' => $image_tkit,
			'FOTO_SMPIT' => $image_smpit,
			'DOKUMEN_PDF' => $dokumen,
			'WEBSITE_SEKOLAH' => $this->input->post('web_sekolah', TRUE),
			'FAX' => $this->input->post('fax', TRUE),
			'FACEBOOK' => $this->input->post('facebook', TRUE),
			'TWITTER' => $this->input->post('twitter', TRUE),
			'INSTAGRAM' => $this->input->post('instagram', TRUE),
			'GOOGLE' => $this->input->post('google', TRUE)
		);
		$this->master_infosekolah->editData('tbl_info_sekolah', $data_update, array('ID_INFO' => 1));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_infosekolah');

	}

}

