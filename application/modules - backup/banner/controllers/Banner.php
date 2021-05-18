<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('banner/Banner_model', 'main_model', TRUE);
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


	public function index()
	{
		$data['title'] = "Input Artikel";

		// $listProfiles = $this->db->query("SELECT web_artikel.*, web_kategori_artikel.*, web_admin.nama_admin
		//                                 FROM web_artikel
		//                                 JOIN web_kategori_artikel ON web_artikel.id_kat_artikel = web_kategori_artikel.id_kat_artikel
		//                                 JOIN web_admin ON web_admin.id_admin = web_artikel.id_admin
		//                                 ORDER BY tgl_jam DESC");
		$listProfiles = $this->db->query("SELECT t_banner.*
                                        FROM t_banner
										WHERE t_banner.trash='0' 
										ORDER BY t_banner.tgl_jam DESC
                                        ");
		$arrProfile = [];
		$arr = [];
		foreach ($listProfiles->result_array() as $key => $row) {
			$result = $this->db->query("SELECT * FROM t_detail_banner WHERE id_banner=" . $row['id_banner'] . "")->result_array();

			if ($result) {
				$arr = array(
					"id_banner"        => $row["id_banner"],
					"nama_banner"    => $row["nama_banner"],
					"status"  => $row["status"],
					// "id_admin"     => $row["id_admin"],
					"tgl_jam"           => $row["tgl_jam"],
					// "path_detail_foto" => $result
					"t_detail_banner" => $result
				);
				array_push($arrProfile, $arr);
			}
		}

		$data["t_banner"] = $arrProfile;

		// var_dump($data);
		// die();
		// $data['alasan'] = $this->main_model->get_alasan();
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('banner/frontend/index');
		} else {
			$this->template->render('banner/backend/index', $data);
		}
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
			'nama_banner' => $this->input->post('nama_banner', TRUE),
			'status' => $this->input->post('status', TRUE),
			// 'id_admin' => $this->input->post('id_admin', TRUE),
		);
		$where = array(
			'id' => $this->input->post('id'),
		);


		if (!$this->input->post('id')) {
			$id = $this->main_model->insert_banner($data);
			if ($id) {
				$count = count($_FILES['path_foto_banner']['name']);
				$tempArr = [];
				for ($i = 0; $i < $count; $i++) {
					$_FILES['upload_File']['name'] = $_FILES['path_foto_banner']['name'][$i];
					$_FILES['upload_File']['name'] = $_FILES['path_foto_banner']['name'][$i];
					$_FILES['upload_File']['type'] = $_FILES['path_foto_banner']['type'][$i];
					$_FILES['upload_File']['tmp_name'] = $_FILES['path_foto_banner']['tmp_name'][$i];
					$_FILES['upload_File']['error'] = $_FILES['path_foto_banner']['error'][$i];
					$_FILES['upload_File']['size'] = $_FILES['path_foto_banner']['size'][$i];

					$uploadPath = './assets/backend/img/img_banner/';
					$config['upload_path'] = $uploadPath;
					$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if ($this->upload->do_upload('upload_File')) {
						$ket_foto   = $this->input->post('ket_foto')[$i];
						$fileData = $this->upload->data();
						$foto = $fileData['file_name'];
						$data2 = array(
							'id_banner' => $id,
							'path_foto_banner' => $foto,
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
			$this->main_model->update_banner($where, $data);
			$this->template->ajax(array('status' => true));
		}
	}


	public function ajax_add()
	{
		$this->cart->destroy();
		$data = (object) array();
		// $data->kategori = $this->main_model->get_kategori();
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
		$album = $this->main_model->get($start, $length, $sort, $order, $filter);
		$number = $_GET['start'] + 1;

		foreach ($album as $row) {
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

		$this->template->ajax($data);
	}

	public function ajax_delete($id)
	{
		$data = array(
			'trash' => '1',
		);
		$this->main_model->update_banner(array('id_banner' => $id), $data);
		$this->template->ajax(array('status' => true));
		redirect("banner");
	}



	public function edit($id)
	{
		$where = array('id_banner' => $id);

		$data["t_banner"] = $this->db->query("SELECT * FROM t_banner WHERE id_banner = '$id'")->result();

		// $data['t_kategori'] = $this->db->query("SELECT * FROM t_kategori WHERE trash='0'")->result(); // join buat ambil data di combobox

		$data['t_detail_banner'] = $this->db->query("SELECT * FROM t_detail_banner WHERE id_banner = '$id'")->result_array();


		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('banner/frontend/index');
		} else {
			$this->template->render('banner/backend/edit', $data);
		}
	}

	public function _rules()
	{
		// $this->form_validation->set_rules('id_kat_artikel', 'kategori artikel', 'required');
		$this->form_validation->set_rules('nama_album', 'nama album', 'required');

		$this->form_validation->set_rules('status', 'status', 'required');
		// $this->form_validation->set_rules('path_foto_banner', '', 'callback_file_check');   
		// $this->form_validation->set_rules('id_admin', 'nama admin', 'required');
	}




	public function updateDataAksi()
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {
			$id             = $this->input->post('id_banner');
			$nama_banner  = $this->input->post('nama_banner');
			$status        = $this->input->post('status');
			$id_admin       = $this->input->post('id_admin');

			$data = array(
				'nama_banner'     => $nama_banner,
				'status'           => $status,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_banner' => $id
			);

			$this->main_model->update_data('t_banner', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_banner_update')); $i++) {

				$id_detail_path_foto_banner_update  = $this->input->post('id_detail_path_foto_banner_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_detail_foto' => $id_detail_path_foto_banner_update
				);
				$this->main_model->update_data('t_detail_foto_galery', $data, $where);
			}

			$file = $_FILES;
			if (!empty($file['path_foto_banner']['name'][0])) {

				// $count = count($_FILES['path_foto_banner']['name']);

				// $config['upload_path']      = './assets/backend/img/img_berita';
				// $config['allowed_types']    = 'jpg|png|jpeg|gif';
				// $config['max_size']         = '5120';
				// $config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_banner']['name'][$i];

				$count = count($_FILES['path_foto_banner']['name']);
				$tempArr = [];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_banner']['name'][$i]) {

						for ($i = 0; $i < $count; $i++) {
							$_FILES['upload_File']['name'] = $_FILES['path_foto_banner']['name'][$i];
							$_FILES['upload_File']['name'] = $_FILES['path_foto_banner']['name'][$i];
							$_FILES['upload_File']['type'] = $_FILES['path_foto_banner']['type'][$i];
							$_FILES['upload_File']['tmp_name'] = $_FILES['path_foto_banner']['tmp_name'][$i];
							$_FILES['upload_File']['error'] = $_FILES['path_foto_banner']['error'][$i];
							$_FILES['upload_File']['size'] = $_FILES['path_foto_banner']['size'][$i];
							$uploadPath = './assets/backend/img/img_galery/';
							$config['upload_path'] = $uploadPath;
							$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$ket_foto  = $this->input->post('ket_foto')[$i];
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							if ($this->upload->do_upload('upload_File')) {
								$fileData = $this->upload->data();
								$foto = $fileData['file_name'];
								$data2 = array(
									'id_foto_galery' => $id,
									'path_foto_banner' => $foto,
									'ket_foto'          => $ket_foto
								);
								$this->main_model->insert_foto($data2);
								$tempArr["file_name"] = 'success' . $_FILES['upload_File']['name'];
								redirect('foto');
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
			redirect('foto');
		}
	}


	public function updateDataAksis()
	{

		date_default_timezone_set('Asia/Jakarta');
		$dateTime = date('Y-m-d H:i:s');
		// $this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->edit($id = null);
		} else {
			$id             = $this->input->post('id_berita');
			$id_kategori = $this->input->post('id_kategori');
			$judul_berita  = $this->input->post('judul_berita');
			$status        = $this->input->post('status');
			$id_admin       = $this->input->post('id_admin');
			$isi_berita    = $this->input->post('isi_berita');

			$data = array(
				'id_kategori'    => $id_kategori,
				'judul_berita'     => $judul_berita,
				'status'           => $status,
				'isi_berita'       => $isi_berita,
				'id_admin'          => $id_admin,
				'tgl_jam'           => $dateTime
			);

			$where = array(
				'id_berita' => $id
			);

			$this->main_model->update_data('t_berita', $data, $where);

			// looping untuk update keterangan image
			for ($i = 0; $i < count($this->input->post('id_detail_path_foto_banner_update')); $i++) {

				$id_detail_path_foto_banner_update  = $this->input->post('id_detail_path_foto_banner_update')[$i];
				$ket_foto_update        = $this->input->post('ket_foto_update')[$i];

				$data = array(
					'ket_foto'     => $ket_foto_update
				);
				$where = array(
					'id_foto_artikel' => $id_detail_path_foto_banner_update
				);
				$this->main_model->update_data('t_foto_berita', $data, $where);
			}

			$file = $_FILES;




			if (!empty($file['path_foto_banner']['name'][0])) {

				$count = count($_FILES['path_foto_banner']['name']);

				$config['upload_path']      = './assets/backend/img/img_berita';
				$config['allowed_types']    = 'jpg|png|jpeg|gif';
				$config['max_size']         = '2048';
				$config['encrypt_name']     = 'TRUE';
				// $config['file_name']        = $_FILES['path_foto_banner']['name'][$i];

				for ($i = 0; $i < $count; $i++) {

					if ($_FILES['path_foto_banner']['name'][$i]) {

						$_FILES['file']['name']     = $_FILES['path_foto_banner']['name'][$i];
						$_FILES['file']['type']     = $_FILES['path_foto_banner']['type'][$i];
						$_FILES['file']['tmp_name'] = $_FILES['path_foto_banner']['tmp_name'][$i];
						$_FILES['file']['error']    = $_FILES['path_foto_banner']['error'][$i];
						$_FILES['file']['size']     = $_FILES['path_foto_banner']['size'][$i];

						// $config['upload_path']      = './assets/backend/img/img_artikel';
						// $config['allowed_types']    = 'jpg|png|jpeg|gif';
						// $config['encrypt_name']     = 'TRUE';
						// $config['max_size']         = '2048';
						// $config['file_name']        = $_FILES['path_foto_banner']['name'][$i];

						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file')) {
							$this->session->set_flashdata(
								'pesan',
								'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Maaf :(!</strong> Upload gagal, format photo (jpg,jpeg,png) ukuran file max 2 Mb.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>'
							);
							return $this->edit($id);
						} else {
							//         $path_foto_banner = $this->upload->data('file_name');
							//     }
							// }
							// $id         = $this->input->post('id_artikel');
							// $urutan     = $this->input->post('urutan')[$i];
							// $ket_foto   = $this->input->post('ket_foto')[$i];

							$uploadData = $this->upload->data();
							$path_foto_banner = $uploadData['file_name'];
							$ket_foto  = $this->input->post('ket_foto')[$i];
							$urutan     = $this->input->post('urutan')[$i];

							$data = array(
								'id_berita'        => $id,
								'path_foto_banner' => $path_foto_banner,
								'urutan'            => $urutan,
								'ket_foto'          => $ket_foto
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
			redirect("berita");
		}
	}

	public function deleteImageAjax($id)
	{
		$where = array('id_detail_foto' => $id);
		$this->main_model->deleteData($where, 't_detail_foto_galery');

		json_encode(array('status' => 200));
	}
}
