<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('permohonan/Permohonan_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		$this->load->library('encrypt');

		
  }
  public function upload()
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

}