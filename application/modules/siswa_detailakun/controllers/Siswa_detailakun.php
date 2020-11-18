<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_detailakun extends MY_Siswa {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_siswa_detailakun','siswa_detailakun');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$detail_guru = $this->siswa_detailakun->tampilData('tbl_siswa','*', array('NO_SISWA' => $this->session->userdata('user_access_id')), TRUE);
		$data['judul_page'] = 'Detail Akun';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['detail'] = $detail_guru;
		$data['modul_active'] = 'siswa_detailakun';
		$data['data_transportasi'] = $this->siswa_detailakun->tampilData('tbl_alat_transportasi','*');
		$data['data_jenis_tinggal'] = $this->siswa_detailakun->tampilData('tbl_jenis_tinggal','*');
		$data['data_bank'] = $this->siswa_detailakun->tampilData('tbl_bank','*');
		$data['data_jenjang_pendidikan_ayah'] = $this->siswa_detailakun->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_jenjang_pendidikan_ibu'] = $this->siswa_detailakun->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_jenjang_pendidikan_wali'] = $this->siswa_detailakun->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_pekerjaan_ayah'] = $this->siswa_detailakun->tampilData('tbl_pekerjaan','*');
		$data['data_pekerjaan_ibu'] = $this->siswa_detailakun->tampilData('tbl_pekerjaan','*');
		$data['data_pekerjaan_wali'] = $this->siswa_detailakun->tampilData('tbl_pekerjaan','*');
		$this->load->view($this->template,$data);
	}
	
	function editSiswaSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nisn', 'NISN', 'required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('id_jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('id_jenis_transportasi', 'Jenis Transportasi', 'required');
		$this->form_validation->set_rules('id_jenis_tinggal', 'Jenis Tinggal', 'required');
		$this->form_validation->set_rules('no_hp', 'Nomer HP', 'required|numeric');
		$this->form_validation->set_rules('no_telepon', 'Nomer Telepon', 'numeric');
		$this->form_validation->set_rules('rt', 'RT', 'numeric');
		$this->form_validation->set_rules('rw', 'RW', 'numeric');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('tempat_lahir_siswa', 'Tempat Lahir Siswa', 'required');
		$this->form_validation->set_rules('tgl_lahir_siswa', 'Tanggal Lahir Siswa', 'required');
		$this->form_validation->set_rules('nik_ayah', 'NIK Ayah', 'required|numeric');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('penghasilan_ayah_1', 'Penghasilan Ayah 1', 'numeric');
		$this->form_validation->set_rules('penghasilan_ayah_2', 'Penghasilan Ayah 2', 'numeric');
		$this->form_validation->set_rules('tgl_lahir_ayah', 'Tanggal Lahir Ayah', 'required');
		$this->form_validation->set_rules('nik_ibu', 'NIK Ibu', 'required|numeric');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		$this->form_validation->set_rules('penghasilan_ayah_1', 'Penghasilan Ibu 1', 'numeric');
		$this->form_validation->set_rules('penghasilan_ayah_2', 'Penghasilan Ibu 2', 'numeric');
		$this->form_validation->set_rules('tgl_lahir_ibu', 'Tanggal Lahir Ibu', 'required');
		if($this->input->post('nisn_form') != $this->input->post('nisn')){
			$this->form_validation->set_rules('nisn', 'NISN', 'is_unique[tbl_siswa.NISN]');
		}
		if($this->input->post('no_hp_form') != $this->input->post('no_hp')){
			$this->form_validation->set_rules('no_hp', 'NO HP', 'is_unique[tbl_siswa.NO_HP]');
		}
		if($this->input->post('email_form') != $this->input->post('email')){
			$this->form_validation->set_rules('email', 'Email', 'is_unique[tbl_siswa.EMAIL]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('siswa_detailakun');
        }
        $foto = $this->siswa_detailakun->tampilData('tbl_siswa','FOTO', array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa'))), TRUE);
        if($_FILES["file_foto"]["error"] != 0){
			$image = $foto->FOTO;
		}
		else{
			$config['upload_path'] = './assets-admin/img/siswa';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				if(file_exists('./assets-admin/img/siswa/'.$foto->FOTO)){
					unlink('./assets-admin/img/siswa/'.$foto->FOTO);
				}
				$image = $this->upload->data('file_name');
            }
		}
        if($this->input->post('name_kps')){
			$no_kps = $this->input->post('no_kps', TRUE);
		}
		else{
			$no_kps = '';
		}
		if($this->input->post('name_kip')){
			$no_kip = $this->input->post('no_kip', TRUE);
		}
		else{
			$no_kip = '';
		}
		$data_update = array(
			'NISN' => $this->input->post('nisn', TRUE),
			'NAMA' => html_escape($this->input->post('nama', TRUE)),
			'JK' => html_escape($this->input->post('id_jk', TRUE)),
			'TMPT_LAHIR' => html_escape($this->input->post('tempat_lahir_siswa', TRUE)),
			'TGL_LAHIR' => html_escape($this->input->post('tgl_lahir_siswa', TRUE)),
			'AGAMA' => $this->input->post('id_agama', TRUE),
			'ALAMAT' => html_escape($this->input->post('alamat', TRUE)),
			'RT' => html_escape($this->input->post('rt', TRUE)),
			'RW' => html_escape($this->input->post('rw', TRUE)),
			'DUSUN' => html_escape($this->input->post('dusun', TRUE)),
			'KELURAHAN' => html_escape($this->input->post('kelurahan', TRUE)),
			'KECAMATAN' => html_escape($this->input->post('kecamatan', TRUE)),
			'KODE_POS' => html_escape($this->input->post('kode_pos', TRUE)),
			'ID_JENIS_TINGGAL' => html_escape($this->input->post('id_jenis_tinggal', TRUE)),
			'ID_ALAT_TRANSPORTASI' => html_escape($this->input->post('id_jenis_transportasi', TRUE)),
			'TELEPON' => html_escape($this->input->post('no_telepon', TRUE)),
			'NO_HP' => html_escape($this->input->post('no_hp', TRUE)),
			'EMAIL' => html_escape($this->input->post('email', TRUE)),
			'SKHUN' => html_escape($this->input->post('skhun', TRUE)),
			'NO_KPS' => $no_kps,
			'NAMA_AYAH' => html_escape($this->input->post('nama_ayah', TRUE)),
			'TGL_LAHIR_AYAH' => html_escape($this->input->post('tgl_lahir_ayah', TRUE)),
			'ID_JENJANG_PENDIDIKAN_AYAH' => html_escape($this->input->post('id_jenjang_ayah', TRUE)),
			'ID_PEKERJAAN_AYAH' => html_escape($this->input->post('id_pekerjaan_ayah', TRUE)),
			'PENGHASILAN_AYAH_1' => html_escape($this->input->post('penghasilan_ayah_1', TRUE)),
			'PENGHASILAN_AYAH_2' => html_escape($this->input->post('penghasilan_ayah_2', TRUE)),
			'NIK_AYAH' => html_escape($this->input->post('nik_ayah', TRUE)),
			'NAMA_IBU' => html_escape($this->input->post('nama_ibu', TRUE)),
			'TGL_LAHIR_IBU' => html_escape($this->input->post('tgl_lahir_ibu', TRUE)),
			'ID_JENJANG_PENDIDIKAN_IBU' => html_escape($this->input->post('id_jenjang_ibu', TRUE)),
			'ID_PEKERJAAN_IBU' => html_escape($this->input->post('id_pekerjaan_ibu', TRUE)),
			'PENGHASILAN_IBU_1' => html_escape($this->input->post('penghasilan_ibu_1', TRUE)),
			'PENGHASILAN_IBU_2' => html_escape($this->input->post('penghasilan_ibu_2', TRUE)),
			'NIK_IBU' => html_escape($this->input->post('nik_ibu', TRUE)),
			'NAMA_WALI' => html_escape($this->input->post('nama_wali', TRUE)),
			'TGL_LAHIR_WALI' => html_escape($this->input->post('tgl_lahir_wali', TRUE)),
			'ID_JENJANG_PENDIDIKAN_WALI' => html_escape($this->input->post('id_jenjang_wali', TRUE)),
			'ID_PEKERJAAN_WALI' => html_escape($this->input->post('id_pekerjaan_wali', TRUE)),
			'PENGHASILAN_WALI_1' => html_escape($this->input->post('penghasilan_wali_1', TRUE)),
			'PENGHASILAN_WALI_2' => html_escape($this->input->post('penghasilan_wali_2', TRUE)),
			'NIK_WALI' => html_escape($this->input->post('nik_ibu', TRUE)),
			'ROMBEL' => html_escape($this->input->post('rombel', TRUE)),
			'NO_PESERTA_UJIAN_NASIONAL' => html_escape($this->input->post('no_peserta_ujian_nasional', TRUE)),
			'NO_SERI_IJAZAH' => html_escape($this->input->post('no_seri_ijazah', TRUE)),
			'NOMOR_KIP' => $no_kip,
			'NOMOR_KKS' => html_escape($this->input->post('no_kks', TRUE)),
			'NO_REGISTRASI_AKTA_LAHIR' => html_escape($this->input->post('no_registrasi_lahir', TRUE)),
			'ID_BANK' => html_escape($this->input->post('id_bank', TRUE)),
			'NOMOR_REKENING_BANK' => html_escape($this->input->post('no_rekening', TRUE)),
			'REKENING_ATAS_NAMA' => html_escape($this->input->post('atas_nama', TRUE)),
			'LAYAK_PIP' => html_escape($this->input->post('layak_pip', TRUE)),
			'KEBUTUHAN_KHUSUS' => html_escape($this->input->post('kebutuhan_khusus', TRUE)),
			'SEKOLAH_ASAL' => html_escape($this->input->post('sekolah_asal', TRUE)),
			'FOTO' => $image
		);
		$this->siswa_detailakun->editData('tbl_siswa', $data_update, array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
       	redirect('siswa_detailakun');
	}
}
