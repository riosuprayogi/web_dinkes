<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('apps/Apps_model', 'apps');
		$this->load->model('menu/Menu_model');
		$this->load->model('menu/Menu_level_model', 'level');
	}

	public function index(){
		$this->template->render('apps/index');
	}

	public function ajax_list(){
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama_app';
		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$filter = $_GET['filter'];

		$data = array();
		$level = $this->apps->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach($level as $row){
			$row->no = $number++;
			switch ($row->scheme) {
				case 'red': $row->scheme = 'Merah'; break;
				case 'green': $row->scheme = 'Hijau'; break;
				case 'blue': $row->scheme = 'Biru'; break;
				case 'yellow': $row->scheme = 'Kuning'; break;
				case 'purple': $row->scheme = 'Ungu'; break;
			}
			$row->status = ($row->status == '1' ? "Aktif" : "Nonaktif");
			$data[] = $row;
		}

		$output = array(
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->apps->count_all(),
			'recordsFiltered' => $this->apps->count_filtered($filter),
			'data' => $data
		);

		$this->template->ajax($output);
	}

	public function ajax_add(){
		$data = (object) array();
		$data->id_menu = $this->Menu_model->get_all();
		$this->template->ajax($data);
	}

	public function ajax_edit($id){
		$menu = array();
		foreach ($this->level->get_by_app($id) as $row)
			$menu[$row->id_menu] = $row;
		$data = $this->apps->get_by_id($id);
		$data->val_menu = $menu;
		$data->id_menu = $this->Menu_model->get_all();
		$this->template->ajax($data);
	}

	public function ajax_detail($id){
		$menu = array();
		foreach ($this->level->get_by_app($id) as $row)
			$menu[$row->id_menu] = $row;
		$data = $this->apps->get_by_id($id);
		$data->val_menu = $menu;
		$data->id_menu = $this->Menu_model->get_all();
		switch ($data->scheme) {
			case 'red': $data->scheme = 'Merah'; break;
			case 'green': $data->scheme = 'Hijau'; break;
			case 'blue': $data->scheme = 'Biru'; break;
			case 'yellow': $data->scheme = 'Kuning'; break;
			case 'purple': $data->scheme = 'Ungu'; break;
		}
		$data->status = ($data->status == '1' ? "Aktif" : "Nonaktif");
		$this->template->ajax($data);
	}

	public function ajax_insert(){
		$this->_validate();
		$data = array(
			'nama_app' => $this->input->post('nama_app'),
			'short_name' => $this->input->post('short_name'),
			'long_name' => $this->input->post('long_name'),
			'icon' => $this->input->post('icon'),
			'scheme' => $this->input->post('scheme'),
			'status' => $this->input->post('status'),
		);
		$insert_appid = $this->apps->insert($data);
		if ($this->input->post('id_menu')) {
			foreach ($this->input->post('id_menu') as $row) {
				$data_menu = array(
					'app_id' => $insert_appid,
					'id_menu' => $row,
				);
				$this->level->insert($data_menu);
			}
		}
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_update(){
		$this->_validate();
		$data = array(
			'nama_app' => $this->input->post('nama_app'),
			'short_name' => $this->input->post('short_name'),
			'long_name' => $this->input->post('long_name'),
			'icon' => $this->input->post('icon'),
			'scheme' => $this->input->post('scheme'),
			'status' => $this->input->post('status'),
		);
		$this->apps->update(array('id_app' => $this->input->post('id')), $data);

		@$this->level->delete_by_appid($this->input->post('id'));
		if($this->input->post('id_menu')){
			foreach($this->input->post('id_menu') as $row){
				$data_menu = array(
					'app_id' => $this->input->post('id'),
					'id_menu' => $row,
				);
				$this->level->insert($data_menu);
			}
		}
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_delete($id){
		$this->apps->delete($id);
		$this->level->delete_by_appid($id);
		$this->template->ajax(array('status' => TRUE));
	}

	private function _validate(){
		$this->load->library('form_validation');
		$this->config->set_item('language', 'indonesian');
		$this->form_validation->set_rules('nama_app', 'Nama Aplikasi', 'trim|required');
		$this->form_validation->set_rules('short_name', 'Nama Pendek', 'trim|required');
		$this->form_validation->set_rules('long_name', 'Nama Panjang', 'trim|required');
		$this->form_validation->set_rules('icon', 'Ikon', 'trim|required');
		$this->form_validation->set_rules('scheme', 'Skema', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run()) return TRUE;

		$data = $error = array();
		$data['error_class'] = $data['error_string'] = array();
		$data['status'] = TRUE;

		if (form_error('nama_app')) $error[] = 'nama_app';
		if (form_error('short_name')) $error[] = 'short_name';
		if (form_error('long_name')) $error[] = 'long_name';
		if (form_error('icon')) $error[] = 'icon';
		if (form_error('scheme')) $error[] = 'scheme';
		if (form_error('status')) $error[] = 'status';

		if ($error) {
			foreach ($error as $err) {
				$data['error_class'][$err] = 'has-error';
				$data['error_string'][$err] = form_error($err);
			}
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
	}
}