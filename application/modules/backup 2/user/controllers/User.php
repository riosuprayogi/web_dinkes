<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model', 'user');
		$this->load->model('apps/Apps_model', 'apps');
		$this->load->model('skpd/Skpd_model', 'skpd');
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
	}

	public function index()
	{
		$this->template->render('user/index');
	}

	public function ajax_list()
	{
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$filter = $_GET['filter'];

		$data = array();
		$user = $this->user->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($user as $row) {
			$row->no = $number++;
			$row->aksi = '
				<center>
				<div class="btn-group">
					<button  href="javascript:void(0)" onclick="detail(' . $row->id_user . ')" class="btn btn-info"><i class="fas fa-eye"></i></button>
					<button  href="javascript:void(0)" onclick="edit(' . $row->id_user . ')" class="btn btn-success"><i class="fas fa-edit"></i></button>
					<button  href="javascript:void(0)" onclick="del(' . $row->id_user . ')" class="btn btn-danger"><i class="fas fa-trash"></i></button>
				</div>
				</center>
			';
			$data[] = $row;
		}

		$output = array(
			'draw' => $_GET['draw'],
			'recordsTotal' => $this->user->count_all(),
			'recordsFiltered' => $this->user->count_filtered($filter),
			'data' => $data,
			'GET' => $_GET,
		);

		$this->template->ajax($output);
	}

	public function ajax_skpd()
	{
		$data = (object) array();
		$data->skpd = $this->skpd->get_all();
		$this->template->ajax($data);
	}

	public function ajax_add()
	{
		$this->cart->destroy();

		$data = (object) array();
		$data->aplikasi = $this->apps->get_all();
		$this->template->ajax($data);
	}

	public function ajax_edit($id)
	{
		$data = $this->user->get_by_id($id);
		$data->aplikasi = $this->apps->get_all();

		$this->cart->destroy();
		$data_detail = $this->user->get_access($id);
		foreach ($data_detail as $row) {
			$cart = array(
				'id' => $row->app_id . '-' . $row->access,
				'qty' => 1,
				'price' => 0,
				'name' => $row->nama_app,
				'options' => array(
					'user_id' => $id,
					'app_id' => $row->app_id,
					'access' => $row->access,
				)
			);
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($cart);
		}

		$this->template->ajax($data);
	}

	public function ajax_detail($id)
	{
		$this->cart->destroy();
		$data_detail = $this->user->get_access($id);
		foreach ($data_detail as $row) {
			$cart = array(
				'id' => $row->app_id . '-' . $row->access,
				'qty' => 1,
				'price' => 0,
				'name' => $row->nama_app,
				'options' => array(
					'user_id' => $id,
					'app_id' => $row->app_id,
					'access' => $row->access,
				)
			);
			$this->cart->product_name_rules = '[:print:]';
			$this->cart->insert($cart);
		}

		$data = $this->user->get_by_id($id);
		$this->template->ajax($data);
	}

	public function ajax_insert()
	{
		$this->_validate();
		$data = array(
			'username' => $this->input->post('username'),
			'nama' => $this->input->post('nama'),
			'id_skpd' => $this->input->post('id_skpd'),
			'kode_unor' => $this->input->post('kode_unor'),
			'nama_unor' => $this->input->post('nama_unor'),
		);
		$insert = $this->user->insert($data);

		foreach ($this->cart->contents() as $row) {
			$data_detail = array(
				'user_id' => $insert,
				'app_id' => $row['options']['app_id'],
				'access' => $row['options']['access'],
			);
			$this->user->insert_roles($data_detail);
		}
		$this->cart->destroy();

		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'username' => $this->input->post('username'),
			'nama' => $this->input->post('nama'),
			'id_skpd' => $this->input->post('id_skpd'),
			'kode_unor' => $this->input->post('kode_unor'),
			'nama_unor' => $this->input->post('nama_unor'),
		);
		$this->user->update(array('id_user' => $this->input->post('id')), $data);

		$this->user->delete_roles_by_userid($this->input->post('id'));
		foreach ($this->cart->contents() as $row) {
			$data_detail = array(
				'user_id' => $row['options']['user_id'],
				'app_id' => $row['options']['app_id'],
				'access' => $row['options']['access'],
			);
			$this->user->insert_roles($data_detail);
		}
		$this->cart->destroy();

		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->user->delete($id);
		// $data = array(
		// 	'status' => 0,
		// );
		// $this->user->update(array('id_user' => $id), $data);
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_cek_nip($nip = '')
	{
		$data = (object) array();
		$user = $this->user->cek_user($nip);
		if (!$user) {
			$rest_u = 'r35t51kd4';
			$rest_p = '5ksnpcua5x6z79yk5xgbtkg89a4zdwc8ym7p2f4z';
			$this->load->library('curl');
			$this->curl->create('http://opendatav2.tangerangkota.go.id/services/pegawai/pegawaibynip/nip/' . $nip . '/format/json');
			$this->curl->http_login($rest_u, $rest_p);
			$result = json_decode($this->curl->execute(), true);
			if ($result) {
				$kode_unor = '';
				for ($i = 0; $i <= 1; $i++) {
					$row = explode(".", $result['kode_unor']);
					if ($i != 1) {
						$kode_unor .= $row[$i] . '.';
					} else {
						$kode_unor .= $row[$i];
					}
				}
				$skpd = $this->skpd->get_by_kode_unor($kode_unor);
				$result['id_skpd'] = $skpd->id_skpd;
				$result['nama_skpd'] = $skpd->nama_lengkap;
				$result['kode_unor'] = $result['kode_unor'];
			} else {
				$this->load->library('curl');
				$this->curl->create('http://opendatav2.tangerangkota.go.id/services/auth/login/uid/' . $nip . '/format/json');
				$this->curl->http_login($rest_u, $rest_p);
				$result = json_decode($this->curl->execute(), true);
				if ($result) {
					$kode_unor = '';

					for ($i = 0; $i <= 1; $i++) {
						$row = explode(".", $result['kode_unor']);
						if ($i != 1) {
							$kode_unor .= $row[$i] . '.';
						} else {
							$kode_unor .= $row[$i];
						}
					}

					$skpd = $this->skpd->get_by_kode_unor($kode_unor);
					$result['id_skpd'] = $skpd->id_skpd;
					$result['nama_skpd'] = $skpd->nama_lengkap;
					$result['kode_unor'] = $result['kode_unor'];
				} else {
					$data->user = @$result;
				}
			}

			$data->user = @$result;
		} else {
			$data->user = 'terdaftar';
			$rest_u = 'r35t51kd4';
			$rest_p = '5ksnpcua5x6z79yk5xgbtkg89a4zdwc8ym7p2f4z';
			$this->load->library('curl');
			$this->curl->create('http://opendatav2.tangerangkota.go.id/services/pegawai/pegawaibynip/nip/' . $nip . '/format/json');
			$this->curl->http_login($rest_u, $rest_p);
			$result = json_decode($this->curl->execute(), true);
			if ($result) {
				$kode_unor = '';
				for ($i = 0; $i <= 1; $i++) {
					$row = explode(".", $result['kode_unor']);
					if ($i != 1) {
						$kode_unor .= $row[$i] . '.';
					} else {
						$kode_unor .= $row[$i];
					}
				}
				$skpd = $this->skpd->get_by_kode_unor($kode_unor);
				$result['id_skpd'] = $skpd->id_skpd;
				$result['nama_skpd'] = $skpd->nama_lengkap;
				$result['kode_unor'] = $result['kode_unor'];
			}

			$data->user = @$result;
		}
		$this->template->ajax($data);
	}

	private function _validate()
	{
		$this->load->library('form_validation');
		$this->config->set_item('language', 'indonesian');
		$this->form_validation->set_rules(
			'username',
			'NIP',
			array(
				'trim', 'required',
				array(
					'nik_exist',
					function ($username = null) {
						if ($this->input->post('oldusername') == $username) return TRUE;
						if ($this->user->cek_user($username)) return FALSE;
						return TRUE;
					}
				)
			)
		);
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('id_skpd', 'ID SKPD', 'trim|required');
		$this->form_validation->set_rules('nama_skpd', 'SKPD', 'trim|required');
		$this->form_validation->set_rules('nama_unor', 'Nama UPT', 'trim|required');
		if ($this->form_validation->run()) return TRUE;

		$data = $error = array();
		$data['error_class'] = $data['error_string'] = array();
		$data['status'] = TRUE;

		if (form_error('username')) $error[] = 'username';
		if (form_error('nama')) $error[] = 'nama';
		if (form_error('id_skpd')) $error[] = 'id_skpd';
		if (form_error('nama_skpd')) $error[] = 'nama_skpd';
		if (form_error('nama_unor')) $error[] = 'nama_unor';

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

	//+an cart
	public function ajax_list_cart()
	{
		$data = array();
		$number = 1;
		foreach ($this->cart->contents() as $row) {
			$cart = array();
			$cart['no'] = $number++;
			$cart['rowid'] = $row['rowid'];
			$cart['id'] = $row['id'];
			$cart['app_name'] = $row['name'];
			$cart['app_id'] = @$row['options']['app_id'];
			// $cart['access'] = @$row['options']['access'];
			// $cart['access_name'] = isset($row['options']['access']) && $row['options']['access'] == 'full' ? 'Semua SKPD' : 'Hanya SKPD';
			// $cart['access_name'] = $row['options']['access'] == 'full';
			$cart['aksi'] = @'<a class="btn btn-block btn-danger btn-xs" href="javascript:void(0)" onclick="del_cart(\'' . $row['rowid'] . '\')"><i class="fas fa-trash"></i></a>';
			$data[] = $cart;
		}

		$output = array(
			'data' => $data,
		);

		$this->template->ajax($output);
	}

	public function ajax_add_cart()
	{
		$this->_validate_roles();
		$data = array(
			'id' => $this->input->post('app_id') . '-' . $this->input->post('access'),
			'qty' => 1,
			'price' => 0,
			'name' => $this->input->post('appname'),
			'options' => array(
				'user_id' => $this->input->post('id'),
				'app_id' => $this->input->post('app_id'),
				'access' => $this->input->post('access'),
			)
		);

		$this->cart->product_name_rules = '[:print:]';
		$this->cart->insert($data);
		$this->template->ajax(array('status' => TRUE, 'data' => $data));
	}

	public function ajax_delete_cart($rowid)
	{
		$data = array(
			'rowid' => $rowid,
			'qty' => 0
		);
		$this->cart->update($data);
		$this->template->ajax(array('status' => TRUE));
	}

	private function _validate_roles()
	{
		$this->load->library('form_validation');
		$this->config->set_item('language', 'indonesian');
		$this->form_validation->set_rules('app_id', 'Aplikasi', 'trim|required|integer');
		// $this->form_validation->set_rules('access', 'Hak Akses', 'trim|required');
		if ($this->form_validation->run()) return TRUE;

		$data = $error = array();
		$data['error_class'] = $data['error_string'] = array();
		$data['status'] = TRUE;

		if (form_error('app_id')) $error[] = 'app_id';
		if (form_error('access')) $error[] = 'access';

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


	public function recsrf()
	{
		$data = array(
			'name' =>  $this->security->get_csrf_token_name(),
			'value' => $this->security->get_csrf_hash(),
		);
		echo json_encode($data);
	}
}
