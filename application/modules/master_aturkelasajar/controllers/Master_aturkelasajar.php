<?php defined('BASEPATH') OR exit('No direct script access allowed');

class master_aturkelasajar extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_aturkelasajar','master_aturkelasajar');
    }
	
	function index(){
		$data['judul_page'] = 'Atur Kelas Mengajar';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_setting';
		$data['data_kelas'] = $this->master_aturkelasajar->tampilData('tbl_kelas');
		$data['data_kelas_filter'] = $this->master_aturkelasajar->tampilData('tbl_kelas', '*');
		$this->load->view($this->template,$data);
	}
	
	function hapusKelasAjar($id){
		$this->load->library('jariprom_tools');
		$this->master_aturkelasajar->hapusData('tbl_rel_kelasajar',array('ID_REL_KELASAJAR' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus kelas mengajar.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_aturkelasajar');
	}
	
	function cariMapel($data, $search){
		$count = 0;
		foreach($data as $key){
			if(in_array($key, $search)){
				$count++;
			}
		}
		if($count == 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function pilihKelasAjarSubmit(){
		$data_rel_mapel_guru = array();
		$data_rel_mapel = array();
		$mapel_kelas = array();
		$get_rel_mapel_guru = $this->master_aturkelasajar->tampilData('tbl_rel_mapel', '*', array('NO_GURU' => $this->input->post('id_guru')));
		if($get_rel_mapel_guru){
			foreach($this->input->post('id_listmapelguru') as $asd){
				$data_rel_mapel_guru[] = $asd;
			}
		}
		else{
			$this->session->set_flashdata('notif', "Guru yang dipilih belum mengajar mata pelajaran apapun, silahkan setting terlebih dahulu.");
			$this->session->set_flashdata('clr', 'info');
			redirect('master_aturkelasajar');
			exit();
		}
		foreach($this->input->post('id_kelasajar') as $id_kelas){
			$mapel_all_kelas = array();
			$get_rel_mapel = $this->master_aturkelasajar->tampilData('tbl_rel_kelasajar', '*', array('ID_KELAS' => $id_kelas));
			if($get_rel_mapel){
				foreach($get_rel_mapel as $get_rel_mapel){
					$mapel_kelas = json_decode($get_rel_mapel->ID_MAPEL);
					foreach($mapel_kelas as $mapel_list){
						$mapel_all_kelas[] = $mapel_list;
					}
				}	
			}
			$check_mapel = $this->cariMapel($mapel_all_kelas, $data_rel_mapel_guru);
			if($check_mapel){
				$data_insert = array(
					'ID_KELAS' => $id_kelas,
					'NO_GURU' => $this->input->post('id_guru'),
					'ID_MAPEL' => json_encode($data_rel_mapel_guru)
				);
				$this->master_aturkelasajar->tambahData($data_insert, 'tbl_rel_kelasajar');
				$data_rel_mapel = array();
				$mapel_kelas = array();
			}
			else{
				$this->session->set_flashdata('notif', "Mata pelajaran sudah ada di kelas yang dipilih.");
				$this->session->set_flashdata('clr', 'info');
				redirect('master_aturkelasajar');
				exit();
			}
		}
		$this->session->set_flashdata('notif', "Pengaturan kelas ajar berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturkelasajar');
	}
	
	function filterKelas(){
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['detail_kelas'] = $this->master_aturkelasajar->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$this->load->view('filter_kelas',$data);
	}
	
	function getKelasAjar($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_aturkelasajar->setTableDatabase('tbl_rel_kelasajar');
			$this->master_aturkelasajar->setSelectColumn(array('ID_REL_KELASAJAR','NO_GURU','ID_KELAS','ID_MAPEL'));
			$this->master_aturkelasajar->setOrderId(array('ID_REL_KELASAJAR','DESC'));
			$this->master_aturkelasajar->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$fetch_data = $this->master_aturkelasajar->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
				$mapel = array();
				$guru = $this->master_aturkelasajar->tampilData('tbl_guru','NUPTK, NAMA', array('NO_GURU' => $row->NO_GURU), TRUE);
				$kelas = $this->master_aturkelasajar->tampilData('tbl_kelas','NAMA_KELAS', array('ID_KELAS' => $row->ID_KELAS), TRUE);
				if($guru){
				    $nuptk = $guru->NUPTK;
				    $nama = $guru->NAMA;
				}
				else{
				    $nuptk = '['.$row->ID_REL_KELASAJAR.'] --- ['.$row->NO_GURU.'] Guru terhapus ---';
				    $nama = '-';
				}
	            $sub_array = array(); 
	            $sub_array[] = $nuptk;
	            $sub_array[] = $nama;
	            $id_mapel = json_decode($row->ID_MAPEL);
	            foreach($id_mapel as $value){
	            	$mapelnya = $this->master_aturkelasajar->tampilData('tbl_mapel', '*', array('ID_MAPEL' => $value), TRUE);
					$mapel[] = $mapelnya->SHORT_MAPEL;
				}
	            $sub_array[] = $kelas->NAMA_KELAS;
	            $sub_array[] = implode(', ',$mapel);
	            $sub_array[] = '<a href="'.base_url('master_aturkelasajar/hapusKelasAjar/'.$this->jariprom_tools->base64_encode_fix($row->ID_REL_KELASAJAR)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_aturkelasajar->get_all_data(),  
	            "recordsFiltered" => $this->master_aturkelasajar->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
	
	function getListMapelGuru(){
		$data['list_mapel'] = $this->db->query('SELECT m.MAPEL as MAPEL, m.ID_MAPEL as ID_MAPEL FROM tbl_mapel m INNER JOIN tbl_rel_mapel rm WHERE NO_GURU='.$this->input->post('no_guru').' AND m.ID_MAPEL = rm.ID_MAPEL')->result();
		$this->load->view('list_mapel_guru',$data);
	}
	
	function searchGuru(){
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->where('NUPTK', $this->input->get("q"));
			$query = $this->db->select('NO_GURU, NAMA')->get("tbl_guru");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
