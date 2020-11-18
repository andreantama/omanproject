<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_siswa extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_siswa','master_siswa');
    }
	
	function index(){
		$data['judul_page'] = 'Master Siswa';
		$data['des_page'] = '';
		$data['page'] = 'view_siswa';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}
	
	function resetPasswordSiswa($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->master_siswa->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$data['judul_page'] = 'Reset Password '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'reset_password';
		$data['detail'] = $detail_siswa;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template, $data);
	}
	
	function resetPasswordSiswaSubmit(){
		$this->load->library('jariprom_tools');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('con_password', 'Konfirmasi Password', 'required|matches[password]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_siswa/resetPasswordSiswa/'.$this->input->post('id_siswa'));
        }
        $data_update = array(
			'PASSWORD' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
		);
		$this->master_siswa->editData('tbl_siswa', $data_update, array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa'))));		
		$this->session->set_flashdata('notif', "Berhasil mereset password.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_siswa/resetPasswordSiswa/'.$this->input->post('id_siswa'));
	}
	
	function addSiswa(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Siswa';
		$data['des_page'] = '';
		$data['page'] = 'add_siswa';
		$data['modul_active'] = 'master_data';
		$data['data_transportasi'] = $this->master_siswa->tampilData('tbl_alat_transportasi','*');
		$data['data_jenis_tinggal'] = $this->master_siswa->tampilData('tbl_jenis_tinggal','*');
		$data['data_bank'] = $this->master_siswa->tampilData('tbl_bank','*');
		$data['data_jenjang_pendidikan_ayah'] = $this->master_siswa->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_jenjang_pendidikan_ibu'] = $this->master_siswa->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_jenjang_pendidikan_wali'] = $this->master_siswa->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_pekerjaan_ayah'] = $this->master_siswa->tampilData('tbl_pekerjaan','*');
		$data['data_pekerjaan_ibu'] = $this->master_siswa->tampilData('tbl_pekerjaan','*');
		$data['data_pekerjaan_wali'] = $this->master_siswa->tampilData('tbl_pekerjaan','*');
		$this->load->view($this->template,$data);
	}
	
	function detailSiswa($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->master_siswa->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$data['judul_page'] = 'Detail siswa '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'detail_siswa';
		$data['detail'] = $detail_siswa;
		$data['modul_active'] = 'master_data';
		$data['data_transportasi'] = $this->master_siswa->tampilData('tbl_alat_transportasi','*');
		$data['data_jenis_tinggal'] = $this->master_siswa->tampilData('tbl_jenis_tinggal','*');
		$data['data_bank'] = $this->master_siswa->tampilData('tbl_bank','*');
		$data['data_jenjang_pendidikan_ayah'] = $this->master_siswa->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_jenjang_pendidikan_ibu'] = $this->master_siswa->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_jenjang_pendidikan_wali'] = $this->master_siswa->tampilData('tbl_jenjang_pendidikan','*');
		$data['data_pekerjaan_ayah'] = $this->master_siswa->tampilData('tbl_pekerjaan','*');
		$data['data_pekerjaan_ibu'] = $this->master_siswa->tampilData('tbl_pekerjaan','*');
		$data['data_pekerjaan_wali'] = $this->master_siswa->tampilData('tbl_pekerjaan','*');
		$this->load->view($this->template,$data);
	}
	
	function addSiswaSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nisn', 'NISN', 'required|numeric|is_unique[tbl_siswa.NISN]');
		$this->form_validation->set_rules('nipd', 'NIPD', 'required|is_unique[tbl_siswa.NIPD]');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_siswa/addSiswa');
        }
        if($_FILES["file_foto"]["error"] != 0){
			$image = NULL;
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
		$data_insert = array(
			'NISN' => $this->input->post('nisn', TRUE),
			'NIPD' => $this->input->post('nipd', TRUE),
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
			'PASSWORD' => password_hash($this->input->post('nipd', TRUE), PASSWORD_DEFAULT),
			'FOTO' => $image,
			'ID_KELAS' => 1
		);
		$this->master_siswa->tambahData($data_insert,'tbl_siswa');
		$this->session->set_flashdata('notif', 'Berhasil menambah data.');
		$this->session->set_flashdata('clr', 'success');
        redirect('master_siswa/addSiswa');
	}
	
	function hapusSiswa($id){
		$this->load->library('jariprom_tools');
		$foto = $this->master_siswa->tampilData('tbl_siswa','FOTO', array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($id)), TRUE);
		if(file_exists('./assets-admin/img/siswa/'.$foto->FOTO)){
			unlink('./assets-admin/img/siswa/'.$foto->FOTO);
		}
		$this->master_siswa->hapusData('tbl_siswa',array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_siswa');
	}
	
	function editSiswaSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nisn', 'NISN', 'required|numeric');
		$this->form_validation->set_rules('nipd', 'NIPD', 'required');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		if($this->input->post('nisn_form') != $this->input->post('nisn')){
			$this->form_validation->set_rules('nisn', 'NISN', 'is_unique[tbl_siswa.NISN]');
		}
		if($this->input->post('nipd_form') != $this->input->post('nipd')){
			$this->form_validation->set_rules('nipd', 'NIPD', 'is_unique[tbl_siswa.NIPD]');
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
        	redirect('master_siswa/detailSiswa/'.$this->input->post('id_siswa'));
        }
        $foto = $this->master_siswa->tampilData('tbl_siswa','FOTO', array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa'))), TRUE);
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
			'NIPD' => $this->input->post('nipd', TRUE),
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
		$this->master_siswa->editData('tbl_siswa', $data_update, array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa'))));		
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
       	redirect('master_siswa/detailSiswa/'.$this->input->post('id_siswa'));
	}
	
	function getSiswa(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_siswa->setTableDatabase('tbl_siswa');
			$this->master_siswa->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->master_siswa->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->master_siswa->setOrderId(array('NO_SISWA','DESC'));
			$this->master_siswa->setSearchQuery(array('NIPD','NAMA'));
			$fetch_data = $this->master_siswa->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $kelas = $this->master_siswa->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $row->ID_KELAS), TRUE);
	            if($kelas){
					$a = $kelas->NAMA_KELAS;
				}
				else{
					$a = '-';
				}
	            $sub_array[] = $a;  
	            $sub_array[] = '<a href="'.base_url('master_siswa/detailSiswa/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-info btn-sm">Edit</a> '.'<a href="'.base_url('master_siswa/resetPasswordSiswa/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-default btn-sm">Reset Password</a>.'.'<a href="'.base_url('master_siswa/hapusSiswa/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_siswa->get_all_data(),  
	            "recordsFiltered" => $this->master_siswa->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
