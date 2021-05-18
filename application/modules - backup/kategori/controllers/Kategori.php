<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('kategori/Kategori_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		// $this->load->model('apps/Apps_model', 'apps');
		$this->load->model('skpd/Skpd_model', 'skpd');
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
	}


	public function index()
	{
		$data['alasan'] = $this->main_model->get_alasan();
		if (@$this->session->has_access[0]->nama_app != "Admin") {

			$this->template->render_home('kategori/frontend/index');
		} else {
			$this->template->render('kategori/backend/index');
		}
	}

	public function tambah_tanggal()
	{
		$jumlah = 16;
		echo date('Y-m-d H:i:s', strtotime(' + ' . $jumlah . ' day'));
	}


	public function ajax_insert()
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori', TRUE)
		);
		$where = array(
			'id_kategori' => $this->input->post('id'),
		);

		if (!$this->input->post('id')) {
			$this->main_model->insert_kategori($data);
		} else {
			$this->main_model->update_kategori($where, $data);
		}
		$this->template->ajax(array('status' => true));
	}

	public function ajax_add()
	{
		$this->cart->destroy();

		$data = (object) array();
		// $data->aplikasi = $this->apps->get_all();
		$this->template->ajax($data);
	}

	public function ajax_list()
	{
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$filter = $_GET['filter'];

		$data = array();
		$kategori = $this->main_model->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($kategori as $row) {
			$row->no = $number++;
			$row->aksi = '
					<center>
					<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="fas fa-cogs"></i>
						</button>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="javascript:void(0)" onclick="edit('  . $row->id_kategori . ')"><i class="fas fa-edit"></i> Edit</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="del(' . $row->id_kategori . ')"><i class="fas fa-trash"></i> Hapus</a>
						</div>
					</center>
				';
			$data[] = $row;
		}

		$output = array(
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->main_model->count_all(),
			'recordsFiltered' => $this->main_model->count_filtered($filter),
			'data' => $data,
			'GET' => $_GET,
		);
		$this->template->ajax($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->main_model->get_by_id($id);
		$this->template->ajax($data);
	}

	public function ajax_delete($id)
	{
		$data = array(
			'trash' => '1',
		);
		$this->main_model->update_kategori(array('id_kategori' => $id), $data);
		$this->template->ajax(array('status' => true));
	}
}
