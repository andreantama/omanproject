<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_bukti extends MY_Admin {

	var $template = 'admin_page';

	function __construct(){
		parent::__construct();
		$this->load->model('M_master_bukti','master_buktipendaftaran');
    }
    public function index()
    {
        $data['judul_page'] = 'Bukti Pendaftaran';
		$data['des_page'] = '';
		$data['page'] = 'index';
        $data['modul_active'] = 'master_buktipendaftaran';
        $sqlWhere = array();
		$data['active'] = $this->master_buktipendaftaran->tampilData('tbl_pmbbuktitransfer','*',$sqlWhere, TRUE);
		$this->load->view($this->template,$data);
    }
    public function getData()
    {
        if($this->input->is_ajax_request()){
            $this->load->library('jariprom_tools');
            $this->master_buktipendaftaran->setTableDatabase('tbl_pmbbuktitransfer');
			$this->master_buktipendaftaran->setSelectColumn(array('ID','NAMA','BERKAS', 'TGL_PMB', 'WKT_PMB'));
			$this->master_buktipendaftaran->setOrderColumn(array('NAMA',NULL,NULL,NULL));
			$this->master_buktipendaftaran->setOrderId(array('ID','DESC'));
			$this->master_buktipendaftaran->setSearchQuery(array('NAMA'));
			$sqlWhere = array();
			$this->master_buktipendaftaran->setWhereColumn($sqlWhere);
			$fetch_data = $this->master_buktipendaftaran->generateDatatables();
			$data = array();
			foreach($fetch_data as $row){
	            $sub_array = array();
	            $sub_array[] = $row->NAMA;
				$sub_array[] = '<img src='.base_url("assets/buktitransfer/".$row->BERKAS).' class="img-thumbnail">';
				$sub_array[] = '<a href='.base_url("assets/buktitransfer/".$row->BERKAS).' class="btn btn-info" target="_blank">Download File</a>';
				$sub_array[] = $row->TGL_PMB;
				$sub_array[] = $row->WKT_PMB;
	            $data[] = $sub_array;
	       }
	       $output = array(
	            "draw" => intval($_GET["draw"]),
	            "recordsTotal" => $this->master_buktipendaftaran->get_all_data(),
	            "recordsFiltered" => $this->master_buktipendaftaran->get_filtered_data(),
	            "data" => $data
	       );
	       return $this->output->set_content_type('application/json')->set_output(json_encode($output));
		}
		else{
			echo 'No direct script access allowed.';
		}
    }
}
