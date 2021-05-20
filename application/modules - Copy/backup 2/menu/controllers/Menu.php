<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('menu/Menu_model', 'menus');
		$this->load->model('menu/Menu_level_model', 'menu_level');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
		
	}

	public function index() {
		$this->template->render('menu/index');
	}

	public function ajax_list(){
		$data = array();
		$menu = $this->menus->get_all_parent();
		$number = $_GET['start'] + 1;

		foreach($menu as $row){
			$row->no = $number++;
			$row->aksi = '
				<div style="text-align:right">
					<a class="btn btn-xs btn-primary" href="javascript:void(0)" onclick="add_child('.$row->id_menu.')" data-toggle="tooltip" title="Tambah"><i class="fas fa-plus"></i></a>
					<a class="btn btn-xs btn-success" href="javascript:void(0)" onclick="edit('.$row->id_menu.')" data-toggle="tooltip" title="Ubah"><i class="fas fa-edit"></i></a>
					<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="del('.$row->id_menu.')" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></a>
				</div>
			';
			$data[] = $row;
			$child = $this->menus->get_child_by_id_parent($row->id_menu);
			foreach($child as $chl){
				$chl->no = '';
				$chl->aksi = '
					<div style="text-align:right">
						<a class="btn btn-xs btn-success" href="javascript:void(0)" onclick="edit('.$chl->id_menu.')" data-toggle="tooltip" title="Ubah"><i class="fas fa-edit"></i></a>
						<a class="btn btn-xs btn-danger" href="javascript:void(0)" onclick="del('.$chl->id_menu.')" data-toggle="tooltip" title="Hapus"><i class="fas fa-trash"></i></a>
					</div>
				';
				$chl->nama = '&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right"></i> ' . $chl->nama;
				$data[] = $chl;
			}
		}

		$output = array(
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->menus->count_all(),
			'recordsFiltered' => count($data),
			'data' => $data
		);

		$this->template->ajax($output);
	}

	public function ajax_edit($id){
		$data = $this->menus->get_by_id($id);
		$this->template->ajax($data);
	}

	public function ajax_insert(){
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'path' => $this->input->post('path'),
				'icon' => $this->input->post('icon'),
				'index' => $this->input->post('index'),
			);
		$insert = $this->menus->insert($data);
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_update(){
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'path' => $this->input->post('path'),
				'icon' => $this->input->post('icon'),
				'index' => $this->input->post('index'),
			);
		$this->menus->update(array('id_menu' => $this->input->post('id')), $data);
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_delete(){
		$id= $this->input->get('key');
		$this->menus->delete($id);
		$this->menu_level->delete_by_menu($id);
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_add_child(){
		$this->_validate();
		$data = array(
				'id_parent' => $this->input->post('id'),
				'nama' => $this->input->post('nama'),
				'path' => $this->input->post('path'),
				'index' => $this->input->post('index'),
			);
		$insert = $this->menus->insert($data);
		$this->template->ajax(array('status' => TRUE));
	}

	private function _validate(){
		$this->load->library('form_validation');
		$this->config->set_item('language', 'indonesian');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('index', 'Index', 'trim|required|numeric');
		if ($this->form_validation->run()) return TRUE;

		$data = $error = array();
		$data['error_class'] = $data['error_string'] = array();
		$data['status'] = TRUE;

		if (form_error('nama')) $error[] = 'nama';
		if (form_error('index')) $error[] = 'index';

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