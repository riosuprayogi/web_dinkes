<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('mitra/Mitra_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		// $this->load->model('apps/Apps_model', 'apps');
		$this->load->model('skpd/Skpd_model', 'skpd');
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('text');
		$this->load->library('cart');
		$this->load->library('curl');
	}


	public function index()
	{
		$data['title'] = "Input Artikel";
		$data["mitra"] = $this->main_model->get_data('t_mitra')->result();
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('mitra/frontend/index');
		} else {
			$this->template->render('mitra/backend/index', $data);
		}
	}

	public function tambah()
	{
		$data['title'] = "Input Artikel Berita";
		// $data['inputartikel'] = $this->db->query("SELECT * FROM web_artikel")->result();
		// $data['kategori'] = $this->db->query("SELECT * FROM t_kategori")->result(); // join buatambil data di combobox
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('berita/frontend/index');
		} else {
			$this->template->render('mitra/backend/add', $data);
		}
	}

	public function action_add()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');

		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah();
		} else {
			$nama_mitra         =   $this->input->post('nama_mitra');
			$link_mitra     =   $this->input->post('link_mitra');
			$path_gambar_mitra   =   $_FILES['path_gambar_mitra']['name'];
			$status     =   $this->input->post('status');

			if ($path_gambar_mitra = '') {
			} else {
				$config['upload_path']     =   './assets/backend/img/img_mitra';
				$config['allowed_types']   =   'jpg|jpeg|png';
				$config['encrypt_name']    =   'True';

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('path_gambar_mitra')) {
					echo "Photo Gagal Di Upload";
				} else {
					$path_gambar_mitra = $this->upload->data('file_name');
				}
			}

			$data = array(
				'nama_mitra' => $nama_mitra,
				'link_mitra'   => $link_mitra,
				'path_gambar_mitra' => $path_gambar_mitra,
				'status'   => $status,
				'tgl_jam'   => $dateTime
			);

			$this->main_model->insert_data($data, 't_mitra');
			$this->session->set_flashdata(
				'pesan',
				'<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Selamatt!</strong> Anda Berhasil Menambahkan Data baru.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>'
			);
			redirect('mitra');
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
			'judul_berita' => $this->input->post('judul_berita', TRUE),
			'isi_berita' => $this->input->post('isi_berita'),
			'status' => $this->input->post('status', TRUE),
			'id_admin' => $this->input->post('id_admin', TRUE),
		);
		$where = array(
			'id_berita' => $this->input->post('id'),
		);


		if (!$this->input->post('id')) {
			$id = $this->main_model->insert_berita($data);
			if ($id) {
				$count = count($_FILES['path_foto_artikel']['name']);
				$tempArr = [];
				for ($i = 0; $i < $count; $i++) {
					$_FILES['upload_File']['name'] = $_FILES['path_foto_artikel']['name'][$i];
					$_FILES['upload_File']['name'] = $_FILES['path_foto_artikel']['name'][$i];
					$_FILES['upload_File']['type'] = $_FILES['path_foto_artikel']['type'][$i];
					$_FILES['upload_File']['tmp_name'] = $_FILES['path_foto_artikel']['tmp_name'][$i];
					$_FILES['upload_File']['error'] = $_FILES['path_foto_artikel']['error'][$i];
					$_FILES['upload_File']['size'] = $_FILES['path_foto_artikel']['size'][$i];

					$uploadPath = './assets/backend/img/img_berita/';
					$config['upload_path'] = $uploadPath;
					$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
					$config['allowed_types'] = 'gif|jpg|png|jpeg';

					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('upload_File')) {
						$fileData = $this->upload->data();
						$foto = $fileData['file_name'];
						$data2 = array(
							'id_berita' => $id,
							'path_foto_artikel' => $foto,
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
			$this->main_model->update_berita($where, $data);
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
						<a class="dropdown-item" href="javascript:void(0)" onclick="edit('  . $row->id_berita . ')"><i class="fas fa-edit"></i> Edit</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="del(' . $row->id_berita . ')"><i class="fas fa-trash"></i> Hapus</a>
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
		$this->main_model->update_berita(array('id_berita' => $id), $data);
		$this->template->ajax(array('status' => true));
		redirect("berita");
	}



	public function edit($id)
	{
		$where = array('id_berita' => $id);

		$data["t_berita"] = $this->db->query("SELECT * FROM t_berita WHERE id_berita = '$id'")->result();

		$data['t_kategori'] = $this->db->query("SELECT * FROM t_kategori WHERE trash='0'")->result(); // join buat ambil data di combobox

		$data['t_foto_berita'] = $this->db->query("SELECT * FROM t_foto_berita WHERE id_berita = '$id' ORDER BY urutan ASC")->result_array();


		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('berita/frontend/index');
		} else {
			$this->template->render('berita/backend/edit', $data);
		}
	}

	public function detail($id)
	{
		$where = array('id_berita' => $id);

		$data["t_berita"] = $this->db->query("SELECT * FROM t_berita WHERE id_berita = '$id'")->result();

		$data['t_kategori'] = $this->db->query("SELECT * FROM t_kategori WHERE trash='0'")->result(); // join buat ambil data di combobox

		$data['t_foto_berita'] = $this->db->query("SELECT * FROM t_foto_berita WHERE id_berita = '$id' ORDER BY urutan ASC")->result_array();


		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('berita/frontend/index');
		} else {
			$this->template->render('berita/backend/detail', $data);
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_mitra', 'nama mitra', 'required');
		$this->form_validation->set_rules('link_mitra', 'link mitra', 'required');
		$this->form_validation->set_rules('status', 'status', 'required');
	}


	public function updateDataAksix()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {

			$id             = $this->input->post('id_berita');
			// $id_kategori = $this->input->post('id_kategori');
			$judul_berita  = $this->input->post('judul_berita');
			$isi_berita    = $this->input->post('isi_berita');
			$status        = $this->input->post('status');
			$id_admin        = $this->input->post('id_admin');

			$data = array(
				// 'id_kategori'    => $id_kategori,
				'judul_berita'     => $judul_berita,
				'isi_berita'       => $isi_berita,
				'status'           => $status,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_berita' => $id
			);

			$this->main_model->update_data('t_berita', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_artikel_update')); $i++) {

				$id_detail_path_foto_artikel_update  = $this->input->post('id_detail_path_foto_artikel_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_berita' => $id_detail_path_foto_artikel_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_artikel']['name'][0])) {

				$count = count($_FILES['path_foto_artikel']['name']);

				$config['upload_path']      = './assets/backend/img/img_berita';
				$config['allowed_types']    = 'jpg|png|jpeg|gif';
				$config['max_size']         = '2048';
				$config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_artikel']['name'][$i];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_artikel']['name'][$i]) {

						$_FILES['file']['name']     = $_FILES['path_foto_artikel']['name'][$i];
						$_FILES['file']['type']     = $_FILES['path_foto_artikel']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['path_foto_artikel']['tmp_name'][$i];
						$_FILES['file']['error']    = $_FILES['path_foto_artikel']['error'][$i];
						$_FILES['file']['size']     = $_FILES['path_foto_artikel']['size'][$i];

						// $config['upload_path']      = './assets/backend/img/img_artikel';
						// $config['allowed_types']    = 'jpg|png|jpeg|gif';
						// $config['encrypt_name']     = 'TRUE';
						// $config['max_size']         = '2048';
						// $config['file_name']        = $_FILES['path_foto_artikel']['name'][$i];

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
							//         $path_foto_artikel = $this->upload->data('file_name');
							//     }
							// }
							// $id         = $this->input->post('id_artikel');
							// $urutan     = $this->input->post('urutan')[$i];
							// $ket_foto   = $this->input->post('ket_foto')[$i];

							$uploadData = $this->upload->data();
							$path_foto_artikel = $uploadData['file_name'];
							// $ket_foto  = $this->input->post('ket_foto')[$i];
							// $urutan     = $this->input->post('urutan')[$i];

							$data = array(
								'id_berita'        => $id,
								'path_foto_artikel' => $path_foto_artikel,
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
			$id             = $this->input->post('id_berita');
			$id_kategori = $this->input->post('id_kategori');
			$judul_berita  = $this->input->post('judul_berita');
			$isi_berita    = $this->input->post('isi_berita');
			$status        = $this->input->post('status');
			$id_admin       = $this->input->post('id_admin');

			$data = array(
				'id_kategori'    => $id_kategori,
				'judul_berita'     => $judul_berita,
				'isi_berita'       => $isi_berita,
				'status'           => $status,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_berita' => $id
			);

			$this->main_model->update_data('t_berita', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_artikel_update')); $i++) {

				$id_detail_path_foto_artikel_update  = $this->input->post('id_detail_path_foto_artikel_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_berita' => $id_detail_path_foto_artikel_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_artikel']['name'][0])) {

				// $count = count($_FILES['path_foto_artikel']['name']);

				// $config['upload_path']      = './assets/backend/img/img_berita';
				// $config['allowed_types']    = 'jpg|png|jpeg|gif';
				// $config['max_size']         = '5120';
				// $config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_artikel']['name'][$i];

				$count = count($_FILES['path_foto_artikel']['name']);
				$tempArr = [];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_artikel']['name'][$i]) {

						for ($i = 0; $i < $count; $i++) {
							$_FILES['upload_File']['name'] = $_FILES['path_foto_artikel']['name'][$i];
							$_FILES['upload_File']['name'] = $_FILES['path_foto_artikel']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['path_foto_artikel']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['path_foto_artikel']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['path_foto_artikel']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['path_foto_artikel']['size'][$i];
							$uploadPath = './assets/backend/img/img_berita/';
							$config['upload_path'] = $uploadPath;
							$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('upload_File')) {
								$fileData = $this->upload->data();
								$foto = $fileData['file_name'];
								$data2 = array(
									'id_berita' => $id,
									'path_foto_artikel' => $foto,
								);
								$this->main_model->insert_foto($data2);
								$tempArr["file_name"] = 'success' . $_FILES['upload_File']['name'];
								redirect('berita');
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
			redirect('berita');
		}
	}

	public function create_edit($id = null) // ini satu form untuk create dan edit
	{
		$data['id'] = $id;

		$this->template->title('Form Data Perusahaan');
		$this->template->set_partial('footer', 'admin/perusahaan_admin/_script/maps');
		$this->template->build('backend/create', $data);
	}


	public function updateDataAksis()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {
			$id             = $this->input->post('id_berita');
			$id_kategori = $this->input->post('id_kategori');
			$judul_berita  = $this->input->post('judul_berita');
			$isi_berita    = $this->input->post('isi_berita');
			$status        = $this->input->post('status');
			$id_admin       = $this->input->post('id_admin');

			$data = array(
				'id_kategori'    => $id_kategori,
				'judul_berita'     => $judul_berita,
				'isi_berita'       => $isi_berita,
				'status'           => $status,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_berita' => $id
			);

			$this->main_model->update_data('t_berita', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_artikel_update')); $i++) {

				$id_detail_path_foto_artikel_update  = $this->input->post('id_detail_path_foto_artikel_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_berita' => $id_detail_path_foto_artikel_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_artikel']['name'][0])) {

				$count = count($_FILES['path_foto_artikel']['name']);

				$config['upload_path']      = './assets/backend/img/img_berita';
				$config['allowed_types']    = 'jpg|png|jpeg|gif';
				$config['max_size']         = '5120';
				$config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_artikel']['name'][$i];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_artikel']['name'][$i]) {

						$_FILES['file']['name']     = $_FILES['path_foto_artikel']['name'][$i];
						$_FILES['file']['type']     = $_FILES['path_foto_artikel']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['path_foto_artikel']['tmp_name'][$i];
						$_FILES['file']['error']    = $_FILES['path_foto_artikel']['error'][$i];
						$_FILES['file']['size']     = $_FILES['path_foto_artikel']['size'][$i];

						// $config['upload_path']      = './assets/backend/img/img_artikel';
						// $config['allowed_types']    = 'jpg|png|jpeg|gif';
						// $config['encrypt_name']     = 'TRUE';
						// $config['max_size']         = '2048';
						// $config['file_name']        = $_FILES['path_foto_artikel']['name'][$i];



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
							//         $path_foto_artikel = $this->upload->data('file_name');
							//     }
							// }
							// $id         = $this->input->post('id_artikel');
							// $urutan     = $this->input->post('urutan')[$i];
							// $ket_foto   = $this->input->post('ket_foto')[$i];

							$uploadData = $this->upload->data();
							$path_foto_artikel = $uploadData['file_name'];
							// $ket_foto  = $this->input->post('ket_foto')[$i];
							// $urutan     = $this->input->post('urutan')[$i];

							$data = array(
								'id_berita'        => $id,
								'path_foto_artikel' => $path_foto_artikel,
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
		$where = array('id_foto_berita' => $id);
		$this->main_model->deleteData($where, 't_foto_berita');

		json_encode(array('status' => 200));
	}
}
