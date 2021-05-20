<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Flayer extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('flayer/Flayer_model', 'main_model', TRUE);
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
		if (@$this->session->has_access[0]->nama_app != "Admin") {

			$this->template->render_home('flayer/frontend/index');
		} else {
			$this->template->render('flayer/backend/index');
		}

		//  phpinfo();
	}

	public function tambah_tanggal()
	{
		$jumlah = 16;
		echo date('Y-m-d H:i:s', strtotime(' + ' . $jumlah . ' day'));
	}

	public function ajax_insert()
	{

		$data = array(
			'judul' => $this->input->post('judul', TRUE),
			'isi' => $this->input->post('isian', TRUE),
		);
		$where = array(
			'id_flayer' => $this->input->post('id'),
		);
		if (!$this->input->post('id')) {

			$id = $this->main_model->insert_flayer($data);
			if ($_FILES['flayer']['name']) {

				$uploadPathflayer = './assets/media/upload/file_flayer/';
				if (is_dir($uploadPathflayer) === false) {
					mkdir($uploadPathflayer, 0777, true);
				}

				$config['upload_path'] 			= $uploadPathflayer;
				$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
				$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
				$config['overwrite']			= true;
				// $config['max_size']             = 10240; // 1MB
				// $config['max_width']            = 1024;

				// $config['max_height']           = 768;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('flayer')) {
					$flayer = $uploadPathflayer . $this->upload->data("file_name");
					$data = array(
						'file' => $flayer,
					);
					$this->main_model->update_flayer(array('id_flayer' => $id), $data);
				} else {
					return $this->template->ajax(array('file' => 'Berkas', 'gagal' => $this->upload->display_errors()));
				}
			}
		} else {

			if ($_FILES['flayer']['name']) {

				$uploadPathflayer = './assets/media/upload/file_flayer/';
				if (is_dir($uploadPathflayer) === false) {
					mkdir($uploadPathflayer, 0777, true);
				}

				$config['upload_path'] 			= $uploadPathflayer;
				$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
				$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
				$config['overwrite']			= true;
				// $config['max_size']             = 10240; // 1MB
				$config['max_size'] 			= '10240';
				// $config['max_width']            = 1024;

				// $config['max_height']           = 768;

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('flayer')) {
					$flayer = $uploadPathflayer . $this->upload->data("file_name");
					$data = array(
						'file' => $flayer,
					);
					$this->main_model->update_flayer($where, $data);
				} else {
					return $this->template->ajax(array('file' => 'Berkas', 'gagal' => $this->upload->display_errors()));
				}
			}
			$this->main_model->update_flayer($where, $data);
		}
		$this->template->ajax(array('status' => true));
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
		$filter = isset($_GET['filter']);

		$data = array();
		$keberatan = $this->main_model->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($keberatan as $row) {
			$row->no = $number++;

			if ($row->file != null) {
				$row->file = '<center><a href="' . $row->file . '" target="_blank" class="btn btn-sm btn-success" > <img style="width:20px;" src="https://img.icons8.com/fluent/48/000000/file.png"/> Unduh </a></center>';
			} else {
				$row->file = '';
			}

			$row->judul = htmlentities($row->judul);

			$row->aksi = '
					<center>
					<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="fas fa-cogs"></i>
						</button>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="javascript:void(0)" onclick="edit(' . $row->id_flayer . ')"><i class="fas fa-edit"></i> Edit</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="detail(' . $row->id_flayer . ')"><i class="fas fa-eye"></i> Detail</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="del(' . $row->id_flayer . ')"><i class="fas fa-trash"></i> Hapus</a>
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
		$this->template->ajax($data);
	}

	public function ajax_delete($id)
	{
		$data = array(
			'trash' => '1',
		);
		$this->main_model->update_flayer(array('id_flayer' => $id), $data);
		$this->template->ajax(array('status' => true));
	}
}
