<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daftar_pembantu extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('daftar_pembantu/Daftar_pembantu_model', 'main_model', TRUE);
		$this->load->model('skpd/Skpd_model', 'skpd', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');

	}


	public function index()
	{
		if (@$this->session->has_access[0]->nama_app != "Admin") {

			// $this->template->render_home('daftar_pembantu/frontend/index');
			$this->load->view('site/404');
		} else {
			$this->template->render('daftar_pembantu/backend/index');
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
			'id_skpd' => $this->input->post('skpd'),
			'id_kategori_pembantu' => $this->input->post('kategori'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('web'),
			'alamat' => $this->input->post('alamat'),
			'no_tlp' => $this->input->post('no_tlp'),
		);
		$where = array(
			'id_daftar_pembantu' => $this->input->post('id'),
		);
		if (!$this->input->post('id')) {

			$this->main_model->insert($data);
		} else {
			$this->main_model->update($where, $data);
		}
		$this->template->ajax(array('status' => true));
	}

	public function ajax_add()
	{
		$data = (object) array();
		$data->skpd = $this->skpd->get_all();
		$data->kategori = $this->main_model->get_all_kategori();
		$this->template->ajax($data);
	}

	public function ajax_cek($id)
	{
		// echo $id;
		$cek = $this->main_model->cek_keberatan($id);
		if ($cek > 0) {
			$ada = 'ada';
		} else {
			$ada = 'ga ada';
		}
		$this->template->ajax(array('status' => $ada));
	}

	public function ajax_list()
	{
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$filter = $_GET['filter'];

		$data = array();
		$keberatan = $this->main_model->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($keberatan as $row) {
			$row->no = $number++;

			$row->aksi = '
					<center>
					<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="fas fa-cogs"></i>
						</button>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="javascript:void(0)" onclick="edit(' . $row->id_daftar_pembantu . ')"><i class="fas fa-edit"></i> Edit</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="detail(' . $row->id_daftar_pembantu . ')"><i class="fas fa-eye"></i> Detail</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="del(' . $row->id_daftar_pembantu . ')"><i class="fas fa-trash"></i> Hapus</a>

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
			'post' => $_GET,
		);

		$this->template->ajax($output);
	}

	public function ajax_edit($id)
	{

		$data = $this->main_model->get_by_id($id);
		$data->skpd = $this->skpd->get_all();
		$data->kategori = $this->main_model->get_all_kategori();
		$this->template->ajax($data);
	}

	public function ajax_delete($key)
	{
		$data = $this->main_model->delete($key);

		if ($data) {
			$this->template->ajax(array('status' => TRUE));
		} else {
			$this->template->ajax(array('status' => FALSE));
		}
		// $this->template->ajax($key);

	}
}
