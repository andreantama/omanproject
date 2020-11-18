<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_dashboard extends MY_Siswa {
	
	var $template = 'admin_page';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_siswa_dashboard','siswa_dashboard');
    }
	
	function index(){
		$data['judul_page'] = 'Dashboard';
		$data['des_page'] = '';
		$data['page'] = 'index';
		$data['modul_active'] = '';
		$this->load->view($this->template,$data);
	}
}
