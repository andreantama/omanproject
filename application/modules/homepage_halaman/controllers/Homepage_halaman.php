<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_halaman extends CI_Controller {
	
	var $template = 'homepage';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_homepage_halaman','homepage_halaman');
    }
	
	function detail($id){
		$data['page'] = 'index';
		$data['detail_page'] = $this->homepage_halaman->tampilData('tbl_menu','*',array('ID_MENUWEB' => $id), TRUE);
		$data['menu_left'] = 'menu_halaman';
		$this->load->view($this->template, $data);
	}
}
