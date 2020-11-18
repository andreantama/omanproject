<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_aturwalikelas extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_aturwalikelas','master_aturwalikelas');
    }
	
	function index(){
		$data['judul_page'] = 'Atur Wali Kelas';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_setting';
		$data['data_kelas'] = $this->master_aturwalikelas->tampilData('tbl_kelas', '*',array('NO_GURU' => NULL));
		$this->load->view($this->template,$data);
	}
	
	function gantiWaliKelas($id){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$data['judul_page'] = 'Ganti Wali Kelas';
		$data['des_page'] = '';
		$data['page'] = 'gantiwalikelas';
		$data['modul_active'] = 'master_setting';
		$data['detail'] = $this->master_aturwalikelas->tampilData('tbl_kelas', '*',array('ID_KELAS' => $id_kelas), TRUE);
		$data['data_kelas_kosong'] = $this->master_aturwalikelas->tampilData('tbl_kelas', '*',array('NO_GURU' => NULL));
		$this->load->view($this->template,$data);
	}
	
	function pilihWaliKelasSubmit(){
		$cek = $this->master_aturwalikelas->tampilData('tbl_kelas', 'ID_KELAS',array('NO_GURU' => $this->input->post('id_guru', TRUE)), TRUE);
		if($cek){
			$this->session->set_flashdata('notif', "Guru sudah menjadi wali kelas di kelas lain, silahkan melakukan perubahan data.");
			$this->session->set_flashdata('clr', 'info');
			redirect('master_aturwalikelas');
			exit();
		}
		$data_update = array(
			'NO_GURU' => $this->input->post('id_guru', TRUE)
		);
		$this->master_aturwalikelas->editData('tbl_kelas', $data_update, array('ID_KELAS' => $this->input->post('id_kelas', TRUE)));
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturwalikelas');
	}
	
	function gantiWaliKelasSubmit(){
		$this->load->library('jariprom_tools');
		$cek = $this->master_aturwalikelas->tampilData('tbl_kelas', 'ID_KELAS',array('NO_GURU' => $this->input->post('id_guru', TRUE)), TRUE);
		if($cek){
			$this->session->set_flashdata('notif', "Guru sudah menjadi wali kelas di kelas lain, silahkan melakukan perubahan data.");
			$this->session->set_flashdata('clr', 'info');
			redirect('master_aturwalikelas/gantiWaliKelas/'.$this->input->post('id_kelas'));
			exit();
		}
		$data_update = array(
			'NO_GURU' => $this->input->post('id_guru', TRUE)
		);
		$this->master_aturwalikelas->editData('tbl_kelas', $data_update, array('ID_KELAS' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_kelas', TRUE))));
		$this->session->set_flashdata('notif', "Pengaturan berhasil diterapkan.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_aturwalikelas/gantiWaliKelas/'.$this->input->post('id_kelas'));
	}
	
	function lepasWaliKelas($id){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$data_update = array(
			'NO_GURU' => NULL
		);
		$this->master_aturwalikelas->editData('tbl_kelas', $data_update, array('ID_KELAS' => $id_kelas));
		$this->session->set_flashdata('notif', "Berhasil melepas jabatan wali kelas.");
		$this->session->set_flashdata('clr', 'info');
		redirect('master_aturwalikelas');
	}
	
	function viewWaliKelas(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_aturwalikelas->setTableDatabase('tbl_kelas');
			$this->master_aturwalikelas->setSelectColumn(array('ID_KELAS','NO_GURU','NAMA_KELAS'));
			$this->master_aturwalikelas->setOrderId(array('ID_KELAS','DESC'));
			$this->master_aturwalikelas->setSearchQuery(array('NAMA_KELAS'));
			$this->master_aturwalikelas->setWhereColumn(array('NO_GURU !=' => NULL));
			$fetch_data = $this->master_aturwalikelas->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
				$guru = $this->master_aturwalikelas->tampilData('tbl_guru','NUPTK, NAMA, NO_GURU', array('NO_GURU' => $row->NO_GURU), TRUE);
				if($guru){
				    $nuptk = $guru->NUPTK;
				    $nama = $guru->NAMA;
				}
				else{
				    $nuptk = '['.$row->NO_GURU.'] Guru terhapus ---';
				    $nama = '-';
				}
	            $sub_array = array(); 
	            $sub_array[] = $nuptk;
	            $sub_array[] = $nama;
	            $sub_array[] = $row->NAMA_KELAS;
	            $sub_array[] = '<a href="'.base_url('master_aturwalikelas/gantiWaliKelas/'.$this->jariprom_tools->base64_encode_fix($row->ID_KELAS)).'" class="btn btn-info btn-sm">Ganti</a> '.'<a href="'.base_url('master_aturwalikelas/lepasWaliKelas/'.$this->jariprom_tools->base64_encode_fix($row->ID_KELAS)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Lepas Wali Kelas</a>';  
	            $data[] = $sub_array;
	       }  
	       $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->master_aturwalikelas->get_all_data(),  
	            "recordsFiltered" => $this->master_aturwalikelas->get_filtered_data(),  
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
