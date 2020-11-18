<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_rekapnilaiuts extends MY_Walikelas {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_rekapnilaiuts','walikelas_rekapnilaiuts');
    }
	
	function index(){
		$data['judul_page'] = 'Rekap Nilai UTS';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['id_kelas'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_kelas','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['data_semester'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_tahun_pel','*');
		$data['modul_active'] = 'walikelas_rekap';
		$this->load->view($this->template,$data);
	}
	
	function cetakRekapNilaiUts($id,$id_tahun_pel){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$detail_semesteraktif = $this->walikelas_rekapnilaiuts->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $id_tahun_pel), TRUE);
		$data['id_kelas'] = $id_kelas;
		$data['detail_kelas'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['detail_semester'] = $id_tahun_pel;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['rekap_nilai'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_siswa', '*', array('ID_KELAS' => $id_kelas));
		$data['data_infosekolah'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$data['data_mapel'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_mapel','*');
		$this->load->view('cetak_nilai',$data);
	}
	
	function filterKelas(){
		$this->load->library('jariprom_tools');
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['detail_semester'] = $this->input->post('id_semester');
		$data['detail_kelas'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$data['rekap_nilai'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_siswa', '*', array('ID_KELAS' => $data['id_kelas']));
		$data['data_mapel'] = $this->walikelas_rekapnilaiuts->tampilData('tbl_mapel','*');
		$this->load->view('filter_kelas',$data);
	}
}
