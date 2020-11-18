<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gurubp_kotakkeluar extends MY_Gurubp {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_gurubp_kotakkeluar','gurubp_kotakkeluar');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Kotak Keluar';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'gurubp_kotakkeluar';
		$this->load->view($this->template,$data);
	}
	
	function detailPesan($id){
		$this->load->library('jariprom_tools');
		$id_pesan = $this->jariprom_tools->base64_decode_fix($id);
		$detail_pesan = $this->gurubp_kotakkeluar->tampilData('tbl_pesan','*',array('ID_PESAN' => $id_pesan), TRUE);
		$data['judul_page'] = 'Pesan '.$detail_pesan->SUBJECT;
		$data['des_page'] = '';
		$data['page'] = 'detail';
		$data['modul_active'] = 'gurubp_kotakkeluar';
		$data['detail_pesan'] = $detail_pesan;
		$data['detail_siswa'] = $this->gurubp_kotakkeluar->tampilData('tbl_siswa','NAMA',array('NO_SISWA' => $detail_pesan->NO_SISWA), TRUE);;
		$this->load->view($this->template,$data);
	}
	
	function hapusPesan($id){
		$this->load->library('jariprom_tools');
		$this->gurubp_kotakkeluar->hapusData('tbl_pesan',array('ID_PESAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('gurubp_kotakkeluar');
	}
	
	function getPesan(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->gurubp_kotakkeluar->setTableDatabase('tbl_pesan');
			$this->gurubp_kotakkeluar->setSelectColumn(array('ID_PESAN','SUBJECT','STS_READ','TGL_KIRIM','WKT_KIRIM','NO_SISWA'));
			$this->gurubp_kotakkeluar->setOrderColumn(array(NULL,'SUBJECT','STS_READ',NULL));
			$this->gurubp_kotakkeluar->setOrderId(array('ID_PESAN','DESC'));
			$this->gurubp_kotakkeluar->setSearchQuery(array('SUBJECT'));
			$fetch_data = $this->gurubp_kotakkeluar->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array();
	            $nama = $this->gurubp_kotakkeluar->tampilData('tbl_siswa', 'NAMA',array('NO_SISWA' => $row->NO_SISWA), TRUE);
	            $sub_array[] = $nama->NAMA;
	            $sub_array[] = $row->SUBJECT;
	            $sub_array[] = ($row->STS_READ == 0 ? '<span class="label label-info">Masuk</span>' : '<span class="label label-success">Sudah Baca</span>');
	            $sub_array[] = $row->TGL_KIRIM.' '.$row->WKT_KIRIM;
	            $sub_array[] = '<a href="'.base_url('gurubp_kotakkeluar/detailPesan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PESAN)).'" class="btn btn-info btn-sm">Detail</a> <a href="'.base_url('gurubp_kotakkeluar/hapusPesan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PESAN)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';  
	            $data[] = $sub_array;
	        }
	        $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->gurubp_kotakkeluar->get_all_data(),  
	            "recordsFiltered" => $this->gurubp_kotakkeluar->get_filtered_data(),  
	            "data" => $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
