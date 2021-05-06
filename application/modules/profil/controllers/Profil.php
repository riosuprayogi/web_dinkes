<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->load->model('profil/Profil_model', 'main_model', TRUE);
		$this->load->library('session');
		$this->load->library('cart');
		$this->load->library('curl');
	}


	public function index()
	{
		if ($this->session->id_user == "") {
			// $this->login();
			$data['profil'] = $this->main_model->get_isi('profil');
			$data['struktur'] = $this->main_model->get_isi_struktur('struktur');
			$data['visi'] = $this->main_model->get_isi('visi');
			$data['misi'] = $this->main_model->get_isi('misi');
			$data['maklumat'] = $this->main_model->get_isi('maklumat');
			$data['kontak'] = $this->main_model->get_kontak();
			$this->template->render_home('profil/index', $data);
		} else {

			$this->template->render('site/index');
		}
	}

	public function visi_misi()
	{
		$sata['visi'] = $this->main_model->get_isi_file('visi');
		// $sata['misi'] = $this->main_model->get_isi('misi');
		$data = $sata;
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('profil/frontend/visimisi', $data);
		} else {
			$this->template->render('profil/backend/visi_misi', $data);
			// echo json_encode($data['visi']['isi']);

		}
	}

	//ss

	public function gambaran_umum()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data = $this->main_model->get_isi('gambaran_umum');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			// $this->template->render_home('profil/frontend/intro', $data);
		} else {
			$this->template->render('profil/backend/gambaran_umum', $data);
			// echo json_encode($data);
		}
	}

	public function ruang_lingkup()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data = $this->main_model->get_isi('ruang_lingkup');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			// $this->template->render_home('profil/frontend/intro', $data);
		} else {
			$this->template->render('profil/backend/ruang_lingkup', $data);
			// echo json_encode($data);
		}
	}

	//ss

	public function ppid()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data = $this->main_model->get_isi('intro');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			// $this->template->render_home('profil/frontend/intro', $data);
		} else {
			$this->template->render('profil/backend/intro', $data);
			// echo json_encode($data);
		}
	}

	public function kepwal()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data['kepwal'] = $this->main_model->get_isi_file('kepwal');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			// $this->template->render_home('profil/frontend/intro', $data);
		} else {
			$this->template->render('profil/backend/kepwal', $data);
			// echo json_encode($data);
		}
	}

	//ss

	public function struk_organisasi()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data['profil'] = $this->main_model->get_isi_file('struk_organisasi');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			// $this->template->render_home('profil/frontend/intro', $data);
		} else {
			$this->template->render('profil/backend/struk_organisasi', $data);
			// echo json_encode($data);
		}
	}

	//ss


	public function profil_ppid()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data['profil'] = $this->main_model->get_isi_file('profil');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			// $this->template->render_home('profil/frontend/intro', $data);
		} else {
			$this->template->render('profil/backend/profil', $data);
			// echo json_encode($data);
		}
	}

	public function kontak()
	{

		$data = $this->main_model->get_kontak();
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('profil/frontend/kontak', $data);
		} else {
			$this->template->render('profil/backend/kontak', $data);
		}
	}

	public function struktur()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data['struktur'] = $this->main_model->get_isi_struktur('struktur');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('profil/frontend/struktur', $data);
		} else {
			// echo json_encode($data);die;
			$this->template->render('profil/backend/struktur', $data);
		}
	}

	public function image_slide()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data['image'] = $this->main_model->get_banner();
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('profil/frontend/image_slider', $data);
		} else {
			// echo json_encode($data);die;
			$this->template->render('profil/backend/image_slider', $data);
		}
	}

	public function maklumat()
	{

		// $this->template->render_home('profil/frontend/profil');
		$data['maklumat'] = $this->main_model->get_isi_file('maklumat');
		if (@$this->session->has_access[0]->nama_app != "Admin") {
			$this->template->render_home('profil/frontend/maklumat', $data);
		} else {
			// echo json_encode($data);die;
			$this->template->render('profil/backend/maklumat', $data);
		}
	}

	public function ajax_insert()
	{
		$opt = $this->input->post('option');
		$check = $this->main_model->cek_isi($opt);

		if ($check > 0) {
			$data = array(
				'isi' => $this->input->post('isi'),
			);
			$this->main_model->update(array('option' => $opt), $data);
		} else {
			$data = array(
				'isi' => $this->input->post('isi'),
				'option' => $opt,
			);
			$insert = $this->main_model->insert($data);
		}
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_insert_maklumat()
	{
		$opt = $this->input->get('option');
		$check = $this->main_model->cek_isi($opt);

		if ($check > 0) {
			$data = array(
				'isi' => $this->input->get('isi'),
			);
			$this->main_model->update(array('option' => $opt), $data);
		} else {
			$data = array(
				'isi' => $this->input->post('isi'),
				'option' => $opt,
			);
			$insert = $this->main_model->insert($data);
		}
		$this->template->ajax(array('status' => TRUE));
	}

	public function ajax_insert_kontak()
	{
		$id = $this->input->post('id');
		$check = $this->main_model->cek_kontak($id);

		$data = array(
			'alamat' => $this->input->post('alamat'),
			'no_tlp' => $this->input->post('no_tlp'),
			'no_fax' => $this->input->post('no_fax'),
			'email' => $this->input->post('email'),
		);
		if ($check > 0) {
			$this->main_model->update_kontak(array('id_kontak' => $id), $data);
		} else {
			$this->main_model->insert_kontak($data);
		}
		$this->template->ajax(array('status' => TRUE));
	}

	public function upload_image_summernote()
	{
		if (isset($_FILES["image"]["name"])) {
			$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
			$config['upload_path'] = './assets/media/image/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')) {
				$this->upload->display_errors();
				return FALSE;
			} else {
				$data = $this->upload->data();
				//Compress Image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/media/image/' . $data['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['quality'] = '60%';
				$config['width'] = 800;
				$config['height'] = 800;
				$config['new_image'] = './assets/media/image/' . $data['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				echo base_url() . 'assets/media/image/' . $data['file_name'];
			}
		}
	}

	function delete_image_summernote()
	{
		$src = $this->input->post('src');
		$file_name = str_replace(base_url(), '', $src);
		if (unlink($file_name)) {
			echo 'File Delete Successfully';
		}
	}



	public function ajax_delete_foto()
	{
		$id = $this->input->get('link');
		$this->main_model->delete_by_isi($id);
		$file_name = './assets/media/image/' . $id;
		if (unlink($file_name)) {
			$this->template->ajax(array('status' => TRUE));
		}
	}

	public function ajax_upload()
	{


		$uploadPath = './assets/media/image/';
		if (is_dir($uploadPath) === false) {
			mkdir($uploadPath, 0777, true);
		}



		$descount = count($_FILES['foto']['name']);
		if ($_FILES['foto']['name']) {
			for ($i = 0; $i < $descount; $i++) {
				$_FILES['upload_File']['name'] = $_FILES['foto']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['foto']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['foto']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['foto']['size'][$i];
				$config['upload_path'] = $uploadPath;
				$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
				$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('upload_File')) {
					$fileData = $this->upload->data();

					$opt = $this->input->post('option');
					$check = $this->main_model->cek_isi($opt);

					$sata = array(
						'isi' => $fileData['file_name'],
						'option' => $opt,
					);
					$this->main_model->insert($sata);
				} else {

					$this->template->ajax(array('status' => $this->upload->display_errors()));
				}
			}

			$this->template->ajax(array('status' => TRUE));
		} else {
			$this->template->ajax(array('status' => TRUE));
		}
	}

	public function ajax_upload_image_slider()
	{


		$uploadPath = './assets/media/image/';
		if (is_dir($uploadPath) === false) {
			mkdir($uploadPath, 0777, true);
		}

		$descount = count($_FILES['foto']['name']);
		if ($_FILES['foto']['name']) {
			for ($i = 0; $i < $descount; $i++) {
				$_FILES['upload_File']['name'] = $_FILES['foto']['name'][$i];
				$_FILES['upload_File']['type'] = $_FILES['foto']['type'][$i];
				$_FILES['upload_File']['tmp_name'] = $_FILES['foto']['tmp_name'][$i];
				$_FILES['upload_File']['error'] = $_FILES['foto']['error'][$i];
				$_FILES['upload_File']['size'] = $_FILES['foto']['size'][$i];
				$config['upload_path'] = $uploadPath;
				$config['file_name']  = md5(date("YmdHms") . '_' . rand(100, 999));
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ($this->upload->do_upload('upload_File')) {
					$fileData = $this->upload->data();

					$caption = $this->input->post('caption')[$i] ? $this->input->post('caption')[$i] : null;

					$sata = array(
						'image' => $fileData['file_name'],
						'caption' => $caption,

					);
					$this->main_model->insert_banner($sata);
				} else {

					$this->template->ajax(array('status' => $this->upload->display_errors()));
				}
			}

			$this->template->ajax(array('status' => TRUE));
		} else {
			$this->template->ajax(array('status' => TRUE));
		}
	}
}
