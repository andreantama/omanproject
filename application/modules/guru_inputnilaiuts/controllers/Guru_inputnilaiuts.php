<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_inputnilaiuts extends MY_Guru {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_guru_inputnilaiuts','guru_inputnilaiuts');
    }
	
	function index(){
		$data['judul_page'] = 'Input Nilai UTS';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'guru_inputnilai';
		$data['status_input'] = $this->guru_inputnilaiuts->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['status_input_2'] = $this->guru_inputnilaiuts->tampilData('tbl_rel_kelasajar','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['data_kelas_filter'] = $this->db->query('SELECT tbl_kelas.NAMA_KELAS, tbl_kelas.ID_KELAS FROM tbl_guru INNER JOIN tbl_rel_kelasajar INNER JOIN tbl_kelas WHERE tbl_guru.NO_GURU = tbl_rel_kelasajar.NO_GURU AND tbl_kelas.ID_KELAS = tbl_rel_kelasajar.ID_KELAS AND tbl_guru.NO_GURU='.$this->session->userdata('user_access_id').' GROUP BY tbl_rel_kelasajar.ID_KELAS')->result();
		$this->load->view($this->template,$data);
	}
	
	function inputNilaiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('uts', 'UTS', 'numeric');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('guru_inputnilaiuts/inputNilai/'.$this->input->post('id_siswa'));
        }
        $detail_semester = $this->guru_inputnilaiuts->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
        $cek_nilai = $this->guru_inputnilaiuts->tampilData('tbl_nilai_uts','*', array('NO_GURU' => $this->session->userdata('user_access_id'),'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL, 'ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_mapel'))), TRUE);
		if($cek_nilai){
			$data_update = array(
				'UTS' => $this->input->post('uts', TRUE),
				'ID_KELAS' => $this->input->post('id_kelas'),
			);
			$this->guru_inputnilaiuts->editData('tbl_nilai_uts', $data_update, array('NO_GURU' => $this->session->userdata('user_access_id'),'ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_mapel')), 'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('guru_inputnilaiuts/inputNilai/'.$this->input->post('id_siswa'));
		}
		else{
			$id_mapel = $this->guru_inputnilaiuts->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
			$data_insert = array(
				'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL,
				'NO_GURU' => $this->session->userdata('user_access_id'),
				'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')),
				'ID_MAPEL' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_mapel')),
				'ID_KELAS' => $this->input->post('id_kelas'),
				'UTS' => $this->input->post('uts', TRUE),
			);
			
			$this->guru_inputnilaiuts->tambahData($data_insert, 'tbl_nilai_uts');
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('guru_inputnilaiuts/inputNilai/'.$this->input->post('id_siswa'));
		}
	}
	
	function inputNilai($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->guru_inputnilaiuts->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$detail_semester = $this->guru_inputnilaiuts->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$detail_matapelajaran = $this->guru_inputnilaiuts->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$detail_semesteraktif = $this->guru_inputnilaiuts->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		$data['judul_page'] = 'Input Nilai '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'input_nilai';
		$data['modul_active'] = 'guru_inputnilai';
		$data['detail'] = $detail_siswa;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['detail_kelas'] = $this->guru_inputnilaiuts->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $detail_siswa->ID_KELAS), TRUE);
		$data['list_mapel'] = $this->guru_inputnilaiuts->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')));
		$data['id_kelas'] = $detail_siswa->ID_KELAS;
		$data['detail_nilai'] = $this->guru_inputnilaiuts->tampilData('tbl_nilai_uts','*', array('NO_SISWA' => $id_siswa, 'ID_TAHUN_PEL' => $detail_semesteraktif->ID_TAHUN_PEL), TRUE);

		$this->load->view($this->template,$data);
	}
	
	function filterNilai(){
		$this->load->library('jariprom_tools');
		$id_mapel = $this->input->post('id_mapel');

		if($id_mapel != 0){
			$id_siswa = $this->input->post('id_siswa');
			$id_kelas = $this->input->post('id_kelas');
			$detail_semester = $this->guru_inputnilaiuts->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
			$detail_semesteraktif = $this->guru_inputnilaiuts->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
			$data['detail_nilai'] = $this->guru_inputnilaiuts->tampilData('tbl_nilai_uts','*', array('NO_SISWA' => $id_siswa, 'ID_TAHUN_PEL' => $detail_semesteraktif->ID_TAHUN_PEL, 'NO_GURU' => $this->session->userdata('user_access_id'), 'ID_MAPEL' => $id_mapel), TRUE);
			$data['detail_mapel'] = $this->guru_inputnilaiuts->tampilData('tbl_mapel','*', array('ID_MAPEL' => $id_mapel), TRUE);
			$data['no_siswa'] = $id_siswa;
			$data['id_mapel'] = $id_mapel;
			$data['id_kelas'] = $id_kelas;
			$this->load->view('filter_nilai',$data);
		}
		else{
			echo '';
		}
	}
	
	function filterKelas(){
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['detail_kelas'] = $this->guru_inputnilaiuts->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$this->load->view('filter_kelas',$data);
	}
	
	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->guru_inputnilaiuts->setTableDatabase('tbl_siswa');
			$this->guru_inputnilaiuts->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->guru_inputnilaiuts->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->guru_inputnilaiuts->setOrderId(array('NO_SISWA','DESC'));
			$this->guru_inputnilaiuts->setSearchQuery(array('NIPD','NAMA'));
			$this->guru_inputnilaiuts->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$fetch_data = $this->guru_inputnilaiuts->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $sub_array[] = '<a href="'.base_url('guru_inputnilaiuts/inputNilai/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-info btn-sm">Input Nilai</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->guru_inputnilaiuts->get_all_data(),  
	            "recordsFiltered" => $this->guru_inputnilaiuts->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
