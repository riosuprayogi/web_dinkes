<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends MX_Controller {

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


	// public function index()
	// {
	// 	$data['serta_merta'] = $this->site->get_curl('http://172.16.10.57/tangerangkota_v2/home/api_get_serta_merta/');
		
	// 	$this->template->render_home('serta_merta/frontend/index',$data);
	// }
	

	public function detail($id){
		$data['artikel'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_artikel/'.$id);

		$this->template->render_home('artikel/frontend/index',$data);

	}

	

}