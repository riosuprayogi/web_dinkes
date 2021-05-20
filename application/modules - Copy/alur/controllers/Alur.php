<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alur extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('alur/Alur_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		
	}

	public function index(){

	}

	public function permohonan($id){
		// $this->template->render('alur');
		echo $id;
	}

	public function ajax_upload(){
		

		$uploadPath = './assets/media/image/alur/';
		if(is_dir($uploadPath) === false){
			mkdir($uploadPath, 0777, true);
		}

		

		$descount = count($_FILES['foto']['name']);
		if($_FILES['foto']['name']){
			for($i = 0; $i < $descount; $i++){
				$_FILES['upload_File']['name'] = $_FILES['foto']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['foto']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['foto']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['foto']['size'][$i];
				$config['upload_path'] = $uploadPath;
				$config['file_name']  = md5(date("YmdHms").'_'.rand(100, 999));
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('upload_File')) {
					$fileData = $this->upload->data();

					$opt = $this->input->post('option');
					$urut = $this->main_model->cek_isi($opt);
					
					$sata = array(
						'file' => $fileData['file_name'],
						'option' => $opt,
					);
					$this->main_model->insert($sata);
					
				}else{
					
					$this->template->ajax(array('status' => $this->upload->display_errors()));
				}
			}

			$this->template->ajax(array('status' => TRUE));

		}else{
			$this->template->ajax(array('status' => TRUE));
		}
	}


}