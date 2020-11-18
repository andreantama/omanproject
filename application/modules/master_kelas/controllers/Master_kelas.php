<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_kelas extends MY_Admin {

	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model('M_master_kelas','master_kelas');
    }

	function index(){
		$data['judul_page'] = 'Master Kelas';
		$data['des_page'] = '';
		$data['page'] = 'view_kelas';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}

	function addKelas(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Tambah Kelas';
		$data['des_page'] = '';
		$data['page'] = 'add_kelas';
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}

	function detailKelas($id){
		$this->load->library('jariprom_tools');
		$id_kelas = $this->jariprom_tools->base64_decode_fix($id);
		$detail_kelas = $this->master_kelas->tampilData('tbl_kelas','*', array('ID_KELAS' => $id_kelas), TRUE);
		$data['judul_page'] = 'Detail kelas '.$detail_kelas->NAMA_KELAS;
		$data['des_page'] = '';
		$data['page'] = 'detail_kelas';
		$data['detail'] = $detail_kelas;
		$data['modul_active'] = 'master_data';
		$this->load->view($this->template,$data);
	}

	function addKelasSubmit(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[tbl_kelas.NAMA_KELAS]');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_kelas/addKelas');
        }
        $data_insert = array(
			'NAMA_KELAS' => $this->input->post('nama_kelas', TRUE)
		);
		$this->master_kelas->tambahData($data_insert,'tbl_kelas');
		$this->session->set_flashdata('notif', "Sukses menambah data.");
		$this->session->set_flashdata('clr', 'success');
       redirect('master_kelas/addKelas');
	}

	function hapusKelas($id){
		$this->load->library('jariprom_tools');
		$this->master_kelas->hapusData('tbl_kelas',array('ID_KELAS' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_kelas');
	}

	function editKelasSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');
		if($this->input->post('nama_kelas_form') != $this->input->post('nama_kelas')){
			$this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'is_unique[tbl_kelas.NAMA_KELAS]');
		}
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_kelas/detailKelas/'.$this->input->post('id_nama_kelas'));
        }
        $data_update = array(
			'NAMA_KELAS' => $this->input->post('nama_kelas', TRUE)
		);
		$this->master_kelas->editData('tbl_kelas', $data_update, array('ID_KELAS' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_nama_kelas'))));
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_kelas/detailKelas/'.$this->input->post('id_nama_kelas'));
	}

	function getKelas(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_kelas->setTableDatabase('tbl_kelas');
			$this->master_kelas->setSelectColumn(array('ID_KELAS','NAMA_KELAS','NO_GURU'));
			$this->master_kelas->setOrderColumn(array('ID_KELAS','NAMA_KELAS'));
			$this->master_kelas->setOrderId(array('ID_KELAS','DESC'));
			$this->master_kelas->setSearchQuery(array('NAMA_KELAS'));
			$fetch_data = $this->master_kelas->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
	            $sub_array = array();
	            $sub_array[] = $row->ID_KELAS;
	            $sub_array[] = $row->NAMA_KELAS;
	            $nama = $this->master_kelas->tampilData('tbl_guru','NAMA', array('NO_GURU' => $row->NO_GURU), TRUE);
	            if($nama){
					$a = $nama->NAMA;
				}
				else{
					$a = '-';
				}
	            $sub_array[] = $a;
	            $sub_array[] = '<a href="'.base_url('master_kelas/detailKelas/'.$this->jariprom_tools->base64_encode_fix($row->ID_KELAS)).'" class="btn btn-info btn-sm">Edit</a> <a href="'.base_url('master_kelas/hapusKelas/'.$this->jariprom_tools->base64_encode_fix($row->ID_KELAS)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	        }
	        $output = array(
	            "draw" => intval($_GET["draw"]),
	            "recordsTotal" => $this->master_kelas->get_all_data(),
	            "recordsFiltered" => $this->master_kelas->get_filtered_data(),
	            "data" => $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
