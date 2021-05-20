<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keberatan extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('template');
		$this->load->model('keberatan/Keberatan_model', 'main_model', TRUE);
		$this->load->model('site/Site_model', 'site', TRUE);
		$this->load->helper('admin');
		// $this->load->library('encrypt');
		
	}


	public function index()
	{
		$data['alasan'] = $this->main_model->get_alasan();
		if(@$this->session->has_access[0]->nama_app != "Admin"){

			$key = $this->input->get('key');
           if($key != null || $key != ''){
			    
			$data['permohonan'] = $this->main_model->get_byhash($key);
			$data['tanggapan'] = $this->main_model->get_tanggapan();
			
			$this->template->render_home('keberatan/frontend/index',$data);
		   }else{
			   redirect(base_url());
		   }
		}else{
			$this->template->render('keberatan/backend/index');
            
		}
	}
	
	public function tambah_tanggal(){
		$jumlah = 16;
		echo date('Y-m-d H:i:s', strtotime(' + '.$jumlah.' day'));
	}

	public function ajax_insert(){


		$data = array(
			'id_permohonan' => $this->input->post('id_permohonan'),
			'no_permohonan' => $this->input->post('no_permohonan'),
			'rincian_informasi' => $this->input->post('rincian'),
			'tujuan' => $this->input->post('tujuan'),
			'nama_pemohon' => $this->input->post('nama_pemohon'),
			'alamat_pemohon' => $this->input->post('alamat_pemohon'),
			'no_tlp_pemohon' => $this->input->post('telepon_pemohon'),
			'pekerjaan_pemohon' => $this->input->post('pekerjaan_pemohon'),
			'nama_kuasa' => $this->input->post('nama_kuasa_pemohon'),
			'alamat_kuasa' => $this->input->post('alamat_kuasa'),
			'no_tlp_kuasa' => $this->input->post('telepon_kuasa_pemohon'),
			'id_alasan' => $this->input->post('alasan'),
			'kasus' => $this->input->post('kasus'),
			// 'tanggal_tanggapan' => $this->input->post('tanggal_tanggapan'),
			
		);
		$where = array(
			'id_keberatan' => $this->input->post('id'),
		);
		if(!$this->input->post('id')){
			$no_keberatan = array(
				// 'no_keberatan' => date('Ymd').'/'.date('Hmis').'/'.rand(1000, 9990),
				'no_keberatan' => null,
			);
			$this->main_model->insert_keberatan($data+$no_keberatan);
		}else{
			$this->main_model->update_keberatan( $where, $data);
		}
		$this->template->ajax(array('status'=>true));
	}

	public function ajax_no_tgl(){
		$data = array(
			'no_keberatan' => $this->input->post('no_keberatans'),
			'tanggal_tanggapan' => $this->input->post('tgl_tanggapan'),
		);
		$where = array(
			'id_keberatan' => $this->input->post('ids'),
		);
		
		$this->main_model->update_keberatan($where, $data);
		$this->template->ajax(array('status' => true ));
	}

	public function ajax_cek($id){
		// echo $id;
		$cek = $this->main_model->cek_keberatan($id);
		if( $cek > 0){
			$ada = 'ada';
		}else{
			$ada = 'ga ada';
		}
		$this->template->ajax(array('status'=> $ada));
	}

	public function ajax_list(){
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
			switch ($row->status_putusan) {
				case 'tolak':
					$row->status_putusan = '<center><a class="btn btn-sm btn-danger" style="pointer-events: none !important;"  href="javascript:void(0)" onclick="history(' . $row->id_keberatan . ')">Gugur</a></center>';
					break;
				case 'terima':
					$row->status_putusan = '<center><a class="btn btn-sm btn-primary" style="pointer-events: none !important;"  href="javascript:void(0)" onclick="history(' . $row->id_keberatan . ')">Diterima</a></center>';
					break;
				default:
					$row->status_putusan = '<center><a class="btn btn-sm btn-info" style="pointer-events: none !important;"  href="javascript:void(0)" onclick="history(' . $row->id_keberatan . ')">Belum Diputuskan</a></center>';
			}
			$row->hari_masuk = '<center>' . time_since(strtotime($row->cdd)) . '</center>';
			$row->batas_tanggapan = '<center>' . $row->tanggal_tanggapan . '</center>';
			$row->aksi = '
					<center>
					<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
							<i class="fas fa-cogs"></i>
						</button>
						<div class="dropdown-menu">
						<a class="dropdown-item" href="javascript:void(0)" onclick="edits(' . $row->id_keberatan . ')"><i class="fas fa-calendar"></i> No & Tgl Tanggapan</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="putusan(' . $row->id_keberatan . ')"><i class="fas fa-gavel"></i> Putusan</a>
						<a class="dropdown-item" href="javascript:void(0)" onclick="detail(' . $row->id_keberatan . ')"><i class="fas fa-eye"></i> Detail</a>
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

	public function ajax_edit($id){

		$data = $this->main_model->get_by_id($id);
		$data->alasan = $this->main_model->get_alasan();
		// $data['dasdasd']= 
		$this->template->ajax($data);
	}

	public function ajax_detail($id){
		$data = $this->main_model->get_by_id($id);
		$this->template->ajax($data);
	}

	public function ajax_putusan()
	{
		$id	= $this->input->post('id');
		$status	= $this->input->post('status_putusan');
		$pesan	= $this->input->post('pesan');

		$email = $this->input->post('email');

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
			}
		}

		$data = $this->main_model->get_by_id($id);
			if ($status == 'tolak') {

				$message_data = array(
					'header' => 'Keberatan Anda Ditolak ',
					'description' => '<b style="color: #777777;"> Maaf Keberatan Informasi Anda Ditolak </b><br>Karena : ' . $pesan . '',
					// 'confirm_link' => base_url('keberatan?key=') . $data->hash,
				);

				$this->main_model->send_email($data->email, $status, $message_data,$attach);
			} else if ($status == 'perbaikan') {
				$message_data = array(
					'header' => 'Perbaikan Keberatan',
					'description' => '<b style="color: #777777;"> Maaf Keberatan Informasi Anda Harus Diperbaiki </b><br>Karena : ' . $pesan . ' <br> Silahkan Kirim Melalui Email Ini Atau Datang Ke Kantor Dinas  : ',
					// 'confirm_link' => base_url('keberatan?key=').$data->hash,
				);

				$this->main_model->send_email($data->email, $status, $message_data,$attach);
			} else {
				$message_data = array(
					'header' => 'Keberatan Diterima',
					'description' => '<b style="color: #777777;"> Keberatan Informasi Anda Diterima </b><br>Informasi : ' . $pesan . ' <br>',
					// 'confirm_link' => base_url('keberatan?key=').$data->hash,
				);

				$this->main_model->send_email($data->email, $status, $message_data,$attach);
			}

		$data = array(
			'status_putusan' => $status,
			'pesan_putusan' => $pesan,
			'file_putusan' => $attach,
		);

		$this->main_model->update_keberatan(array('id_keberatan' => $id), $data);

		// $sata = array(
		// 	'id_permohonan' => $id,
		// 	'status_putusan' => $status,
		// 	'pesan' => $pesan,
		// 	'cby' => $this->session->id_user,
		// 	'cdd' => date('Y-m-d H:i:s'),
		// );
		// $this->main_model->insert_histori_permohonan($sata);
		$this->template->ajax(array('status' => true));
	}


}