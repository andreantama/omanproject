<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pmb extends MY_Admin {

	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model('M_master_pmb','master_pmb');
    }

    function index(){
		$data['judul_page'] = 'PPDB';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_pmb';
		$sqlWhere['ID_SET_PMB'] = 1;
		
		$data['active'] = $this->master_pmb->tampilData('tbl_set_pmb','*',$sqlWhere, TRUE);
		$this->load->view($this->template,$data);
	}

	function daftarUlang(){
		$data['judul_page'] = 'Daftar Ulang';
		$data['des_page'] = '';
		$data['page'] = 'daftarulang';
		$data['modul_active'] = 'master_pmbdaftarulang';
		$this->load->view($this->template,$data);
	}

	function downloadDocument($id){
		$this->load->library('jariprom_tools');
		$this->load->helper('download');
		$id_pmb = $this->jariprom_tools->base64_decode_fix($id);
		$detail_website = $this->master_pmb->tampilData('tbl_pmbdaftarulang','*', array('ID_PMB' => $id_pmb), TRUE);
		force_download('./assets/berkas/'.$detail_website->BERKAS, NULL);
	}

	function hapusPmbUlang($id){
		$this->load->library('jariprom_tools');
		$id_pmb = $this->jariprom_tools->base64_decode_fix($id);
		$detail_website = $this->master_pmb->tampilData('tbl_pmbdaftarulang','*', array('ID_PMB' => $id_pmb), TRUE);
		unlink('./assets/berkas/'.$detail_website->BERKAS);
		$this->master_pmb->hapusData('tbl_pmbdaftarulang',array('ID_PMB' =>$id_pmb));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_pmb/daftarUlang');
	}

	function detailPmb($id){
		$this->load->library('jariprom_tools');
		$id_pmb = $this->jariprom_tools->base64_decode_fix($id);
		$detail_pmb = $this->master_pmb->tampilData('tbl_pmb','*', array('ID_PMB' => $id_pmb), TRUE);
		$data['judul_page'] = 'Detail PMB '.$detail_pmb->NAMA;
		$data['des_page'] = '';
		$data['page'] = 'detail_pmb';
		$data['detail'] = $detail_pmb;
		$data['modul_active'] = 'master_pmb';
		$this->load->view($this->template,$data);
	}

	function editPmbSubmit(){
		$this->load->library('form_validation');
		$this->load->library('jariprom_tools');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('ttl', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_ttl', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        if($this->form_validation->run() == FALSE){
        	$this->session->set_flashdata('notif', validation_errors());
			$this->session->set_flashdata('clr', 'danger');
        	redirect('master_pmb/detailPmb/'.$this->input->post('id_pmb'));
        }
        $data_update = array(
			'NAMA' => $this->input->post('nama', TRUE),
			'JK' => $this->input->post('jk', TRUE),
			'TMPT_LAHIR' => $this->input->post('ttl', TRUE),
			'TGL_LAHIR' => $this->input->post('tgl_ttl', TRUE),
			'ALAMAT' => $this->input->post('alamat', TRUE),
			'NAMA_AYAH' => $this->input->post('nama_ayah', TRUE),
			'NAMA_IBU' => $this->input->post('nama_ibu', TRUE),
		);
		$this->master_pmb->editData('tbl_pmb', $data_update, array('ID_PMB' => $this->jariprom_tools->base64_decode_fix($this->input->post('id_pmb'))));
		$this->session->set_flashdata('notif', "Berhasil memperbaharui data.");
		$this->session->set_flashdata('clr', 'success');
		redirect('master_pmb/detailPmb/'.$this->input->post('id_pmb'));
	}

	function updatePpdb($sts){
		 $data_update = array(
			'ACTIVE_PMB' => $sts
		);
		$this->master_pmb->editData('tbl_set_pmb', $data_update, array('ID_SET_PMB' => 1));
		if($sts == 1){
			$this->session->set_flashdata('notif', "Berhasil membuka PPDB.");
			$this->session->set_flashdata('clr', 'success');
			redirect('master_pmb');
		}
		else{
			$this->session->set_flashdata('notif', "Berhasil menutup PPDB.");
			$this->session->set_flashdata('clr', 'warning');
			redirect('master_pmb');
		}
	}

	function hapusPmb($id){
		$this->load->library('jariprom_tools');
		$this->master_pmb->hapusData('tbl_pmb',array('ID_PMB' => $this->jariprom_tools->base64_decode_fix($id)));
		$this->session->set_flashdata('notif', 'Berhasil menghapus data.');
		$this->session->set_flashdata('clr', 'info');
        redirect('master_pmb');
	}

	function getPmb($pendidikan = null){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_pmb->setTableDatabase('tbl_pmb');
			$this->master_pmb->setSelectColumn(array('ID_PMB','NAMA','NAMA_AYAH','NO_HANDPHONE'));
			$this->master_pmb->setOrderColumn(array('NAMA',NULL,NULL,NULL));
			$this->master_pmb->setOrderId(array('ID_PMB','DESC'));
			$this->master_pmb->setSearchQuery(array('NAMA','NO_HANDPHONE'));
			$sqlWhere = array();
			// if($pendidikan  != null){
			// 	$sqlWhere['PENDIDIKAN'] = $pendidikan;
			// }
			$this->master_pmb->setWhereColumn($sqlWhere);
			$fetch_data = $this->master_pmb->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
	            $sub_array = array();
	            $sub_array[] = $row->NAMA;
	            $sub_array[] = $row->NO_HANDPHONE;
	            $sub_array[] = $row->NAMA_AYAH;
	            $b = 'onclick="window.open(\''.base_url('homepage_pmb/cetakPmb/'.$this->jariprom_tools->base64_encode_fix($row->ID_PMB)).'\', \'_blank\', \'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0\')"';
	            $c = 'onclick="window.open(\''.base_url('homepage_pmb/cetakPdf/'.$this->jariprom_tools->base64_encode_fix($row->ID_PMB)).'\', \'_blank\', \'width=800,height=600,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0\')"';
	            $sub_array[] = '<a href="#" class="btn btn-info btn-sm" '.$c.'>Unduh PDF</a> '.'<a href="#" class="btn btn-info btn-sm" '.$b.'>Cetak</a> '.'<a href="'.base_url('master_pmb/detailPmb/'.$this->jariprom_tools->base64_encode_fix($row->ID_PMB)).'" class="btn btn-primary btn-sm">Edit</a>'.' <a href="'.base_url('master_pmb/hapusPmb/'.$this->jariprom_tools->base64_encode_fix($row->ID_PMB)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
	            $data[] = $sub_array;
	       }
	       $output = array(
	            "draw" => intval($_GET["draw"]),
	            "recordsTotal" => $this->master_pmb->get_all_data(),
	            "recordsFiltered" => $this->master_pmb->get_filtered_data(),
	            "data" => $data
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}

	function getPmbDaftarUlang(){
		if($this->input->is_ajax_request()){
			$this->load->library('jariprom_tools');
			$this->master_pmb->setTableDatabase('tbl_pmbdaftarulang');
			$this->master_pmb->setSelectColumn(array('ID_PMB','NAMA','NO_HANDPHONE'));
			$this->master_pmb->setOrderColumn(array('NAMA','NO_HANDPHONE',NULL));
			$this->master_pmb->setOrderId(array('ID_PMB','DESC'));
			$this->master_pmb->setSearchQuery(array('NAMA','NO_HANDPHONE'));
			$fetch_data = $this->master_pmb->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
	            $sub_array = array();
	            $sub_array[] = $row->NAMA;
	            $sub_array[] = $row->NO_HANDPHONE;
	            $sub_array[] = '<a href="'.base_url('master_pmb/downloadDocument/'.$this->jariprom_tools->base64_encode_fix($row->ID_PMB)).'" class="btn btn-primary btn-sm">Download Berkas</a>'.' <a href="'.base_url('master_pmb/hapusPmbUlang/'.$this->jariprom_tools->base64_encode_fix($row->ID_PMB)).'" onclick="return confirm(\'Apakah Anda Yakin ?\')" class="btn btn-danger btn-sm">Hapus</a>';
	            $data[] = $sub_array;
	       }
	       $output = array(
	            "draw" => intval($_GET["draw"]),
	            "recordsTotal" => $this->master_pmb->get_all_data(),
	            "recordsFiltered" => $this->master_pmb->get_filtered_data(),
	            "data" => $data
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
	}
}
