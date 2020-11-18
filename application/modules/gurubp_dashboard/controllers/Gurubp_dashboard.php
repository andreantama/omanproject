<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gurubp_dashboard extends MY_Gurubp {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_gurubp_dashboard','gurubp_dashboard');
    }
	
	function index(){
		$data['judul_page'] = 'Dashboard';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'gurubp_dashboard';
		$this->load->view($this->template,$data);
	}
}
