<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_kotakkeluar extends MY_Walikelas {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_kotakkeluar','walikelas_kotakkeluar');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Kotak Keluar';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'walikelas_kotakkeluar';
		$this->load->view($this->template,$data);
	}
	
	function detailPesan($id){
		$this->load->library('jariprom_tools');
		$id_pesan = $this->jariprom_tools->base64_decode_fix($id);
		$detail_pesan = $this->walikelas_kotakkeluar->tampilData('tbl_pesan','*',array('ID_PESAN' => $id_pesan), TRUE);
		$data['judul_page'] = 'Pesan '.$detail_pesan->SUBJECT;
		$data['des_page'] = '';
		$data['page'] = 'detail';
		$data['modul_active'] = 'walikelas_kotakkeluar';
		$data['detail_pesan'] = $detail_pesan;
		$data['detail_siswa'] = $this->walikelas_kotakkeluar->tampilData('tbl_siswa','NAMA',array('NO_SISWA' => $detail_pesan->NO_SISWA), TRUE);;
		$this->load->view($this->template,$data);
	}
	
	function hapusPesan($id){
		$this->load->library('jariprom_tools');
		$this->walikelas_kotakkeluar->hapusData('tbl_pesan',array('ID_PESAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('walikelas_kotakkeluar');
	}
	
	function getPesan(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->walikelas_kotakkeluar->setTableDatabase('tbl_pesan');
			$this->walikelas_kotakkeluar->setSelectColumn(array('ID_PESAN','SUBJECT','STS_READ','TGL_KIRIM','WKT_KIRIM','NO_SISWA'));
			$this->walikelas_kotakkeluar->setOrderColumn(array(NULL,'SUBJECT','STS_READ',NULL));
			$this->walikelas_kotakkeluar->setOrderId(array('ID_PESAN','DESC'));
			$this->walikelas_kotakkeluar->setWhereColumn(array('level' => 1, 'NO_GURU' => $this->session->userdata('user_access_id')));
			$this->walikelas_kotakkeluar->setSearchQuery(array('SUBJECT'));
			$fetch_data = $this->walikelas_kotakkeluar->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array();
	            $nama = $this->walikelas_kotakkeluar->tampilData('tbl_siswa', 'NAMA',array('NO_SISWA' => $row->NO_SISWA), TRUE);
	            $sub_array[] = $nama->NAMA;
	            $sub_array[] = $row->SUBJECT;
	            $sub_array[] = ($row->STS_READ == 0 ? '<span class="label label-info">Masuk</span>' : '<span class="label label-success">Sudah Baca</span>');
	            $sub_array[] = $row->TGL_KIRIM.' '.$row->WKT_KIRIM;
	            $sub_array[] = '<a href="'.base_url('walikelas_kotakkeluar/detailPesan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PESAN)).'" class="btn btn-info btn-sm">Detail</a> <a href="'.base_url('walikelas_kotakkeluar/hapusPesan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PESAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	        }
	        $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->walikelas_kotakkeluar->get_all_data(),  
	            "recordsFiltered" => $this->walikelas_kotakkeluar->get_filtered_data(),  
	            "data" => $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
