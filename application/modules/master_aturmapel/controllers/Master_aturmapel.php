<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_aturmapel extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_aturmapel','master_aturmapel');
    }
	
	function index(){
		$data['judul_page'] = 'Atur Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_setting';
		$data['data_mapel'] = $this->master_aturmapel->tampilData('tbl_mapel');
		$this->load->view($this->template,$data);
	}
	
	function gantiMapel($id){
		$mapel = array();
		$this->load->library('jariprom_tools');
		$id_rel_mapel = $this->jariprom_tools->base64_decode_fix($id);
		$detail = $this->master_aturmapel->tampilData('tbl_rel_mapel','*',array('ID_REL_MAPEL' => $id_rel_mapel), TRUE);
		$data['judul_page'] = 'Ganti Mata Pelajaran';
		$data['des_page'] = '';
		$data['page'] = 'gantimapel';
		$data['modul_active'] = 'master_setting';
		$data['data_mapel'] = $this->master_aturmapel->tampilData('tbl_mapel');
		$data['detail_guru'] = $this->master_aturmapel->tampilData('tbl_guru', 'NO_GURU,NAMA, NUPTK',array('NO_GURU' => $detail->NO_GURU), TRUE);
		$data['detail'] = $detail;
		$data['detail_mapel'] = $this->master_aturmapel->tampilData('tbl_mapel','MAPEL',array('ID_MAPEL' => $detail->ID_MAPEL), TRUE);
		$this->load->view($this->template,$data);
	}
	
	function pilihMapelSubmit(){
		$cek = $this->master_aturmapel->tampilData('tbl_rel_mapel', 'ID_REL_MAPEL', array('ID_MAPEL' => $this->input->post('id_mata_pelajaran', TRUE), 'NO_GURU' => $this->input->post('id_guru', TRUE)), TRUE);
		if($cek){
			$this->session->set_flashdata('notif', "Guru yang bersangkutan sudah mengajar mata pelajaran ini.");
			$this->session->set_flashdata('clr', 'info');
			redirect('master_aturmapel');
			exit();
		}
		$data_insert = array(
			'NO_GURU' => $this->input->post('id_guru', TRUE),
			'ID_MAPEL' => $this->input->post('id_mata_pelajaran', TRUE)
		);
		$this->master_aturmapel->tambahData($data_insert,'tbl_rel_mapel');
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturmapel');
	}
	
	function hapusMapelKelas($array, $item) {
		$data = array();
		$index = array_search($item, $array);
		if ( $index !== false ) {
			unset($array[$index]);
		}
		foreach($array as $key ){
			$data[] = $key;
		}
		return $data;
	}
	
	function gantiMapelGuru($id_guru, $id_mapel){
		$mapel_all_kelas = array();
		$get_rel_mapel = $this->master_aturmapel->tampilData('tbl_rel_kelasajar', '*', array('NO_GURU' => $id_guru));
		if($get_rel_mapel){
			foreach($get_rel_mapel as $get_rel_mapel){
				$mapel_kelas = json_decode($get_rel_mapel->ID_MAPEL);
				$del_mapel = $this->hapusMapelKelas($mapel_kelas, $id_mapel);
				$data_update = array(
					'ID_MAPEL' => json_encode($del_mapel)
				);
				$this->master_aturmapel->editData('tbl_rel_kelasajar', $data_update, array('ID_REL_KELASAJAR' => $get_rel_mapel->ID_REL_KELASAJAR));
				$cek_mapel = $this->master_aturmapel->tampilData('tbl_rel_kelasajar', '*', array('ID_REL_KELASAJAR' => $get_rel_mapel->ID_REL_KELASAJAR), TRUE);
				if($cek_mapel){
					$count_mapel = json_decode($cek_mapel->ID_MAPEL);
					if(count($count_mapel) == 0){
						$this->master_aturmapel->hapusData('tbl_rel_kelasajar',array('ID_REL_KELASAJAR' => $get_rel_mapel->ID_REL_KELASAJAR));
					}
				}
			}	
		}
	}
	
	function gantiMapelSubmit(){
		$this->load->library('jariprom_tools');
		$id_guru = $this->jariprom_tools->base64_decode_fix($this->input->post('id_guru', TRUE));
		$id_rel_mapel = $this->jariprom_tools->base64_decode_fix($this->input->post('id_rel_mapel', TRUE));
		$check_mapel = $this->master_aturmapel->tampilData('tbl_rel_mapel', '*', array('NO_GURU' => $id_guru, 'ID_MAPEL' => $this->input->post('id_mata_pelajaran', TRUE)), TRUE);
		if($check_mapel){
			$this->session->set_flashdata('notif', "Guru tidak bisa mengajar mata pelajaran yang sama.");
			$this->session->set_flashdata('clr', 'warning');
			redirect('master_aturmapel/gantiMapel/'.$this->input->post('id_rel_mapel'));
			exit();
		}
		$this->gantiMapelGuru($id_guru);
		$data_update = array(
			'ID_MAPEL' => $this->input->post('id_mata_pelajaran', TRUE)
		);
		$this->master_aturmapel->editData('tbl_rel_mapel', $data_update, array('ID_REL_MAPEL' => $id_rel_mapel));
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturmapel/gantiMapel/'.$this->input->post('id_rel_mapel'));
	}
	
	function lepasMapel($id, $no_guru){
		$this->load->library('jariprom_tools');
		$sql = $this->master_aturmapel->tampilData('tbl_rel_mapel', '*', array('ID_REL_MAPEL' => $this->jariprom_tools->base64_decode_fix($id)), TRUE);
		$guru = $this->master_aturmapel->tampilData('tbl_guru','NUPTK, NAMA', array('NO_GURU' => $this->jariprom_tools->base64_decode_fix($no_guru)), TRUE);
		if($guru){
		    $this->gantiMapelGuru($sql->NO_GURU, $sql->ID_MAPEL);
		}
		$this->master_aturmapel->hapusData('tbl_rel_mapel',array('ID_REL_MAPEL' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil melepas mata pelajaran.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_aturmapel');
	}
	
	function viewAturMapel(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_aturmapel->setTableDatabase('tbl_rel_mapel');
			$this->master_aturmapel->setSelectColumn(array('ID_REL_MAPEL','NO_GURU','ID_MAPEL'));
			$this->master_aturmapel->setOrderId(array('ID_REL_MAPEL','DESC'));
			$fetch_data = $this->master_aturmapel->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
				$guru = $this->master_aturmapel->tampilData('tbl_guru','NUPTK, NAMA', array('NO_GURU' => $row->NO_GURU), TRUE);
				$mapel = $this->master_aturmapel->tampilData('tbl_mapel','MAPEL', array('ID_MAPEL' => $row->ID_MAPEL), TRUE);
				if($guru){
				    $nuptk = $guru->NUPTK;
				    $nama = $guru->NAMA;
				}
				else{
				    $nuptk = '['.$row->ID_REL_MAPEL.'] --- ['.$row->NO_GURU.'] Guru terhapus ---';
				    $nama = '-';
				}
				if($mapel){
				    $nama_mapel = $mapel->MAPEL;
				}
				$sub_array = array(); 
	            $sub_array[] = $nuptk;
	            $sub_array[] = $nama;
	            $sub_array[] = $nama_mapel;
	            $sub_array[] = '<a href="'.base_url('master_aturmapel/lepasMapel/'.$this->jariprom_tools->base64_encode_fix($row->ID_REL_MAPEL).'/'.$this->jariprom_tools->base64_encode_fix($row->NO_GURU)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Lepas Mata Pelajaran</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_aturmapel->get_all_data(),  
	            "recordsFiltered" => $this->master_aturmapel->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
	
	function searchGuru(){
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->where('NUPTK', $this->input->get("q"));
			$query = $this->db->select('NO_GURU as id, NAMA as text')->get("tbl_guru");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
