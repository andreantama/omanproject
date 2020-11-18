<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_rekapnilai extends MY_Walikelas {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_rekapnilai','walikelas_rekapnilai');
    }
	
	function index(){
		$data['judul_page'] = 'Rekap Nilai Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['id_kelas'] = $this->walikelas_rekapnilai->tampilData('tbl_kelas','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['data_semester'] = $this->walikelas_rekapnilai->tampilData('tbl_tahun_pel','*');
		$data['data_mapel'] = $this->walikelas_rekapnilai->tampilData('tbl_mapel','*');
		$data['modul_active'] = 'walikelas_rekap';
		$this->load->view($this->template,$data);
	}
	
	function cetakRekapNilaiMapel($id,$id_tahun_pel,$id_mapel){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$detail_semesteraktif = $this->walikelas_rekapnilai->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $id_tahun_pel), TRUE);
		$data['id_kelas'] = $id_kelas;
		$data['detail_kelas'] = $this->walikelas_rekapnilai->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['detail_semester'] = $id_tahun_pel;
		$data['id_mapel'] = $id_mapel;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['rekap_nilai'] = $this->walikelas_rekapnilai->tampilData('tbl_siswa', '*', array('ID_KELAS' => $id_kelas));
		$data['detail_mapel'] = $this->walikelas_rekapnilai->tampilData('tbl_mapel','*', array('ID_MAPEL' => $id_mapel), TRUE);
		$data['data_infosekolah'] = $this->walikelas_rekapnilai->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$this->load->view('cetak_nilai',$data);
	}
	
	function filterKelas(){
		$this->load->library('jariprom_tools');
		$detail_mapel = $this->walikelas_rekapnilai->tampilData('tbl_mapel','*', array('ID_MAPEL' => $this->input->post('id_mapel')), TRUE);
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['id_mapel'] = $this->input->post('id_mapel');
		$data['detail_mapel'] = $detail_mapel;
		$data['detail_kelas'] = $this->walikelas_rekapnilai->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$data['detail_semester'] = $this->input->post('id_semester');
		$data['rekap_nilai'] = $this->walikelas_rekapnilai->tampilData('tbl_siswa', '*', array('ID_KELAS' => $data['id_kelas']));
		$this->load->view('filter_kelas',$data);
	}
}
