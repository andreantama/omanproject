<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_rekapabsensi extends MY_Siswa {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_siswa_rekapabsensi','siswa_rekapabsensi');
    }
	
	function index(){
		$kelas_siswa = $this->siswa_rekapabsensi->tampilData('tbl_siswa','ID_KELAS', array('NO_SISWA' => $this->session->userdata('user_access_id')), TRUE);
		$id = $kelas_siswa->ID_KELAS;
		$this->load->library('jariprom_tools');
		$detail_kelas = $this->siswa_rekapabsensi->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $id), TRUE);
		$detail_semester = $this->siswa_rekapabsensi->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$detail_semesteraktif = $this->siswa_rekapabsensi->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $detail_semester->ID_TAHUN_PEL), TRUE);
		$data['judul_page'] = 'Lihat Absensi';
		$data['des_page'] = '';
		$data['page'] = 'rekap_absen';
		$data['modul_active'] = 'siswa_rekapabsen';
		$data['id_kelas'] = $id;
		$data['detail_semester'] = $detail_semesteraktif;
		$this->load->view($this->template,$data);
	}
	
	function cetakAbsen($id_kelas, $id_semester, $month){
		$data_siswa = $this->siswa_rekapabsensi->tampilData('tbl_siswa','NAMA, NO_SISWA', array('ID_KELAS' => $id_kelas));
		$detail_semesteraktif = $this->siswa_rekapabsensi->tampilData('tbl_tahun_pel','*', array('ID_TAHUN_PEL' => $id_semester), TRUE);
		$data['data_siswa'] = $data_siswa;
		$data['id_kelas'] = $id_kelas;
		$data['bulan'] = $month;
		$data['detail_kelas'] =  $this->siswa_rekapabsensi->tampilData('tbl_kelas', '*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['detail_semester'] = $id_semester;
		$data['detail_semesternya'] = $detail_semesteraktif;
		$data['data_infosekolah'] = $this->siswa_rekapabsensi->tampilData('tbl_info_sekolah','*',array('ID_INFO' => 1), TRUE);
		$this->load->view('cetak_absensi',$data);
	}
	
	function loadAbsen(){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->input->post('id_kelas');
		$data_siswa = $this->siswa_rekapabsensi->tampilData('tbl_siswa','NAMA, NO_SISWA', array('ID_KELAS' => $id_kelas, 'NO_SISWA' => $this->session->userdata('user_access_id')));
		$detail_semester = $this->siswa_rekapabsensi->tampilData('tbl_set_tahunpel','*', array('ID_SET_TAHUNPEL' => 1), TRUE);
		$data['data_siswa'] = $data_siswa;
		$data['id_kelas'] = $id_kelas;
		$data['bulan'] = $this->input->post('bulan');
		$data['detail_semester'] = $detail_semester->ID_TAHUN_PEL;
		$this->load->view('filter_bulan',$data);
	}
	
	function submitAbsen(){
		$this->load->library('jariprom_tools');
		for($a = 1;$a <= count($this->input->post('id_siswa')); $a++){
			$data_absen = array();
			$id_siswa = $this->input->post('id_siswa')[$a];
			$id_semester = $this->input->post('id_semester');
			$id_kelas = $this->input->post('id_kelas');
			$bulan = $this->input->post('bulan');
			$detail_absen = $this->siswa_rekapabsensi->tampilData('tbl_absen','*', array('NO_SISWA' => $id_siswa, 'ID_KELAS' => $this->jariprom_tools->base64_decode_fix($id_kelas), 'ID_TAHUN_PEL' => $id_semester, 'MONTH' => (int)$bulan), TRUE);
			if($detail_absen){
				$id_absensi = $this->input->post('id_absensi')[$a];
				for($as = 1;$as <= 31; $as++){
					$data_absen["TGL_".$as] = $this->input->post('absensi')[$a][$as];
				}
				$this->siswa_rekapabsensi->editData('tbl_absen', $data_absen, array('ID_ABSENSI' => $id_absensi));
				$sts_update = true;
			}
			else{
				for($as = 1;$as <= 31; $as++){
					$data_absen["TGL_".$as] = $this->input->post('absensi')[$a][$as];
				}
				$data_absen['ID_TAHUN_PEL'] = $id_semester;
				$data_absen['ID_KELAS'] = $this->jariprom_tools->base64_decode_fix($id_kelas);
				$data_absen['NO_SISWA'] = $id_siswa;
				$data_absen['MONTH'] = $bulan;
				$this->siswa_rekapabsensi->tambahData($data_absen,'tbl_absen');
				$sts_update = true;
			}
		}
		if($sts_update == TRUE){
			$this->session->set_flashdata('notif', "Berhasil memperbaharui absensi.");
			$this->session->set_flashdata('clr', 'success');
			redirect('siswa_rekapabsensi/inputAbsen/'.$id_kelas);
		}
	}
	
	function getKelas(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->siswa_rekapabsensi->setTableDatabase('tbl_kelas');
			$this->siswa_rekapabsensi->setSelectColumn(array('ID_KELAS','NAMA_KELAS','NO_GURU'));
			$this->siswa_rekapabsensi->setOrderColumn(array('ID_KELAS','NAMA_KELAS'));
			$this->siswa_rekapabsensi->setOrderId(array('ID_KELAS','DESC'));
			$this->siswa_rekapabsensi->setSearchQuery(array('NAMA_KELAS'));
			$fetch_data = $this->siswa_rekapabsensi->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            if($row->ID_KELAS != 1){
					$sub_array[] = $row->NAMA_KELAS;
		            $nama = $this->siswa_rekapabsensi->tampilData('tbl_guru','NAMA', array('NO_GURU' => $row->NO_GURU), TRUE);
		            if($nama){
						$a = $nama->NAMA;
					}
					else{
						$a = '-';
					}
					$num_murid = $this->db->query('SELECT COUNT(ID_KELAS) AS NUM_KELAS from tbl_siswa WHERE ID_KELAS='.$row->ID_KELAS)->row();
		            $sub_array[] = $a;
		            $sub_array[] = $num_murid->NUM_KELAS;
		            $sub_array[] = '<a href="'.base_url('siswa_rekapabsensi/inputAbsen/'.$this->jariprom_tools->base64_encode_fix($row->ID_KELAS)).'" class="btn btn-info btn-sm">Input Absensi</a> ';  
		            $data[] = $sub_array;
				}
	        }
	        $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->siswa_rekapabsensi->get_all_data(),  
	            "recordsFiltered" => $this->siswa_rekapabsensi->get_filtered_data(),  
	            "data" => $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
