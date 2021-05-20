<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Switcher extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('user/User_model', '', TRUE);
		$this->load->model('menu/Menu_level_model', '', TRUE);
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
	}

	public function index() {
		if (!$this->session->id_user)
			redirect(base_url());
		$data = [];
		$app_id = $this->input->get('appid');
		$acc = $this->input->get('acc');
		if ($app_id && $this->session->has_access) {
			$allowed_app = FALSE;
			foreach ($this->session->has_access as $has_access) {
				if ($app_id == $has_access->app_id) {
					$allowed_app = TRUE;
					break;
				}
			}
			if ($allowed_app) {

				$access = $this->User_model->get_access($this->session->id_user, $app_id, $acc);
				if ($access) {
					$user = [];
					$user['app_id'] = $access->app_id;
					$user['app_name'] = $access->short_name;
					$user['app_lname'] = $access->long_name;
					$user['app_access'] = $access->access;
					$user['app_module'] = $access->nama_app;
					$user['app_scheme'] = $access->scheme;
					//create menu
					$menu = $this->Menu_level_model->get_by_app($app_id);
					$user['menu'] = $this->buildtree($menu);
					$user['menu_all'] = $menu;
					$this->session->set_userdata($user);
				}
				redirect(base_url());

			} else
				$data['messages'] = 'Anda tidak memiliki akses terhadap aplikasi, silakan hubungi Helpdesk!';
		}
		$this->template->render('switcher/index', $data);
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
}