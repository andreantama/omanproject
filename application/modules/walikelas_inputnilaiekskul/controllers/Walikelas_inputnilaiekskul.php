<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_inputnilaiekskul extends MY_Walikelas {

	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_inputnilaiekskul','walikelas_inputnilaiekskul');
    }

	function index(){
		$wali_kelas = $this->walikelas_inputnilaiekskul->tampilData('tbl_kelas','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$id = $wali_kelas->ID_KELAS;
		$data['judul_page'] = 'Input Nilai Ekskul & Akhlak';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'walikelas_inputekskul';
		$data['id_kelas'] = $id;
		$this->load->view($this->template,$data);
	}

	function inputNilai($id){
		$this->load->library('jariprom_tools');
		$id_siswa = $this->jariprom_tools->base64_decode_fix($id);
		$detail_siswa = $this->walikelas_inputnilaiekskul->tampilData('tbl_siswa','*', array('NO_SISWA' => $id_siswa), TRUE);
		$detail_semester = $this->walikelas_inputnilaiekskul->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$detail_matapelajaran = $this->walikelas_inputnilaiekskul->tampilData('tbl_rel_mapel','*', array('NO_GURU' => $this->session->userdata('user_access_id')), TRUE);
		$detail_semesteraktif = $this->walikelas_inputnilaiekskul->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		$data['judul_page'] = 'Input Nilai '.$detail_siswa->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'input_nilai';
		$data['modul_active'] = 'walikelas_inputekskul';
		$data['detail'] = $detail_siswa;
		$data['semester_aktif'] = $detail_semesteraktif;
		$data['detail_nilai'] = $this->walikelas_inputnilaiekskul->tampilData('tbl_ekskul_akhlak','*', array('NO_SISWA' => $id_siswa, 'ID_TAHUN_PEL' => $detail_semesteraktif->ID_TAHUN_PEL), TRUE);
		$this->load->view($this->template,$data);
	}

	function inputNilaiSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
        $detail_semester = $this->walikelas_inputnilaiekskul->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
        $cek_nilai = $this->walikelas_inputnilaiekskul->tampilData('tbl_ekskul_akhlak','*', array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		if($cek_nilai){
			$data_update = array(
				'PRAMUKA' => $this->input->post('pramuka', TRUE),
				'TAHFIDZH' => $this->input->post('tahfidzh', TRUE),
				'ENGLISH_CLUB' => $this->input->post('english_club', TRUE),
				'SCIENCE' => $this->input->post('science', TRUE),
				'ARCHERY_CLUB' => $this->input->post('archery_club', TRUE),
				'ARABIC_CLUB' => $this->input->post('arabic_club', TRUE),
				'THEATER_CLUB' => $this->input->post('theater_club', TRUE),
				'TARI_KREASI' => $this->input->post('tari_kreasi', TRUE),
				'KALIGRAFI' => $this->input->post('kaligrafi', TRUE),
				'NASYID' => $this->input->post('nasyid', TRUE),
				'PUISI' => $this->input->post('puisi', TRUE),
				'REBANA_CLUB' => $this->input->post('rebana_club', TRUE),
				'KEDISIPLINAN' => $this->input->post('kedisiplinan', TRUE),
				'KEBERSIHAN' => $this->input->post('kebersihan', TRUE),
				'KERAPIAN' => $this->input->post('kerapian', TRUE),
				'TANGGUNG_JAWAB' => $this->input->post('tanggung_jawab', TRUE),
				'SOPAN_SANTUN' => $this->input->post('sopan_santun', TRUE),
				'KOMPETITIF' => $this->input->post('kompetitif', TRUE),
				'HUBUNGAN_SOSIAL' => $this->input->post('hubungan_sosial', TRUE),
				'KEJUJURAN' => $this->input->post('kejujuran', TRUE),
				'KEMANDIRIAN' => $this->input->post('kemandirian', TRUE),
				'PELAKSANAAN_IBADAH_RITUAL' => $this->input->post('pelaksaan_ibadah_ritual', TRUE),
				'BADMINTON' => $this->input->post('badminton', TRUE),
				'FUTSAL' => $this->input->post('futsal', TRUE),
				'SILAT' => $this->input->post('silat', TRUE),
				'LUKIS_KALIGRAFI' => $this->input->post('lukis_kaligrafi', TRUE),
				'MARCHING_BAND' => $this->input->post('marching_band', TRUE),
				'CATATAN_1' => $this->input->post('catatan_1', TRUE),
				'CATATAN_2' => $this->input->post('catatan_2', TRUE),
				'CATATAN_3' => $this->input->post('catatan_3', TRUE),
				'CATATAN_4' => $this->input->post('catatan_4', TRUE)
			);
			$this->walikelas_inputnilaiekskul->editData('tbl_ekskul_akhlak', $data_update, array('NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')), 'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL));
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('walikelas_inputnilaiekskul/inputNilai/'.$this->input->post('id_siswa'));
		}
		else{
			$data_insert = array(
				'ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL,
				'NO_SISWA' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_siswa')),
				'PRAMUKA' => $this->input->post('pramuka', TRUE),
				'TAHFIDZH' => $this->input->post('tahfidzh', TRUE),
				'ENGLISH_CLUB' => $this->input->post('english_club', TRUE),
				'SCIENCE' => $this->input->post('science', TRUE),
				'TARI_KREASI' => $this->input->post('tari_kreasi', TRUE),
				'KALIGRAFI' => $this->input->post('kaligrafi', TRUE),
				'NASYID' => $this->input->post('nasyid', TRUE),
				'PUISI' => $this->input->post('puisi', TRUE),
				'REBANA_CLUB' => $this->input->post('rebana_club', TRUE),
				'KEDISIPLINAN' => $this->input->post('kedisiplinan', TRUE),
				'KEBERSIHAN' => $this->input->post('kebersihan', TRUE),
				'KERAPIAN' => $this->input->post('kerapian', TRUE),
				'TANGGUNG_JAWAB' => $this->input->post('tanggung_jawab', TRUE),
				'SOPAN_SANTUN' => $this->input->post('sopan_santun', TRUE),
				'KOMPETITIF' => $this->input->post('kompetitif', TRUE),
				'HUBUNGAN_SOSIAL' => $this->input->post('hubungan_sosial', TRUE),
				'KEJUJURAN' => $this->input->post('kejujuran', TRUE),
				'KEMANDIRIAN' => $this->input->post('kemandirian', TRUE),
				'PELAKSANAAN_IBADAH_RITUAL' => $this->input->post('pelaksaan_ibadah_ritual', TRUE),
				'BADMINTON' => $this->input->post('badminton', TRUE),
				'FUTSAL' => $this->input->post('futsal', TRUE),
				'SILAT' => $this->input->post('silat', TRUE),
				'LUKIS_KALIGRAFI' => $this->input->post('lukis_kaligrafi', TRUE),
				'MARCHING_BAND' => $this->input->post('marching_band', TRUE),
				'CATATAN_1' => $this->input->post('catatan_1', TRUE),
				'CATATAN_2' => $this->input->post('catatan_2', TRUE),
				'CATATAN_3' => $this->input->post('catatan_3', TRUE),
				'CATATAN_4' => $this->input->post('catatan_4', TRUE)
			);
			$this->walikelas_inputnilaiekskul->tambahData($data_insert, 'tbl_ekskul_akhlak');
			$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
			$this->session->set_flashdata('clr', 'success');
			redirect('walikelas_inputnilaiekskul/inputNilai/'.$this->input->post('id_siswa'));
		}
	}

	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->walikelas_inputnilaiekskul->setTableDatabase('tbl_siswa');
			$this->walikelas_inputnilaiekskul->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->walikelas_inputnilaiekskul->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->walikelas_inputnilaiekskul->setOrderId(array('NO_SISWA','DESC'));
			$this->walikelas_inputnilaiekskul->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$this->walikelas_inputnilaiekskul->setSearchQuery(array('NIPD','NAMA'));
			$fetch_data = $this->walikelas_inputnilaiekskul->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
	            $sub_array = array();
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $kelas = $this->walikelas_inputnilaiekskul->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $row->ID_KELAS), TRUE);
	            if($kelas){
					$a = $kelas->NAMA_KELAS;
				}
				else{
					$a = '-';
				}
	            $sub_array[] = $a;
	            $sub_array[] = '<a href="'.base_url('walikelas_inputnilaiekskul/inputNilai/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" class="btn btn-info btn-sm">Input Nilai</a> ';
	            $data[] = $sub_array;
	       }
	       $output = array(
	            "draw" => intval($_GET["draw"]),
	            "recordsTotal" => $this->walikelas_inputnilaiekskul->get_all_data(),
	            "recordsFiltered" => $this->walikelas_inputnilaiekskul->get_filtered_data(),
	            "data" => $data
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
