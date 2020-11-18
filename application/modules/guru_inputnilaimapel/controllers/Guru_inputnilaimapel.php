<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_inputnilaimapel extends MY_Guru {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_guru_inputnilaimapel','guru_inputnilaimapel');
    }
	
	function index(){
		$data['judul_page'] = 'Input Nilai Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'guru_inputnilai';
		$data['status_input'] = $this->guru_inputnilaimapel->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['status_input_2'] = $this->guru_inputnilaimapel->tampilData('tbl_rel_kelasajar','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['data_kelas_filter'] = $this->db->query('SELECT tbl_kelas.NAMA_KELAS, tbl_kelas.ID_KELAS FROM tbl_guru INNER JOIN tbl_rel_kelasajar INNER JOIN tbl_kelas WHERE tbl_guru.NO_GURU = tbl_rel_kelasajar.NO_GURU AND tbl_kelas.ID_KELAS = tbl_rel_kelasajar.ID_KELAS AND tbl_guru.NO_GURU='.$this->session->userdata('user_access_id').' GROUP BY tbl_rel_kelasajar.ID_KELAS')->result();
		$this->load->view($this->template,$data);
	}
	
	function inputNilaiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('tugas_1', 'Tugas 1', 'numeric');
		$this->form_validation->set_rules('tugas_2', 'Tugas 3', 'numeric');
		$this->form_validation->set_rules('tugas_3', 'Tugas 4', 'numeric');
		$this->form_validation->set_rules('tugas_4', 'Tugas 5', 'numeric');
		$this->form_validation->set_rules('tugas_5', 'Tugas 6', 'numeric');
		$this->form_validation->set_rules('tugas_6', 'Tugas 7', 'numeric');
		$this->form_validation->set_rules('tugas_7', 'Tugas 8', 'numeric');
		$this->form_validation->set_rules('tugas_8', 'Tugas 9', 'numeric');
		$this->form_validation->set_rules('tugas_9', 'Tugas 10', 'numeric');
		$this->form_validation->set_rules('tugas_10', 'Tugas 11', 'numeric');
		$this->form_validation->set_rules('tugas_11', 'Tugas 12', 'numeric');
		$this->form_validation->set_rules('tugas_12', 'Tugas 13', 'numeric');
		$this->form_validation->set_rules('uh_1', 'Tugas 13', 'numeric');
		$this->form_validation->set_rules('uh_2', 'Tugas 13', 'numeric');
		$this->form_validation->set_rules('uh_3', 'Tugas 13', 'numeric');
		$this->form_validation->set_rules('ul_ts', 'Tugas 13', 'numeric');
		$this->form_validation->set_rules('ul_umum', 'Tugas 13', 'numeric');
		$this->form_validation->set_rules('uu_2', 'UU2', 'numeric');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('guru_inputnilaimapel/inputNilai/'.$this->input->post('id_siswa'));
        }
        $detail_semester = $this->guru_inputnilaimapel->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
        $cek_nilai = $this->guru_inputnilaimapel->tampilData('tbl_nilai_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id'),'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL, 'ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_mapel'))), TRUE);
		if($cek_nilai){
			$data_update = array(
				'UH_1' => $this->input->post('uh_1', TRUE),
				'UH_2' => $this->input->post('uh_2', TRUE),
				'UH_3' => $this->input->post('uh_3', TRUE),
				'TUGAS_1' => $this->input->post('tugas_1', TRUE),
				'TUGAS_2' => $this->input->post('tugas_2', TRUE),
				'TUGAS_3' => $this->input->post('tugas_3', TRUE),
				'TUGAS_4' => $this->input->post('tugas_4', TRUE),
				'TUGAS_5' => $this->input->post('tugas_5', TRUE),
				'TUGAS_6' => $this->input->post('tugas_6', TRUE),
				'TUGAS_7' => $this->input->post('tugas_7', TRUE),
				'TUGAS_8' => $this->input->post('tugas_8', TRUE),
				'TUGAS_9' => $this->input->post('tugas_9', TRUE),
				'TUGAS_10' => $this->input->post('tugas_10', TRUE),
				'TUGAS_11' => $this->input->post('tugas_11', TRUE),
				'TUGAS_12' => $this->input->post('tugas_12', TRUE),
				'UL_TS' => $this->input->post('ul_ts', TRUE),
				'UL_UMUM' => $this->input->post('ul_umum', TRUE),
				'UU_2' => $this->input->post('uu_2', TRUE)
			);
			$this->guru_inputnilaimapel->editData('tbl_nilai_mapel', $data_update, array('NO_GURU' => $this->session->userdata('user_access_id'),'ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_mapel')), 'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('guru_inputnilaimapel/inputNilai/'.$this->input->post('id_siswa'));
		}
		else{
			$data_insert = array(
				'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL,
				'NO_GURU' => $this->session->userdata('user_access_id'),
				'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')),
				'ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_mapel')),
				'UH_1' => $this->input->post('uh_1', TRUE),
				'UH_2' => $this->input->post('uh_2', TRUE),
				'UH_3' => $this->input->post('uh_3', TRUE),
				'TUGAS_1' => $this->input->post('tugas_1', TRUE),
				'TUGAS_2' => $this->input->post('tugas_2', TRUE),
				'TUGAS_3' => $this->input->post('tugas_3', TRUE),
				'TUGAS_4' => $this->input->post('tugas_4', TRUE),
				'TUGAS_5' => $this->input->post('tugas_5', TRUE),
				'TUGAS_6' => $this->input->post('tugas_6', TRUE),
				'TUGAS_7' => $this->input->post('tugas_7', TRUE),
				'TUGAS_8' => $this->input->post('tugas_8', TRUE),
				'TUGAS_9' => $this->input->post('tugas_9', TRUE),
				'TUGAS_10' => $this->input->post('tugas_10', TRUE),
				'TUGAS_11' => $this->input->post('tugas_11', TRUE),
				'TUGAS_12' => $this->input->post('tugas_12', TRUE),
				'UL_TS' => $this->input->post('ul_ts', TRUE),
				'UL_UMUM' => $this->input->post('ul_umum', TRUE),
				'UU_2' => $this->input->post('uu_2', TRUE)
			);
			$this->guru_inputnilaimapel->tambahData($data_insert, 'tbl_nilai_mapel');
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('guru_inputnilaimapel/inputNilai/'.$this->input->post('id_siswa'));
		}
	}
	
	function filterNilai(){
		$this->load->library('jariprom_tools');
		$id_mapel = $this->input->post('id_mapel');
		if($id_mapel != 0){
			$id_siswa = $this->input->post('id_siswa');
			$detail_semester = $this->guru_inputnilaimapel->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
			$detail_semesteraktif = $this->guru_inputnilaimapel->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
			$data['detail_nilai'] = $this->guru_inputnilaimapel->tampilData('tbl_nilai_mapel','*', array('NO_SISWA' => $id_siswa, 'ID_TAHUN_PEL' => $detail_semesteraktif->ID_TAHUN_PEL, 'NO_GURU' => $this->session->userdata('user_access_id'), 'ID_MAPEL' => $id_mapel), TRUE);
			$data['detail_mapel'] = $this->guru_inputnilaimapel->tampilData('tbl_mapel','*', array('ID_MAPEL' => $id_mapel), TRUE);
			$data['no_siswa'] = $id_siswa;
			$data['id_mapel'] = $id_mapel;
			$this->load->view('filter_nilai',$data);
		}
		else{
			echo '';
		}
	}
	
	function inputNilai($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->guru_inputnilaimapel->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$detail_semester = $this->guru_inputnilaimapel->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$detail_matapelajaran = $this->guru_inputnilaimapel->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$detail_semesteraktif = $this->guru_inputnilaimapel->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		$data['judul_page'] = 'Input Nilai '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'input_nilai';
		$data['modul_active'] = 'guru_inputnilai';
		$data['detail'] = $detail_siswa;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['detail_kelas'] = $this->guru_inputnilaimapel->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $detail_siswa->ID_KELAS), TRUE);
		$data['id_kelas'] = $detail_siswa->ID_KELAS;
		$data['list_mapel'] = $this->guru_inputnilaimapel->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')));
		$this->load->view($this->template,$data);
	}
	
	function filterKelas(){
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['detail_kelas'] = $this->guru_inputnilaimapel->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$this->load->view('filter_kelas',$data);
	}
	
	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->guru_inputnilaimapel->setTableDatabase('tbl_siswa');
			$this->guru_inputnilaimapel->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->guru_inputnilaimapel->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->guru_inputnilaimapel->setOrderId(array('NO_SISWA','DESC'));
			$this->guru_inputnilaimapel->setSearchQuery(array('NIPD','NAMA'));
			$this->guru_inputnilaimapel->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$fetch_data = $this->guru_inputnilaimapel->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $sub_array[] = '<a href="'.base_url('guru_inputnilaimapel/inputNilai/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-info btn-sm">Input Nilai</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->guru_inputnilaimapel->get_all_data(),  
	            "recordsFiltered" => $this->guru_inputnilaimapel->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
