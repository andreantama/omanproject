<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_rekapnilaipembi extends MY_Siswa {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_siswa_rekapnilaipembi','siswa_rekapnilaipembi');
    }
	
	function index(){
		$data['judul_page'] = 'Rekap Nilai Pembiasaan';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$detail_siswa = $this->siswa_rekapnilaipembi->tampilData('tbl_siswa','ID_KELAS', array('NO_SISWA' => $this->session->userdata('user_access_id')), TRUE);
		$data['id_kelas'] = $this->siswa_rekapnilaipembi->tampilData('tbl_kelas','*', array('ID_KELAS' => $detail_siswa->ID_KELAS), TRUE);
		$data['data_semester'] = $this->siswa_rekapnilaipembi->tampilData('tbl_tahun_pel','*');
		$data['modul_active'] = 'siswa_rekap';
		$this->load->view($this->template,$data);
	}
	
	function cetakRekapNilaiPembi($id,$id_tahun_pel){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$detail_semesteraktif = $this->siswa_rekapnilaipembi->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $id_tahun_pel), TRUE);
		$data['id_kelas'] = $id_kelas;
		$data['detail_kelas'] = $this->siswa_rekapnilaipembi->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['detail_semester'] = $id_tahun_pel;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['rekap_nilai'] = $this->siswa_rekapnilaipembi->tampilData('tbl_siswa', '*', array('NO_SISWA' => $this->session->userdata('user_access_id')));
		$data['data_infosekolah'] = $this->siswa_rekapnilaipembi->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$data['data_mapel'] = $this->siswa_rekapnilaipembi->tampilData('tbl_mapel','*');
		$this->load->view('cetak_nilai',$data);
	}
	
	function filterKelas(){
		$this->load->library('jariprom_tools');
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['detail_semester'] = $this->input->post('id_semester');
		$data['detail_kelas'] = $this->siswa_rekapnilaipembi->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$data['rekap_nilai'] = $this->siswa_rekapnilaipembi->tampilData('tbl_siswa', '*', array('ID_KELAS' => $data['id_kelas'], 'NO_SISWA' => $this->session->userdata('user_access_id')));
		$this->load->view('filter_kelas',$data);
	}
}
