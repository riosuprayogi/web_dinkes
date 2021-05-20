<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class informasi_perencanaan extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('dasar_hukum/Dasar_hukum_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
		
	}


	public function index()
	{
		$data['alasan'] = $this->main_model->get_alasan();
		$this->template->render_home('informasi_perencanaan/frontend/index');
	}
}