<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ppid extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('profil/Profil_model', 'main_model', TRUE);
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
		
    }
    
    public function index()
	{
		if(@$this->session->has_access[0]->nama_app != "Admin"){
			$this->template->render_home('profil/frontend/daftar_ppid');
		}else{
			$this->template->render('profil/backend/visi_misi');
			// echo json_encode($data['visi']['isi']);

		}
    }
}