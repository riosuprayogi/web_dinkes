<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy_policy extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');

	}

	public function index() {
		// $data['view']         = 'index';
		// $data['title']        = 'Privacy Policy | Web Kota Tangerang';
		// $data['content']	= 'sections/index';
		$data['title']		= 'Privacy Policy | PPID Kota Tangerang';

        
		// $this->load->view('theme/mobirise/core', $data);
		// $this->load->view('core',$data);
		$this->template->render_home("privacy_policy/index",$data);
	}


}