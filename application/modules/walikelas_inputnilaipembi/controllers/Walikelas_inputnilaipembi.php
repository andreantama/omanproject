<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_inputnilaipembi extends MY_Walikelas {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_inputnilaipembi','walikelas_inputnilaipembi');
    }
	
	function index(){
		$wali_kelas = $this->walikelas_inputnilaipembi->tampilData('tbl_kelas','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$id = $wali_kelas->ID_KELAS;
		$data['judul_page'] = 'Input Nilai Pembiasaan';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'walikelas_inputpem';
		$data['id_kelas'] = $id;
		$this->load->view($this->template,$data);
	}
	
	function inputNilai($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->walikelas_inputnilaipembi->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$detail_semester = $this->walikelas_inputnilaipembi->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$detail_matapelajaran = $this->walikelas_inputnilaipembi->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$detail_semesteraktif = $this->walikelas_inputnilaipembi->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		$data['judul_page'] = 'Input Nilai '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'input_nilai';
		$data['modul_active'] = 'walikelas_inputpem';
		$data['detail'] = $detail_siswa;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['detail_nilai'] = $this->walikelas_inputnilaipembi->tampilData('tbl_nilai_pembiasaan','*', array('NO_SISWA' => $id_siswa, 'ID_TAHUN_PEL' => $detail_semesteraktif->ID_TAHUN_PEL), TRUE);
		$this->load->view($this->template,$data);
	}
	
	function inputNilaiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('wudhu', 'Wudhu', 'numeric');
		$this->form_validation->set_rules('sholat', 'Sholat', 'numeric');
		$this->form_validation->set_rules('surat_pendek', 'Surah Pendek', 'numeric');
		$this->form_validation->set_rules('tahsin', 'Tahsin', 'numeric');
		$this->form_validation->set_rules('hadist', 'Hadist', 'numeric');
		$this->form_validation->set_rules('doa', 'Doa', 'numeric');
		$this->form_validation->set_rules('tahfidz', 'Tahfidz', 'numeric');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('walikelas_inputnilaipembi/inputNilai/'.$this->input->post('id_siswa'));
        }
        $detail_semester = $this->walikelas_inputnilaipembi->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
        $cek_nilai = $this->walikelas_inputnilaipembi->tampilData('tbl_nilai_pembiasaan','*', array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		if($cek_nilai){
			$data_update = array(
				'WUDHU' => $this->input->post('wudhu', TRUE),
				'SHOLAT' => $this->input->post('sholat', TRUE),
				'TAHSIN' => $this->input->post('tahsin', TRUE),
				'SURAT_PENDEK' => $this->input->post('surat_pendek', TRUE),
				'HADITS' => $this->input->post('hadist', TRUE),
				'DOA' => $this->input->post('doa', TRUE),
				'TAHFIDZH' => $this->input->post('tahfidz', TRUE),
				'TAHFIDZH_2' => $this->input->post('tahfidz_2', TRUE),
				'CATATAN' => $this->input->post('catatan', TRUE),
				'PREDIKAT' => $this->input->post('predikat', TRUE),
				'NAMA_SURAH' => $this->input->post('nama_surah', TRUE),
				'NAMA_SURAH_2' => $this->input->post('nama_surah_2', TRUE)
			);
			$this->walikelas_inputnilaipembi->editData('tbl_nilai_pembiasaan', $data_update, array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('walikelas_inputnilaipembi/inputNilai/'.$this->input->post('id_siswa'));
		}
		else{
			$data_insert = array(
				'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL,
				'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')),
				'WUDHU' => $this->input->post('wudhu', TRUE),
				'SHOLAT' => $this->input->post('sholat', TRUE),
				'TAHSIN' => $this->input->post('tahsin', TRUE),
				'SURAT_PENDEK' => $this->input->post('surat_pendek', TRUE),
				'HADITS' => $this->input->post('hadist', TRUE),
				'DOA' => $this->input->post('doa', TRUE),
				'TAHFIDZH' => $this->input->post('tahfidz', TRUE),
				'TAHFIDZH_2' => $this->input->post('tahfidz_2', TRUE),
				'CATATAN' => $this->input->post('catatan', TRUE),
				'PREDIKAT' => $this->input->post('predikat', TRUE),
				'NAMA_SURAH' => $this->input->post('nama_surah', TRUE),
				'NAMA_SURAH_2' => $this->input->post('nama_surah_2', TRUE)
			);
			$this->walikelas_inputnilaipembi->tambahData($data_insert, 'tbl_nilai_pembiasaan');
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('walikelas_inputnilaipembi/inputNilai/'.$this->input->post('id_siswa'));
		}
	}
	
	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->walikelas_inputnilaipembi->setTableDatabase('tbl_siswa');
			$this->walikelas_inputnilaipembi->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->walikelas_inputnilaipembi->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->walikelas_inputnilaipembi->setOrderId(array('NO_SISWA','DESC'));
			$this->walikelas_inputnilaipembi->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$this->walikelas_inputnilaipembi->setSearchQuery(array('NIPD','NAMA'));
			$fetch_data = $this->walikelas_inputnilaipembi->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $kelas = $this->walikelas_inputnilaipembi->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $row->ID_KELAS), TRUE);
	            if($kelas){
					$a = $kelas->NAMA_KELAS;
				}
				else{
					$a = '-';
				}
	            $sub_array[] = $a;  
	            $sub_array[] = '<a href="'.base_url('walikelas_inputnilaipembi/inputNilai/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-info btn-sm">Input Nilai</a> ';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->walikelas_inputnilaipembi->get_all_data(),  
	            "recordsFiltered" => $this->walikelas_inputnilaipembi->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
