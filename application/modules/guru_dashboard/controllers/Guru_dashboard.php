<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_dashboard extends MY_Guru {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_guru_dashboard','guru_dashboard');
    }
	
	function index(){
		$data['judul_page'] = 'Dashboard';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = '';
		$this->load->view($this->template,$data);
	}
}
