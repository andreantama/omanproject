<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_sekilasinfo extends CI_Controller {
	
	var $template = 'homepage';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_homepage_sekilasinfo','homepage_sekilasinfo');
    }
	
	function index(){
		$per_page = 3;
		if($this->input->get('per_page', TRUE) != ''){
			$result = ($per_page * $this->input->get('per_page') - $per_page);
		}
		else{
			$result = 0;
		}
		$this->load->library('pagination');
		$this->db->from('tbl_sekilas_info');
		$rows = $this->db->count_all_results();
		$config['base_url'] = base_url().'homepage_sekilasinfo';
		$config['page_query_string'] = TRUE;
 		$config['total_rows'] = $rows;
 		$config['use_page_numbers'] = TRUE;
 		$config['per_page'] = $per_page;
 		$config['first_link'] = 'Awal';
 		$config['last_link'] = 'Terakhir';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li class="page">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$this->pagination->initialize($config);
 		$data["paging_list"] = $this->pagination->create_links();
		$data['page'] = 'index';
		$data['menu_left'] = 'menu_halaman';
		$data['sekilas_info'] = $this->homepage_sekilasinfo->tampilData('tbl_sekilas_info','*',array(),FALSE,$per_page,$result, 'ID_SEKILAS_INFO DESC');
		$this->load->view($this->template, $data);
	}
}
