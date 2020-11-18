<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_rekapnilai extends MY_Guru {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_guru_rekapnilai','guru_rekapnilai');
    }
	
	function index(){
		$data['judul_page'] = 'Rekap Nilai Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'guru_rekap';
		$data['status_rekap'] = $this->guru_rekapnilai->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['status_input_2'] = $this->guru_rekapnilai->tampilData('tbl_rel_kelasajar','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$detail_mapel = $this->guru_rekapnilai->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['list_mapel'] = $this->guru_rekapnilai->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')));
		$data['data_kelas_filter'] = $this->db->query('SELECT tbl_kelas.NAMA_KELAS, tbl_kelas.ID_KELAS FROM tbl_guru INNER JOIN tbl_rel_kelasajar INNER JOIN tbl_kelas WHERE tbl_guru.NO_GURU = tbl_rel_kelasajar.NO_GURU AND tbl_kelas.ID_KELAS = tbl_rel_kelasajar.ID_KELAS AND tbl_guru.NO_GURU='.$this->session->userdata('user_access_id'))->result();
		$data['data_semester'] = $this->guru_rekapnilai->tampilData('tbl_tahun_pel');
		$this->load->view($this->template,$data);
	}
	
	function cetakRekapNilaiMapel($id,$id_tahun_pel,$id_mapel){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$detail_semesteraktif = $this->guru_rekapnilai->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $id_tahun_pel), TRUE);
		$data['id_kelas'] = $id_kelas;
		$data['detail_kelas'] = $this->guru_rekapnilai->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['detail_semester'] = $id_tahun_pel;
		$data['id_mapel'] = $id_mapel;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['rekap_nilai'] = $this->guru_rekapnilai->tampilData('tbl_siswa', '*', array('ID_KELAS' => $id_kelas));
		$data['detail_mapel'] = $this->guru_rekapnilai->tampilData('tbl_mapel','*', array('ID_MAPEL' => $id_mapel), TRUE);
		$data['data_infosekolah'] = $this->guru_rekapnilai->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$this->load->view('cetak_nilai',$data);
	}
	
	function filterKelas(){
		$this->load->library('jariprom_tools');
		$id_mapel = $this->input->post('id_mapel');
		if($id_mapel != 0){
			$detail_mapel = $this->guru_rekapnilai->tampilData('tbl_mapel','*', array('ID_MAPEL' => $id_mapel), TRUE);
			$data['id_kelas'] = $this->input->post('id_kelas');
			$data['id_mapel'] = $id_mapel;
			$data['detail_mapel'] = $detail_mapel;
			$data['detail_kelas'] = $this->guru_rekapnilai->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
			$data['detail_semester'] = $this->input->post('id_semester');
			$data['rekap_nilai'] = $this->guru_rekapnilai->tampilData('tbl_siswa', '*', array('ID_KELAS' => $data['id_kelas']));
			$this->load->view('filter_kelas',$data);
		}
		else{
			echo '<div class="panel panel-default"><div class="panel-body">Pilih mata pelajaran terlebih dahulu.</div></div>';
		}
	}
}
