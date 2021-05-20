<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permohonan extends MX_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->module('template');
		$this->output->set_header('X-Frame-Options: SAMEORIGIN');
		$this->load->model('permohonan/Permohonan_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');
	}


	public function index()
	{
		if($this->input->get('key')){
			$key = $this->input->get('key');
			$data['permohonan'] = $this->main_model->get_byhash($key);
			$data['kategori'] = $this->main_model->get_kategori();
			$this->template->render_home('permohonan/frontend/form_edit', $data);
			// echo json_encode($data);
		}else{
			if (@$this->session->has_access[0]->nama_app != "Admin") {
				$data['kategori'] = $this->main_model->get_kategori();
				$data['cara_memperoleh'] = $this->main_model->get_cara();
				$data['bentuk'] = $this->main_model->get_bentuk();
				$this->template->render_home('permohonan/frontend/form', $data);
			}else {
				$this->template->render('permohonan/backend/index');
				// echo json_encode($data['visi']['isi']);
			}
		}
		
	}

	public function ajax_list()
	{
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		$length = isset($_GET['length']) ? intval($_GET['length']) : 10;
		$sort = isset($_GET['columns'][$_GET['order'][0]['column']]['data']) ? strval($_GET['columns'][$_GET['order'][0]['column']]['data']) : 'nama';
		$order = isset($_GET['order'][0]['dir']) ? strval($_GET['order'][0]['dir']) : 'asc';
		$filter = $_GET['filter'];

		$data = array();
		$pemohon = $this->main_model->get($start, $length, $sort,$order, $filter);
		// echo $this->db->last_quer
		$number = $_GET['start'] + 1;

		foreach ($pemohon as $row) {
			$row->no = $number++;
			switch ($row->status_lengkap) {
				case 'lengkap':
					$row->status_lengkap = '<center><a style="vertical-align : middle !important; color: green; pointer-events:none;" href="javascript:void(0)" onclick="detail(' . $row->id_permohonan . ')"> Lengkap</a></center>';
					break;
				case 'tidak lengkap':
					$row->status_lengkap = '<center><a style="vertical-align : middle !important; color: red; pointer-events:none;" href="javascript:void(0)" onclick="warn(' . $row->id_permohonan . ')">Tidak Lengkap</a></center>';
					break;
			}

			$row->tgl1 = new DateTime();
			$row->tgl2 = new DateTime($row->tanggal_tanggapan);
			switch ($row->status_putusan) {
				case 'perbaikan':
					if(  $row->tgl1 > $row->tgl2  ){
						// $this->main_model->update_permohonan(array('id_permohonan' => $row->id_permohonan), array('gagal_pending', 1));
						$row->status_putusan = '<center><a class="align-middle btn btn-sm btn-danger"  href="javascript:void(0)" onclick="history(' . $row->id_permohonan . ')">Ditolak Pending</a></center>';
					}else{
						$row->status_putusan = '<center><a class="align-middle btn btn-sm btn-warning"  href="javascript:void(0)" onclick="history(' . $row->id_permohonan . ')"> Perbaikan</a></center>';
					}
					break;
				case 'gugur':
					$row->status_putusan = '<center><a class="align-middle btn btn-sm btn-danger"  href="javascript:void(0)" onclick="history(' . $row->id_permohonan . ')">Ditolak</a></center>';
					break;
				case 'terima':
					$row->status_putusan = '<center><a class="align-middle btn btn-sm btn-primary"  href="javascript:void(0)" onclick="history(' . $row->id_permohonan . ')">Diterima</a></center>';
					break;
				default:
					$row->status_putusan = '<center><a class="align-middle btn btn-sm btn-info"  href="javascript:void(0)" onclick="history(' . $row->id_permohonan . ')">Belum Diputuskan</a></center>';
			}

			switch ($row->selesai_perbaikan) {
				case 'belum':
					$row->selesai_perbaikan = '<center><a style="vertical-align : middle !important; pointer-events:none;" class="align-middle btn btn-sm btn-warning"  href="javascript:void(0)" > BELUM</a></center>';
					break;
				case 'sudah':
					$row->selesai_perbaikan = '<center><a style="vertical-align : middle !important; pointer-events:none;" class="align-middle btn btn-sm btn-success"  href="javascript:void(0)" >SUDAH</a></center>';
					break;
				default:
					$row->selesai_perbaikan = '<center><a style="vertical-align : middle !important; pointer-events:none;" class="align-middle btn btn-sm btn-info"  href="javascript:void(0)" >Tidak Ada Perbaikan</a></center>';
			}


			$row->hari_masuk = '<center >'.indonesian_date_3(date_format(date_create($row->cdd),"Y-m-d")).' </center>';
			$row->aksi = '
					<center>
					<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="fas fa-cogs"></i>
						</button>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="javascript:void(0)" onclick="putusan(' . $row->id_permohonan . ')"><i class="fas fa-gavel"></i> Putusan</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="detail(' . $row->id_permohonan . ')"><i class="fas fa-eye"></i> Detail</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="edit(' . $row->id_permohonan . ')"><i class="fas fa-edit"></i> Edit</a>
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
		$data->history = $this->main_model->get_last_history($id);
		$data->kategori = $this->main_model->get_kategori();
		$data->cara_memperoleh = $this->main_model->get_cara();
		$data->bentuk = $this->main_model->get_bentuk();

		$this->template->ajax($data);
	}

	public function ajax_detail($id)
	{
		$data = $this->main_model->get_by_id($id);

		$this->template->ajax($data);
	}

	public function ajax_filter()
	{
		$data = (object) array();
		$data->kategori = $this->main_model->get_kategori();
		$data->cara_memperoleh = $this->main_model->get_cara();
		$data->bentuk = $this->main_model->get_bentuk();

		$this->template->ajax($data);
	}

	public function ajax_histori($id)
	{
		$data = (object) array();
		$data->histori = $this->main_model->get_all_history($id);
		$this->template->ajax($data);
	}


	public function ajax_upload()
	{
		$this->config->set_item('language', 'indonesian');

		$alamat = strip_tags($this->input->post('alamat'));
		$tujuan = strip_tags($this->input->post('tujuan'));
		$rincian = strip_tags($this->input->post('rincian'));
		$email = strip_tags($this->input->post('email'));
		$nik = strip_tags($this->input->post('nik'));
		$name = strip_tags($this->input->post('name'));
		$no_tlp = strip_tags($this->input->post('no_tlp'));
		$kategori = strip_tags($this->input->post('kategori'));
		$cara_memperoleh = $this->input->post('cara_memperoleh');
		$bentuk_informasi = $this->input->post('bentuk_informasi');

		$id = $this->input->post('id');



		if ($_FILES['ktp']['name']) {

			$uploadPathKtp = './assets/media/upload/' . date("Y/m/d") . '/ktp/';
			if (is_dir($uploadPathKtp) === false) {
				mkdir($uploadPathKtp, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathKtp;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;
			// $config['max_height']           = 768;

			$this->load->library('upload', $config, 'ktpUpload');
			$this->ktpUpload->initialize($config);

			if ($this->ktpUpload->do_upload('ktp')) {
				$ktp = $uploadPathKtp . $this->ktpUpload->data("file_name");
			}else{
				return $this->template->ajax(array('file'=>'KTP','gagal' => $this->ktpUpload->display_errors()));
			}

			// $this->template->ajax(array('status' => TRUE));

		} else {
			if ($this->input->post('file_ktp') == '') {
				$ktp = null;
			} else {
				$ktp = $this->input->post('file_ktp');
			}
		}

		if ($_FILES['kuasa']['name']) {

			$uploadPathkuasa = './assets/media/upload/'.date("Y/m/d").'/surat_kuasa/';
			if (is_dir($uploadPathkuasa) === false) {
				mkdir($uploadPathkuasa, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathkuasa;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;

			// $config['max_height']           = 768;

			$this->load->library('upload', $config, 'kuasaUpload');
			$this->kuasaUpload->initialize($config);
			if ($this->kuasaUpload->do_upload('kuasa')) {
				$kuasa = $uploadPathkuasa . $this->kuasaUpload->data("file_name");
			}else{
				return $this->template->ajax(array('file'=>'Surat Kuasa','gagal' => $this->kuasaUpload->display_errors()));
			}

			// $this->template->ajax(array('status' => TRUE));

		} else {
			if ($this->input->post('file_kuasa') == '') {
				$kuasa = null;
			} else {
				$kuasa = $this->input->post('file_kuasa');
			}
		}

		if ($_FILES['ktp_kuasa']['name']) {

			$uploadPathktp_kuasa = './assets/media/upload/' . date("Y/m/d") . '/pemberi_ktp_kuasa/';
			if (is_dir($uploadPathktp_kuasa) === false) {
				mkdir($uploadPathktp_kuasa, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathktp_kuasa;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;

			// $config['max_height']           = 768;

			$this->load->library('upload', $config, 'ktp_kuasaUpload');
			$this->ktp_kuasaUpload->initialize($config);

			if ($this->ktp_kuasaUpload->do_upload('ktp_kuasa')) {
				$ktp_kuasa = $uploadPathktp_kuasa . $this->ktp_kuasaUpload->data("file_name");
			}else{
				return $this->template->ajax(array('file'=>'KTP Pemberi Kuasa','gagal' => $this->ktp_kuasaUpload->display_errors()));
			}

			// $this->template->ajax(array('status' => TRUE));

		} else {
			if ($this->input->post('file_ktp_kuasa') == '') {
				$ktp_kuasa = null;
			} else {
				$ktp_kuasa = $this->input->post('file_ktp_kuasa');
			}
		}

		if ($_FILES['keterangan']['name']) {

			$uploadPathketerangan = './assets/media/upload/' . date("Y/m/d") . '/surat_keterangan/';
			if (is_dir($uploadPathketerangan) === false) {
				mkdir($uploadPathketerangan, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathketerangan;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;

			// $config['max_height']           = 768;

			$this->load->library('upload', $config, 'keteranganUpload');
			$this->keteranganUpload->initialize($config);

			if ($this->keteranganUpload->do_upload('keterangan')) {
				$keterangan = $uploadPathketerangan . $this->keteranganUpload->data("file_name");
			}else{
				return $this->template->ajax(array('file'=>'Surat Keterangan','gagal' => $this->keteranganUpload->display_errors()));
			}

			// $this->template->ajax(array('status' => TRUE));

		} else {
			if ($this->input->post('file_keterangan') == '') {
				$keterangan = null;
			} else {
				$keterangan = $this->input->post('file_keterangan');
			}
		}

		if ($_FILES['akta']['name']) {

			$uploadPathakta = './assets/media/upload/' . date("Y/m/d") . '/akta_notaris/';
			if (is_dir($uploadPathakta) === false) {
				mkdir($uploadPathakta, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathakta;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;

			// $config['max_height']           = 768;

			$this->load->library('upload', $config, 'aktaUpload');
			$this->aktaUpload->initialize($config);

			if ($this->aktaUpload->do_upload('akta')) {
				$akta = $uploadPathakta.$this->aktaUpload->data("file_name");
			}else{
				return $this->template->ajax(array('file'=>'Surat Akta','gagal' => $this->aktaUpload->display_errors()));
				
			}

			// $this->template->ajax(array('status' => TRUE));

		} else {
			if ($this->input->post('file_akta') == '') {
				$akta = null;
			} else {
				$akta = $this->input->post('file_akta');
			}
		}

		if ($_FILES['pengesahan']['name']) {

			$uploadPathpengesahan = './assets/media/upload/' . date("Y/m/d") . '/pengesahan_notaris/';
			if (is_dir($uploadPathpengesahan) === false) {
				mkdir($uploadPathpengesahan, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathpengesahan;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;

			// $config['max_height']           = 768;

			$this->load->library('upload', $config, 'pengesahanUpload');
			$this->pengesahanUpload->initialize($config);

			if ($this->pengesahanUpload->do_upload('pengesahan')) {
				$pengesahan = $uploadPathpengesahan.$this->pengesahanUpload->data("file_name");
			}else{
				return $this->template->ajax(array('file'=>'Surat Keterangan','gagal' => $this->pengesahanUpload->display_errors()));
			}

			// $this->template->ajax(array('status' => TRUE));

		} else {
			if ($this->input->post('file_pengesahan') == '') {
				$pengesahan = null;
			} else {
				$pengesahan = $this->input->post('file_pengesahan');
			}
		}

		

		switch ($kategori) {
			case '1':
				if ($ktp == null) {
					$status = 'tidak lengkap';
				} else {
					$status = 'lengkap';
				}
				break;
			case '2':
				if ($ktp == null || $kuasa == null || $ktp_kuasa == null) {
					$status = 'tidak lengkap';
				} else {
					$status = 'lengkap';
				}
				break;
			case '3':
				if ($ktp == null || $kuasa == null || $ktp_kuasa == null) {
					$status = 'tidak lengkap';
				} else {
					$status = 'lengkap';
				}
				break;
			case '4':
				if ($ktp == null || $kuasa == null || $ktp_kuasa == null || $akta == null || $pengesahan == null) {
					$status = 'tidak lengkap';
				} else {
					$status = 'lengkap';
				}
				break;
			case '5':
				if ($ktp == null || $kuasa == null || $ktp_kuasa == null || $akta == null  || $keterangan == null) {
					$status = 'tidak lengkap';
				} else {
					$status = 'lengkap';
				}
				break;
		}

		if (!$id) {
			$no = date('Ymd') . '/PPID/' . date('Hmis') . '/' . rand(1000, 9990);

			$cek = $this->main_model->get_last_no($no);
			if ($cek > 0) {
				$no = date('Ymd') . '/PPID/' . date('Hmis') . '/' . rand(1000, 9990);
			}

			$data = array(
				'no_permohonan' => $no,
				'nik' => $nik,
				'nama_pemohon' => $name,
				'alamat' => $alamat,
				'no_tlp' => $no_tlp,
				'email' => $email,
				'id_kategori_permohonan' => $kategori,
				'file_ktp ' => $ktp,
				'file_ktp_kuasa' => $ktp_kuasa,
				'file_surat_kuasa ' => $kuasa,
				'file_akta ' => $akta,
				'file_pengesahan ' => $pengesahan,
				'file_surat_keterangan' => $keterangan,
				'rincian_informasi' => $rincian,
				'tujuan' => $tujuan,
				'id_memperoleh_informasi' => $cara_memperoleh,
				'bentuk_informasi' => $bentuk_informasi,
				'status_lengkap' => $status,
				'cdd' => date('Y-m-d H:i:s'),
				'hash' => md5(rand(1, 9999) + time()),
				'tanggal_tanggapan' => date('Y-m-d', strtotime(' + 14 day')),

			);

			$this->main_model->insert_permohonan($data);
		} else {

			if($this->session->id_user){
				$user = $this->session->id_user;
			}else{
				$user = 0;
			}
			$data = array(
				'nik' => $nik,
				'nama_pemohon' => $name,
				'alamat' => $alamat,
				'no_tlp' => $no_tlp,
				'email' => $email,
				'id_kategori_permohonan' => $kategori,
				'file_ktp' => $ktp,
				'file_ktp_kuasa' => $ktp_kuasa,
				'file_surat_kuasa' => $kuasa,
				'file_akta' => $akta,
				'file_pengesahan' => $pengesahan,
				'file_surat_keterangan' => $keterangan,
				'rincian_informasi' => $rincian,
				'tujuan' => $tujuan,
				'id_memperoleh_informasi' => $cara_memperoleh,
				'bentuk_informasi' => $bentuk_informasi,
				'status_lengkap' => $status,
				'selesai_perbaikan' => 'sudah',
				'uby' => $user,
				'udd' => date('Y-m-d H:i:s'),
				'tanggal_perbaikan' => date('Y-m-d H:i:s'),
			);

			$this->main_model->update_permohonan(array('id_permohonan' => $this->input->post('id')), $data);
		}
		$this->template->ajax(array('status' => true));
	}

	public function ajax_putusan()
	{
		$id	= $this->input->post('id');
		$status	= $this->input->post('status_putusan');
		$pesan	= $this->input->post('pesan');


		

		$sata = array(
			'id_permohonan' => $id,
			'status_putusan' => $status,
			'pesan' => $pesan,
			'cby' => $this->session->id_user,
			'cdd' => date('Y-m-d H:i:s'),
		);
		$id_histori = $this->main_model->insert_histori_permohonan($sata);

		if ($_FILES['attach']['name']) {

			$uploadPathattach = './assets/media/upload/file_attach/';
			if (is_dir($uploadPathattach) === false) {
				mkdir($uploadPathattach, 0777, true);
			}

			$config['upload_path'] 			= $uploadPathattach;
			$config['file_name']  			= md5(date("YmdHms") . '_' . rand(100, 999));
			$config['allowed_types'] 		= 'gif|jpg|png|jpeg|pdf';
			$config['overwrite']			= true;
			$config['max_size']             = 5120; // 1MB
			// $config['max_width']            = 5120;

			// $config['max_height']           = 768;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('attach')) {
				$attach = $uploadPathattach . $this->upload->data("file_name");
				$data = array(
					'file' => $attach,
				);
				$this->main_model->update_histori_permohonan(array('id_histori' => $id_histori), $data);
			}
		}else{
			$attach = null;
		}

		$data = $this->main_model->get_by_id($id);
			if ($status == 'gugur') {

				$aksi = '<div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">
				<a href="'.base_url('keberatan?key=').$data->hash.'" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 15px; line-height: 21px; background-color: #6fb3e0;">&nbsp; Klik Disini &nbsp;</a>
				</div> ';

				$message_data = array(
					'header' => 'Permohonan Anda Ditolak ',
					'description' => '<b style="color: #777777;"> Maaf Permohonan Informasi Anda Ditolak </b><br>Karena : ' . $pesan . 'Jika Anda Keberatan Bisa Mengunjungi Link Berikut : '.$aksi,
					'confirm_link' => base_url('keberatan?key=') . $data->hash,
				);

				$this->main_model->send_email($data->email, $status, $message_data,$attach);

			} else if ($status == 'perbaikan') {
				$message_data = array(
					'header' => 'Perbaikan Permohonan',
					'description' => '<b style="color: #777777;"> Maaf Permohonan Informasi Anda Harus Diperbaiki </b><br>Karena : ' . $pesan . ' <br> Silahkan Kirim Klik <a href='.base_url('permohonan?key=').$data->hash.'> Disini </a> Ini Atau Datang Ke Kantor Dinas  : ',
					'confirm_link' => base_url('permohonan?key=').$data->hash,
				);

				$this->main_model->send_email($data->email, $status, $message_data,$attach);
			} else {
				$aksi = '<div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">
				<a href="'.base_url('keberatan?key=').$data->hash.'" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 15px; line-height: 21px; background-color: #6fb3e0;">&nbsp; Klik Disini &nbsp;</a>
				</div> ';
				$message_data = array(
					'header' => 'Permohonan Diterima',
					'description' => '<b style="color: #777777;"> Permohonan Informasi Anda Harus Diterima </b><br>Informasi : ' . $pesan . ' <br>Jika Anda Keberatan Bisa Mengunjungi Link Berikut : '.$aksi,
					'confirm_link' => base_url('keberatan?key=').$data->hash,
				);

				$this->main_model->send_email($data->email, $status, $message_data,$attach);
			}

		if($status == 'perbaikan'){
			$status_perbaikan = 'belum';
		}else if($status == 'terima'){
			$status_perbaikan = 'sudah';
		}else{
			$status_perbaikan = null;
		}

		$data = array(
			'status_putusan' => $status,
			'pesan_putusan' => $pesan,
			'selesai_perbaikan' => $status_perbaikan,
		);

		$this->main_model->update_permohonan(array('id_permohonan' => $id), $data);
		$this->template->ajax(array('status' => true));
	}

	public function ajax_cek_nik($nik = ''){
		$data = (object) array();

		//if(!$this->warga->cek_warga($nik)){
			$useragent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
			$json_url = 'https://service-tlive.tangerangkota.go.id/services/tlive/ceknik/cek_nik/'.$nik;
			$ch = curl_init( $json_url );
			curl_setopt($ch, CURLOPT_USERAGENT, $useragent );
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERPWD, 'r35t4p12:8540c5ef27b4afdb197405dc551ce5b5bfcb73bb2');
			$hasil = json_decode(curl_exec($ch),true);
			$result =  @$hasil['decode'];
			if($result){
				$result['nik'] = $result[0]['NIK'];
				$result['nama'] = $result[0]['NAMA_LGKP'];
				$result['no_kk'] = $result[0]['NO_KK'];
				$result['jenis_kelamin'] = ($result[0]['JENIS_KLMIN'] == 'Laki-Laki' ? 'L' : 'P');
				$result['tempat_lahir'] = $result[0]['TMPT_LHR'];
				$result['tanggal_lahir'] = date('Y-m-d', strtotime($result[0]['TGL_LHR']));
				$result['alamat'] = $result[0]['ALAMAT'];
			}

			$data->warga = @$result;
			// $data->warga = null; 

		// }else{
		// 	$data->user = 'terdaftar';
		// }
		$this->template->ajax($data);
	}


	///////// Form Kuisioner////////

	public function kuisioner(){
		$this->template->render_home('permohonan/frontend/form_kuisioner');

		// header( "refresh:15;url=".base_url() );
	}



}
