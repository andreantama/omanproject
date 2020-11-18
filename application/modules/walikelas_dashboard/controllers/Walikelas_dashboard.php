<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Walikelas_dashboard extends MY_Walikelas {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_walikelas_dashboard','walikelas_dashboard');
    }
	
	function index(){
		$data['judul_page'] = 'Dashboard';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = 'walikelas_dashboard';
		$this->load->view($this->template,$data);
	}
}
