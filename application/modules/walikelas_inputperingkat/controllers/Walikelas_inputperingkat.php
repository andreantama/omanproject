<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_inputperingkat extends MY_Walikelas {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_inputperingkat','walikelas_inputperingkat');
    }
	
	function index(){
		$wali_kelas = $this->walikelas_inputperingkat->tampilData('tbl_kelas','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$id = $wali_kelas->ID_KELAS;
		$data['judul_page'] = 'Input Bintang Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'walikelas_inputperingkat';
		$data['id_kelas'] = $id;
		$this->load->view($this->template,$data);
	}
	
	function inputNilai($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->walikelas_inputperingkat->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$detail_semester = $this->walikelas_inputperingkat->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$detail_matapelajaran = $this->walikelas_inputperingkat->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$detail_semesteraktif = $this->walikelas_inputperingkat->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		$data['judul_page'] = 'Input Bintang Pelajaran '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'input_nilai';
		$data['modul_active'] = 'walikelas_inputperingkat';
		$data['detail'] = $detail_siswa;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['detail_nilai'] = $this->walikelas_inputperingkat->tampilData('tbl_nilai_peringkat','*', array('NO_SISWA' => $id_siswa, 'ID_TAHUN_PEL' => $detail_semesteraktif->ID_TAHUN_PEL), TRUE);
		$this->load->view($this->template,$data);
	}
	
	function inputNilaiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('id_kelas', 'ID KELAS', 'numeric');
//		$this->form_validation->set_rules('id_siswa', 'ID SISWA', 'numeric');
//		$this->form_validation->set_rules('peringkat', 'Peringkat', 'numeric');
    if($this->form_validation->run() == FALSE){
      $this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
      redirect('walikelas_inputperingkat/inputNilai/'.$this->input->post('id_siswa'));
    }
		$detail_semester = $this->walikelas_inputperingkat->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		
		// Check exist 
//		$exist_peringkat = $this->walikelas_inputperingkat->existPeringkatKelas(array('PERINGKAT' => $this->input->post('peringkat', TRUE), 'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_KELAS' => $this->input->post('id_kelas', TRUE), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
//    if($exist_peringkat){
//      $this->session->set_flashdata('notif', 'Duplikat Bintang Pelajaran ' . $this->input->post('peringkat', TRUE) . ' !');
//			$this->session->set_flashdata('clr', 'danger');
//      redirect('walikelas_inputperingkat/inputNilai/'.$this->input->post('id_siswa'));
//    }	
    
    $cek_nilai = $this->walikelas_inputperingkat->tampilData('tbl_nilai_peringkat','*', array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		
		if($cek_nilai){
			$data_update = array(
				'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL,
				'ID_KELAS' => $this->input->post('id_kelas', TRUE),
				'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')),
				'PERINGKAT' => $this->input->post('peringkat', TRUE),
				'PREDIKAT' => $this->input->post('predikat', TRUE),
				'CATATAN' => $this->input->post('catatan', TRUE)
			);
			$this->walikelas_inputperingkat->editData('tbl_nilai_peringkat', $data_update, array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('walikelas_inputperingkat/inputNilai/'.$this->input->post('id_siswa'));
		}
		else{
			$data_insert = array(
				'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL,
				'ID_KELAS' => $this->input->post('id_kelas', TRUE),
				'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')),
				'PERINGKAT' => $this->input->post('peringkat', TRUE),
				'PREDIKAT' => $this->input->post('predikat', TRUE),
				'CATATAN' => $this->input->post('catatan', TRUE)
			);
			$this->walikelas_inputperingkat->tambahData($data_insert, 'tbl_nilai_peringkat');
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('walikelas_inputperingkat/inputNilai/'.$this->input->post('id_siswa'));
		}
	}
	
	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');

			$detail_semester = $this->walikelas_inputperingkat->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
				
			$this->walikelas_inputperingkat->setTableDatabase('tbl_siswa');
			$this->walikelas_inputperingkat->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->walikelas_inputperingkat->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->walikelas_inputperingkat->setOrderId(array('NO_SISWA','DESC'));
			$this->walikelas_inputperingkat->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$this->walikelas_inputperingkat->setSearchQuery(array('NIPD','NAMA'));
			$fetch_data = $this->walikelas_inputperingkat->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
				
	            $sub_array = array(); 
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $kelas = $this->walikelas_inputperingkat->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $row->ID_KELAS), TRUE);
	            $peringkat = $this->walikelas_inputperingkat->getPeringkatKelas(array('ID_KELAS' => $row->ID_KELAS, 'NO_SISWA' => $row->NO_SISWA, 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
	            //$sub_array[] = ($kelas) ? $kelas->NAMA_KELAS : '-'; 
							$sub_array[] = $peringkat;
	            $sub_array[] = '<a href="'.base_url('walikelas_inputperingkat/inputNilai/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-info btn-sm">Input Nilai</a> ';

	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->walikelas_inputperingkat->get_all_data(),  
	            "recordsFiltered" => $this->walikelas_inputperingkat->get_filtered_data(),  
	            "data" => $data  
	       );
			
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
