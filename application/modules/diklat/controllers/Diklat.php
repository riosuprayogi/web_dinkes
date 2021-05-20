<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('diklat/Diklat_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		// $this->load->model('apps/Apps_model', 'apps');
		$this->load->model('skpd/Skpd_model', 'skpd');
		$this->load->model('kategori/Kategori_model', 'kategori');
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->library('cart');
		$this->load->library('curl');
	}


	public function batas($string, $length)
	{
		if (strlen($string) <= ($length)) {
			return $string;
		} else {
			$cetak = substr($string, 0, $length) . '';
			return $cetak;
		}
	}



	public function index()
	{
		$data['title'] = "Input Artikel";

		// $listProfiles = $this->db->query("SELECT web_artikel.*, web_kategori_artikel.*, web_admin.nama_admin
		//                                 FROM web_artikel
		//                                 JOIN web_kategori_artikel ON web_artikel.id_kat_artikel = aweb_kategori_artikel.id_kat_artikel
		//                                 JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
		//                                 ORDER BY tgl_jam DESC");
		$listProfiles = $this->db->query("SELECT t_diklat.*
			FROM t_diklat
			WHERE t_diklat.trash='0' 
			ORDER BY t_diklat.tgl_jam DESC
			");
		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {
			$result = $this->db->query("SELECT *, MIN(urutan)AS urutan FROM t_foto_diklat WHERE id_diklat=" . $row['id_diklat'] . "")->result_array();

			if ($result) {
				$arr = array(
					"id_diklat"        => $row["id_diklat"],
					// "id_kategori"    => $row["id_kategori"],
					"nama_diklat"  => $row["nama_diklat"],
					// "nama_diklat"     => $row["nama_diklat"],
					"isi_diklat"       => $row["isi_diklat"],
					"status"           => $row["status"],
					"tgl_jam"           => $row["tgl_jam"],
					// "path_foto_diklat" => $result
					"path_foto_diklat" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data["t_diklat"] = $arrProfile;

		$listProfiles = $this->db->query("SELECT t_diklat.*
			FROM t_diklat
			WHERE t_diklat.trash='0' 
			ORDER BY t_diklat.tgl_jam DESC
			");
		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {
			$result = $this->db->query("SELECT *FROM t_foto_diklat WHERE id_diklat=" . $row['id_diklat'] . "")->result_array();

			if ($result) {
				$arr = array(
					"id_diklat"        => $row["id_diklat"],
					// "id_kategori"    => $row["id_kategori"],
					"nama_diklat"  => $row["nama_diklat"],
					// "nama_diklat"     => $row["nama_diklat"],
					"isi_diklat"       => $row["isi_diklat"],
					"status"           => $row["status"],
					"tgl_jam"           => $row["tgl_jam"],
					// "path_foto_diklat" => $result
					"path_foto_diklat" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data2["t_diklat2"] = $arrProfile;

		// var_dump($data2);
		// die();
		// $data['alasan'] = $this->main_model->get_alasan();
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('diklat/frontend/index', $data);
		} else {
			$this->template->render('diklat/backend/index', $data2);
		}
	}


	public function detail($id)
	{

		$data['foto'] = $this->db->query("SELECT t_diklat.*, t_foto_diklat.*
			FROM t_diklat
			JOIN t_foto_diklat ON t_diklat.id_diklat = t_foto_diklat.id_diklat
			WHERE t_diklat.id_diklat = '$id' AND t_diklat.status = 'show'")->result();

		$data["detailBerita"] = $this->db->query("SELECT * FROM t_diklat WHERE  status = 'show' AND id_diklat='$id'")->result();


		$listProfiles = $this->db->query("SELECT t_diklat.*, t_foto_diklat.*

			FROM t_diklat
			    -- JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
			    -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			    JOIN t_foto_diklat ON t_diklat.id_diklat = t_foto_diklat.id_diklat
			    WHERE t_diklat.status = 'show' AND trash='0'  ORDER BY tgl_jam DESC");
			// var_dump($listProfiles);
			            	// die();

		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {

			$result = $this->db->query("SELECT * FROM t_foto_diklat WHERE  id_diklat='$id'")->result_array();
			            	// var_dump($result);
			            	// die();
			if ($result) {

				$arr = array(
					"id_diklat" => $row["id_diklat"],
						// "id_kategori" => $row["id_kategori"],
						// "judul_berita" => $row["judul_berita"],
						// "isi_berita" => $this->batas($row["isi_berita"], 50),
			                    // "nama_admin"  =>  $row["nama_admin"],
			                    // "publish" => $row["publish"],
					"tgl_jam" => $row["tgl_jam"],
					"path_foto_diklat" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data["sliderdetaildiklat"] = $arrProfile;
			// var_dump($datae);
			// die();
		// ================= berita

		$listProfiles = $this->db->query("SELECT t_diklat.*

			FROM t_diklat 
			    -- JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
			    -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			    WHERE t_diklat.status = 'show' AND trash='0' AND t_diklat.id_diklat=$id ORDER BY tgl_jam DESC LIMIT 4");
		// var_dump($listProfiles);
		// die();

		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {

			$result = $this->db->query("SELECT *, MIN(urutan)AS urutan FROM t_foto_diklat WHERE id_diklat=" . $row['id_diklat'] . "")->result_array();
			// var_dump($result);
			// die();
			if ($result) {

				$arr = array(
					"id_diklat" => $row["id_diklat"],
					// "id_kategori" => $row["id_kategori"],
					"nama_diklat" => $row["nama_diklat"],
					"isi_diklat" => $this->batas($row["isi_diklat"], 50),
					// "nama_admin"  =>  $row["nama_admin"],
					// "publish" => $row["publish"],
					"tgl_jam" => $row["tgl_jam"],
					"path_foto_diklat" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data["berita3"] = $arrProfile;
		// var_dump($datae);
		// die();





		// ============== isi berita
		$data['foto'] = $this->db->query("SELECT t_diklat.*, t_foto_diklat.*
			FROM t_diklat
			JOIN t_foto_diklat ON t_diklat.id_diklat = t_foto_diklat.id_diklat
			WHERE t_diklat.id_diklat = '$id' AND t_diklat.status = 'show'")->result();

		$data["detailBerita"] = $this->db->query("SELECT * FROM t_diklat WHERE  status = 'show' AND id_diklat='$id'")->result();
		// ============== akhir isi berita



		$listProfiles2 = $this->db->query("SELECT t_diklat.* 

			FROM t_diklat 
			                                        -- JOIN t_foto_berita ON t_berita.id_berita = t_foto_berita.id_berita
			                                        -- JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
			                                        WHERE t_diklat.status = 'show' AND trash='0'    ORDER BY tgl_jam DESC LIMIT 4");


		// var_dump($listProfiles2);
		// die();

		$arrProfile2 = [];
		$arr2 = [];
		foreach ($listProfiles2->result_array() as $key => $row) {

			$result = $this->db->query("SELECT *, MIN(urutan)AS urutan FROM t_foto_diklat WHERE id_diklat=" . $row['id_diklat'] . "")->result_array();
			// var_dump($result);
			// die();
			if ($result) {

				$arr2 = array(
					"id_diklat" => $row["id_diklat"],
					// "id_kategori" => $row["id_kategori"],
					"nama_diklat" => $row["nama_diklat"],
					"isi_diklat" => $row["isi_diklat"],
					// "id_kategori"  =>  $row["id_kategori"],
					// "publish" => $row["publish"],
					"tgl_jam" => $row["tgl_jam"],
					"path_foto_diklat" => $result
				);
				array_push($arrProfile2, $arr2);
			}
		}

		$data["diklatterkait"] = $arrProfile2;
		// var_dump($data4);
		// die();
		// var_dump($data);
		// die();
		$data['title'] = "Detail Artikel";
		$this->template->render_home('diklat/frontend/detail', $data);
		// $data ['detailFeatured'] = $this->crudBaznas->getById($id);
		// $data ['image'] = $this->crudBaznas->imgById($id);
		// $this->load->view('templates_users/header', $data);
		// $this->load->view('templates_users/navbar');
		// $this->load->view('users/detailBerita', $data);
		// $this->load->view('templates_users/footer');
	}




	public function tambah()
	{
		$data['title'] = "Input Artikel Berita";
		// $data['inputartikel'] = $this->db->query("SELECT * FROM web_artikel")->result();
		$data['kategori'] = $this->db->query("SELECT * FROM t_kategori")->result(); // join buatambil data di combobox
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('berita/frontend/index');
		} else {
			$this->template->render('berita/backend/tambah', $data);
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
			// 'id_kategori' => $this->input->post('dd_kategori_berita', TRUE),
			'nama_diklat' => $this->input->post('nama_diklat', TRUE),
			'isi_diklat' => $this->input->post('isi_diklat'),
			'status' => $this->input->post('status', TRUE),
			// 'id_admin' => $this->input->post('id_admin', TRUE),
		);
		$where = array(
			'id_diklat' => $this->input->post('id'),
		);


		if (!$this->input->post('id')) {
			$id = $this->main_model->insert_diklat($data);
			if ($id) {
				$count = count($_FILES['path_foto_diklat']['name']);
				$tempArr = [];
				for ($i = 0; $i < $count; $i++) {
					$_FILES['upload_File']['name'] = $_FILES['path_foto_diklat']['name'][$i];
					$_FILES['upload_File']['name'] = $_FILES['path_foto_diklat']['name'][$i];
					$_FILES['upload_File']['type'] = $_FILES['path_foto_diklat']['type'][$i];
					$_FILES['upload_File']['tmp_name'] = $_FILES['path_foto_diklat']['tmp_name'][$i];
					$_FILES['upload_File']['error'] = $_FILES['path_foto_diklat']['error'][$i];
					$_FILES['upload_File']['size'] = $_FILES['path_foto_diklat']['size'][$i];

					$uploadPath = './assets/backend/img/img_diklat/';
					$config['upload_path'] = $uploadPath;
					$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('upload_File')) {
						$fileData = $this->upload->data();
						$foto = $fileData['file_name'];
						$data2 = array(
							'id_diklat' => $id,
							'path_foto_diklat' => $foto,
						);
						$this->main_model->insert_foto($data2);
						$tempArr["file_name"] = 'success' . $_FILES['upload_File']['name'];
					} else {
						$status = 'foto' . $this->upload->display_errors();
						$tempArr["file_name"] = $status;
					}
				}
				$this->template->ajax(array('status' => true, 'name' => $tempArr));
			}
		} else {
			$this->main_model->update_diklat($where, $data);
			$this->template->ajax(array('status' => true));
		}
	}


	public function ajax_add()
	{
		$this->cart->destroy();
		$data = (object) array();
		$data->kategori = $this->main_model->get_kategori();
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
		$berita = $this->main_model->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($berita as $row) {
			$row->no = $number++;
			$row->foto = base_url($row["photo"]);
			$row->aksi = '
			<center>
			<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
			<i class="fas fa-cogs"></i>
			</button>
			<div class="dropdown-menu">
			<a class="dropdown-item" href="javascript:void(0)" onclick="edit('  . $row->id_diklat . ')"><i class="fas fa-edit"></i> Edit</a>
			<a class="dropdown-item" href="javascript:void(0)" onclick="del(' . $row->id_diklat . ')"><i class="fas fa-trash"></i> Hapus</a>
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
		$data->kategori = $this->main_model->get_kategori();
		$this->template->ajax($data);
	}

	public function ajax_delete($id)
	{
		$data = array(
			'trash' => '1',
		);
		$this->main_model->update_diklat(array('id_diklat' => $id), $data);
		$this->template->ajax(array('status' => true));
		redirect("diklat");
	}

	public function edit($id)
	{
		$where = array('id_diklat' => $id);

		$data["t_diklat"] = $this->db->query("SELECT * FROM t_diklat WHERE id_diklat = '$id'")->result();

		// $data['t_kategori'] = $this->db->query("SELECT * FROM t_kategori WHERE trash='0'")->result(); // join buat ambil data di combobox

		$data['t_foto_diklat'] = $this->db->query("SELECT * FROM t_foto_diklat WHERE id_diklat = '$id' ORDER BY urutan ASC")->result_array();


		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('diklat/frontend/index');
		} else {
			$this->template->render('diklat/backend/edit', $data);
		}
	}

	public function detail_($id)
	{
		$where = array('id_diklat' => $id);

		$data["t_diklat"] = $this->db->query("SELECT * FROM t_diklat WHERE id_diklat = '$id'")->result();

		// $data['t_kategori'] = $this->db->query("SELECT * FROM t_kategori WHERE trash='0'")->result(); // join buat ambil data di combobox

		$data['t_foto_diklat'] = $this->db->query("SELECT * FROM t_foto_diklat WHERE id_diklat = '$id' ORDER BY urutan ASC")->result_array();


		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('diklat/frontend/index');
		} else {
			$this->template->render('diklat/backend/detail', $data);
		}
	}

	public function _rules()
	{
		// $this->form_validation->set_rules('id_kat_artikel', 'kategori artikel', 'required');
		$this->form_validation->set_rules('nama_diklat', 'judul berita', 'required');
		$this->form_validation->set_rules('isi_diklat', 'isi berita', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
		// $this->form_validation->set_rules('path_foto_diklat', '', 'callback_file_check');   
		// $this->form_validation->set_rules('id_admin', 'nama admin', 'required');
	}


	public function updateDataAksix()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {

			$id             = $this->input->post('id_diklat');
			// $id_kategori = $this->input->post('id_kategori');
			$nama_diklat  = $this->input->post('nama_diklat');
			$isi_diklat    = $this->input->post('isi_diklat');
			$status        = $this->input->post('status');
			$id_admin        = $this->input->post('id_admin');

			$data = array(
				// 'id_kategori'    => $id_kategori,
				'nama_diklat'     => $nama_diklat,
				'isi_diklat'       => $isi_diklat,
				'status'           => $status,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_diklat' => $id
			);

			$this->main_model->update_data('t_berita', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_diklat_update')); $i++) {

				$id_detail_path_foto_diklat_update  = $this->input->post('id_detail_path_foto_diklat_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_berita' => $id_detail_path_foto_diklat_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_diklat']['name'][0])) {

				$count = count($_FILES['path_foto_diklat']['name']);

				$config['upload_path']      = './assets/backend/img/img_berita';
				$config['allowed_types']    = 'jpg|png|jpeg|gif';
				$config['max_size']         = '2048';
				$config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_diklat']['name'][$i];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_diklat']['name'][$i]) {

						$_FILES['file']['name']     = $_FILES['path_foto_diklat']['name'][$i];
						$_FILES['file']['type']     = $_FILES['path_foto_diklat']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['path_foto_diklat']['tmp_name'][$i];
						$_FILES['file']['error']    = $_FILES['path_foto_diklat']['error'][$i];
						$_FILES['file']['size']     = $_FILES['path_foto_diklat']['size'][$i];

						// $config['upload_path']      = './assets/backend/img/img_artikel';
						// $config['allowed_types']    = 'jpg|png|jpeg|gif';
						// $config['encrypt_name']     = 'TRUE';
						// $config['max_size']         = '2048';
						// $config['file_name']        = $_FILES['path_foto_diklat']['name'][$i];

						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file')) {
							$this->session->set_flashdata(
								'pesan',
								'<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Maaf :(!</strong> Uploawdawdawdad gagal, format photo (jpg,jpeg,png) ukuran file max 2 Mb.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								</div>'
							);
							return $this->edit($id);
						} else {
							//         $path_foto_diklat = $this->upload->data('file_name');
							//     }
							// }
							// $id         = $this->input->post('id_artikel');
							// $urutan     = $this->input->post('urutan')[$i];
							// $ket_foto   = $this->input->post('ket_foto')[$i];

							$uploadData = $this->upload->data();
							$path_foto_diklat = $uploadData['file_name'];
							// $ket_foto  = $this->input->post('ket_foto')[$i];
							// $urutan     = $this->input->post('urutan')[$i];

							$data = array(
								'id_diklat'        => $id,
								'path_foto_diklat' => $path_foto_diklat,
								// 'urutan'            => $urutan,
								// 'ket_foto'          => $ket_foto
							);
						}
					}
					$this->main_model->insert_data($data, 't_foto_berita');
				}
			}

			// $id_foto_artikel = $this->input->post('id_foto_artikel');
			// $id = $this->input->post('id_artikel');
			// $urutan = $this->input->post('urutan');
			// $ket_foto = $this->input->post('ket_foto');
			// $data = array(
			//     'id_artikel' => $id,
			//     'urutan' => $urutan,
			//     'ket_foto' => $ket_foto
			// );

			// $where = array(
			//     'id_foto_artikel' => $id_foto_artikel
			// );
			// $this->Inputartikel_model->update_data('web_foto_artikel', $data, $where);
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Selamatt!</strong> Anda Berhasil Mengupdate Data baru.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>'
			);
			redirect('berita');
		}
	}



	public function updateDataAksi()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {
			$id             = $this->input->post('id_diklat');
			// $id_kategori = $this->input->post('id_kategori');
			$nama_diklat  = $this->input->post('nama_diklat');
			$isi_diklat    = $this->input->post('isi_diklat');
			$status        = $this->input->post('status');
			// $id_admin       = $this->input->post('id_admin');

			$data = array(
				// 'id_kategori'    => $id_kategori,
				'nama_diklat'     => $nama_diklat,
				'isi_diklat'       => $isi_diklat,
				'status'           => $status,
				// 'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_diklat' => $id
			);

			$this->main_model->update_data('t_diklat', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_diklat_update')); $i++) {

				$id_detail_path_foto_diklat_update  = $this->input->post('id_detail_path_foto_diklat_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_berita' => $id_detail_path_foto_diklat_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_diklat']['name'][0])) {

				// $count = count($_FILES['path_foto_diklat']['name']);

				// $config['upload_path']      = './assets/backend/img/img_berita';
				// $config['allowed_types']    = 'jpg|png|jpeg|gif';
				// $config['max_size']         = '5120';
				// $config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_diklat']['name'][$i];

				$count = count($_FILES['path_foto_diklat']['name']);
				$tempArr = [];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_diklat']['name'][$i]) {

						for ($i = 0; $i < $count; $i++) {
							$_FILES['upload_File']['name'] = $_FILES['path_foto_diklat']['name'][$i];
							$_FILES['upload_File']['name'] = $_FILES['path_foto_diklat']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['path_foto_diklat']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['path_foto_diklat']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['path_foto_diklat']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['path_foto_diklat']['size'][$i];
							$uploadPath = './assets/backend/img/img_diklat/';
							$config['upload_path'] = $uploadPath;
							$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('upload_File')) {
								$fileData = $this->upload->data();
								$foto = $fileData['file_name'];
								$data2 = array(
									'id_diklat' => $id,
									'path_foto_diklat' => $foto,
								);
								$this->main_model->insert_foto($data2);
								$tempArr["file_name"] = 'success' . $_FILES['upload_File']['name'];
								redirect('diklat');
							} else {
								$status = 'foto' . $this->upload->display_errors();
								$tempArr["file_name"] = $status;
								return $this->edit($id);
							}
						}
					}
				}
			}

			// $id_foto_artikel = $this->input->post('id_foto_artikel');
			// $id = $this->input->post('id_artikel');
			// $urutan = $this->input->post('urutan');
			// $ket_foto = $this->input->post('ket_foto');
			// $data = array(
			//     'id_artikel' => $id,
			//     'urutan' => $urutan,
			//     'ket_foto' => $ket_foto
			// );

			// $where = array(
			//     'id_foto_artikel' => $id_foto_artikel
			// );
			// $this->Inputartikel_model->update_data('web_foto_artikel', $data, $where);
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Selamatt!</strong> Anda Berhasil Mengupdate Data baru.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>'
			);
			redirect('diklat');
		}
	}


	public function updateDataAksis()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {
			$id             = $this->input->post('id_diklat');
			$id_kategori = $this->input->post('id_kategori');
			$nama_diklat  = $this->input->post('nama_diklat');
			$isi_diklat    = $this->input->post('isi_diklat');
			$status        = $this->input->post('status');
			$id_admin       = $this->input->post('id_admin');

			$data = array(
				'id_kategori'    => $id_kategori,
				'nama_diklat'     => $nama_diklat,
				'isi_diklat'       => $isi_diklat,
				'status'           => $status,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_diklat' => $id
			);

			$this->main_model->update_data('t_berita', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_diklat_update')); $i++) {

				$id_detail_path_foto_diklat_update  = $this->input->post('id_detail_path_foto_diklat_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_berita' => $id_detail_path_foto_diklat_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_diklat']['name'][0])) {

				$count = count($_FILES['path_foto_diklat']['name']);

				$config['upload_path']      = './assets/backend/img/img_berita';
				$config['allowed_types']    = 'jpg|png|jpeg|gif';
				$config['max_size']         = '5120';
				$config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_diklat']['name'][$i];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_diklat']['name'][$i]) {

						$_FILES['file']['name']     = $_FILES['path_foto_diklat']['name'][$i];
						$_FILES['file']['type']     = $_FILES['path_foto_diklat']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['path_foto_diklat']['tmp_name'][$i];
						$_FILES['file']['error']    = $_FILES['path_foto_diklat']['error'][$i];
						$_FILES['file']['size']     = $_FILES['path_foto_diklat']['size'][$i];

						// $config['upload_path']      = './assets/backend/img/img_artikel';
						// $config['allowed_types']    = 'jpg|png|jpeg|gif';
						// $config['encrypt_name']     = 'TRUE';
						// $config['max_size']         = '2048';
						// $config['file_name']        = $_FILES['path_foto_diklat']['name'][$i];



						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file')) {
							$this->session->set_flashdata(
								'pesan',
								'<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Maaf :(!</strong> Upload gagal, format photo (jpg,jpeg,png) ukuran file max 5 Mb.
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								</div>'
							);
							return $this->edit($id);
						} else {
							//         $path_foto_diklat = $this->upload->data('file_name');
							//     }
							// }
							// $id         = $this->input->post('id_artikel');
							// $urutan     = $this->input->post('urutan')[$i];
							// $ket_foto   = $this->input->post('ket_foto')[$i];

							$uploadData = $this->upload->data();
							$path_foto_diklat = $uploadData['file_name'];
							// $ket_foto  = $this->input->post('ket_foto')[$i];
							// $urutan     = $this->input->post('urutan')[$i];

							$data = array(
								'id_diklat'        => $id,
								'path_foto_diklat' => $path_foto_diklat,
								// 'urutan'            => $urutan,
								// 'ket_foto'          => $ket_foto
							);
						}
					}
					$this->main_model->insert_data($data, 't_foto_berita');
				}
			}

			// $id_foto_artikel = $this->input->post('id_foto_artikel');
			// $id = $this->input->post('id_artikel');
			// $urutan = $this->input->post('urutan');
			// $ket_foto = $this->input->post('ket_foto');
			// $data = array(
			//     'id_artikel' => $id,
			//     'urutan' => $urutan,
			//     'ket_foto' => $ket_foto
			// );

			// $where = array(
			//     'id_foto_artikel' => $id_foto_artikel
			// );
			// $this->Inputartikel_model->update_data('web_foto_artikel', $data, $where);
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Selamatt!</strong> Anda Berhasil Mengupdate Data baru.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>'
			);
			redirect('berita');
		}
	}



	public function deleteImageAjax($id)
	{
		$where = array('id_foto_diklat' => $id);
		$this->main_model->deleteData($where, 't_foto_diklat');

		json_encode(array('status' => 200));
	}
}
