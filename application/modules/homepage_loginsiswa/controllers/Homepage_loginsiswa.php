<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage_loginsiswa extends CI_Controller {
	
	var $template = 'homepage';
	
	function __construct(){
		parent::__construct();
    }
	
	function index(){
		$data['page'] = 'index';
		$this->load->view($this->template, $data);
	}
}
