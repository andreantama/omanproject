<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {
	
	var $template = 'homepage';
	
	function __construct(){
		parent::__construct();
		$this->load->model('M_homepage','homepage');

		$this->load->helper('text');
    }
	
	function index(){
		$data['page'] = 'index';
		$this->load->view($this->template, $data);
	}
}
