<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_aturkelas extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_aturkelas','master_aturkelas');
    }
	
	function index(){
		$data['judul_page'] = 'Atur Kelas';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_setting';
		$data['data_kelas'] = $this->master_aturkelas->tampilData('tbl_kelas', '*');
		$data['data_kelas_filter'] = $this->master_aturkelas->tampilData('tbl_kelas', '*');
		$this->load->view($this->template,$data);
	}
	
	function pilihKelasSubmit(){
		foreach($this->input->post('id_siswa') as $key){
			 $data_update = array(
				'ID_KELAS' => $this->input->post('id_kelas', TRUE)
			);
			$this->master_aturkelas->editData('tbl_siswa', $data_update, array('NO_SISWA' => $key));		
		}
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturkelas');
	}
	
	function filterKelas(){
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['detail_kelas'] = $this->master_aturkelas->tampilData('tbl_kelas', '*', array('ID_KELAS' => $data['id_kelas']), TRUE);
		$this->load->view('filter_kelas',$data);
	}
	
	function getSiswa($id_kelas){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_aturkelas->setTableDatabase('tbl_siswa');
			$this->master_aturkelas->setSelectColumn(array('NIPD','NAMA','ID_KELAS','NO_SISWA'));
			$this->master_aturkelas->setOrderColumn(array('NIPD','NAMA','ID_KELAS'));
			$this->master_aturkelas->setOrderId(array('NO_SISWA','DESC'));
			$this->master_aturkelas->setSearchQuery(array('NIPD','NAMA'));
			$this->master_aturkelas->setWhereColumn(array('ID_KELAS' => $id_kelas));
			$fetch_data = $this->master_aturkelas->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array(); 
	            $sub_array[] = $row->NIPD;
	            $sub_array[] = $row->NAMA;
	            $sub_array[] = '<a href="'.base_url('master_siswa/detailSiswa/'.$this->jariprom_tools->base64_encode_fix($row->NO_SISWA)).'" target="_blank" class="btn btn-info btn-sm">Detail</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_aturkelas->get_all_data(),  
	            "recordsFiltered" => $this->master_aturkelas->get_filtered_data(),  
	            "data" => $data  
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
	
	function searchSiswa(){
		$json = [];
		if(!empty($this->input->get("q"))){
			$this->db->where('NIPD', $this->input->get("q"));
			$this->db->where('ID_KELAS', 1);
			$query = $this->db->select('NO_SISWA as id, NAMA as text')->get("tbl_siswa");
			$json = $query->result();
		}
		echo json_encode($json);
	}
}
