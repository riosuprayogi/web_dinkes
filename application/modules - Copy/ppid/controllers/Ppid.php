<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ppid extends MX_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		//$data['view'] = 'home';
		$data['title'] = 'PPID Kota Tangerang';
		$this->load->view('ppid_kota/core', $data);
	}
	
	
}
