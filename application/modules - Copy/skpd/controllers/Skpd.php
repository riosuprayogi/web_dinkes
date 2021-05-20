<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skpd extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('skpd/Skpd_model', 'skpd');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
	}

	public function index(){
		$this->template->render('skpd/index');
	}

	public function ajax_list(){
		$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
		$length = isset($_POST['length']) ? intval($_POST['length']) : 10;
		$sort = isset($_POST['columns'][$_POST['order'][0]['column']]['data']) ? strval($_POST['columns'][$_POST['order'][0]['column']]['data']) : 'nama_lengkap';
		$order = isset($_POST['order'][0]['dir']) ? strval($_POST['order'][0]['dir']) : 'asc';
		$filter = $_POST['filter'];

		$data = array();
		$skpd = $this->skpd->get($start, $length, $sort, $order, $filter);
		$number = $_POST['start'] + 1;

		foreach($skpd as $row){
			$row->no = $number++;
			$row->aksi = '
				<center>
				<a data-toggle="tooltip" data-placement="top" title="Detail" class="btn btn-xs btn-info" href="javascript:void(0)" onclick="detail('.$row->id_skpd.')"><i class="glyphicon glyphicon-eye-open"></i></a>
				</center>
			';
			$data[] = $row;
		}

		$output = array(
			'draw' => $_POST['draw'],
			'recordsTotal' => $this->skpd->count_all(),
			'recordsFiltered' => $this->skpd->count_filtered($filter),
			'data' => $data,
		);

		$this->template->ajax($output);
	}

	public function ajax_detail($id){
		$data = $this->skpd->get_by_id($id);
		$this->template->ajax($data);
	}
}