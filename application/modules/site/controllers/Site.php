<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->model('user/User_model', '', TRUE);
		$this->load->model('menu/Menu_level_model', '', TRUE);
		$this->load->model('profil/Profil_model', 'main_model', TRUE);

		
	}



	public function index()
	{

		$this->load->helper('text');
		// $this->load->library('curl');
		// $useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
		// $json_url = 'https://tangerangkota.go.id/home/api_get_siaran/';
		// $ch = curl_init( $json_url );
		// curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// // curl_setopt($ch, CURLOPT_ENCODING, '');
		// curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $hasil = json_decode(curl_exec($ch),true);
		// $result =  @$hasil['data'];

		// $json_url = 'https://tangerangkota.go.id/banner/api-banner';
		// $ch = curl_init( $json_url );
		// curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $hasil = json_decode(curl_exec($ch),true);
		// $results =  @$hasil['banner'];

		// $json_url = 'https://tangerangkota.go.id/video/rest-api-widget';
		// $ch = curl_init( $json_url );
		// curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $hasil = json_decode(curl_exec($ch),true);
		// $videos =  @$hasil['video'];
		

		if ($this->session->id_user == "") {
			// $this->logout();
			// $this->template->render_home('home/index');
			$data['title'] = 'PPID Kota Tangerang';
			$data['profil'] = $this->main_model->get_isi('intro');
			$data['profil_image'] = $this->main_model->get_isi_file('profil');
			$data['struktur'] = $this->main_model->get_isi_struktur('struktur');
			$data['visi'] = $this->main_model->get_isi_file('visi');
			$data['kepwal'] = $this->main_model->get_isi_file('kepwal');
			$data['maklumat'] = $this->main_model->get_isi_file('maklumat');
			$data['kontak'] =$this->main_model->get_kontak();
			$data['image'] = $this->main_model->get_banner();
			// $data['latest_news'] = $result;
			$data['siaran'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_siaran/');
			$data['banner'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_banner/');
			
			// $data['banner'] = $this->site->get_curl('https://tangerangkota.go.id/banner/api-banner/');

			$data['berita'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_berita/');
			
			$data['video_tng'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_video_tng/');
			$data['video_humas'] = $this->site->get_curl('https://tangerangkota.go.id/home/api_get_video_humas/');




			// json_decode($)
			// echo json_encode($data);
			// $this->load->view('ppid/ppid_kota/core', $data);

			$this->template->render_home('site/home',$data);

		} else {

			$this->template->render('site/index');
		}
	}

	public function login() {
		if ($this->session->id_user)
			redirect(base_url());
		$redirect = '/';
		if ($this->input->get('next'))
			$redirect = '?next='.$this->input->get('next');
		$data['action'] = site_url('site/check'.$redirect);
		$this->load->view('login', $data);
	}
	

	public function logout() {
		$this->session->sess_destroy();
		// redirect(base_url());
		$redirect = '/';
		$data['action'] = site_url('site/check'.$redirect);
		$this->load->view('login', $data);
	}

	
	public function check() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		switch (strtoupper($username)) {
			case 'EGOV':
			case 'SUPERADMIN':
			case 'ENTRY':
			case 'REGUSER':
			case 'SARKES':
				$user = (array) $this->User_model->get_by_username2($username, false);
				if ($user) {

					$user['has_access'] = [];
					$user['app_id'] = null;
					$user['app_name'] = null;
					$user['app_lname'] = null;
					$user['app_access'] = null;
					$user['app_module'] = null;
					$user['app_scheme'] = null;
					$access = (array) $this->User_model->get_access($user['id_user']);
					if ($access) {
						$user['has_access'] = $access;
						if (count($access) == 1) {
							$user['app_id'] = $access[0]->app_id;
							$user['app_name'] = $access[0]->short_name;
							$user['app_lname'] = $access[0]->long_name;
							$user['app_access'] = $access[0]->access;
							$user['app_module'] = $access[0]->nama_app;
							$user['app_scheme'] = $access[0]->scheme;
							//create menu
							$menu = $this->Menu_level_model->get_by_app($access[0]->app_id);
							$user['menu'] = $this->buildtree($menu);
							$user['menu_all'] = $menu;
						}
					}
					$this->session->set_userdata($user);
					$this->User_model->update_login($username);

				} else
					$this->session->set_flashdata('pesan','Username atau Password Salah');
			break;
			
			default:
				$user = (array) $this->User_model->get_by_username2($username);
				
				if ($user) {
					$rest_u = 'r35t51kd4';
					$rest_p = '5ksnpcua5x6z79yk5xgbtkg89a4zdwc8ym7p2f4z';
					$this->load->library('curl');
					$this->curl->http_login($rest_u, $rest_p);
					$this->curl->create('http://opendatav2.tangerangkota.go.id/services/auth/login/uid/'.$username.'/pid/'.$password.'/format/json');
					$result = json_decode($this->curl->execute(), true);
					// echo json_encode($result);die;
					if ($result) {
						$user['has_access'] = [];
						$user['app_id'] = null; 
						$user['app_name'] = null;
						$user['app_lname'] = null;
						$user['app_access'] = null;
						$user['app_module'] = null;
						$user['app_scheme'] = null;
						$access = (array) $this->User_model->get_access($user['id_user']);
						if ($access) {
							$user['has_access'] = $access;
							if (count($access) == 1) {
								$user['app_id'] = $access[0]->app_id;
								$user['app_name'] = $access[0]->short_name;
								$user['app_lname'] = $access[0]->long_name;
								$user['app_access'] = $access[0]->access;
								$user['app_module'] = $access[0]->nama_app;
								$user['app_scheme'] = $access[0]->scheme;
								//create menu
								$menu = $this->Menu_level_model->get_by_app($access[0]->app_id);
								$user['menu'] = $this->buildtree($menu);
								$user['menu_all'] = $menu;
							}
						}					
						$this->session->set_userdata($user);
						$this->User_model->update_login($username);
					} else{
						$this->session->set_flashdata('pesan','Username atau Password Salah');
					}
				} else{
					$this->session->set_flashdata('pesan','NIP Tidak terdaftar');
					$redirect = '/site/login';
					redirect(base_url($redirect));
					die();
				}
			break;
		}

		$redirect = '/';
		if ($this->input->get('next'))
			$redirect = $this->input->get('next');
		if (!$this->session->app_id)
			$redirect = 'switcher';
		redirect(base_url($redirect));
			

	}

	private function buildtree($src_arr, $id_parent = 0, $tree = array()){
		$data = array();
		foreach($src_arr as $idx => $row){
			if($row->id_parent == $id_parent){
				foreach($row as $k => $v){
					$tree[$k] = $v;
				}
				unset($src_arr[$idx]);
				$tree['children'] = $this->buildtree($src_arr, $row->id_menu);
				$data[] = $tree;
			}
		}
		return $data;
	}

	public function notfound_404(){
		$this->load->view('404');
	}
}
