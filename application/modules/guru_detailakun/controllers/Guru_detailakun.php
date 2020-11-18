<?php defined('BASEPATH') OR exit('No direct script access allowed');

class guru_detailakun extends MY_Guru {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_guru_detailakun','guru_detailakun');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$detail_guru = $this->guru_detailakun->tampilData('tbl_guru','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['judul_page'] = 'Detail Akun';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['detail'] = $detail_guru;
		$data['modul_active'] = 'guru_detailakun';
		$data['data_jenis_ptk'] = $this->guru_detailakun->tampilData('tbl_jenis_ptk','*');
		$data['data_kepegawaian'] = $this->guru_detailakun->tampilData('tbl_kepegawaian','*');
		$data['data_bank'] = $this->guru_detailakun->tampilData('tbl_bank','*');
		$data['data_lembaga_pengangkatan'] = $this->guru_detailakun->tampilData('tbl_lembaga_pengangkatan','*');
		$data['data_pekerjaan'] = $this->guru_detailakun->tampilData('tbl_pekerjaan','*');
		$data['data_sumber_gaji'] = $this->guru_detailakun->tampilData('tbl_sumber_gaji','*');
		$this->load->view($this->template,$data);
	}
	
	function cetakGuru(){
		$this->load->library('jariprom_tools');
		$detail_guru = $this->guru_detailakun->tampilData('tbl_guru','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['judul_page'] = 'Detail Akun';
		$data['des_page'] = '';
		$data['detail'] = $detail_guru;
		$data['modul_active'] = 'guru_detailakun';
		$data['data_jenis_ptk'] = $this->guru_detailakun->tampilData('tbl_jenis_ptk','*');
		$data['data_kepegawaian'] = $this->guru_detailakun->tampilData('tbl_kepegawaian','*');
		$data['data_bank'] = $this->guru_detailakun->tampilData('tbl_bank','*');
		$data['data_lembaga_pengangkatan'] = $this->guru_detailakun->tampilData('tbl_lembaga_pengangkatan','*');
		$data['data_pekerjaan'] = $this->guru_detailakun->tampilData('tbl_pekerjaan','*');
		$data['data_sumber_gaji'] = $this->guru_detailakun->tampilData('tbl_sumber_gaji','*');
		$data['data_infosekolah'] = $this->guru_detailakun->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$this->load->view('cetak', $data);
	}
	
	function editGuruSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('id_jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('no_hp', 'Nomer HP', 'required|numeric');
		$this->form_validation->set_rules('no_telepon', 'Nomer Telepon', 'numeric');
		$this->form_validation->set_rules('rt', 'RT', 'numeric');
		$this->form_validation->set_rules('rw', 'RW', 'numeric');
		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		$this->form_validation->set_rules('tempat_lahir_guru', 'Tempat Lahir Guru', 'required');
		$this->form_validation->set_rules('tgl_lahir_guru', 'Tanggal Lahir Guru', 'required');
		if($this->input->post('nip_form') != $this->input->post('nip')){
			$this->form_validation->set_rules('nip', 'NIP', 'is_unique[tbl_guru.NIP]');
		}
		if($this->input->post('no_hp_form') != $this->input->post('no_hp')){
			$this->form_validation->set_rules('no_hp', 'NO HP', 'is_unique[tbl_guru.NO_HP]');
		}
		if($this->input->post('email_form') != $this->input->post('email')){
			$this->form_validation->set_rules('email', 'Email', 'is_unique[tbl_guru.EMAIL]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('guru_detailakun');
        }
        $foto = $this->guru_detailakun->tampilData('tbl_guru','FOTO', array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_guru'))), TRUE);
        if($_FILES["file_foto"]["error"] != 0){
			$image = $foto->FOTO;
		}
		else{
			$config['upload_path'] = './assets-admin/img/guru';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_foto')){
				if(file_exists('./assets-admin/img/guru/'.$foto->FOTO)){
					unlink('./assets-admin/img/guru/'.$foto->FOTO);
				}
				$image = $this->upload->data('file_name');
            }
		}
		if($this->input->post('lisensi_kepala_sekolah')){
			$lisensi_kepala_sekolah = 1;
		}
		else{
			$lisensi_kepala_sekolah = 0;
		}
		if($this->input->post('diklat_kepengawasan')){
			$diklat_kepengawasan = 1;
		}
		else{
			$diklat_kepengawasan = 0;
		}
		if($this->input->post('keahlian_braille')){
			$keahlian_braille = 1;
		}
		else{
			$keahlian_braille = 0;
		}
		if($this->input->post('keahlian_bahasa_isyarat')){
			$keahlian_bahasa_isyarat = 1;
		}
		else{
			$keahlian_bahasa_isyarat = 0;
		}
		$data_update = array(
			'NIP' => $this->input->post('nip', TRUE),
			'NAMA' => $this->input->post('nama', TRUE),
			'JK' => html_escape($this->input->post('id_jk', TRUE)),
			'TMPT_LAHIR' => html_escape($this->input->post('tempat_lahir_guru', TRUE)),
			'TGL_LAHIR' => html_escape($this->input->post('tgl_lahir_guru', TRUE)),
			'ID_KEPEGAWAIAN' => html_escape($this->input->post('id_kepegawaian', TRUE)),
			'AGAMA' => $this->input->post('id_agama', TRUE),
			'ALAMAT_JALAN' => html_escape($this->input->post('alamat', TRUE)),
			'RT' => html_escape($this->input->post('rt', TRUE)),
			'RW' => html_escape($this->input->post('rw', TRUE)),
			'NAMA_DUSUN' => html_escape($this->input->post('dusun', TRUE)),
			'DESA_KELURAHAN' => html_escape($this->input->post('kelurahan', TRUE)),
			'KECAMATAN' => html_escape($this->input->post('kecamatan', TRUE)),
			'KODE_POS' => html_escape($this->input->post('kode_pos', TRUE)),
			'TELEPON' => html_escape($this->input->post('no_telepon', TRUE)),
			'NO_HP' => html_escape($this->input->post('no_hp', TRUE)),
			'EMAIL' => html_escape($this->input->post('email', TRUE)),
			'TUGAS_TAMBAHAN' => html_escape($this->input->post('tugas_tambahan', TRUE)),
			'SK_CPNS' => html_escape($this->input->post('sk_cpns', TRUE)),
			'TGL_CPNS' => html_escape($this->input->post('tgl_cpns', TRUE)),
			'SK_PENGANGKATAN' => html_escape($this->input->post('sk_pengangkatan', TRUE)),
			'TMT_PENGANGKATAN' => html_escape($this->input->post('tmt_pengangkatan', TRUE)),
			'ID_LEMBAGA_PENGANGKATAN' => html_escape($this->input->post('id_lembaga_pengangkatan', TRUE)),
			'PANGKAT_GOLONGAN' => html_escape($this->input->post('pangkat_golongan', TRUE)),
			'ID_SUMBER_GAJI' => html_escape($this->input->post('id_sumber_gaji', TRUE)),
			'NAMA_IBU_KANDUNG' => html_escape($this->input->post('nama_ibu_kandung', TRUE)),
			'STS_PERKAWINAN' => html_escape($this->input->post('id_status_perkawinan', TRUE)),
			'NAMA_SUAMI_ISTRI' => html_escape($this->input->post('nama_suami_istri', TRUE)),
			'NIP_SUAMI_ISTRI' => html_escape($this->input->post('nip_suami_istri', TRUE)),
			'ID_PEKERJAAN_SUAMI_ISTRI' => html_escape($this->input->post('id_pekerjaan_suami_istri', TRUE)),
			'TMT_PNS' => html_escape($this->input->post('tamat_pns', TRUE)),
			'STS_LISENSI_KEPALA_SEKOLAH' => $lisensi_kepala_sekolah,
			'STS_DIKLAT_KEPEGAWAIAN' => $diklat_kepengawasan,
			'STS_KEAHLIAN_BRAILLE' => $keahlian_braille,
			'STS_KEAHLIAN_BAHASA_ISYARAT' => $keahlian_bahasa_isyarat,
			'NPWP' => html_escape($this->input->post('npwp', TRUE)),
			'NAMA_WAJIB_PAJAK' => html_escape($this->input->post('nama_wajib_pajak', TRUE)),
			'KEWARGANEGARAAN' => html_escape($this->input->post('kewarganegaraan', TRUE)),
			'ID_BANK' => html_escape($this->input->post('id_bank', TRUE)),
			'NOMOR_REKENING_BANK' => html_escape($this->input->post('no_rekening', TRUE)),
			'REKENING_ATAS_NAMA' => html_escape($this->input->post('atas_nama', TRUE)),
			'NIK' => html_escape($this->input->post('nik_suami_istri', TRUE)),
			'FOTO' => $image
		);
		$this->guru_detailakun->editData('tbl_guru', $data_update, array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_guru'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
       	redirect('guru_detailakun');
	}
}
