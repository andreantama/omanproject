<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_pmb extends CI_Controller {

	var $template = 'index';

	function __construct(){
		parent::__construct();
		$this->load->model('M_homepage_pmb','homepage_pmb');
    }

	function index(){
		$data['page'] = 'homepage_pmb';
		$this->load->view($this->template, $data);
	}
	public function buktitransfer()
	{
		$data['page'] = 'buktitransfer';
		//$data['active'] = $this->homepage_pmb->tampilData('tbl_set_pmb','*',array('ID_SET_PMB' => 1), TRUE);
		$this->load->view($this->template, $data);
	}
	
	function daftarPMB(){
		$data['page'] = 'daftar';
		$data['active'] = $this->homepage_pmb->tampilData('tbl_set_pmb','*',array('ID_SET_PMB' => 1), TRUE);
		$this->load->view($this->template, $data);
	}

	function daftarUlang(){
		$data['page'] = 'daftarulang';
		$data['active'] = $this->homepage_pmb->tampilData('tbl_set_pmb','*',array('ID_SET_PMB' => 1), TRUE);
		$this->load->view($this->template, $data);
	}

	function cekPMB(){
		$data['page'] = 'cek_pmb';
		$this->load->view($this->template, $data);
	}

	function cekPMBSubmit(){
		$this->load->library('jariprom_tools');
		$data['page'] = 'daftar';
		$data['detail_registrasi'] = $this->homepage_pmb->tampilData('tbl_pmb','*',array('NO_HANDPHONE' => $this->input->post('no_handphone')), TRUE);
		$this->load->view('cek_pmb_ajax', $data);
	}

	function downloadPdfInstruction(){
		$this->load->helper('download');
		$detail_website = $this->homepage_pmb->tampilData('tbl_info_sekolah','*', array('ID_INFO' => 1), TRUE);
		force_download('./assets/dokumen/'.$detail_website->DOKUMEN_PDF, NULL);
	}

	function cetakPdf($id){
		$this->load->library('jariprom_tools');
		$this->load->library('html2pdf');
		$this->load->helper('download');
		$id = $this->jariprom_tools->base64_decode_fix($id);
		$this->html2pdf->folder('./assets/pdfs/');
		$this->html2pdf->filename('pmb_mutiaracendekia_'.$this->jariprom_tools->formatPmb($id,4).'.pdf');
		$this->html2pdf->paper('a4', 'portrait');
		$data['detail_registrasi'] = $this->homepage_pmb->tampilData('tbl_pmb','*',array('ID_PMB' => $id), TRUE);
		$data['detail'] = $this->db->query('SELECT * FROM tbl_info_sekolah')->row();
		$this->html2pdf->html($this->load->view('download_pdf', $data, true));
		$this->html2pdf->create('save');
		force_download('./assets/pdfs/pmb_mutiaracendekia_'.$this->jariprom_tools->formatPmb($id,4).'.pdf', NULL);
	}

	function cetakPmb($id){
		$this->load->library('jariprom_tools');
		$id = $this->jariprom_tools->base64_decode_fix($id);
		$data['detail_registrasi'] = $this->homepage_pmb->tampilData('tbl_pmb','*',array('ID_PMB' => $id), TRUE);
		$data['detail'] = $this->db->query('SELECT * FROM tbl_info_sekolah')->row();
		$this->load->view('cetak',$data);
	}
	public function buktiTransferSubmit()
	{
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('homepage_pmb/buktitransferr');
        }
		$config['upload_path'] = './assets/buktitransfer';
		$config['allowed_types'] = 'jpg|png|jpeg|JPEG';
		$config['max_size'] = '50000048';
		$config['encrypt_name'] = TRUE;
		$config['file_ext_tolower'] = TRUE;
		$config['detect_mime'] = TRUE;
		$this->load->library('upload', $config);
		if($this->upload->do_upload('dokumen')){
			$dokumen = $this->upload->data('file_name');
			//TODO ADD TO TABLE
		}
		else{
			$this->session->set_flashdata('notif', $this->upload->display_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('homepage_pmb/buktitransfer');
			exit();
		}
		$data_insert = array(
			'NAMA' => $this->input->post('nama', TRUE),
			'BERKAS' => $dokumen,
			'TGL_PMB' => $this->jariprom_tools->tglSekarang(),
			'WKT_PMB' => $this->jariprom_tools->wktSekarang()
		);
		$this->homepage_pmb->tambahData($data_insert,'tbl_pmbbuktitransfer');
		$this->session->set_flashdata('notif', "Bukti Transfer Berhasil Di Upload");
		$this->session->set_flashdata('clr', 'success');
		redirect('homepage_pmb/buktitransfer');
	}
	function daftarPmbUlangSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validaiton->set_rules("pendidikan", "Pendidikan", "required");
		$this->form_validation->set_rules('no_hp', 'No Handphone '.$this->input->post('no_hp', TRUE), 'required|numeric|is_unique[tbl_pmbdaftarulang.NO_HANDPHONE]');
		$this->form_validation->set_message('is_unique', '{field} sudah pernah Anda daftarkan sebelumnya. Jika ada kesalahan input hubungi Admin.');
		if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('homepage_pmb/daftarUlang');
        }
		$config['upload_path'] = './assets/berkas';
		$config['allowed_types'] = 'zip|rar|pdf';
		$config['max_size'] = '50000048';
		$config['encrypt_name'] = TRUE;
		$config['file_ext_tolower'] = TRUE;
		$config['detect_mime'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if($this->upload->do_upload('dokumen')){
			$dokumen = $this->upload->data('file_name');
		}
		else{
			$this->session->set_flashdata('notif', $this->upload->display_errors());
			$this->session->set_flashdata('clr', 'danger');
			redirect('homepage_pmb/daftarUlang');
			exit();
		}
		$data_insert = array(
			'NAMA' => $this->input->post('nama', TRUE),
			'NO_HANDPHONE' => $this->input->post('no_hp', TRUE),
			'BERKAS' => $dokumen,
			'PENDIDIKAN' => $this->input->post('pendidikan', TRUE),
			'TGL_PMB' => $this->jariprom_tools->tglSekarang(),
			'WKT_PMB' => $this->jariprom_tools->wktSekarang()
		);
		$this->homepage_pmb->tambahData($data_insert,'tbl_pmbdaftarulang');
		$this->session->set_flashdata('notif', "Pendaftaran ulang berhasil, terima kasih");
		$this->session->set_flashdata('clr', 'success');
		redirect('homepage_pmb/daftarUlang');
	}

	function daftarPMBSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('ttl', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_ttl', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		$this->form_validation->set_rules('no_hp', 'No Handphone', 'numeric|is_unique[tbl_pmb.NO_HANDPHONE]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('homepage_pmb/daftarPMB');
        }
		$data_insert = array(
			'NAMA' => $this->input->post('nama', TRUE),
			'JK' => $this->input->post('jk', TRUE),
			'TMPT_LAHIR' => $this->input->post('ttl', TRUE),
			'TGL_LAHIR' => $this->input->post('tgl_ttl', TRUE),
			'ALAMAT' => $this->input->post('alamat', TRUE),
			'NAMA_AYAH' => $this->input->post('nama_ayah', TRUE),
			'NAMA_IBU' => $this->input->post('nama_ibu', TRUE),
			'NO_HANDPHONE' => $this->input->post('no_hp', TRUE),
			'TGL_PMB' => $this->jariprom_tools->tglSekarang(),
			'WKT_PMB' => $this->jariprom_tools->wktSekarang()
		);
		$this->homepage_pmb->tambahData($data_insert,'tbl_pmb');
		$id_pmb = $this->db->insert_id();
		$this->session->set_flashdata('notif', "Pendaftaran berhasil, silahkan unduh PDF / Cetak formulir.");
		$this->session->set_flashdata('clr', 'success');
		$this->session->set_flashdata('print', TRUE);
       	redirect('homepage_pmb/snapPmb/'.$this->jariprom_tools->base64_encode_fix($id_pmb));
	}

	function snapPmb($id){
		$this->load->library('jariprom_tools');
		$id = $this->jariprom_tools->base64_decode_fix($id);
		if($this->session->userdata("print") == FALSE){
			redirect('homepage_pmb');
		}
		else{
			$data['page'] = 'snap';
			$data['detail_registrasi'] = $this->homepage_pmb->tampilData('tbl_pmb','*',array('ID_PMB' => $id), TRUE);
			$this->load->view($this->template, $data);
		}
	}
}
