<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_raportnilaipembi extends MY_Walikelas {

	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_raportnilaipembi','walikelas_raportnilaipembi');
    }

	function index(){
		$wali_kelas = $this->walikelas_raportnilaipembi->tampilData('tbl_kelas','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$id = $wali_kelas->ID_KELAS;
		$data['judul_page'] = 'Cetak Raport Pembiasaan';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'walikelas_raport';
		$data['id_kelas'] = $id;
		$this->load->view($this->template,$data);
	}

	function cetakPdf($no_siswa,$id_kelas){
		$this->load->library('jariprom_tools');
		$this->load->library('html2pdf');
		$this->load->helper('download');
		$this->html2pdf->folder('./assets/pdfs/');
		$this->html2pdf->filename('raport_nilaipembiasaan_'.$no_siswa.'.pdf');
		$this->html2pdf->paper('a4', 'portrait');
		$setting_semesteraktif = $this->walikelas_raportnilaipembi->tampilData('tbl_set_tahunpel','ID_TAHUN_PEL', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$data['detail_nilai'] = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','*',array('NO_SISWA' => $no_siswa , 'ID_TAHUN_PEL' => $setting_semesteraktif->ID_TAHUN_PEL), TRUE);
		$data['detail_kelas'] = $this->walikelas_raportnilaipembi->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['semester_aktif'] = $this->walikelas_raportnilaipembi->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $setting_semesteraktif->ID_TAHUN_PEL), TRUE);
		$data['semester_aktifnya'] = $setting_semesteraktif->ID_TAHUN_PEL;
		$data['rekap_nilai'] = $this->walikelas_raportnilaipembi->tampilData('tbl_siswa', 'NO_SISWA', array('ID_KELAS' => $id_kelas));
		$data['jumlah_siswa'] = $this->db->query('SELECT NO_SISWA FROM tbl_siswa WHERE ID_KELAS='.$id_kelas)->num_rows();
		$data['detail_siswa'] = $this->walikelas_raportnilaipembi->tampilData('tbl_siswa', '*', array('NO_SISWA' => $no_siswa), TRUE);
		$data['detail_walikelas'] = $this->walikelas_raportnilaipembi->tampilData('tbl_guru', '*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['data_infosekolah'] = $this->walikelas_raportnilaipembi->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$data['detail_kepsek'] = $this->walikelas_raportnilaipembi->tampilData('tbl_guru', '*', array('ID_JNS_PTK' => 3), TRUE);
		$this->html2pdf->html($this->load->view('cetak_pdf', $data, true));
		$this->html2pdf->create('save');
		force_download('./assets/pdfs/raport_nilaipembiasaan_'.$no_siswa.'.pdf', NULL);
	}

	function cetakRaporNilaiPembi($no_siswa,$id_kelas){
		$this->load->library('jariprom_tools');
		$setting_semesteraktif = $this->walikelas_raportnilaipembi->tampilData('tbl_set_tahunpel','ID_TAHUN_PEL', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$data['detail_nilai'] = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','*',array('NO_SISWA' => $no_siswa , 'ID_TAHUN_PEL' => $setting_semesteraktif->ID_TAHUN_PEL), TRUE);
		$data['detail_kelas'] = $this->walikelas_raportnilaipembi->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['semester_aktif'] = $this->walikelas_raportnilaipembi->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $setting_semesteraktif->ID_TAHUN_PEL), TRUE);
		$data['semester_aktifnya'] = $setting_semesteraktif->ID_TAHUN_PEL;
		$data['rekap_nilai'] = $this->walikelas_raportnilaipembi->tampilData('tbl_siswa', 'NO_SISWA', array('ID_KELAS' => $id_kelas));
		$data['jumlah_siswa'] = $this->db->query('SELECT NO_SISWA FROM tbl_siswa WHERE ID_KELAS='.$id_kelas)->num_rows();
		$data['detail_siswa'] = $this->walikelas_raportnilaipembi->tampilData('tbl_siswa', '*', array('NO_SISWA' => $no_siswa), TRUE);
		$data['detail_walikelas'] = $this->walikelas_raportnilaipembi->tampilData('tbl_guru', '*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$data['data_infosekolah'] = $this->walikelas_raportnilaipembi->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$data['detail_kepsek'] = $this->walikelas_raportnilaipembi->tampilData('tbl_guru', '*', array('ID_JNS_PTK' => 3), TRUE);
		$this->load->view('cetak_nilai',$data);
	}

	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->walikelas_raportnilaipembi->setTableDatabase('tbl_siswa');
			$this->walikelas_raportnilaipembi->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->walikelas_raportnilaipembi->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->walikelas_raportnilaipembi->setOrderId(array('NO_SISWA','DESC'));
			$this->walikelas_raportnilaipembi->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$this->walikelas_raportnilaipembi->setSearchQuery(array('NIPD','NAMA'));
			$fetch_data = $this->walikelas_raportnilaipembi->generateDatatables();
			$setting_semesteraktif = $this->walikelas_raportnilaipembi->tampilData('tbl_set_tahunpel','ID_TAHUN_PEL', array('ID_SET_TAHUNPEL' => 1), TRUE);
			$data = array();
			foreach($fetch_data as $row){
	            $sub_array = array();
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $kelas = $this->walikelas_raportnilaipembi->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $row->ID_KELAS), TRUE);
	            $nilai = $this->walikelas_raportnilaipembi->tampilData('tbl_nilai_pembiasaan','NO_SISWA',array('NO_SISWA' => $row->NO_SISWA, 'ID_TAHUN_PEL' => $setting_semesteraktif->ID_TAHUN_PEL), TRUE);
	            if($kelas){
					$a = $kelas->NAMA_KELAS;
				}
				else{
					$a = '-';
				}
				if($nilai){
					$b = 'onclick="window.open(\''.base_url('walikelas_raportnilaipembi/cetakRaporNilaiPembi/'.$row->NO_SISWA.'/'.$row->ID_KELAS).'?print-date=\' + $(\'#tanggal-cetak\').val(), \'_blank\', \'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0\')"';
					$c = 'onclick="location.href=\''.base_url('walikelas_raportnilaipembi/cetakPdf/'.$row->NO_SISWA.'/'.$row->ID_KELAS).'?print-date=\' + $(\'#tanggal-cetak\').val()"';
				}
				else{
					$b = 'onclick="return alert(\'Nilai belum diinput/belum tersedia.\')"';
					$c = 'onclick="return alert(\'Nilai belum diinput/belum tersedia.\')"';
				}
	            $sub_array[] = $a;
	            $sub_array[] = '<a href="#" class="btn btn-info btn-sm" '.$b.'>Cetak Raport</a> '.'<a href="#" class="btn btn-info btn-sm" '.$c.'>Unduh PDF</a> ';
	            $data[] = $sub_array;
	       }
	       $output = array(
	            "draw" => intval($_GET["draw"]),
	            "recordsTotal" => $this->walikelas_raportnilaipembi->get_all_data(),
	            "recordsFiltered" => $this->walikelas_raportnilaipembi->get_filtered_data(),
	            "data" => $data
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
