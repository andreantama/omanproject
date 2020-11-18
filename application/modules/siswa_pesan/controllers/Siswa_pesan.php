<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_pesan extends MY_Siswa {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_siswa_pesan','siswa_pesan');
    }
	
	function index(){
		$this->load->library('jariprom_tools');
		$data['judul_page'] = 'Pesan';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'siswa_pesan';
		$this->load->view($this->template,$data);
	}
	
	function detailPesan($id){
		$this->load->library('jariprom_tools');
		$id_pesan = $this->jariprom_tools->base64_decode_fix($id);
		$data_update = array(
			'STS_READ' => 1
		);
		$this->siswa_pesan->editData('tbl_pesan', $data_update, array('ID_PESAN' => $id_pesan));		
		$detail_pesan = $this->siswa_pesan->tampilData('tbl_pesan','*',array('ID_PESAN' => $id_pesan), TRUE);
		$data['judul_page'] = 'Pesan '.$detail_pesan->SUBJECT;
		$data['des_page'] = '';
		$data['page'] = 'detail';
		$data['modul_active'] = 'siswa_pesan';
		$data['detail_pesan'] = $detail_pesan;
		$data['detail_siswa'] = $this->siswa_pesan->tampilData('tbl_siswa','NAMA',array('NO_SISWA' => $detail_pesan->NO_SISWA), TRUE);
		$this->load->view($this->template,$data);
	}
	
	function hapusPesan($id){
		$this->load->library('jariprom_tools');
		$this->siswa_pesan->hapusData('tbl_pesan',array('ID_PESAN' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('siswa_pesan');
	}
	
	function getPesan(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->siswa_pesan->setTableDatabase('tbl_pesan');
			$this->siswa_pesan->setSelectColumn(array('ID_PESAN','SUBJECT','STS_READ','TGL_KIRIM','WKT_KIRIM','NO_SISWA','LEVEL','NO_GURU'));
			$this->siswa_pesan->setOrderColumn(array(NULL,'SUBJECT','STS_READ',NULL));
			$this->siswa_pesan->setOrderId(array('ID_PESAN','DESC'));
			$this->siswa_pesan->setWhereColumn(array('NO_SISWA' => $this->session->userdata('user_access_id')));
			$this->siswa_pesan->setSearchQuery(array('SUBJECT'));
			$fetch_data = $this->siswa_pesan->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){  
	            $sub_array = array();
	            $nama = $this->siswa_pesan->tampilData('tbl_siswa', 'NAMA',array('NO_SISWA' => $row->NO_SISWA), TRUE);
	            $guru = $this->siswa_pesan->tampilData('tbl_guru', 'NAMA',array('NO_GURU' => $row->NO_GURU), TRUE);
	            $sub_array[] = $nama->NAMA;
	            $sub_array[] = $row->SUBJECT;
	            $sub_array[] = ($row->STS_READ == 0 ? '<span class="label label-info">Masuk</span>' : '<span class="label label-success">Sudah Baca</span>');
	            $sub_array[] = $row->TGL_KIRIM.' '.$row->WKT_KIRIM;
	            $sub_array[] = ($row->LEVEL == 1 ? $guru->NAMA."( Wali Kelas )" : $guru->NAMA." ( Guru BP )");
	            $sub_array[] = '<a href="'.base_url('siswa_pesan/detailPesan/'.$this->jariprom_tools->base64_encode_fix($row->ID_PESAN)).'" class="btn btn-info btn-sm">Detail</a>';  
	            $data[] = $sub_array;
	        }
	        $output = array(  
	            "draw" => intval($_GET["draw"]), 
	            "recordsTotal" => $this->siswa_pesan->get_all_data(),  
	            "recordsFiltered" => $this->siswa_pesan->get_filtered_data(),  
	            "data" => $data
	        );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
