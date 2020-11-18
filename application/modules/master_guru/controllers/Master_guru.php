<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_guru extends MY_Admin {

	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model('M_master_guru','master_guru');
    }

	function index(){
		$data['judul_page'] = 'Master Guru';
		$data['des_page'] = '';
		$data['page'] = 'view_guru';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}

	function addGuru(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Guru';
		$data['des_page'] = '';
		$data['page'] = 'add_guru';
		$data['modul_active'] = 'master_data';
		$data['data_jenis_ptk'] = $this->master_guru->tampilData('tbl_jenis_ptk','*');
		$data['data_kepegawaian'] = $this->master_guru->tampilData('tbl_kepegawaian','*');
		$data['data_bank'] = $this->master_guru->tampilData('tbl_bank','*');
		$data['data_lembaga_pengangkatan'] = $this->master_guru->tampilData('tbl_lembaga_pengangkatan','*');
		$data['data_pekerjaan'] = $this->master_guru->tampilData('tbl_pekerjaan','*');
		$data['data_sumber_gaji'] = $this->master_guru->tampilData('tbl_sumber_gaji','*');
		$this->load->view($this->template,$data);
	}

	function resetPasswordGuru($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_guru = $this->master_guru->tampilData('tbl_guru','*', array('NO_GURU' => $id_siswa), TRUE);
		$data['judul_page'] = 'Reset Password '.$detail_guru->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'reset_password';
		$data['detail'] = $detail_guru;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template, $data);
	}

	

	function resetPasswordGuruSubmit(){

		$this->load->library('jariprom_tools');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_rules('con_password', 'Konfirmasi Password', 'required|matches[password]');

        if($this->form_validation->run() == FALSE){

        	$this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

        	redirect('master_guru/resetPasswordGuru/'.$this->input->post('id_guru'));

        }

        $data_update = array(

			'PASSWORD' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)

		);

		$this->master_guru->editData('tbl_guru', $data_update, array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_guru'))));		

		$this->session->set_flashdata('notif', "Berhasil mereset password.");

		$this->session->set_flashdata('clr', 'success');

		redirect('master_guru/resetPasswordGuru/'.$this->input->post('id_guru'));

	}

	

	function detailGuru($id){

		$this->load->library('jariprom_tools');

		$id_guru = $this->jariprom_tools->base64_decode_fix($id);

		$detail_guru = $this->master_guru->tampilData('tbl_guru','*', array('NO_GURU' => $id_guru), TRUE);

		$data['judul_page'] = 'Detail guru '.$detail_guru->NAMA;

		$data['des_page'] = '';

		$data['page'] = 'detail_guru';

		$data['detail'] = $detail_guru;

		$data['modul_active'] = 'master_data';

		$data['data_jenis_ptk'] = $this->master_guru->tampilData('tbl_jenis_ptk','*');

		$data['data_kepegawaian'] = $this->master_guru->tampilData('tbl_kepegawaian','*');

		$data['data_bank'] = $this->master_guru->tampilData('tbl_bank','*');

		$data['data_lembaga_pengangkatan'] = $this->master_guru->tampilData('tbl_lembaga_pengangkatan','*');

		$data['data_pekerjaan'] = $this->master_guru->tampilData('tbl_pekerjaan','*');

		$data['data_sumber_gaji'] = $this->master_guru->tampilData('tbl_sumber_gaji','*');

		$this->load->view($this->template,$data);

	}

	

	function addGuruSubmit(){

		$this->load->library('form_validation');

		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric|is_unique[tbl_guru.NIP]');

		$this->form_validation->set_rules('nuptk', 'NUPTK', 'required|is_unique[tbl_guru.NUPTK]');

		$this->form_validation->set_rules('nama', 'Nama', 'required');

		$this->form_validation->set_rules('id_jk', 'Jenis Kelamin', 'required');

		$this->form_validation->set_rules('no_hp', 'Nomer HP', 'required|numeric|is_unique[tbl_guru.NO_HP]');

		$this->form_validation->set_rules('no_telepon', 'Nomer Telepon', 'numeric');

		$this->form_validation->set_rules('rt', 'RT', 'numeric');

		$this->form_validation->set_rules('rw', 'RW', 'numeric');

		$this->form_validation->set_rules('kode_pos', 'Kode Pos', 'numeric');

		$this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[tbl_guru.EMAIL]');

		$this->form_validation->set_rules('password', 'Password', 'required');

		$this->form_validation->set_rules('tempat_lahir_guru', 'Tempat Lahir Guru', 'required');

		$this->form_validation->set_rules('tgl_lahir_guru', 'Tanggal Lahir Guru', 'required');

        if($this->form_validation->run() == FALSE){

        	$this->session->set_flashdata('notif', validation_errors());

			$this->session->set_flashdata('clr', 'danger');

        	redirect('master_guru/addGuru');

        }

        if($_FILES["file_foto"]["error"] != 0){
			$image = NULL;
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
				$image = $this->upload->data('file_name');
            }
		}

		if($_FILES["file_ttd_guru"]["error"] != 0){
			$image2 = NULL;
		}
		else{
			$config['upload_path'] = './assets-admin/img/ttd_guru';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['max_width'] = '200';
			$config['max_height'] = '100';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_ttd_guru')){
				$image2 = $this->upload->data('file_name');
			}
			else{
				$this->session->set_flashdata('notif', $this->upload->display_errors());
				$this->session->set_flashdata('clr', 'danger');
				redirect('master_guru/addGuru');
				exit();
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

		$data_insert = array(

			'NIP' => $this->input->post('nip', TRUE),

			'NAMA' => $this->input->post('nama', TRUE),

			'NUPTK' => html_escape($this->input->post('nuptk', TRUE)),

			'JK' => html_escape($this->input->post('id_jk', TRUE)),

			'TMPT_LAHIR' => html_escape($this->input->post('tempat_lahir_guru', TRUE)),

			'TGL_LAHIR' => html_escape($this->input->post('tgl_lahir_guru', TRUE)),

			'ID_KEPEGAWAIAN' => html_escape($this->input->post('id_kepegawaian', TRUE)),

			'ID_JNS_PTK' => html_escape($this->input->post('id_jenis_ptk', TRUE)),

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

			'PASSWORD' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),

			'FOTO' => $image,
			'FOTO_TTD' => $image2

		);

		$this->master_guru->tambahData($data_insert,'tbl_guru');

		$this->session->set_flashdata('notif', 'Berhasil menambah data.');

		$this->session->set_flashdata('clr', 'success');

        redirect('master_guru/addGuru');

	}

	

	function hapusGuru($id){

		$this->load->library('jariprom_tools');

		$foto = $this->master_guru->tampilData('tbl_guru','FOTO', array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($id)), TRUE);

		if(file_exists('./assets-admin/img/guru/'.$foto->FOTO)){

			unlink('./assets-admin/img/guru/'.$foto->FOTO);

		}

		$this->master_guru->hapusData('tbl_guru',array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($id)));

		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');

		$this->session->set_flashdata('clr', 'info');

        redirect('master_guru');

	}

	

	function editGuruSubmit(){

		$this->load->library('form_validation');

		$this->load->library('jariprom_tools');

		$this->form_validation->set_rules('nip', 'NIP', 'required|numeric');

		$this->form_validation->set_rules('nuptk', 'NUPTK', 'required');

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

		if($this->input->post('nuptk_form') != $this->input->post('nuptk')){

			$this->form_validation->set_rules('nuptk', 'NUPTK', 'is_unique[tbl_guru.NUPTK]');

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

        	redirect('master_guru/detailGuru/'.$this->input->post('id_guru'));

        }

        $foto = $this->master_guru->tampilData('tbl_guru','FOTO, FOTO_TTD', array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_guru'))), TRUE);
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

		if($_FILES["file_ttd_guru"]["error"] != 0){
			$image2 = $foto->FOTO_TTD;
		}
		else{
			$config['upload_path'] = './assets-admin/img/ttd_guru';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = '10048';
			$config['max_width'] = '200';
			$config['max_height'] = '100';
			$config['file_ext_tolower'] = TRUE;
			$config['encrypt_name'] = TRUE;
			$config['detect_mime'] = TRUE;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('file_ttd_guru')){
				if(file_exists('./assets-admin/img/ttd_guru/'.$foto->FOTO_TTD)){
					unlink('./assets-admin/img/ttd_guru/'.$foto->FOTO_TTD);
				}
				$image2 = $this->upload->data('file_name');
            }
			else{
				$this->session->set_flashdata('notif', $this->upload->display_errors());
				$this->session->set_flashdata('clr', 'danger');
				redirect('master_guru/detailGuru/'.$this->input->post('id_guru'));
				exit();
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

			'NUPTK' => html_escape($this->input->post('nuptk', TRUE)),

			'JK' => html_escape($this->input->post('id_jk', TRUE)),

			'TMPT_LAHIR' => html_escape($this->input->post('tempat_lahir_guru', TRUE)),

			'TGL_LAHIR' => html_escape($this->input->post('tgl_lahir_guru', TRUE)),

			'ID_KEPEGAWAIAN' => html_escape($this->input->post('id_kepegawaian', TRUE)),

			'ID_JNS_PTK' => html_escape($this->input->post('id_jenis_ptk', TRUE)),

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

			'FOTO' => $image,
			'FOTO_TTD' => $image2

		);

		$this->master_guru->editData('tbl_guru', $data_update, array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_guru'))));		

		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");

		$this->session->set_flashdata('clr', 'success');

       	redirect('master_guru/detailGuru/'.$this->input->post('id_guru'));

	}

	

	function getGuru(){

		if($this->input->is_ajax_request()){

			$this->load->library('jariprom_tools');

			$this->master_guru->setTableDatabase('tbl_guru');

			$this->master_guru->setSelectColumn(array('NUPTK','NAMA','NO_GURU'));

			$this->master_guru->setOrderColumn(array('NUPTK','NAMA'));

			$this->master_guru->setOrderId(array('NO_GURU','DESC'));

			$this->master_guru->setSearchQuery(array('NUPTK','NAMA'));

			$fetch_data = $this->master_guru->generateDatatables();

			$data = array();

			foreach($fetch_data as $row){  

	            $sub_array = array(); 

	            $sub_array[] = $row->NUPTK;

	            $sub_array[] = $row->NAMA;

	            $sub_array[] = '<a href="'.base_url('master_guru/detailGuru/'.$this->jariprom_tools->base64_encode_fix($row->NO_GURU)).'" class="btn btn-info btn-sm">Edit</a> '.'<a href="'.base_url('master_guru/resetPasswordGuru/'.$this->jariprom_tools->base64_encode_fix($row->NO_GURU)).'" class="btn btn-default btn-sm">Reset Password</a>.'.'<a href="'.base_url('master_guru/hapusGuru/'.$this->jariprom_tools->base64_encode_fix($row->NO_GURU)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  

	            $data[] = $sub_array;

	       }  

	       $output = array(  

	            "draw" => intval($_GET["draw"]), 

	            "recordsTotal" => $this->master_guru->get_all_data(),  

	            "recordsFiltered" => $this->master_guru->get_filtered_data(),  

	            "data" => $data  

	       );

	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));

		}

		else{

			echo 'No direct script access allowed.';

		}

	}

}

