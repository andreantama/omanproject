<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Master_dashboard extends MY_Admin {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_master_dashboard','master_dashboard');
    }
	
	function index(){
		$data['judul_page'] = 'Dashboard';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'master_dashboard';
		$this->load->view($this->template,$data);
	}
}
